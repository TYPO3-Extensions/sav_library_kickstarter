<?php
<sav:function name="removeEmptyLines">
if (!defined ('TYPO3_MODE')) die ('Access denied.');
<f:for each="{extension.newTables}" as="table">
<f:alias map="{
  model: '{sav:buildTableName(shortName:table.tablename, extensionKey:extension.general.1.extensionKey)}'
}">

<f:if condition="{table.allow_on_pages}">
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('{model}');
</f:if>

<f:if condition="{table.allow_ce_insert_records}">
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToInsertRecords('{model}');
</f:if>

$TCA['{model}'] = array (
	'ctrl' => array (
		'title' => 'LLL:EXT:{extension.general.1.extensionKey}/Resources/Private/Language/locallang_db.xml:{model}',
		'label' => '{f:if(condition:table.header_field,then:table.header_field,else:"uid")}',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
    <f:if condition="{table.type_field}">
		'type' => '{table.type_field}',
		</f:if>
    <f:if condition="{table.versioning}">
		'origUid' => 't3_origuid',
		'versioningWS' => TRUE,
		</f:if>
    <f:if condition="{table.localization}">
		'languageField' => 'sys_language_uid',
		'transOrigPointerField' => 'l18n_parent',
		'transOrigDiffSourceField' => 'l18n_diffsource',
		</f:if>
		<f:if condition="{table.sorting}">
      <f:then>
		'sortby' => '{model}.sorting',
      </f:then>
      <f:else>
		'default_sortby' => 'ORDER BY {model}.{table.sorting_field} {f:if(condition:table.sorting_desc,then:"DESC")}',
      </f:else>
    </f:if>
    <f:if condition="{table.add_deleted}">
		'delete' => 'deleted',
		</f:if>
		'enablecolumns' => array (
      <f:if condition="{table.add_hidden}">
		  'disabled' => 'hidden',
		  </f:if>
      <f:if condition="{table.add_starttime}">
  		'starttime' => 'starttime',
  		</f:if>
      <f:if condition="{table.add_endtime}">
  		'endtime' => 'endtime',
  		</f:if>
      <f:if condition="{table.add_access}">
  		'fe_group' => 'fe_group',
  		</f:if>
		),
		'dynamicConfigFile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Configuration/TCA/tca.php',
		'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY) . 'Resources/Private/Icons/icon_{model}.gif'
	)
);
</f:alias>
</f:for>

<f:for each="{extension.existingTables}" as="table">
<f:alias map="{
  model: '{table.tablename}'
}">

$tempColumns = array (
	<f:for each="{table.fields}" as="field">
	<sav:removeIfContainsDoNotCreate>
	'{sav:buildTableName(shortName:field.fieldname, extensionKey:extension.general.1.extensionKey)}' => array (
		'exclude' => 1,
		'label'  => 'LLL:EXT:{extension.general.1.extensionKey}/Resources/Private/Language/locallang_db.xml:{model}.{sav:buildTableName(shortName:field.fieldname, extensionKey:extension.general.1.extensionKey)}',
		'config' => array (
			<sav:indent count="4"><sav:render partial="../CodeTemplates/ForSavLibraryPlus/Partials/TCA/{field.type}.phpt" arguments="{field:field,model:'{model}_{sav:buildTableName(shortName:0, extensionKey:extension.general.1.extensionKey)}',extension:extension}" /></sav:indent>
		)
	),
	</sav:removeIfContainsDoNotCreate>
	</f:for>
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('{model}',$tempColumns,1);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes('{model}',';;;;1-1-1<f:alias map="{RichTextEditor:'RichTextEditor',ShowOnly:'ShowOnly'}"><f:for each="{table.fields}" as="field"><f:if condition="{field.type} != {ShowOnly}">, {sav:buildTableName(shortName:field.fieldname, extensionKey:extension.general.1.extensionKey)}<f:if condition="{field.type} == {RichTextEditor}">;;;richtext[]:rte_transform[mode=ts]</f:if></f:if></f:for></f:alias>');

</f:alias>
</f:for>

$TCA['tt_content']['types']['list']['subtypes_excludelist'][$_EXTKEY . '_pi1'] = 'layout,select_key';

// Adds flexform field to plugin option
$TCA['tt_content']['types']['list']['subtypes_addlist'][$_EXTKEY . '_pi1'] = 'pi_flexform';

// Adds flexform DataStructure
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue($_EXTKEY . '_pi1', 'FILE:EXT:' . $_EXTKEY . '/Configuration/Flexforms/ExtensionFlexform.xml');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPlugin(array(
	'LLL:EXT:{extension.general.1.extensionKey}/Resources/Private/Language/locallang_db.xml:tt_content.list_type_pi1',
	$_EXTKEY . '_pi1',
), 'list_type');
</sav:function>
?>
