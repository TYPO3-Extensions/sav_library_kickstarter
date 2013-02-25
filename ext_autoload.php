<?php

$extensionClassesPath = t3lib_extMgm::extPath('sav_library_kickstarter') . 'Classes/';
// Version for Object Accessor Node
$versionObjectAccessorNode = '';
$versionObjectAccessorNode = (version_compare(TYPO3_version, '4.5', '>=') ? 'ForTypo3VersionGreaterOrEqualTo4_5' : $versionObjectAccessorNode);
$versionObjectAccessorNode = (version_compare(TYPO3_version, '4.6', '>=') ? 'ForTypo3VersionGreaterOrEqualTo4_6' : $versionObjectAccessorNode);
// Version for the Core Template Parser
$versionTemplateParser = '';
$versionTemplateParser = (version_compare(TYPO3_version, '4.6', '>=') ? 'ForTypo3VersionGreaterOrEqualTo4_6' : $versionTemplateParser);
// Version for the Template Compiler
$versionTemplateCompiler = 'ForTypo3VersionGreaterOrEqualTo4_6';
$versionTemplateCompiler = (version_compare(TYPO3_version, '6.0', '>=') ? 'ForTypo3VersionGreaterOrEqualTo6_0' : $versionTemplateCompiler);
// Version for the Extension manager
$versionExtensionManager = '';
$versionExtensionManager = (version_compare(TYPO3_version, '4.5', '>=') ? 'ForTypo3VersionGreaterOrEqualTo4_5' : $versionExtensionManager);
$versionExtensionManager = (version_compare(TYPO3_version, '6.0', '>=') ? 'ForTypo3VersionGreaterOrEqualTo6_0' : $versionExtensionManager);

return array(
	'tx_savlibrarykickstarter_core_parser_syntaxtree_objectaccessornode' => $extensionClassesPath . 'Core/Parser/SyntaxTree/ObjectAccessorNode' . $versionObjectAccessorNode . '.php',
	'tx_savlibrarykickstarter_core_parser_templateparser' => $extensionClassesPath . 'Core/Parser/TemplateParser' . $versionTemplateParser . '.php',
	'tx_savlibrarykickstarter_core_compiler_templatecompiler' => $extensionClassesPath . 'Core/Compiler/TemplateCompiler' . $versionTemplateCompiler . '.php',
	'tx_savlibrarykickstarter_compatibility_extensionmanager' => $extensionClassesPath . 'Compatibility/ExtensionManager' . $versionExtensionManager . '.php',
);
?>
