<?php
if (!defined ('TYPO3_MODE')) die ('Access denied.');
<sav:function name="removeEmptyLines">
<f:for each="{extension.newTables}" as="table">
<f:alias map="{
  model: '{sav:buildTableName(shortName:table.tablename, extensionKey:extension.general.1.extensionKey)}'
}">

<f:if condition="{table.allow_on_pages}">
t3lib_extMgm::allowTableOnStandardPages('{model}');
</f:if>

<f:if condition="{table.allow_ce_insert_records}">
t3lib_extMgm::addToInsertRecords('{model}');
</f:if>

$TCA['{model}'] = array (
	'ctrl' => array (
		'title' => 'LLL:EXT:{extension.general.1.extensionKey}/locallang_db.xml:{model}',
		'label' => '{f:if(condition:table.header_field,then:table.header_field,else:"uid")}',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
    <f:if condition="{table.type_field}">
		'type' => '{table.type_field}',
		</f:if>
    <f:if condition="{table.versioning}">
		'origUid' => 't3_origuid',
		'versioningWS' => true,
		</f:if>
    <f:if condition="{table.localization}">
		'languageField' => 'sys_language_uid',
		'transOrigPointerField' => 'l18n_parent',
		'transOrigDiffSourceField' => 'l18n_diffsource',
		</f:if>
		<f:if condition="{table.sorting}">
      <f:then>
		'sortby' => 'sorting',
      </f:then>
      <f:else>
		'default_sortby' => 'ORDER BY {table.sorting_field} {f:if(condition:table.sorting_desc,then:"DESC")}',
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
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY) . 'tca.php',
		'iconfile' => t3lib_extMgm::extRelPath($_EXTKEY) . 'icon_{model}.gif'
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
		'label'  => 'LLL:EXT:{extension.general.1.extensionKey}/locallang_db.xml:{model}.{sav:buildTableName(shortName:field.fieldname, extensionKey:extension.general.1.extensionKey)}',
		'config' => array (
			<sav:indent count="4"><sav:render partial="../CodeTemplates/ForSavLibrary/Partials/TCA/{field.type}.phpt" arguments="{field:field,model:'{model}_{sav:buildTableName(shortName:0, extensionKey:extension.general.1.extensionKey)}',extensionKey:extension.general.1.extensionKey}" /></sav:indent>
		)
	),
	</sav:removeIfContainsDoNotCreate>
	</f:for>
);
t3lib_div::loadTCA('{model}');
t3lib_extMgm::addTCAcolumns('{model}',$tempColumns,1);
t3lib_extMgm::addToAllTCAtypes('{model}',';;;;1-1-1<f:alias map="{RichTextEditor:'RichTextEditor',ShowOnly:'ShowOnly'}"><f:for each="{table.fields}" as="field"><f:if condition="{field.type} != {ShowOnly}">, {sav:buildTableName(shortName:field.fieldname, extensionKey:extension.general.1.extensionKey)}<f:if condition="{field.type} == {RichTextEditor}">;;;richtext[]:rte_transform[mode=ts]</f:if></f:if></f:for></f:alias>');

</f:alias>
</f:for>


t3lib_div::loadTCA('tt_content');
$TCA['tt_content']['types']['list']['subtypes_excludelist'][$_EXTKEY . '_pi1'] = 'layout,select_key';

// Add flexform field to plugin option
$TCA['tt_content']['types']['list']['subtypes_addlist'][$_EXTKEY . '_pi1'] = 'pi_flexform';

// Add flexform DataStructure
t3lib_extMgm::addPiFlexFormValue($_EXTKEY . '_pi1', 'FILE:EXT:' . $_EXTKEY . '/flexform_ds_pi1.xml');

t3lib_extMgm::addPlugin(array(
	'LLL:EXT:{extension.general.1.extensionKey}/locallang_db.xml:tt_content.list_type_pi1',
	$_EXTKEY . '_pi1',
),'list_type');

</sav:function>
?>
