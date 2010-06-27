<?php
if (!defined ('TYPO3_MODE')) 	die ('Access denied.');

// Makes the extension version available to the extension scripts
require_once(t3lib_extMgm::extPath($_EXTKEY) . 'ext_emconf.php');
$TYPO3_CONF_VARS['EXTCONF'][$_EXTKEY]['version'] = $EM_CONF[$_EXTKEY]['version'];

if (t3lib_extMgm::isLoaded('fluid')) {
  // Gets the fluid version and makes it available to the extension scripts
  $_EXTKEY = 'fluid';
  require_once(t3lib_extMgm::extPath($_EXTKEY) . 'ext_emconf.php');
  $TYPO3_CONF_VARS['EXTCONF'][$_EXTKEY]['version'] = $EM_CONF[$_EXTKEY]['version'];
}
                               
?>
