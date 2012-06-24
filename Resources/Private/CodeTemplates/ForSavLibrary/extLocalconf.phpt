<?php
<sav:function name="removeEmptyLines">
if (!defined ('TYPO3_MODE')) {
 	die ('Access denied.');
}
<f:for each="{extension.newTables}" as="newTable">
<f:alias map="{
  model: '{sav:buildTableName(shortName:newTable.tablename, extensionKey:extension.general.1.extensionKey)}'
}">
<f:if condition="{newTable.save_and_new}">
t3lib_extMgm::addUserTSConfig('
	options.saveDocNew.{model}=1
');
</f:if>
</f:alias>
</f:for>

t3lib_extMgm::addPItoST43($_EXTKEY, 'pi1/class.tx_{sav:function(name:"removeUnderscore", arguments:"{extension.general.1.extensionKey}")}_pi1.php', '_pi1', 'list_type', 0);
</sav:function>
?>
