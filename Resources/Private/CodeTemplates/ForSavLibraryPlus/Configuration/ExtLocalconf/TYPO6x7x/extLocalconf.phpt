<sav:function name="removeEmptyLines">
<f:for each="{extension.newTables}" as="newTable">
<f:alias map="{
  model: '{sav:buildTableName(shortName:newTable.tablename, extensionKey:extension.general.1.extensionKey)}'
}">
<f:if condition="{newTable.save_and_new}">
	\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addUserTSConfig('
		options.saveDocNew.{model}=1
	');
</f:if>
</f:alias>
</f:for>

	\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPItoST43($_EXTKEY, 'Classes/class.tx_{sav:function(name:"removeUnderscore", arguments:"{extension.general.1.extensionKey}")}_pi1.php', '_pi1', 'list_type', 1);
</sav:function>
