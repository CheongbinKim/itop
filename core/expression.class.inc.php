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
 * General definition of an expression tree (could be OQL, SQL or whatever) 
 *
 * @author      Erwan Taloc <erwan.taloc@combodo.com>
 * @author      Romain Quetiez <romain.quetiez@combodo.com>
 * @author      Denis Flaven <denis.flaven@combodo.com>
 * @license     http://www.opensource.org/licenses/gpl-3.0.html LGPL
 */

class MissingQueryArgument extends CoreException
{
}

abstract class Expression
{
	// recursive translation of identifiers
	abstract public function GetUnresolvedFields($sAlias, &$aUnresolved);
	abstract public function Translate($aTranslationData, $bMatchAll = true, $bMarkFieldsAsResolved = true);

	// recursive rendering (aArgs used as input by default, or used as output if bRetrofitParams set to True
	abstract public function Render(&$aArgs = null, $bRetrofitParams = false);

	// recursively builds an array of class => fieldname
	abstract public function ListRequiredFields();

	abstract public function IsTrue();

	public function RequiresField($sClass, $sFieldName)
	{
		// #@# todo - optimize : this is called quite often when building a single query !
		$aRequired = $this->ListRequiredFields();
		if (!in_array($sClass.'.'.$sFieldName, $aRequired)) return false;
		return true;
	}

	public function serialize()
	{
		return base64_encode($this->Render());
	}
	
	static public function unserialize($sValue)
	{
		return self::FromOQL(base64_decode($sValue));
	}

	static public function FromOQL($sConditionExpr)
	{
		$oOql = new OqlInterpreter($sConditionExpr);
		$oExpression = $oOql->ParseExpression();
		
		return $oExpression;
	}

	static public function FromSQL($sSQL)
	{
		$oSql = new SQLExpression($sSQL);
		return $oSql;
	}

	public function LogAnd($oExpr)
	{
		if ($this->IsTrue()) return clone $oExpr;
		if ($oExpr->IsTrue()) return clone $this;
		return new BinaryExpression($this, 'AND', $oExpr);
	}

	public function LogOr($oExpr)
	{
		return new BinaryExpression($this, 'OR', $oExpr);
	}
	
	abstract public function RenameParam($sOldName, $sNewName);
}

class SQLExpression extends Expression
{
	protected $m_sSQL;

	public function __construct($sSQL)
	{
		$this->m_sSQL  = $sSQL;
	}

	public function IsTrue()
	{
		return false;
	}

	// recursive rendering
	public function Render(&$aArgs = null, $bRetrofitParams = false)
	{
		return $this->m_sSQL;
	}

	public function GetUnresolvedFields($sAlias, &$aUnresolved)
	{
	}

	public function Translate($aTranslationData, $bMatchAll = true, $bMarkFieldsAsResolved = true)
	{
		return clone $this;
	}

	public function ListRequiredFields()
	{
		return array();
	}
	
	public function RenameParam($sOldName, $sNewName)
	{
		// Do nothing, since there is nothing to rename
	}
}



class BinaryExpression extends Expression
{
	protected $m_oLeftExpr; // filter code or an SQL expression (later?)
	protected $m_oRightExpr;
	protected $m_sOperator;

	public function __construct($oLeftExpr, $sOperator, $oRightExpr)
	{
		if (!is_object($oLeftExpr))
		{
			throw new CoreException('Expecting an Expression object on the left hand', array('found_type' => gettype($oLeftExpr)));
		}
		if (!is_object($oRightExpr))
		{
			throw new CoreException('Expecting an Expression object on the right hand', array('found_type' => gettype($oRightExpr)));
		}
		if (!$oLeftExpr instanceof Expression)
		{
			throw new CoreException('Expecting an Expression object on the left hand', array('found_class' => get_class($oLeftExpr)));
		}
		if (!$oRightExpr instanceof Expression)
		{
			throw new CoreException('Expecting an Expression object on the right hand', array('found_class' => get_class($oRightExpr)));
		}
		$this->m_oLeftExpr  = $oLeftExpr;
		$this->m_oRightExpr = $oRightExpr;
		$this->m_sOperator  = $sOperator;
	}

	public function IsTrue()
	{
		// return true if we are certain that it will be true
		if ($this->m_sOperator == 'AND')
		{
			if ($this->m_oLeftExpr->IsTrue() && $this->m_oLeftExpr->IsTrue()) return true;
		}
		return false;
	}

	public function GetLeftExpr()
	{
		return $this->m_oLeftExpr;
	}

	public function GetRightExpr()
	{
		return $this->m_oRightExpr;
	}

	public function GetOperator()
	{
		return $this->m_sOperator;
	}

	// recursive rendering
	public function Render(&$aArgs = null, $bRetrofitParams = false)
	{
		$sOperator = $this->GetOperator();
		$sLeft = $this->GetLeftExpr()->Render($aArgs, $bRetrofitParams);
		$sRight = $this->GetRightExpr()->Render($aArgs, $bRetrofitParams);
		return "($sLeft $sOperator $sRight)";
	}

	public function GetUnresolvedFields($sAlias, &$aUnresolved)
	{
		$this->GetLeftExpr()->GetUnresolvedFields($sAlias, $aUnresolved);
		$this->GetRightExpr()->GetUnresolvedFields($sAlias, $aUnresolved);
	}

	public function Translate($aTranslationData, $bMatchAll = true, $bMarkFieldsAsResolved = true)
	{
		$oLeft = $this->GetLeftExpr()->Translate($aTranslationData, $bMatchAll, $bMarkFieldsAsResolved);
		$oRight = $this->GetRightExpr()->Translate($aTranslationData, $bMatchAll, $bMarkFieldsAsResolved);
		return new BinaryExpression($oLeft, $this->GetOperator(), $oRight);
	}

	public function ListRequiredFields()
	{
		$aLeft = $this->GetLeftExpr()->ListRequiredFields();
		$aRight = $this->GetRightExpr()->ListRequiredFields();
		return array_merge($aLeft, $aRight);
	}
	
	public function RenameParam($sOldName, $sNewName)
	{
		$this->GetLeftExpr()->RenameParam($sOldName, $sNewName);
		$this->GetRightExpr()->RenameParam($sOldName, $sNewName);
	}
}


class UnaryExpression extends Expression
{
	protected $m_value;

	public function __construct($value)
	{
		$this->m_value = $value;
	}

	public function IsTrue()
	{
		// return true if we are certain that it will be true
		return ($this->m_value == 1);
	}

	public function GetValue()
	{
		return $this->m_value;
	} 

	// recursive rendering
	public function Render(&$aArgs = null, $bRetrofitParams = false)
	{
		if ($bRetrofitParams)
		{
			$iParamIndex = count($aArgs) + 1; // 1-based indexation
			$aArgs['param'.$iParamIndex] = $this->m_value;
			return ':param'.$iParamIndex;
		}
		else
		{
			return CMDBSource::Quote($this->m_value);
		}
	}

	public function GetUnresolvedFields($sAlias, &$aUnresolved)
	{
	}

	public function Translate($aTranslationData, $bMatchAll = true, $bMarkFieldsAsResolved = true)
	{
		return clone $this;
	}

	public function ListRequiredFields()
	{
		return array();
	}
	
	public function RenameParam($sOldName, $sNewName)
	{
		// Do nothing
		// really ? what about :param{$iParamIndex} ??
	}
}

class ScalarExpression extends UnaryExpression
{
	public function __construct($value)
	{
		if (!is_scalar($value))
		{
			throw new CoreException('Attempt to create a scalar expression from a non scalar', array('var_type'=>gettype($value)));
		}
		parent::__construct($value);
	}
}

class TrueExpression extends ScalarExpression
{
	public function __construct()
	{
		parent::__construct(1);
	}

	public function IsTrue()
	{
		return true;
	}
}

class FalseExpression extends ScalarExpression
{
	public function __construct()
	{
		parent::__construct(0);
	}

	public function IsTrue()
	{
		return false;
	}
}

class FieldExpression extends UnaryExpression
{
	protected $m_sParent;
	protected $m_sName;

	public function __construct($sName, $sParent = '')
	{
		parent::__construct("$sParent.$sName");

		$this->m_sParent = $sParent;
		$this->m_sName = $sName;
	}

	public function IsTrue()
	{
		// return true if we are certain that it will be true
		return false;
	}

	public function GetParent() {return $this->m_sParent;}
	public function GetName() {return $this->m_sName;}

	// recursive rendering
	public function Render(&$aArgs = null, $bRetrofitParams = false)
	{
		if (empty($this->m_sParent))
		{
			return "`{$this->m_sName}`";
		}
		return "`{$this->m_sParent}`.`{$this->m_sName}`";
	}

	public function ListRequiredFields()
	{
		return array($this->m_sParent.'.'.$this->m_sName);
	}

	public function GetUnresolvedFields($sAlias, &$aUnresolved)
	{
		if ($this->m_sParent == $sAlias)
		{
			// Add a reference to the field
			$aUnresolved[$this->m_sName] = $this;
		}
	}

	public function Translate($aTranslationData, $bMatchAll = true, $bMarkFieldsAsResolved = true)
	{
		if (!array_key_exists($this->m_sParent, $aTranslationData))
		{
			if ($bMatchAll) throw new CoreException('Unknown parent id in translation table', array('parent_id' => $this->m_sParent, 'translation_table' => array_keys($aTranslationData)));
			return clone $this;
		} 
		if (!array_key_exists($this->m_sName, $aTranslationData[$this->m_sParent]))
		{
			if (!array_key_exists('*', $aTranslationData[$this->m_sParent]))
			{
				// #@# debug - if ($bMatchAll) MyHelpers::var_dump_html($aTranslationData, true);
				if ($bMatchAll) throw new CoreException('Unknown name in translation table', array('name' => $this->m_sName, 'parent_id' => $this->m_sParent, 'translation_table' => array_keys($aTranslationData[$this->m_sParent])));
				return clone $this;
			}
			$sNewParent = $aTranslationData[$this->m_sParent]['*'];
			$sNewName = $this->m_sName;
			if ($bMarkFieldsAsResolved)
			{
				$oRet = new FieldExpressionResolved($sNewName, $sNewParent);
			}
			else
			{
				$oRet = new FieldExpression($sNewName, $sNewParent);
			}
		}
		else
		{
			$oRet = $aTranslationData[$this->m_sParent][$this->m_sName];
		}
		return $oRet;
	}
}

// Has been resolved into an SQL expression
class FieldExpressionResolved extends FieldExpression
{
	public function GetUnresolvedFields($sAlias, &$aUnresolved)
	{
	}

	public function Translate($aTranslationData, $bMatchAll = true, $bMarkFieldsAsResolved = true)
	{
		return clone $this;
	}
}

class VariableExpression extends UnaryExpression
{
	protected $m_sName;

	public function __construct($sName)
	{
		parent::__construct($sName);

		$this->m_sName = $sName;
	}

	public function IsTrue()
	{
		// return true if we are certain that it will be true
		return false;
	}

	public function GetName() {return $this->m_sName;}

	// recursive rendering
	public function Render(&$aArgs = null, $bRetrofitParams = false)
	{
		if (is_null($aArgs))
		{
			return ':'.$this->m_sName;
		}
		elseif (array_key_exists($this->m_sName, $aArgs))
		{
			return CMDBSource::Quote($aArgs[$this->m_sName]);
		}
		elseif ($bRetrofitParams)
		{
			//$aArgs[$this->m_sName] = null;
			return ':'.$this->m_sName;
		}
		else
		{
			throw new MissingQueryArgument('Missing query argument', array('expecting'=>$this->m_sName, 'available'=>$aArgs));
		}
	}
	
	public function RenameParam($sOldName, $sNewName)
	{
		if ($this->m_sName == $sOldName)
		{
			$this->m_sName = $sNewName;
		}
	}
}

// Temporary, until we implement functions and expression casting!
// ... or until we implement a real full text search based in the MATCH() expression
class ListExpression extends Expression
{
	protected $m_aExpressions;

	public function __construct($aExpressions)
	{
		$this->m_aExpressions = $aExpressions;
	}

	public static function FromScalars($aScalars)
	{
		$aExpressions = array();
		foreach($aScalars as $value)
		{
			$aExpressions[] = new ScalarExpression($value);
		}
		return new ListExpression($aExpressions);
	}

	public function IsTrue()
	{
		// return true if we are certain that it will be true
		return false;
	}

	public function GetItems()
	{
		return $this->m_aExpressions;
	}

	// recursive rendering
	public function Render(&$aArgs = null, $bRetrofitParams = false)
	{
		$aRes = array();
		foreach ($this->m_aExpressions as $oExpr)
		{
			$aRes[] = $oExpr->Render($aArgs, $bRetrofitParams);
		}
		return '('.implode(', ', $aRes).')';
	}

	public function GetUnresolvedFields($sAlias, &$aUnresolved)
	{
		foreach ($this->m_aExpressions as $oExpr)
		{
			$oExpr->GetUnresolvedFields($sAlias, $aUnresolved);
		}
	}

	public function Translate($aTranslationData, $bMatchAll = true, $bMarkFieldsAsResolved = true)
	{
		$aRes = array();
		foreach ($this->m_aExpressions as $oExpr)
		{
			$aRes[] = $oExpr->Translate($aTranslationData, $bMatchAll, $bMarkFieldsAsResolved);
		}
		return new ListExpression($aRes);
	}

	public function ListRequiredFields()
	{
		$aRes = array();
		foreach ($this->m_aExpressions as $oExpr)
		{
			$aRes = array_merge($aRes, $oExpr->ListRequiredFields());
		}
		return $aRes;
	}
	
	public function RenameParam($sOldName, $sNewName)
	{
		$aRes = array();
		foreach ($this->m_aExpressions as $key => $oExpr)
		{
			$this->m_aExpressions[$key] = $oExpr->RenameParam($sOldName, $sNewName);
		}
	}	
}


class FunctionExpression extends Expression
{
	protected $m_sVerb;
	protected $m_aArgs; // array of expressions

	public function __construct($sVerb, $aArgExpressions)
	{
		$this->m_sVerb = $sVerb;
		$this->m_aArgs = $aArgExpressions;
	}

	public function IsTrue()
	{
		// return true if we are certain that it will be true
		return false;
	}

	public function GetVerb()
	{
		return $this->m_sVerb;
	}

	public function GetArgs()
	{
		return $this->m_aArgs;
	}

	// recursive rendering
	public function Render(&$aArgs = null, $bRetrofitParams = false)
	{
		$aRes = array();
		foreach ($this->m_aArgs as $oExpr)
		{
			$aRes[] = $oExpr->Render($aArgs, $bRetrofitParams);
		}
		return $this->m_sVerb.'('.implode(', ', $aRes).')';
	}

	public function GetUnresolvedFields($sAlias, &$aUnresolved)
	{
		foreach ($this->m_aArgs as $oExpr)
		{
			$oExpr->GetUnresolvedFields($sAlias, $aUnresolved);
		}
	}

	public function Translate($aTranslationData, $bMatchAll = true, $bMarkFieldsAsResolved = true)
	{
		$aRes = array();
		foreach ($this->m_aArgs as $oExpr)
		{
			$aRes[] = $oExpr->Translate($aTranslationData, $bMatchAll, $bMarkFieldsAsResolved);
		}
		return new FunctionExpression($this->m_sVerb, $aRes);
	}

	public function ListRequiredFields()
	{
		$aRes = array();
		foreach ($this->m_aArgs as $oExpr)
		{
			$aRes = array_merge($aRes, $oExpr->ListRequiredFields());
		}
		return $aRes;
	}
	
	public function RenameParam($sOldName, $sNewName)
	{
		foreach ($this->m_aArgs as $key => $oExpr)
		{
			$this->m_aArgs[$key] = $oExpr->RenameParam($sOldName, $sNewName);
		}
	}	
}

class IntervalExpression extends Expression
{
	protected $m_oValue; // expression
	protected $m_sUnit;

	public function __construct($oValue, $sUnit)
	{
		$this->m_oValue = $oValue;
		$this->m_sUnit = $sUnit;
	}

	public function IsTrue()
	{
		// return true if we are certain that it will be true
		return false;
	}

	public function GetValue()
	{
		return $this->m_oValue;
	}

	public function GetUnit()
	{
		return $this->m_sUnit;
	}

	// recursive rendering
	public function Render(&$aArgs = null, $bRetrofitParams = false)
	{
		return 'INTERVAL '.$this->m_oValue->Render($aArgs, $bRetrofitParams).' '.$this->m_sUnit;
	}

	public function GetUnresolvedFields($sAlias, &$aUnresolved)
	{
		$this->m_oValue->GetUnresolvedFields($sAlias, $aUnresolved);
	}

	public function Translate($aTranslationData, $bMatchAll = true, $bMarkFieldsAsResolved = true)
	{
		return new IntervalExpression($this->m_oValue->Translate($aTranslationData, $bMatchAll, $bMarkFieldsAsResolved), $this->m_sUnit);
	}

	public function ListRequiredFields()
	{
		return array();
	}
	
	public function RenameParam($sOldName, $sNewName)
	{
		$this->m_oValue->RenameParam($sOldName, $sNewName);
	}	
}

class CharConcatExpression extends Expression
{
	protected $m_aExpressions;

	public function __construct($aExpressions)
	{
		$this->m_aExpressions = $aExpressions;
	}

	public function IsTrue()
	{
		// return true if we are certain that it will be true
		return false;
	}

	public function GetItems()
	{
		return $this->m_aExpressions;
	}

	// recursive rendering
	public function Render(&$aArgs = null, $bRetrofitParams = false)
	{
		$aRes = array();
		foreach ($this->m_aExpressions as $oExpr)
		{
			$sCol = $oExpr->Render($aArgs, $bRetrofitParams);
			// Concat will be globally NULL if one single argument is null ! 
			$aRes[] = "COALESCE($sCol, '')";
		}
		return "CAST(CONCAT(".implode(', ', $aRes).") AS CHAR)";
	}

	public function GetUnresolvedFields($sAlias, &$aUnresolved)
	{
		foreach ($this->m_aExpressions as $oExpr)
		{
			$oExpr->GetUnresolvedFields($sAlias, $aUnresolved);
		}
	}

	public function Translate($aTranslationData, $bMatchAll = true, $bMarkFieldsAsResolved = true)
	{
		$aRes = array();
		foreach ($this->m_aExpressions as $oExpr)
		{
			$aRes[] = $oExpr->Translate($aTranslationData, $bMatchAll, $bMarkFieldsAsResolved);
		}
		return new CharConcatExpression($aRes);
	}

	public function ListRequiredFields()
	{
		$aRes = array();
		foreach ($this->m_aExpressions as $oExpr)
		{
			$aRes = array_merge($aRes, $oExpr->ListRequiredFields());
		}
		return $aRes;
	}

	public function RenameParam($sOldName, $sNewName)
	{
		foreach ($this->m_aExpressions as $key => $oExpr)
		{
			$this->m_aExpressions[$key] = $oExpr->RenameParam($sOldName, $sNewName);
		}
	}	
}


class CharConcatWSExpression extends CharConcatExpression
{
	protected $m_separator;

	public function __construct($separator, $aExpressions)
	{
		$this->m_separator = $separator;
		parent::__construct($aExpressions);
	}

	// recursive rendering
	public function Render(&$aArgs = null, $bRetrofitParams = false)
	{
		$aRes = array();
		foreach ($this->m_aExpressions as $oExpr)
		{
			$sCol = $oExpr->Render($aArgs, $bRetrofitParams);
			// Concat will be globally NULL if one single argument is null ! 
			$aRes[] = "COALESCE($sCol, '')";
		}
		$sSep = CMDBSource::Quote($this->m_separator);
		return "CAST(CONCAT_WS($sSep, ".implode(', ', $aRes).") AS CHAR)";
	}
}


class QueryBuilderExpressions
{
	protected $m_oConditionExpr;
	protected $m_aSelectExpr;
	protected $m_aJoinFields;

	public function __construct($aSelect, $oCondition)
	{
		$this->m_oConditionExpr = $oCondition;
		$this->m_aSelectExpr = $aSelect;
		$this->m_aJoinFields = array();
	}

	public function GetSelect()
	{
		return $this->m_aSelectExpr;
	}

	public function GetCondition()
	{
		return $this->m_oConditionExpr;
	}

	public function PopJoinField()
	{
		return array_pop($this->m_aJoinFields);
	}

	public function AddSelect($sAttAlias, $oExpression)
	{
		$this->m_aSelectExpr[$sAttAlias] = $oExpression;
	}

			//$oConditionTree = $oConditionTree->LogAnd($oFinalClassRestriction);
	public function AddCondition($oExpression)
	{
		$this->m_oConditionExpr = $this->m_oConditionExpr->LogAnd($oExpression);
	}

	public function PushJoinField($oExpression)
	{
		array_push($this->m_aJoinFields, $oExpression);
	}

	public function GetUnresolvedFields($sAlias, &$aUnresolved)
	{
		$this->m_oConditionExpr->GetUnresolvedFields($sAlias, $aUnresolved);
		foreach($this->m_aSelectExpr as $sColAlias => $oExpr)
		{
			$oExpr->GetUnresolvedFields($sAlias, $aUnresolved);
		}
		foreach($this->m_aJoinFields as $oExpression)
		{
			$oExpression->GetUnresolvedFields($sAlias, $aUnresolved);
		}
	}

	public function Translate($aTranslationData, $bMatchAll = true, $bMarkFieldsAsResolved = true)
	{
		$this->m_oConditionExpr = $this->m_oConditionExpr->Translate($aTranslationData, $bMatchAll, $bMarkFieldsAsResolved);
		foreach($this->m_aSelectExpr as $sColAlias => $oExpr)
		{
			$this->m_aSelectExpr[$sColAlias] = $oExpr->Translate($aTranslationData, $bMatchAll, $bMarkFieldsAsResolved);
		}
		foreach($this->m_aJoinFields as $index => $oExpression)
		{
			$this->m_aJoinFields[$index] = $oExpression->Translate($aTranslationData, $bMatchAll, $bMarkFieldsAsResolved);
		}
	}

	public function RenameParam($sOldName, $sNewName)
	{
		$this->m_oConditionExpr->RenameParam($sOldName, $sNewName);
		foreach($this->m_aSelectExpr as $sColAlias => $oExpr)
		{
			$this->m_aSelectExpr[$sColAlias] = $oExpr->RenameParam($sOldName, $sNewName);
		}
		foreach($this->m_aJoinFields as $index => $oExpression)
		{
			$this->m_aJoinFields[$index] = $oExpression->RenameParam($sOldName, $sNewName);
		}
	}
}

?>
