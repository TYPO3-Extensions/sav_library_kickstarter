<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

/**
* Register Backend Module
*/

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerModule(
	'SAV.' . $_EXTKEY,
	'tools',
	'mod',
	'',
	array(
		'Kickstarter' => '
      extensionList,
      selectExtensionVersion,
      changeExtensionVersion,
      createExtension,
      copyExtension,
      editExtension,
      installExtension,
      uninstallExtension,
      downloadExtension,
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
		'icon'   => 'EXT:' . $_EXTKEY . '/ext_icon.gif',
		'labels' => 'LLL:EXT:' . $_EXTKEY . '/Resources/Private/Language/locallang_mod.xml',
	)
);

// Context Sensitive Help for the SAV Library Kickstarter sections
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('xEXT_' . $_EXTKEY . '_emconf','EXT:' . $_EXTKEY . '/Resources/Private/Language/ContextSensitiveHelp/locallang_csh_emconf.xml');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('xEXT_' . $_EXTKEY . '_views','EXT:' . $_EXTKEY . '/Resources/Private/Language/ContextSensitiveHelp/locallang_csh_views.xml');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('xEXT_' . $_EXTKEY . '_queries','EXT:' . $_EXTKEY . '/Resources/Private/Language/ContextSensitiveHelp/locallang_csh_queries.xml');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('xEXT_' . $_EXTKEY . '_forms','EXT:' . $_EXTKEY . '/Resources/Private/Language/ContextSensitiveHelp/locallang_csh_forms.xml');

// Context Sensitive Help for the field types
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('xEXT_' . $_EXTKEY . '_all','EXT:' . $_EXTKEY . '/Resources/Private/Language/ContextSensitiveHelp/Types/locallang_csh_all.xml');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('xEXT_' . $_EXTKEY . '_checkbox','EXT:' . $_EXTKEY . '/Resources/Private/Language/ContextSensitiveHelp/Types/locallang_csh_checkbox.xml');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('xEXT_' . $_EXTKEY . '_checkboxes','EXT:' . $_EXTKEY . '/Resources/Private/Language/ContextSensitiveHelp/Types/locallang_csh_checkboxes.xml');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('xEXT_' . $_EXTKEY . '_date','EXT:' . $_EXTKEY . '/Resources/Private/Language/ContextSensitiveHelp/Types/locallang_csh_date.xml');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('xEXT_' . $_EXTKEY . '_dateTime','EXT:' . $_EXTKEY . '/Resources/Private/Language/ContextSensitiveHelp/Types/locallang_csh_dateTime.xml');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('xEXT_' . $_EXTKEY . '_files','EXT:' . $_EXTKEY . '/Resources/Private/Language/ContextSensitiveHelp/Types/locallang_csh_files.xml');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('xEXT_' . $_EXTKEY . '_functions','EXT:' . $_EXTKEY . '/Resources/Private/Language/ContextSensitiveHelp/Types/locallang_csh_functions.xml');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('xEXT_' . $_EXTKEY . '_graph','EXT:' . $_EXTKEY . '/Resources/Private/Language/ContextSensitiveHelp/Types/locallang_csh_graph.xml');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('xEXT_' . $_EXTKEY . '_general','EXT:' . $_EXTKEY . '/Resources/Private/Language/ContextSensitiveHelp/Types/locallang_csh_general.xml');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('xEXT_' . $_EXTKEY . '_integer','EXT:' . $_EXTKEY . '/Resources/Private/Language/ContextSensitiveHelp/Types/locallang_csh_integer.xml');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('xEXT_' . $_EXTKEY . '_link','EXT:' . $_EXTKEY . '/Resources/Private/Language/ContextSensitiveHelp/Types/locallang_csh_link.xml');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('xEXT_' . $_EXTKEY . '_radioButtons','EXT:' . $_EXTKEY . '/Resources/Private/Language/ContextSensitiveHelp/Types/locallang_csh_radioButtons.xml');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('xEXT_' . $_EXTKEY . '_relationManyToManyAsDoubleSelectorbox','EXT:' . $_EXTKEY . '/Resources/Private/Language/ContextSensitiveHelp/Types/locallang_csh_relationManyToManyAsDoubleSelectorbox.xml');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('xEXT_' . $_EXTKEY . '_relationManyToManyAsSubform','EXT:' . $_EXTKEY . '/Resources/Private/Language/ContextSensitiveHelp/Types/locallang_csh_relationManyToManyAsSubform.xml');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('xEXT_' . $_EXTKEY . '_relationOneToManyAsSelectorbox','EXT:' . $_EXTKEY . '/Resources/Private/Language/ContextSensitiveHelp/Types/locallang_csh_relationOneToManyAsSelectorbox.xml');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('xEXT_' . $_EXTKEY . '_richTextEditor','EXT:' . $_EXTKEY . '/Resources/Private/Language/ContextSensitiveHelp/Types/locallang_csh_richTextEditor.xml');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('xEXT_' . $_EXTKEY . '_selectorbox','EXT:' . $_EXTKEY . '/Resources/Private/Language/ContextSensitiveHelp/Types/locallang_csh_selectorbox.xml');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('xEXT_' . $_EXTKEY . '_showOnly','EXT:' . $_EXTKEY . '/Resources/Private/Language/ContextSensitiveHelp/Types/locallang_csh_showOnly.xml');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('xEXT_' . $_EXTKEY . '_string','EXT:' . $_EXTKEY . '/Resources/Private/Language/ContextSensitiveHelp/Types/locallang_csh_string.xml');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('xEXT_' . $_EXTKEY . '_text','EXT:' . $_EXTKEY . '/Resources/Private/Language/ContextSensitiveHelp/Types/locallang_csh_text.xml');

?>
