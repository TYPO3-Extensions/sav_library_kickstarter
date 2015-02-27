<?php

if (version_compare(TYPO3_version, '6.0', '<')) {
  require_once(t3lib_extMgm::extPath('sav_library_kickstarter') . 'Configuration/Autoload/ext_autoload.php');
} else {
  $extensionClassesPath = t3lib_extMgm::extPath('sav_library_kickstarter') . 'Classes/';	  

  // Version for the Extension manager
  if (version_compare(TYPO3_version, '6.2', '>=')) {
    $extensionManagerVersion = 'ForTypo3VersionGreaterOrEqualTo6_2';
  } else {
    $extensionManagerVersion = 'ForTypo3VersionGreaterOrEqualTo6_0';    
  }

  // Version for the kickstarterRootPath
  if (version_compare(TYPO3_version, '7.0', '>=')) {
    $kickstarterRootPathVersion = 'ForTypo3VersionGreaterOrEqualTo7_0';
  } else {
    $kickstarterRootPathVersion = 'ForTypo3VersionGreaterOrEqualTo6_0';    
  }  
  $classMap = array(
		'SAV\\SavLibraryKickstarter\\Compatibility\\ExtensionManager' => $extensionClassesPath . 'Compatibility/ExtensionManager' . $extensionManagerVersion . '.php',
		'SAV\\SavLibraryKickstarter\\Controller\\KickstarterControllerRootPath' => $extensionClassesPath . 'Controller/KickstarterControllerRootPath' . $kickstarterRootPathVersion . '.php',
  );
}
 return $classMap;
?>
