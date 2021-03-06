<?php
// Copyright (C) 2010 Combodo SARL
//
//  This program is free software; you can redistribute it and/or modify
//  it under the terms of the GNU General Public License as published by
//  the Free Software Foundation; version 3 of the License.
//
//  This program is distributed in the hope that it will be useful,
//  but WITHOUT ANY WARRANTY; without even the implied warranty of
//  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
//  GNU General Public License for more details.
//
//  You should have received a copy of the GNU General Public License
//  along with this program; if not, write to the Free Software
//  Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA 02111-1307 USA

/**
 * Localized data
 *
 * @author   Erwan Taloc <erwan.taloc@combodo.com>
 * @author   Romain Quetiez <romain.quetiez@combodo.com>
 * @author   Denis Flaven <denis.flaven@combodo.com>
 * @author   Stephan Rosenke <stephan.rosenke@itomig.de>
 * @license   http://www.opensource.org/licenses/gpl-3.0.html LGPL
 */


//////////////////////////////////////////////////////////////////////
// Classes in 'core/cmdb'
//////////////////////////////////////////////////////////////////////
//

//
// Class: CMDBChange
//

Dict::Add('DE DE', 'German', 'Deutsch', array(
	'Core:AttributeLinkedSet' => 'Array von Objekten',
	'Core:AttributeLinkedSet+' => 'Beliebige Art von Objekten der [subclass] der selben Klasse',

	'Core:AttributeLinkedSetIndirect' => 'Array von Objekten (N-N)',
	'Core:AttributeLinkedSetIndirect+' => 'Beliebige Art von Objekten der [subclass] der selben Klasse',

	'Core:AttributeInteger' => 'Integer',
	'Core:AttributeInteger+' => 'Numerischer Wert (kann negativ sein)',

	'Core:AttributeDecimal' => 'Decimal',
	'Core:AttributeDecimal+' => 'Dezimaler Wert (kann negativ sein)',

	'Core:AttributeBoolean' => 'Boolean',
	'Core:AttributeBoolean+' => 'Boolscher Wert',

	'Core:AttributeString' => 'String',
	'Core:AttributeString+' => 'Alphanumerischer String',

	'Core:AttributeClass' => 'Class',
	'Core:AttributeClass+' => 'Class',

	'Core:AttributeApplicationLanguage' => 'Benutzersprache',
	'Core:AttributeApplicationLanguage+' => 'Sprache und LAnd (DE DE)',

	'Core:AttributeFinalClass' => 'Class (auto)',
	'Core:AttributeFinalClass+' => 'Echte Klasse des Objekt (automatisch erstellt durch den Core)',

	'Core:AttributePassword' => 'Passwort',
	'Core:AttributePassword+' => 'Passwort eines externen Geräts',

 	'Core:AttributeEncryptedString' => 'verschlüsselter String',
	'Core:AttributeEncryptedString+' => 'mit einem lokalen Schüssel verschlüsselter String',

	'Core:AttributeText' => 'Text',
	'Core:AttributeText+' => 'Mehrzeiliger String',

	'Core:AttributeHTML' => 'HTML',
	'Core:AttributeHTML+' => 'HTML-String',

	'Core:AttributeEmailAddress' => 'Email-Adresse',
	'Core:AttributeEmailAddress+' => 'Email-Adresse',

	'Core:AttributeIPAddress' => 'IP-Adresse',
	'Core:AttributeIPAddress+' => 'IP-Adresse',

	'Core:AttributeOQL' => 'OQL',
	'Core:AttributeOQL+' => 'Object-Query-Langage-Ausdruck',

	'Core:AttributeEnum' => 'Enum',
	'Core:AttributeEnum+' => 'Liste vordefinierter alphanumerischer Strings',

	'Core:AttributeTemplateString' => 'Vorlagen-String',
	'Core:AttributeTemplateString+' => 'String mit Platzhaltern',

	'Core:AttributeTemplateText' => 'Vorlagen-Text',
	'Core:AttributeTemplateText+' => 'Text mit Platzhaltern',

	'Core:AttributeTemplateHTML' => 'Vorlagen-HTML',
	'Core:AttributeTemplateHTML+' => 'HTML mit Platzhaltern',

	'Core:AttributeDateTime' => 'Datum/Uhrzeit',
	'Core:AttributeDateTime+' => 'Datum und Uhrzeit (Jahr-Monat-Tag hh:mm:ss)',

	'Core:AttributeDate' => 'Datum',
	'Core:AttributeDate+' => 'Datum (Jahr-Monat-Tag)',

	'Core:AttributeDeadline' => 'Frist',
	'Core:AttributeDeadline+' => 'relativ zur aktuellen Zeit angezeigtes Datum',

	'Core:AttributeExternalKey' => 'Externer Schlüssel',
	'Core:AttributeExternalKey+' => 'Externer (oder fremder) Schlüssel',

	'Core:AttributeExternalField' => 'Externes Feld',
	'Core:AttributeExternalField+' => 'durch einen externen Schlüssel abgebildetes Feld',

	'Core:AttributeURL' => 'URL',
	'Core:AttributeURL+' => 'Absolute oder relative URL als Text-String',

	'Core:AttributeBlob' => 'Blob',
	'Core:AttributeBlob+' => 'Beliebiger binärer Inhalt (Dokument)',

	'Core:AttributeOneWayPassword' => 'gehashtes Passwort',
	'Core:AttributeOneWayPassword+' => 'gehashtes Passwort',

	'Core:AttributeTable' => 'Tabelle',
	'Core:AttributeTable+' => 'Indiziertes Array mit zwei Dimensionen',

	'Core:AttributePropertySet' => 'Eigenschaften',
	'Core:AttributePropertySet+' => 'Liste typloser Eigenschaften (Name und Wert)',
));


Dict::Add('DE DE', 'German', 'Deutsch', array(
	'Class:CMDBChange' => 'Change',
	'Class:CMDBChange+' => 'Protokollierung der Changes',
	'Class:CMDBChange/Attribute:date' => 'Datum',
	'Class:CMDBChange/Attribute:date+' => 'Datum und Uhrzeit der Änderungen',
	'Class:CMDBChange/Attribute:userinfo' => 'Sonstige Informationen',
	'Class:CMDBChange/Attribute:userinfo+' => 'Aufruferdefinierte Informationen',
));

//
// Class: CMDBChangeOp
//

Dict::Add('DE DE', 'German', 'Deutsch', array(
	'Class:CMDBChangeOp' => 'Change-Operation',
	'Class:CMDBChangeOp+' => 'Protokoll der Change-Operation',
	'Class:CMDBChangeOp/Attribute:change' => 'Change',
	'Class:CMDBChangeOp/Attribute:change+' => 'Change',
	'Class:CMDBChangeOp/Attribute:date' => 'Datum',
	'Class:CMDBChangeOp/Attribute:date+' => 'Datum und Uhrzeit der Änderungen',
	'Class:CMDBChangeOp/Attribute:userinfo' => 'Benutzer',
	'Class:CMDBChangeOp/Attribute:userinfo+' => 'Wer führte diese Änderung durch',
	'Class:CMDBChangeOp/Attribute:objclass' => 'Objektklasse',
	'Class:CMDBChangeOp/Attribute:objclass+' => 'Objektklasse',
	'Class:CMDBChangeOp/Attribute:objkey' => 'Objekt-ID',
	'Class:CMDBChangeOp/Attribute:objkey+' => 'Objekt-ID',
	'Class:CMDBChangeOp/Attribute:finalclass' => 'Typ',
	'Class:CMDBChangeOp/Attribute:finalclass+' => '',
));

//
// Class: CMDBChangeOpCreate
//

Dict::Add('DE DE', 'German', 'Deutsch', array(
	'Class:CMDBChangeOpCreate' => 'Objekterstellung',
	'Class:CMDBChangeOpCreate+' => 'Protokoll der Objekterstellung',
));

//
// Class: CMDBChangeOpDelete
//

Dict::Add('DE DE', 'German', 'Deutsch', array(
	'Class:CMDBChangeOpDelete' => 'Objektlöschung',
	'Class:CMDBChangeOpDelete+' => 'Protokoll der Objektlöschung',
));

//
// Class: CMDBChangeOpSetAttribute
//

Dict::Add('DE DE', 'German', 'Deutsch', array(
	'Class:CMDBChangeOpSetAttribute' => 'Objektänderung',
	'Class:CMDBChangeOpSetAttribute+' => 'Protokoll der Objektänderungen',
	'Class:CMDBChangeOpSetAttribute/Attribute:attcode' => 'Attribut',
	'Class:CMDBChangeOpSetAttribute/Attribute:attcode+' => 'Code der geänderten Eigenschaft',
));

//
// Class: CMDBChangeOpSetAttributeScalar
//

Dict::Add('DE DE', 'German', 'Deutsch', array(
	'Class:CMDBChangeOpSetAttributeScalar' => 'Eigenschaften ändern',
	'Class:CMDBChangeOpSetAttributeScalar+' => 'Aufzeichnen der Änderungen am Objekt',
	'Class:CMDBChangeOpSetAttributeScalar/Attribute:oldvalue' => 'Vorheriger Wert',
	'Class:CMDBChangeOpSetAttributeScalar/Attribute:oldvalue+' => 'Vorheriger Wert des Attributes',
	'Class:CMDBChangeOpSetAttributeScalar/Attribute:newvalue' => 'Neuer Wert',
	'Class:CMDBChangeOpSetAttributeScalar/Attribute:newvalue+' => 'Neuer Wert des Attributes',
));
// Used by CMDBChangeOp... & derived classes
Dict::Add('DE DE', 'German', 'Deutsch', array(
	'Change:ObjectCreated' => 'Objekt erstellt',
	'Change:ObjectDeleted' => 'Objekt gelöscht',
	'Change:ObjectModified' => 'Objekt geändert',
	'Change:AttName_SetTo_NewValue_PreviousValue_OldValue' => '%1$s geändert zu %2$s (vorheriger Wert: %3$s)',
	'Change:AttName_SetTo' => '%1$s geändert zu %2$s',
	'Change:Text_AppendedTo_AttName' => '%1$s zugefügt an %2$s',
	'Change:AttName_Changed_PreviousValue_OldValue' => '%1$s modifiziert, vorheriger Wert: %2$s',
	'Change:AttName_Changed' => '%1$s modifiziert',
));

//
// Class: CMDBChangeOpSetAttributeBlob
//

Dict::Add('DE DE', 'German', 'Deutsch', array(
	'Class:CMDBChangeOpSetAttributeBlob' => 'Daten ändern',
	'Class:CMDBChangeOpSetAttributeBlob+' => 'Aufzeichnen der Datenänderung',
	'Class:CMDBChangeOpSetAttributeBlob/Attribute:prevdata' => 'Vorherige Daten',
	'Class:CMDBChangeOpSetAttributeBlob/Attribute:prevdata+' => 'Vorherige Inhalte des Attributes',
));

//
// Class: CMDBChangeOpSetAttributeText
//

Dict::Add('DE DE', 'German', 'Deutsch', array(
	'Class:CMDBChangeOpSetAttributeText' => 'Text ändern',
	'Class:CMDBChangeOpSetAttributeText+' => 'Aufzeichnen der Textänderung',
	'Class:CMDBChangeOpSetAttributeText/Attribute:prevdata' => 'Vorherige Daten',
	'Class:CMDBChangeOpSetAttributeText/Attribute:prevdata+' => 'Vorherige Inhalte des Attributes',
));

//
// Class: Event
//

Dict::Add('DE DE', 'German', 'Deutsch', array(
	'Class:Event' => 'Log Event',
	'Class:Event+' => 'Ein anwendungsinterner Event',
	'Class:Event/Attribute:message' => 'Nachricht',
	'Class:Event/Attribute:message+' => 'Kurze Beschreibung des Events',
	'Class:Event/Attribute:date' => 'Datum',
	'Class:Event/Attribute:date+' => 'Datum und Uhrzeit der Änderungen',
	'Class:Event/Attribute:userinfo' => 'Benutzer-Information',
	'Class:Event/Attribute:userinfo+' => 'Identifikation des Benutzer, der die Aktion ausführte, die diesen Event ausgelöst hat',
	'Class:Event/Attribute:finalclass' => 'Typ',
	'Class:Event/Attribute:finalclass+' => '',
));

//
// Class: EventNotification
//

Dict::Add('DE DE', 'German', 'Deutsch', array(
	'Class:EventNotification' => 'Notification Event',
	'Class:EventNotification+' => 'Protokollierung der gesendeten Benachrichtigungen',
	'Class:EventNotification/Attribute:trigger_id' => 'Trigger',
	'Class:EventNotification/Attribute:trigger_id+' => 'Benutzerkonto',
	'Class:EventNotification/Attribute:action_id' => 'Benutzer',
	'Class:EventNotification/Attribute:action_id+' => 'Benutzerkonto',
	'Class:EventNotification/Attribute:object_id' => 'Objekt-ID',
	'Class:EventNotification/Attribute:object_id+' => 'Objekt-ID (Klasse, die von Trigger definiert wurde?)',
));

//
// Class: EventNotificationEmail
//

Dict::Add('DE DE', 'German', 'Deutsch', array(
	'Class:EventNotificationEmail' => 'Email Emission Event',
	'Class:EventNotificationEmail+' => 'Verfolgung einer Email, die gesendet wurde',
	'Class:EventNotificationEmail/Attribute:to' => 'An',
	'Class:EventNotificationEmail/Attribute:to+' => 'An',
	'Class:EventNotificationEmail/Attribute:cc' => 'Kopie an',
	'Class:EventNotificationEmail/Attribute:cc+' => 'Kopie an',
	'Class:EventNotificationEmail/Attribute:bcc' => 'Blindkopie (BCC)',
	'Class:EventNotificationEmail/Attribute:bcc+' => 'Blindkopie (BCC)',
	'Class:EventNotificationEmail/Attribute:from' => 'Von',
	'Class:EventNotificationEmail/Attribute:from+' => 'Absender der Nachricht',
	'Class:EventNotificationEmail/Attribute:subject' => 'Betreff',
	'Class:EventNotificationEmail/Attribute:subject+' => 'Betreff',
	'Class:EventNotificationEmail/Attribute:body' => 'Inhalt der Nachricht',
	'Class:EventNotificationEmail/Attribute:body+' => 'Inhalt der Nachricht',
));

//
// Class: EventIssue
//

Dict::Add('DE DE', 'German', 'Deutsch', array(
	'Class:EventIssue' => 'Issue Event',
	'Class:EventIssue+' => 'Protokollierung einer Issue (Warnungen, Fehler, etc.)',
	'Class:EventIssue/Attribute:issue' => 'Issue',
	'Class:EventIssue/Attribute:issue+' => 'Was passierte?',
	'Class:EventIssue/Attribute:impact' => 'Auswirkungen',
	'Class:EventIssue/Attribute:impact+' => 'Was waren die Auswirkungen?',
	'Class:EventIssue/Attribute:page' => 'Seite',
	'Class:EventIssue/Attribute:page+' => 'HTTP entry point',
	'Class:EventIssue/Attribute:arguments_post' => 'Eingegebene Arguments',
	'Class:EventIssue/Attribute:arguments_post+' => 'HTTP POST-Argumente',
	'Class:EventIssue/Attribute:arguments_get' => 'URL-Argumente',
	'Class:EventIssue/Attribute:arguments_get+' => 'HTTP GET-Argumente',
	'Class:EventIssue/Attribute:callstack' => 'Callstack',
	'Class:EventIssue/Attribute:callstack+' => 'Call stack',
	'Class:EventIssue/Attribute:data' => 'Daten',
	'Class:EventIssue/Attribute:data+' => 'Mehr Informationen',
));

//
// Class: EventWebService
//

Dict::Add('DE DE', 'German', 'Deutsch', array(
	'Class:EventWebService' => 'Web Service Event',
	'Class:EventWebService+' => 'Protokollierung eines Web Service Calls',
	'Class:EventWebService/Attribute:verb' => 'Verb',
	'Class:EventWebService/Attribute:verb+' => 'Name der Operation',
	'Class:EventWebService/Attribute:result' => 'Ergebnis',
	'Class:EventWebService/Attribute:result+' => 'Gesamterfolg/-misserfolg',
	'Class:EventWebService/Attribute:log_info' => 'Informations-Protokollierung',
	'Class:EventWebService/Attribute:log_info+' => 'Ergebnis der Informations-Protokollierung',
	'Class:EventWebService/Attribute:log_warning' => 'Warnungs-Protokollierung',
	'Class:EventWebService/Attribute:log_warning+' => 'Ergebnis der Warnungs-Protokollierung',
	'Class:EventWebService/Attribute:log_error' => 'Fehler-Protokollierung',
	'Class:EventWebService/Attribute:log_error+' => 'Ergebnis der Fehler-Protokollierung',
	'Class:EventWebService/Attribute:data' => 'Daten',
	'Class:EventWebService/Attribute:data+' => 'Ergebnisdaten',
));

//
// Class: Action
//

Dict::Add('DE DE', 'German', 'Deutsch', array(
	'Class:Action' => 'Benutzerdefinierte Aktion',
	'Class:Action+' => 'Benutzerdefinierte Aktionen',
	'Class:Action/Attribute:name' => 'Name',
	'Class:Action/Attribute:name+' => '',
	'Class:Action/Attribute:description' => 'Beschreibung',
	'Class:Action/Attribute:description+' => '',
	'Class:Action/Attribute:status' => 'Status',
	'Class:Action/Attribute:status+' => 'Im Einsatz oder?',
	'Class:Action/Attribute:status/Value:test' => 'Wird getestet',
	'Class:Action/Attribute:status/Value:test+' => 'Wird getestet',
	'Class:Action/Attribute:status/Value:enabled' => 'Im Einsatz',
	'Class:Action/Attribute:status/Value:enabled+' => 'Im Einsatz',
	'Class:Action/Attribute:status/Value:disabled' => 'Inaktiv',
	'Class:Action/Attribute:status/Value:disabled+' => 'Inaktiv',
	'Class:Action/Attribute:trigger_list' => 'Zugehörige Trigger',
	'Class:Action/Attribute:trigger_list+' => 'Trigger, die mit dieser Aktion verknüpft sind',
	'Class:Action/Attribute:finalclass' => 'Typ',
	'Class:Action/Attribute:finalclass+' => '',
));

//
// Class: ActionNotification
//

Dict::Add('DE DE', 'German', 'Deutsch', array(
	'Class:ActionNotification' => 'Benachrichtigung',
	'Class:ActionNotification+' => 'Benachrichtigung (Kurzbeschreibung)',
));

//
// Class: ActionEmail
//

Dict::Add('DE DE', 'German', 'Deutsch', array(
	'Class:ActionEmail' => 'Email-Benachrichtigung',
	'Class:ActionEmail+' => '',
	'Class:ActionEmail/Attribute:test_recipient' => 'Testempfänger',
	'Class:ActionEmail/Attribute:test_recipient+' => 'Empfänger im Fall eines "Test"-Status',
	'Class:ActionEmail/Attribute:from' => 'Von',
	'Class:ActionEmail/Attribute:from+' => 'Wird im Email-Header mitgesendet',
	'Class:ActionEmail/Attribute:reply_to' => 'Antworten an',
	'Class:ActionEmail/Attribute:reply_to+' => 'Wird im Email-Header mitgesendet',
	'Class:ActionEmail/Attribute:to' => 'An',
	'Class:ActionEmail/Attribute:to+' => 'Empfänger der Nachricht',
	'Class:ActionEmail/Attribute:cc' => 'Kopie an',
	'Class:ActionEmail/Attribute:cc+' => 'Kopie an',
	'Class:ActionEmail/Attribute:bcc' => 'Blindkopie (BCC)',
	'Class:ActionEmail/Attribute:bcc+' => 'Blindkopie (BCC)',
	'Class:ActionEmail/Attribute:subject' => 'Betreff',
	'Class:ActionEmail/Attribute:subject+' => 'Betreff der Email',
	'Class:ActionEmail/Attribute:body' => 'Inhalt der Nachricht',
	'Class:ActionEmail/Attribute:body+' => 'Inhalt der Nachricht',
	'Class:ActionEmail/Attribute:importance' => 'Priorität',
	'Class:ActionEmail/Attribute:importance+' => 'Prioritätseinstufung',
	'Class:ActionEmail/Attribute:importance/Value:low' => 'niedrig',
	'Class:ActionEmail/Attribute:importance/Value:low+' => 'niedrig',
	'Class:ActionEmail/Attribute:importance/Value:normal' => 'normal',
	'Class:ActionEmail/Attribute:importance/Value:normal+' => 'normal',
	'Class:ActionEmail/Attribute:importance/Value:high' => 'hoch',
	'Class:ActionEmail/Attribute:importance/Value:high+' => 'hoch',
));

//
// Class: Trigger
//

Dict::Add('DE DE', 'German', 'Deutsch', array(
	'Class:Trigger' => 'Trigger',
	'Class:Trigger+' => 'Custom event handler',
	'Class:Trigger/Attribute:description' => 'Beschreibung',
	'Class:Trigger/Attribute:description+' => 'Kurzbeschreibung',
	'Class:Trigger/Attribute:action_list' => 'Verbundene Trigger-Aktionen',
	'Class:Trigger/Attribute:action_list+' => 'Aktionen, die ausgeführt werden, wenn der Trigger aktiviert ist',
	'Class:Trigger/Attribute:finalclass' => 'Typ',
	'Class:Trigger/Attribute:finalclass+' => '',
));

//
// Class: TriggerOnObject
//

Dict::Add('DE DE', 'German', 'Deutsch', array(
	'Class:TriggerOnObject' => 'Trigger (klassenunabhängig)',
	'Class:TriggerOnObject+' => 'Trigger einer gegebenen Klasse an Objekten',
	'Class:TriggerOnObject/Attribute:target_class' => 'Zielklasse',
	'Class:TriggerOnObject/Attribute:target_class+' => '',
));

//
// Class: TriggerOnStateChange
//

Dict::Add('DE DE', 'German', 'Deutsch', array(
	'Class:TriggerOnStateChange' => 'Trigger (bei Statusänderung)',
	'Class:TriggerOnStateChange+' => 'Trigger bei Änderung des Objektstatus',
	'Class:TriggerOnStateChange/Attribute:state' => 'Status',
	'Class:TriggerOnStateChange/Attribute:state+' => '',
));

//
// Class: TriggerOnStateEnter
//

Dict::Add('DE DE', 'German', 'Deutsch', array(
	'Class:TriggerOnStateEnter' => 'Trigger (beim Eintritt eines Status)',
	'Class:TriggerOnStateEnter+' => 'Trigger bei Eintritt einer Objektstatusänderung',
));

//
// Class: TriggerOnStateLeave
//

Dict::Add('DE DE', 'German', 'Deutsch', array(
	'Class:TriggerOnStateLeave' => 'Trigger (beim Verlassen eines Status)',
	'Class:TriggerOnStateLeave+' => 'Trigger beim Verlassen einer Objektstatusänderung',
));

//
// Class: TriggerOnObjectCreate
//

Dict::Add('DE DE', 'German', 'Deutsch', array(
	'Class:TriggerOnObjectCreate' => 'Trigger (bei Objekterstellung)',
	'Class:TriggerOnObjectCreate+' => 'Trigger bei Objekterstellung (einer Kindklasse) einer gegebenen Klasse',
));

//
// Class: lnkTriggerAction
//

Dict::Add('DE DE', 'German', 'Deutsch', array(
	'Class:lnkTriggerAction' => 'Aktion/Trigger',
	'Class:lnkTriggerAction+' => 'Verknüpfung zwischen einem Trigger und einer Aktion',
	'Class:lnkTriggerAction/Attribute:action_id' => 'Aktion',
	'Class:lnkTriggerAction/Attribute:action_id+' => 'Die auszuführende Aktion',
	'Class:lnkTriggerAction/Attribute:action_name' => 'Aktion',
	'Class:lnkTriggerAction/Attribute:action_name+' => '',
	'Class:lnkTriggerAction/Attribute:trigger_id' => 'Trigger',
	'Class:lnkTriggerAction/Attribute:trigger_id+' => '',
	'Class:lnkTriggerAction/Attribute:trigger_name' => 'Trigger',
	'Class:lnkTriggerAction/Attribute:trigger_name+' => '',
	'Class:lnkTriggerAction/Attribute:order' => 'Reihenfolge',
	'Class:lnkTriggerAction/Attribute:order+' => 'Reihenfolge der Aktionsausführungen',
));

//
// Synchro Data Source
//
Dict::Add('DE DE', 'German', 'Deutsch', array(
	'Class:SynchroDataSource/Attribute:name' => 'Name',
	'Class:SynchroDataSource/Attribute:name+' => 'Name',
	'Class:SynchroDataSource/Attribute:description' => 'Beschreibung',
	'Class:SynchroDataSource/Attribute:status' => 'Status', //TODO: enum values
	'Class:SynchroDataSource/Attribute:scope_class' => 'Ziel-Klasse',
	'Class:SynchroDataSource/Attribute:user_id' => 'Benutzer',
	'Class:SynchroDataSource/Attribute:notify_contact_id' => 'zu benachrichtigender Kontakt',
	'Class:SynchroDataSource/Attribute:notify_contact_id+' => 'Kontakt, der im Fehlerfall benachrichtigt werden muß',
	'Class:SynchroDataSource/Attribute:url_icon' => 'Hyperlink zum Icon',
	'Class:SynchroDataSource/Attribute:url_icon+' => 'Ein (kleines) Bild verlinken, das die Applikation repräsentiert, mit der iTop synchronisiert wird',
	'Class:SynchroDataSource/Attribute:url_application' => 'Hyperlink zur Applikation',
	'Class:SynchroDataSource/Attribute:url_application+' => 'Hyperlink zum iTop Objekt in der externen Applikation mit der iTop synchronisiert wird (falls anwendbar). Mögliche Platzhalter: $this->attribute$ und $replica->primary_key$',
	'Class:SynchroDataSource/Attribute:reconciliation_policy' => 'Abgleichsvorgehen', //TODO enum values
	'Class:SynchroDataSource/Attribute:full_load_periodicity' => 'Intervall zwischen zwei vollständigen Reloads',
	'Class:SynchroDataSource/Attribute:full_load_periodicity+' => 'Ein vollständiger Reload des gesamten Datenbestands muß mindestens in diesem Intervall erfolgen',
	'Class:SynchroDataSource/Attribute:action_on_zero' => 'Verhalten bei keinen Treffern',
	'Class:SynchroDataSource/Attribute:action_on_zero+' => 'Verhalten, wenn die Suche keine Objekte zurückgibt',
	'Class:SynchroDataSource/Attribute:action_on_one' => 'Verhalten bei einem Treffer',
	'Class:SynchroDataSource/Attribute:action_on_one+' => 'Verhalten, wenn die Suche genau ein Objekt zurückgibt',
	'Class:SynchroDataSource/Attribute:action_on_multiple' => 'Verhalten bei vielen Treffern',
	'Class:SynchroDataSource/Attribute:action_on_multiple+' => 'Verhalten, wenn die Suche mehr als ein Objekt zurückgibt',
	'Class:SynchroDataSource/Attribute:user_delete_policy' => 'zugelassene Benutzer',
	'Class:SynchroDataSource/Attribute:user_delete_policy+' => 'Benutzer, die synchronisierte Objekte löschen dürfen',
	'Class:SynchroDataSource/Attribute:user_delete_policy' => 'zugelassene Benutzer',
	'Class:SynchroDataSource/Attribute:delete_policy/Value:never' => 'Niemand',
	'Class:SynchroDataSource/Attribute:delete_policy/Value:depends' => 'nur Administratoren',
	'Class:SynchroDataSource/Attribute:delete_policy/Value:always' => 'Alle zugelassenen Benutzer',
	'Class:SynchroDataSource/Attribute:delete_policy_update' => 'Update-Regeln',
	'Class:SynchroDataSource/Attribute:delete_policy_update+' => 'Syntax: Feld_Name:Wert; ...',
	'Class:SynchroDataSource/Attribute:delete_policy_retention' => 'Zeitraum bis zur endgültigen Löschung',
	'Class:SynchroDataSource/Attribute:delete_policy_retention+' => 'Zeitraum, nach dem ein obsoletes Objekt endgültig gelöscht wird',
	'SynchroDataSource:Description' => 'Beschreibung',
	'SynchroDataSource:Reconciliation' => 'Suche &amp; Abgleich',
	'SynchroDataSource:Deletion' => 'Löschregeln',
	'SynchroDataSource:Status' => 'Status',
	'SynchroDataSource:Information' => 'Information',
	'SynchroDataSource:Definition' => 'Definition',
	'Core:SynchroAttributes' => 'Attribute',
	'Core:SynchroStatus' => 'Status',
	'Core:Synchro:ErrorsLabel' => 'Fehler',	
	'Core:Synchro:CreatedLabel' => 'erzeugt',
	'Core:Synchro:ModifiedLabel' => 'modifiziert',
	'Core:Synchro:UnchangedLabel' => 'unverändert',
	'Core:Synchro:ReconciledErrorsLabel' => 'Fehler',
	'Core:Synchro:ReconciledLabel' => 'abgeglichen',
	'Core:Synchro:ReconciledNewLabel' => 'erzeugt',
	'Core:SynchroReconcile:Yes' => 'Ja',
	'Core:SynchroReconcile:No' => 'Nein',
	'Core:SynchroUpdate:Yes' => 'Ja',
	'Core:SynchroUpdate:No' => 'Nein',
	'Core:Synchro:LastestStatus' => 'Neuester Status',
	'Core:Synchro:History' => 'Verlauf der Synchronisation',
	'Core:Synchro:NeverRun' => 'Synchronisation noch nicht erfolgt. Kein Protokoll verfügbar.',
	'Core:Synchro:SynchroEndedOn_Date' => 'Die letzte Synchronisation endete um %1$s.',
	'Core:Synchro:SynchroRunningStartedOn_Date' => 'Die Synchronisation, die um $1$s gestartet wurde, läuft noch ...',
	'Menu:DataSources' => 'Datenquellen für die Synchronisation',
	'Menu:DataSources+' => 'Alle Datenquellen für die Synchronisation',
	'Core:Synchro:label_repl_ignored' => 'Ignoriert (%1$s)',
	'Core:Synchro:label_repl_disappeared' => 'Verschwunden (%1$s)',
	'Core:Synchro:label_repl_existing' => 'Vorhanden (%1$s)',
	'Core:Synchro:label_repl_new' => 'Neu (%1$s)',
	'Core:Synchro:label_obj_deleted' => 'gelöscht (%1$s)',
	'Core:Synchro:label_obj_obsoleted' => 'obsolet (%1$s)',
	'Core:Synchro:label_obj_disappeared_errors' => 'Fehler (%1$s)',
	'Core:Synchro:label_obj_disappeared_no_action' => 'Keine Aktion (%1$s)',
	'Core:Synchro:label_obj_unchanged' => 'unverändert (%1$s)',
	'Core:Synchro:label_obj_updated' => 'Updated (%1$s)', 
	'Core:Synchro:label_obj_updated_errors' => 'Fehler (%1$s)',
	'Core:Synchro:label_obj_new_unchanged' => 'unverändert (%1$s)',
	'Core:Synchro:label_obj_new_updated' => 'updated (%1$s)',
	'Core:Synchro:label_obj_created' => 'erzeugt (%1$s)',
	'Core:Synchro:label_obj_new_errors' => 'Fehler (%1$s)',
	'Core:Synchro:History' => 'Synchronisations-Verlauf',
	'Core:SynchroLogTitle' => '%1$s - %2$s',
	'Core:Synchro:Nb_Replica' => 'Replica verarbeitet: %1$s',
	'Core:Synchro:Nb_Class:Objects' => '%1$s: %2$s',
	'Class:SynchroDataSource/Error:AtLeastOneReconciliationKeyMustBeSpecified' => 'Mindestens ein Abgleichsschlüssel muß angegeben werden oder das Abgleichsvorgehen muß den primären Schlüssel verwenden.',			
	'Class:SynchroDataSource/Error:DeleteRetentionDurationMustBeSpecified' => 'Der Zeitraum bis zur endgültigen Löschung muß angegeben werden, da die Objekte nach einer Kennzeichnung als obsolet gelöscht werden.',			
	'Class:SynchroDataSource/Error:DeletePolicyUpdateMustBeSpecified' => 'Obsolete Objekte werden aktualisiert, aber es wurde keine Aktualisierung angegeben.',
	'Core:SynchroReplica:PublicData' => 'Öffentliche Daten',
	'Core:SynchroReplica:PrivateDetails' => 'Private Hinweise',
	'Core:SynchroReplica:BackToDataSource' => 'Zurück zur Synchronisations-Datenquelle: %1$s',
	'Core:SynchroReplica:ListOfReplicas' => 'Liste der Replica',
	'Core:SynchroAttExtKey:ReconciliationById' => 'id (Primärschlüssel)',
	'Core:SynchroAtt:attcode' => 'Attribut',
	'Core:SynchroAtt:attcode+' => 'Feld des Objekts',
	'Core:SynchroAtt:reconciliation' => 'Abgleich',
	'Core:SynchroAtt:reconciliation+' => 'Für die Suche genutzt',
	'Core:SynchroAtt:update' => 'Update',
	'Core:SynchroAtt:update+' => 'Für die Aktualisierung des Objekts benutzt',
	'Core:SynchroAtt:update_policy' => 'Update Policy',
	'Core:SynchroAtt:update_policy+' => 'Verhalten des aktualisierten Feld',
	'Core:SynchroAtt:reconciliation_attcode' => 'Abgleichsschlüssel',
	'Core:SynchroAtt:reconciliation_attcode+' => 'Attributscode für den Abgleich über einen externen Schlüssel',
	'Core:SyncDataExchangeComment' => '(DataExchange)',
	'Core:Synchro:ListOfDataSources' => 'Liste der Datenquellen:',
	'Core:Synchro:LastSynchro' => 'Letzte Synchronisation:',
	'Core:Synchro:ThisObjectIsSynchronized' => 'Dieses Objekt wird mit einer externen Datenquelle synchronisiert',
	'Core:Synchro:TheObjectWasCreatedBy_Source' => 'Das Objekt wurde durch die externe Datenquelle %1$s <b>erzeugt</b>',
	'Core:Synchro:TheObjectCanBeDeletedBy_Source' => 'Das Objekt kann durch die externe Datenquelle %1$s <b>gelöscht werden</b>.',
	'Core:Synchro:TheObjectCannotBeDeletedByUser_Source' => 'Sie <b>können das Objekt nicht löschen</b>, weil es zur externen Datenquelle %1$s gehört',
	'TitleSynchroExecution' => 'Ausführung der Synchronisation',
	'Class:SynchroDataSource:DataTable' => 'Datenbanktabelle: %1$s',
	'Core:SyncDataSourceObsolete' => 'Die Datenquelle ist als obsolet markiert. Operation abgebrochen.',
	'Core:SyncDataSourceAccessRestriction' => 'Nur Administratoren oder die in der Datenquelle angegebenen Benutzer können diese Operation ausführen. Operation abgebrochen.',
	'Core:SyncTooManyMissingReplicas' => 'Alle Einträge wurden seit längerem nicht aktualisiert, alle Objekte könnten gelöscht werden. Bitte überprüfen Sie die Funktionalität der Synchronisation. Operation abgebrochen.',

	'Class:AsyncSendEmail' => 'Email (asynchron)',
	'Class:AsyncSendEmail/Attribute:to' => 'An',
	'Class:AsyncSendEmail/Attribute:subject' => 'Betreff',
	'Class:AsyncSendEmail/Attribute:body' => 'Body',
	'Class:AsyncSendEmail/Attribute:header' => 'Header',
	'Class:CMDBChangeOpSetAttributeOneWayPassword' => 'Verschlüsseltes Passwort',
	'Class:CMDBChangeOpSetAttributeOneWayPassword/Attribute:prev_pwd' => 'Vorheriger Wert',
	'Class:CMDBChangeOpSetAttributeEncrypted' => 'Verschlüsseltes Feld',
	'Class:CMDBChangeOpSetAttributeEncrypted/Attribute:prevstring' => 'Vorheriger Wert',
	'Class:CMDBChangeOpSetAttributeCaseLog' => 'Fall-Protokoll',
	'Class:CMDBChangeOpSetAttributeCaseLog/Attribute:lastentry' => 'letzter Eintrag',
	'Class:SynchroDataSource' => 'Synchronisations-Datenquelle',
	'Class:SynchroDataSource/Attribute:status/Value:implementation' => 'Implementation',
	'Class:SynchroDataSource/Attribute:status/Value:obsolete' => 'Obsolet',
	'Class:SynchroDataSource/Attribute:status/Value:production' => 'Produktion',
	'Class:SynchroDataSource/Attribute:scope_restriction' => 'Anwendungsbereich',
	'Class:SynchroDataSource/Attribute:reconciliation_policy/Value:use_attributes' => 'Attribute benutzen',
	'Class:SynchroDataSource/Attribute:reconciliation_policy/Value:use_primary_key' => 'Feld primary_key benutzen',
	'Class:SynchroDataSource/Attribute:action_on_zero/Value:create' => 'Erzeugen',
	'Class:SynchroDataSource/Attribute:action_on_zero/Value:error' => 'Fehler',
	'Class:SynchroDataSource/Attribute:action_on_one/Value:error' => 'Fehler',
	'Class:SynchroDataSource/Attribute:action_on_one/Value:update' => 'Update',
	'Class:SynchroDataSource/Attribute:action_on_multiple/Value:create' => 'Erzeugen',
	'Class:SynchroDataSource/Attribute:action_on_multiple/Value:error' => 'Fehler',
	'Class:SynchroDataSource/Attribute:action_on_multiple/Value:take_first' => 'ersten Treffer benutzen',
	'Class:SynchroDataSource/Attribute:delete_policy' => 'Löschungs-Policy',
	'Class:SynchroDataSource/Attribute:delete_policy/Value:delete' => 'Löschen',
	'Class:SynchroDataSource/Attribute:delete_policy/Value:ignore' => 'Ignorieren',
	'Class:SynchroDataSource/Attribute:delete_policy/Value:update' => 'Update',
	'Class:SynchroDataSource/Attribute:delete_policy/Value:update_then_delete' => 'Update, danach Löschen',
	'Class:SynchroDataSource/Attribute:attribute_list' => 'Liste der Attribute',
	'Class:SynchroDataSource/Attribute:user_delete_policy/Value:administrators' => 'nur Administratoren',
	'Class:SynchroDataSource/Attribute:user_delete_policy/Value:everybody' => 'Jeder darf solche Objekte löschen',
	'Class:SynchroDataSource/Attribute:user_delete_policy/Value:nobody' => 'Niemand',
	'Class:SynchroAttribute' => 'Synchronisations-Attribut',
	'Class:SynchroAttribute/Attribute:sync_source_id' => 'Synchronisations-Datenquelle',
	'Class:SynchroAttribute/Attribute:attcode' => 'Attributs-Code',
	'Class:SynchroAttribute/Attribute:update' => 'Update',
	'Class:SynchroAttribute/Attribute:reconcile' => 'Abgleich',
	'Class:SynchroAttribute/Attribute:update_policy' => 'Update Policy',
	'Class:SynchroAttribute/Attribute:update_policy/Value:master_locked' => 'gesperrt',
	'Class:SynchroAttribute/Attribute:update_policy/Value:master_unlocked' => 'entsperrt',
	'Class:SynchroAttribute/Attribute:update_policy/Value:write_if_empty' => 'Initialisieren falls leer',
	'Class:SynchroAttribute/Attribute:finalclass' => 'Klasse',
	'Class:SynchroAttExtKey' => 'Synchronisations-Attribut (Externer Schlüssel)',
	'Class:SynchroAttExtKey/Attribute:reconciliation_attcode' => 'Abgleichsattribut',
	'Class:SynchroAttLinkSet' => 'Synchronisations-Attribut (Linkset)',
	'Class:SynchroAttLinkSet/Attribute:row_separator' => 'Reihen-Trenner',
	'Class:SynchroAttLinkSet/Attribute:attribute_separator' => 'Attributs-Trenner',
	'Class:SynchroLog' => 'Synchronisations-Protokoll',
	'Class:SynchroLog/Attribute:sync_source_id' => 'Synchronisations-Datenquelle',
	'Class:SynchroLog/Attribute:start_date' => 'Anfangsdatum',
	'Class:SynchroLog/Attribute:end_date' => 'Enddatum',
	'Class:SynchroLog/Attribute:status' => 'Status',
	'Class:SynchroLog/Attribute:status/Value:completed' => 'vervollständigt',
	'Class:SynchroLog/Attribute:status/Value:error' => 'Fehler',
	'Class:SynchroLog/Attribute:status/Value:running' => 'noch in Betrieb',
	'Class:SynchroLog/Attribute:stats_nb_replica_seen' => 'Nb replica vorhanden',
	'Class:SynchroLog/Attribute:stats_nb_replica_total' => 'Nb replica insgesamt',
	'Class:SynchroLog/Attribute:stats_nb_obj_deleted' => 'Nb Objekte gelöscht',
	'Class:SynchroLog/Attribute:stats_nb_obj_deleted_errors' => 'Nb Fehler während des Löschvorgangs',
	'Class:SynchroLog/Attribute:stats_nb_obj_obsoleted' => 'Nb Objekte obsolet',
	'Class:SynchroLog/Attribute:stats_nb_obj_obsoleted_errors' => 'Nb Fehler während des Obsolet-Machens',
	'Class:SynchroLog/Attribute:stats_nb_obj_created' => 'Nb Objekte erzeugt',
	'Class:SynchroLog/Attribute:stats_nb_obj_created_errors' => 'Nb oder Fehler während der Erzeugung',
	'Class:SynchroLog/Attribute:stats_nb_obj_updated' => 'Nb Objekte aktualisiert',
	'Class:SynchroLog/Attribute:stats_nb_obj_updated_errors' => 'Nb Fehler während der Aktualisierung',
	'Class:SynchroLog/Attribute:stats_nb_replica_reconciled_errors' => 'Nb Fehler während des Abgleichs',
	'Class:SynchroLog/Attribute:stats_nb_replica_disappeared_no_action' => 'Nb replica verschwunden',
	'Class:SynchroLog/Attribute:stats_nb_obj_new_updated' => 'Nb Objekte aktualisiert',
	'Class:SynchroLog/Attribute:stats_nb_obj_new_unchanged' => 'Nb Objekte nicht verändert',
	'Class:SynchroLog/Attribute:last_error' => 'Letzter Fehler',
	'Class:SynchroLog/Attribute:traces' => 'Traces',
	'Class:SynchroReplica' => 'Synchronisations-Replica',
	'Class:SynchroReplica/Attribute:sync_source_id' => 'Synchronisations-Datenquelle',
	'Class:SynchroReplica/Attribute:dest_id' => 'Ziel-Objekt (ID)',
	'Class:SynchroReplica/Attribute:dest_class' => 'Ziel-Typ',
	'Class:SynchroReplica/Attribute:status_last_seen' => 'Zuletzt gesehen',
	'Class:SynchroReplica/Attribute:status' => 'Status',
	'Class:SynchroReplica/Attribute:status/Value:modified' => 'Modifiziert',
	'Class:SynchroReplica/Attribute:status/Value:new' => 'Neu',
	'Class:SynchroReplica/Attribute:status/Value:obsolete' => 'Obsolete',
	'Class:SynchroReplica/Attribute:status/Value:orphan' => 'Verwaist',
	'Class:SynchroReplica/Attribute:status/Value:synchronized' => 'Synchronisiert',
	'Class:SynchroReplica/Attribute:status_dest_creator' => 'Objekt erzeugt',
	'Class:SynchroReplica/Attribute:status_last_error' => 'Letzter Fehler',
	'Class:SynchroReplica/Attribute:info_creation_date' => 'Erzeugungs-Datum',
	'Class:SynchroReplica/Attribute:info_last_modified' => 'Datum der letzten Modifikation',
	'Class:appUserPreferences' => 'Benutzer-Voreinstellungen',
	'Class:appUserPreferences/Attribute:userid' => 'Benutzer',
	'Class:appUserPreferences/Attribute:preferences' => 'Voreinstellungen',
));

//
// Attribute Duration
//
Dict::Add('DE DE', 'German', 'Deutsch', array(
	'Core:Duration_Seconds'	=> '%1$ds',	
	'Core:Duration_Minutes_Seconds'	=>'%1$dmin %2$ds',	
	'Core:Duration_Hours_Minutes_Seconds' => '%1$dh %2$dmin %3$ds',		
	'Core:Duration_Days_Hours_Minutes_Seconds' => '%1$sd %2$dh %3$dmin %4$ds',		
));

?>
