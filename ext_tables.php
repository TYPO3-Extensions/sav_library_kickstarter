<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

/**
* Register Backend Module
*/

Tx_Extbase_Utility_Extension::registerModule(
	$_EXTKEY,
	'tools',
	'mod',
	'',
	array(
		'Kickstarter' => '
      extensionList,
      createExtension,
      copyExtension,
      editExtension,
      installExtension,
      uninstallExtension,
      generateExtension,
      upgradeExtension,
      addItem,
      deleteItem,
      editItem,
      emconfEditSection,
      newTablesEditSection,
      existingTablesEditSection,
      existingTablesImportFields,
      generalEditSection,
      viewsEditSection,
      queriesEditSection,
      formsEditSection,
      save,
      changeView,
      changeConfigurationView,
      editFieldConfiguration,
      editFieldDefinition,
      addNewField,
      moveUpField,
      moveDownField,
      deleteField,
      addNewFolder,
      moveUpFolder,
      moveDownFolder,
      deleteFolder,
      addNewWhereTag,
      deleteWhereTag,
      addNewBoxItem,
      deleteBoxItem,
      generateCode,
    '
	),
	array(
		'access' => 'admin',
		'icon'   => 'EXT:sav_library_kickstarter/ext_icon.gif',
		'labels' => 'LLL:EXT:sav_library_kickstarter/Resources/Private/Language/locallang_mod.xml',
	)
);

t3lib_extMgm::addLLrefForTCAdescr('sav_library_kickstarter','EXT:sav_library_kickstarter/Resources/Private/Language/locallang_csh_kickstarter.xml');

?>
