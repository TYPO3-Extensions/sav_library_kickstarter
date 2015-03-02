<?php

$extensionClassesPath = t3lib_extMgm::extPath('sav_library_kickstarter') . 'Classes/';	

// Version for Object Accessor Node
$versionObjectAccessorNode = 'ForTypo3VersionGreaterOrEqualTo4_5';
$versionObjectAccessorNode = (version_compare(TYPO3_version, '4.6', '>=') ? 'ForTypo3VersionGreaterOrEqualTo4_6' : $versionObjectAccessorNode);

// Version for the Core Template Parser
$versionTemplateParser = 'ForTypo3VersionGreaterOrEqualTo4_5';
$versionTemplateParser = (version_compare(TYPO3_version, '4.6', '>=') ? 'ForTypo3VersionGreaterOrEqualTo4_6' : $versionTemplateParser);

// Version for the Template Compiler
$versionTemplateCompiler = 'ForTypo3VersionGreaterOrEqualTo4_6';


$classMap = array(
	'tx_savlibrarykickstarter_codegenerator_abstractcodegenerator' =>  $extensionClassesPath . 'CodeGenerator/AbstractCodeGenerator.php',
	'tx_savlibrarykickstarter_codegenerator_codegeneratorforsavlibrary' =>  $extensionClassesPath . 'CodeGenerator/CodeGeneratorForSavLibrary.php',
	'tx_savlibrarykickstarter_codegenerator_codegeneratorforsavlibraryplus' =>  $extensionClassesPath . 'CodeGenerator/CodeGeneratorForSavLibraryPlus.php',

  'tx_savlibrarykickstarter_compatibility_extensionmanager' => $extensionClassesPath . 'TYPO4x/Compatibility/ExtensionManager.php',
	'tx_savlibrarykickstarter_compatibility_templateparserbuilder' => $extensionClassesPath . 'TYPO4x/Compatibility/TemplateParserBuilder.php',
	'tx_savlibrarykickstarter_compatibility_templateview' => $extensionClassesPath . 'TYPO4x/Compatibility/TemplateView.php',

	'tx_savlibrarykickstarter_configuration_configurationmanager' =>  $extensionClassesPath . 'Configuration/ConfigurationManager.php',

	'tx_savlibrarykickstarter_controller_kickstartercontroller' =>  $extensionClassesPath . 'TYPO4x/Controller/KickstarterController.php',
	'tx_savlibrarykickstarter_controller_kickstartercontrollerrootpath' =>  $extensionClassesPath . 'TYPO4x/Controller/KickstarterControllerRootPath.php',

	'tx_savlibrarykickstarter_core_compiler_templatecompiler' => $extensionClassesPath . 'Core/Compiler/TemplateCompiler' . $versionTemplateCompiler . '.php',

	'tx_savlibrarykickstarter_core_parser_syntaxtree_objectaccessornode' => $extensionClassesPath . 'TYPO4x/Core/Parser/SyntaxTree/ObjectAccessorNode' . $versionObjectAccessorNode . '.php',
	'tx_savlibrarykickstarter_core_parser_templateparser' => $extensionClassesPath . 'TYPO4x/Core/Parser/TemplateParser' . $versionTemplateParser . '.php',

	'tx_savlibrarykickstarter_parser_contentparser' => $extensionClassesPath . 'TYPO4x/Parser/ContentParser.php',

	'tx_savlibrarykickstarter_upgrade_abstractupgrademanager' => $extensionClassesPath . 'Upgrade/AbstractUpgradeManager.php',
	'tx_savlibrarykickstarter_upgrade_upgradefromkickstarter' => $extensionClassesPath . 'Upgrade/UpgradeFromKickstarter.php',

	'tx_savlibrarykickstarter_utility_autoloader' => $extensionClassesPath . 'TYPO4x/Utility/Autoloader.php',
	'tx_savlibrarykickstarter_utility_conversion' => $extensionClassesPath . 'Utility/Conversion.php',
	'tx_savlibrarykickstarter_utility_itemmanager' => $extensionClassesPath . 'Utility/ItemManager.php',
	'tx_savlibrarykickstarter_utility_viewhelpxclass' => $extensionClassesPath . 'Utility/ViewHelpXclass.php',    
  
  'tx_savlibrarykickstarter_viewhelpers_be_iconviewhelper' => $extensionClassesPath . 'TYPO4x/ViewHelpers/Be/IconViewHelper.php', 
  'tx_savlibrarykickstarter_viewhelpers_be_helpwindowviewhelper' => $extensionClassesPath . 'TYPO4x/ViewHelpers/Be/HelpWindowViewHelper.php',  

  'tx_savlibrarykickstarter_viewhelpers_form_selectviewhelper' => $extensionClassesPath . 'TYPO4x/ViewHelpers/Form/SelectViewHelper.php',

  'tx_savlibrarykickstarter_viewhelpers_link_emptyviewhelper' => $extensionClassesPath . 'TYPO4x/ViewHelpers/Link/EmptyViewHelper.php',

  'tx_savlibrarykickstarter_viewhelpers_aliasviewhelper' => $extensionClassesPath . 'ViewHelpers/AliasViewHelper.php',
  'tx_savlibrarykickstarter_viewhelpers_buildclassforextensionversionviewhelper' => $extensionClassesPath . 'TYPO4x/ViewHelpers/BuildClassForExtensionVersionViewHelper.php',
  'tx_savlibrarykickstarter_viewhelpers_buildconstraintsforextensionmanagerviewhelper' => $extensionClassesPath . 'TYPO4x/ViewHelpers/BuildConstraintsForExtensionManagerViewHelper.php',
  'tx_savlibrarykickstarter_viewhelpers_buildoptionsforexistingtablesselectorboxviewhelper' => $extensionClassesPath . 'TYPO4x/ViewHelpers/BuildOptionsForExistingTablesSelectorboxViewHelper.php',
  'tx_savlibrarykickstarter_viewhelpers_buildoptionsforextensionversionselectorboxviewhelper' => $extensionClassesPath . 'TYPO4x/ViewHelpers/BuildOptionsForExtensionVersionSelectorboxViewHelper.php',
  'tx_savlibrarykickstarter_viewhelpers_buildoptionsforfieldselectorboxviewhelper' => $extensionClassesPath . 'TYPO4x/ViewHelpers/BuildOptionsForFieldSelectorboxViewHelper.php',
  'tx_savlibrarykickstarter_viewhelpers_buildoptionsforfieldtypeselectorboxviewhelper' => $extensionClassesPath . 'TYPO4x/ViewHelpers/BuildOptionsForFieldTypeSelectorboxViewHelper.php',
  'tx_savlibrarykickstarter_viewhelpers_buildoptionsforfileiconselectorboxviewhelper' => $extensionClassesPath . 'TYPO4x/ViewHelpers/BuildOptionsForFileIconSelectorboxViewHelper.php',
  'tx_savlibrarykickstarter_viewhelpers_buildoptionsforrelationtableselectorboxviewhelper' => $extensionClassesPath . 'TYPO4x/ViewHelpers/BuildOptionsForRelationTableSelectorboxViewHelper.php',
  'tx_savlibrarykickstarter_viewhelpers_buildoptionsforrendertypeselectorboxviewhelper' => $extensionClassesPath . 'TYPO4x/ViewHelpers/BuildOptionsForRenderTypeSelectorboxViewHelper.php',
  'tx_savlibrarykickstarter_viewhelpers_buildoptionsforviewselectorboxviewhelper' => $extensionClassesPath . 'TYPO4x/ViewHelpers/BuildOptionsForViewSelectorboxViewHelper.php',
  'tx_savlibrarykickstarter_viewhelpers_buildorderbyclauseforrelationtableviewhelper' => $extensionClassesPath . 'TYPO4x/ViewHelpers/BuildOrderByClauseForRelationTableViewHelper.php',
  'tx_savlibrarykickstarter_viewhelpers_buildtablenameviewhelper' => $extensionClassesPath . 'TYPO4x/ViewHelpers/BuildTableNameViewHelper.php',
  'tx_savlibrarykickstarter_viewhelpers_commentviewhelper' => $extensionClassesPath . 'TYPO4x/ViewHelpers/CommentViewHelper.php',
  'tx_savlibrarykickstarter_viewhelpers_flashhtmlmessagesviewhelper' => $extensionClassesPath . 'TYPO4x/ViewHelpers/FlashHtmlMessagesViewHelper.php',
  'tx_savlibrarykickstarter_viewhelpers_functionviewhelper' => $extensionClassesPath . 'TYPO4x/ViewHelpers/FunctionViewHelper.php',
  'tx_savlibrarykickstarter_viewhelpers_getrelationtablekeyforsubformviewhelper' => $extensionClassesPath . 'TYPO4x/ViewHelpers/GetRelationTableKeyForSubformViewHelper.php',
  'tx_savlibrarykickstarter_viewhelpers_indentviewhelper' => $extensionClassesPath . 'TYPO4x/ViewHelpers/IndentViewHelper.php',
  'tx_savlibrarykickstarter_viewhelpers_lowercamelviewhelper' => $extensionClassesPath . 'TYPO4x/ViewHelpers/LowerCamelViewHelper.php',
  'tx_savlibrarykickstarter_viewhelpers_parseviewhelper' => $extensionClassesPath . 'TYPO4x/ViewHelpers/ParseViewHelper.php',
  'tx_savlibrarykickstarter_viewhelpers_removeifcontainsdonotcreateviewhelper' => $extensionClassesPath . 'TYPO4x/ViewHelpers/RemoveIfContainsDoNotCreateViewHelper.php',
  'tx_savlibrarykickstarter_viewhelpers_removeifcontainsdonotcreateviewhelper' => $extensionClassesPath . 'TYPO4x/ViewHelpers/RemoveIfContainsDoNotCreateViewHelper.php',
  'tx_savlibrarykickstarter_viewhelpers_renderviewhelper' => $extensionClassesPath . 'TYPO4x/ViewHelpers/RenderViewHelper.php',
  'tx_savlibrarykickstarter_viewhelpers_SortFieldsViewHelper' => $extensionClassesPath . 'TYPO4x/ViewHelpers/SortFieldsViewHelper.php',
  'tx_savlibrarykickstarter_viewhelpers_tcaelementstoxmlviewhelper' => $extensionClassesPath . 'TYPO4x/ViewHelpers/TcaElementsToXmlViewHelper.php',
  'tx_savlibrarykickstarter_viewhelpers_tolowerviewhelper' => $extensionClassesPath . 'TYPO4x/ViewHelpers/ToLowerViewHelper.php',
  'tx_savlibrarykickstarter_viewhelpers_uppercamelviewhelper' => $extensionClassesPath . 'TYPO4x/ViewHelpers/UpperCamelViewHelper.php',

);
?>