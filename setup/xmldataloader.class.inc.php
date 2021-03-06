<?php
// Copyright (C) 2010 Combodo SARL
//
//   This program is free software; you can redistribute it and/or modify
//   it under the terms of the GNU General Public License as published by
//   the Free Software Foundation; version 3 of the License.
//
//   This program is distributed in the hope that it will be useful,
//   but WITHOUT ANY WARRANTY; without even the implied warranty of
//   MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
//   GNU General Public License for more details.
//
//   You should have received a copy of the GNU General Public License
//   along with this program; if not, write to the Free Software
//   Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA

/**
 * Load XML data from a set of files
 *
 * @author      Erwan Taloc <erwan.taloc@combodo.com>
 * @author      Romain Quetiez <romain.quetiez@combodo.com>
 * @author      Denis Flaven <denis.flaven@combodo.com>
 * @license     http://www.opensource.org/licenses/gpl-3.0.html LGPL
 */

define ('KEYS_CACHE_FILE', APPROOT.'/keyscache.tmp');
/**
 * Class to load sets of objects from XML files into the database
 * XML files can be produced by the 'export' web service or by any other means
 * Here is a simple example:
 * $oLoader  = new XMLDataLoader('../itop-config.php');
 * $oLoader->StartSession();
 * $oLoader->LoadFile('./organizations.xml');
 * $oLoader->LoadFile('./locations.xml');
 * $oLoader->EndSession();
 */
class XMLDataLoader
{
	protected $m_aKeys;
	protected $m_aObjectsCache;
	protected $m_bSessionActive;
	protected $m_oChange;
	protected $m_sCacheFileName;

	protected $m_aErrors;
	protected $m_aWarnings;
	protected $m_iCountCreated;

	public function __construct()
	{
		$this->m_aKeys = array();
		$this->m_aObjectsCache = array();
		$this->m_oChange = null;
		$this->m_sCacheFileName = KEYS_CACHE_FILE;
		$this->LoadKeysCache();
		$this->m_bSessionActive = true;
		$this->m_aErrors = array();
		$this->m_aWarnings = array();
		$this->m_iCountCreated = 0;
	}
	
	public function StartSession($oChange)
	{
		// Do cleanup any existing cache file (shall not be necessary unless a setup was interrupted abruptely)
		$this->ClearKeysCache();

		$this->m_oChange = $oChange;
		$this->m_bSessionActive  = true;
	}
	
	public function EndSession($bStrict = false)
	{
		$this->ResolveExternalKeys();
		$this->m_bSessionActive  = false;

		if (count($this->m_aErrors) > 0)
		{
			return false;
		}
		elseif ($bStrict && count($this->m_aWarnings) > 0)
		{
			return false;
		}
		else
		{
			return true;
		}
	}

	public function GetErrors()
	{
		return $this->m_aErrors;
	}

	public function GetWarnings()
	{
		return $this->m_aWarnings;
	}

	public function GetCountCreated()
	{
		return $this->m_iCountCreated;
	}
	
	public function __destruct()
	{
		// Stopping in the middle of a session, let's save the context information
		if ($this->m_bSessionActive)
		{
			$this->SaveKeysCache();
		}
		else
		{
			$this->ClearKeysCache();
		}
	}
			
	/**
	 * Stores the keys & object cache in a file
	 */
	protected function SaveKeysCache()
	{
		$hFile = @fopen($this->m_sCacheFileName, 'w');
		if ($hFile !== false)
		{
			$sData = serialize( array('keys' => $this->m_aKeys,
									'objects' => $this->m_aObjectsCache,
									'change' => $this->m_oChange,
									'errors' => $this->m_aErrors,
									'warnings' => $this->m_aWarnings,
									));
			fwrite($hFile, $sData);
			fclose($hFile);
		}
		else
		{
			throw new Exception("Cannot write to file: '{$this->m_sCacheFileName}'");
		}
	}
		 	
	/**
	 * Loads the keys & object cache from the tmp file
	 */
	protected function LoadKeysCache()
	{
		$sFileContent = @file_get_contents($this->m_sCacheFileName);
		if (!empty($sFileContent))
		{
			$aCache = unserialize($sFileContent);
			$this->m_aKeys = $aCache['keys'];
			$this->m_aObjectsCache = $aCache['objects']; 
			$this->m_oChange = $aCache['change'];
			$this->m_aErrors = $aCache['errors'];
			$this->m_aWarnings = $aCache['warnings'];
		}
	}	 	
	
	/**
	 * Remove the tmp file used to store the keys cache
	 */
	protected function ClearKeysCache()
	{
		if(is_file($this->m_sCacheFileName))
		{
			unlink($this->m_sCacheFileName);
		}
		else
		{
			//echo "<p>Hm, it looks like the file does not exist!!!</p>";
		}
		$this->m_aKeys = array();
		$this->m_aObjectsCache = array(); 
	}	 	
	
	/**
	 * Helper function to load the objects from a standard XML file into the database
	 */
	function LoadFile($sFilePath)
	{
		global $aKeys;
		
		$oXml = simplexml_load_file($sFilePath);
		
		$aReplicas  = array();
		foreach($oXml as $sClass => $oXmlObj)
		{
			if (!MetaModel::IsValidClass($sClass))
			{
				SetupWebPage::log_error("Unknown class - $sClass");
				throw(new Exception("Unknown class - $sClass"));
			}

			$iSrcId = (integer)$oXmlObj['id']; // Mandatory to cast
			
			// Import algorithm
			// Here enumerate all the attributes of the object
			// for all attribute that is neither an external field
			// not an external key, assign it
			// Store all external keys for further reference
			// Create the object an store the correspondance between its newly created Id
			// and its original Id
			// Once all the objects have been created re-assign all the external keys to
			// their actual Ids
			$oTargetObj = MetaModel::NewObject($sClass);
			foreach($oXmlObj as $sAttCode => $oSubNode)
			{
				if (!MetaModel::IsValidAttCode($sClass, $sAttCode))
				{
					$sMsg = "Unknown attribute code - $sClass/$sAttCode";
					SetupWebPage::log_error($sMsg);
					throw(new Exception($sMsg));
				}

				$oAttDef = MetaModel::GetAttributeDef($sClass, $sAttCode);
				if (($oAttDef->IsWritable()) && ($oAttDef->IsScalar()))
				{
					if ($oAttDef->IsExternalKey())
					{
						if (substr(trim($oSubNode), 0, 6) == 'SELECT')
						{
							$sQuery = trim($oSubNode);
							$oSet = new DBObjectSet(DBObjectSearch::FromOQL($sQuery));
							$iMatches = $oSet->Count();
							if ($iMatches == 1)
							{
								$oFoundObject = $oSet->Fetch();
								$iExtKey = $oFoundObject->GetKey();
							}
							else
							{
								$sMsg = "Ext key not reconcilied - $sClass/$iSrcId - $sAttCode: '".$sQuery."' - found $iMatches matche(s)";
								SetupWebPage::log_error($sMsg);
								$this->m_aErrors[] = $sMsg;
								$iExtKey = 0;
							}
						}
						else
						{
							$iDstObj = (integer)($oSubNode);
							// Attempt to find the object in the list of loaded objects
							$iExtKey = $this->GetObjectKey($oAttDef->GetTargetClass(), $iDstObj);
							if ($iExtKey == 0)
							{
								$iExtKey = -$iDstObj; // Convention: Unresolved keys are stored as negative !
								$oTargetObj->RegisterAsDirty();
							}
							// here we allow external keys to be invalid because we will resolve them later on...
						}
						//$oTargetObj->CheckValue($sAttCode, $iExtKey);
						$oTargetObj->Set($sAttCode, $iExtKey);
					}
					elseif ($oAttDef instanceof AttributeBlob)
					{
						$sMimeType = (string) $oSubNode->mimetype;
						$sFileName = (string) $oSubNode->filename;
						$data = base64_decode((string) $oSubNode->data);
						$oDoc = new ormDocument($data, $sMimeType, $sFileName);
						$oTargetObj->Set($sAttCode, $oDoc);
					}
					else
					{
						$value = (string)$oSubNode;

						if ($value == '')
						{
							$value = $oAttDef->GetNullValue();
						}

						$res = $oTargetObj->CheckValue($sAttCode, $value);
						if ($res !== true)
						{
							// $res contains the error description
							$sMsg = "Value not allowed - $sClass/$iSrcId - $sAttCode: '".$oSubNode."' ; $res";
							SetupWebPage::log_error($sMsg);
							$this->m_aErrors[] = $sMsg;
						}
						$oTargetObj->Set($sAttCode, $value);
					}
				}
			}
			$this->StoreObject($sClass, $oTargetObj, $iSrcId);
		}
		return true;
	}
	
	/**
	 * Get the new ID of an object in the database given its original ID
	 * This may fail (return 0) if the object has not yet been created in the database
	 * This is why the order of the import may be important  
	 */ 
	protected function GetObjectKey($sClass, $iSrcId)
	{
		if (isset($this->m_aKeys[$sClass]) && isset($this->m_aKeys[$sClass][$iSrcId]))
		{
			return $this->m_aKeys[$sClass][$iSrcId];
		}
		return 0;
	}
	
	/**
	 * Store an object in the database and remember the mapping
	 * between its original ID and the newly created ID in the database
	 */  
	protected function StoreObject($sClass, $oTargetObj, $iSrcId, $bSearch = false)
	{
		$iObjId = 0;
		try
		{
			if ($bSearch)
			{
				// Check if the object does not already exist, based on its usual reconciliation keys...
				$aReconciliationKeys = MetaModel::GetReconcKeys($sClass);
				if (count($aReconciliationKeys) > 0)
				{
					// Some reconciliation keys have been defined, use them to search for the object
					$oSearch = new DBObjectSearch($sClass);
					$iConditionsCount  = 0;
					foreach($aReconciliationKeys as $sAttCode)
					{
						if ($oTargetObj->Get($sAttCode) != '')
						{
							$oSearch->AddCondition($sAttCode, $oTargetObj->Get($sAttCode), '=');
							$iConditionsCount++;
						}
					}
					if ($iConditionsCount > 0) // Search only if there are some valid conditions...
					{
						$oSet = new DBObjectSet($oSearch);
						if ($oSet->count() == 1)
						{
							// The object already exists, reuse it
							$oExistingObject = $oSet->Fetch();
							$iObjId = $oExistingObject->GetKey();
						}
					}
				}
			}	
			
			if ($iObjId == 0)
			{
				// No similar object found for sure, let's create it
				if (is_subclass_of($oTargetObj, 'CMDBObject'))
				{
			        $iObjId = $oTargetObj->DBInsertTrackedNoReload($this->m_oChange);
				}
				else
				{
			        $iObjId = $oTargetObj->DBInsertNoReload();
				}
				$this->m_iCountCreated++;
			}	        
		}
		catch(Exception $e)
		{
			SetupWebPage::log_error("An object could not be recorded - $sClass/$iSrcId - ".$e->getMessage());
			$this->m_aErrors[] = "An object could not be recorded - $sClass/$iSrcId - ".$e->getMessage();
		}
		$aParentClasses = MetaModel::EnumParentClasses($sClass);
		$aParentClasses[] = $sClass;
		foreach($aParentClasses as $sObjClass)
		{
			$this->m_aKeys[$sObjClass][$iSrcId] = $iObjId;
		}
		$this->m_aObjectsCache[$sClass][$iObjId] = $oTargetObj;
	}
	
	/**
	 * Maps an external key to its (newly created) value
	 */
	 
	protected function ResolveExternalKeys()
	{
		foreach($this->m_aObjectsCache as $sClass => $oObjList)
		{
			foreach($oObjList as $oTargetObj)
			{	
				$bChanged = false;
				$sClass = get_class($oTargetObj);
				foreach(MetaModel::ListAttributeDefs($sClass) as $sAttCode=>$oAttDef)
				{
					if ( ($oAttDef->IsExternalKey()) && ($oTargetObj->Get($sAttCode) < 0) ) // Convention unresolved key = negative
					{
						$sTargetClass = $oAttDef->GetTargetClass();
						$iTempKey = $oTargetObj->Get($sAttCode);

						$iExtKey = $this->GetObjectKey($sTargetClass, -$iTempKey);
						if ($iExtKey == 0)
						{
							$sMsg = "unresolved extkey in $sClass::".$oTargetObj->GetKey()."(".$oTargetObj->GetName().")::$sAttCode=$sTargetClass::$iTempKey";
							SetupWebPage::log_warning($sMsg);
							$this->m_aWarnings[] = $sMsg;
							//echo "<pre>aKeys[".$sTargetClass."]:\n";
							//print_r($this->m_aKeys[$sTargetClass]);
							//echo "</pre>\n";
						}
						else
						{
							$bChanged = true;
							$oTargetObj->Set($sAttCode, $iExtKey);
						}
					}
				}
				if ($bChanged)
				{
					try
					{
						if (is_subclass_of($oTargetObj, 'CMDBObject'))
						{
					        $oTargetObj->DBUpdateTracked($this->m_oChange);
						}
						else
						{
					        $oTargetObj->DBUpdate();
						}
					}
					catch(Exception $e)
					{
						$this->m_aErrors[] = "The object changes could not be tracked - $sClass/$iSrcId - ".$e->getMessage();
					}
				}
			}
		}
	
		return true;
	}
}
?>
