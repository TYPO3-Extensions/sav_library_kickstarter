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
      upgradeExtensions,      
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
      changeFolder,
      showAllFields,
      showFieldsNotInFolders,
      changeConfigurationView,
      editFieldConfiguration,
      addNewField,
      moveUpField,
      moveDownField,
      deleteField,
      addNewViewWithCondition,
      deleteViewWithCondition,
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

// Context Sensitive Help for the SAV Library Kickstarter sections
t3lib_extMgm::addLLrefForTCAdescr('sav_library_kickstarter_emconf','EXT:sav_library_kickstarter/Resources/Private/Language/ContextSensitiveHelp/locallang_csh_emconf.xml');
t3lib_extMgm::addLLrefForTCAdescr('sav_library_kickstarter_views','EXT:sav_library_kickstarter/Resources/Private/Language/ContextSensitiveHelp/locallang_csh_views.xml');
t3lib_extMgm::addLLrefForTCAdescr('sav_library_kickstarter_queries','EXT:sav_library_kickstarter/Resources/Private/Language/ContextSensitiveHelp/locallang_csh_queries.xml');
t3lib_extMgm::addLLrefForTCAdescr('sav_library_kickstarter_forms','EXT:sav_library_kickstarter/Resources/Private/Language/ContextSensitiveHelp/locallang_csh_forms.xml');

// Context Sensitive Help for the field types
t3lib_extMgm::addLLrefForTCAdescr('sav_library_kickstarter_all','EXT:sav_library_kickstarter/Resources/Private/Language/ContextSensitiveHelp/Types/locallang_csh_all.xml');
t3lib_extMgm::addLLrefForTCAdescr('sav_library_kickstarter_checkbox','EXT:sav_library_kickstarter/Resources/Private/Language/ContextSensitiveHelp/Types/locallang_csh_checkbox.xml');
t3lib_extMgm::addLLrefForTCAdescr('sav_library_kickstarter_checkboxes','EXT:sav_library_kickstarter/Resources/Private/Language/ContextSensitiveHelp/Types/locallang_csh_checkboxes.xml');
t3lib_extMgm::addLLrefForTCAdescr('sav_library_kickstarter_date','EXT:sav_library_kickstarter/Resources/Private/Language/ContextSensitiveHelp/Types/locallang_csh_date.xml');
t3lib_extMgm::addLLrefForTCAdescr('sav_library_kickstarter_dateTime','EXT:sav_library_kickstarter/Resources/Private/Language/ContextSensitiveHelp/Types/locallang_csh_dateTime.xml');
t3lib_extMgm::addLLrefForTCAdescr('sav_library_kickstarter_files','EXT:sav_library_kickstarter/Resources/Private/Language/ContextSensitiveHelp/Types/locallang_csh_files.xml');
t3lib_extMgm::addLLrefForTCAdescr('sav_library_kickstarter_functions','EXT:sav_library_kickstarter/Resources/Private/Language/ContextSensitiveHelp/Types/locallang_csh_functions.xml');
t3lib_extMgm::addLLrefForTCAdescr('sav_library_kickstarter_graph','EXT:sav_library_kickstarter/Resources/Private/Language/ContextSensitiveHelp/Types/locallang_csh_graph.xml');
t3lib_extMgm::addLLrefForTCAdescr('sav_library_kickstarter_general','EXT:sav_library_kickstarter/Resources/Private/Language/ContextSensitiveHelp/Types/locallang_csh_general.xml');
t3lib_extMgm::addLLrefForTCAdescr('sav_library_kickstarter_integer','EXT:sav_library_kickstarter/Resources/Private/Language/ContextSensitiveHelp/Types/locallang_csh_integer.xml');
t3lib_extMgm::addLLrefForTCAdescr('sav_library_kickstarter_link','EXT:sav_library_kickstarter/Resources/Private/Language/ContextSensitiveHelp/Types/locallang_csh_link.xml');
t3lib_extMgm::addLLrefForTCAdescr('sav_library_kickstarter_radioButtons','EXT:sav_library_kickstarter/Resources/Private/Language/ContextSensitiveHelp/Types/locallang_csh_radioButtons.xml');
t3lib_extMgm::addLLrefForTCAdescr('sav_library_kickstarter_relationManyToManyAsDoubleSelectorbox','EXT:sav_library_kickstarter/Resources/Private/Language/ContextSensitiveHelp/Types/locallang_csh_relationManyToManyAsDoubleSelectorbox.xml');
t3lib_extMgm::addLLrefForTCAdescr('sav_library_kickstarter_relationManyToManyAsSubform','EXT:sav_library_kickstarter/Resources/Private/Language/ContextSensitiveHelp/Types/locallang_csh_relationManyToManyAsSubform.xml');
t3lib_extMgm::addLLrefForTCAdescr('sav_library_kickstarter_richTextEditor','EXT:sav_library_kickstarter/Resources/Private/Language/ContextSensitiveHelp/Types/locallang_csh_richTextEditor.xml');
t3lib_extMgm::addLLrefForTCAdescr('sav_library_kickstarter_selectorbox','EXT:sav_library_kickstarter/Resources/Private/Language/ContextSensitiveHelp/Types/locallang_csh_selectorbox.xml');
t3lib_extMgm::addLLrefForTCAdescr('sav_library_kickstarter_showOnly','EXT:sav_library_kickstarter/Resources/Private/Language/ContextSensitiveHelp/Types/locallang_csh_showOnly.xml');
t3lib_extMgm::addLLrefForTCAdescr('sav_library_kickstarter_string','EXT:sav_library_kickstarter/Resources/Private/Language/ContextSensitiveHelp/Types/locallang_csh_string.xml');
t3lib_extMgm::addLLrefForTCAdescr('sav_library_kickstarter_text','EXT:sav_library_kickstarter/Resources/Private/Language/ContextSensitiveHelp/Types/locallang_csh_text.xml');

?>
