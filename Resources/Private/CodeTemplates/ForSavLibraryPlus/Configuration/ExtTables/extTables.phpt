<?php

if (version_compare(TYPO3_version, '6.0', '<')) {
  require_once(t3lib_extMgm::extPath('{extension.general.1.extensionKey}') . 'Configuration/ExtTables/TYPO4x/ext_tables.php');
} else {
  require_once(\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('{extension.general.1.extensionKey}') . 'Configuration/ExtTables/ext_tables.php');
}
?>
