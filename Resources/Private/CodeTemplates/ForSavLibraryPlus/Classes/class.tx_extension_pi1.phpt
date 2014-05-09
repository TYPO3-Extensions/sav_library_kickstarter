<?php

/***************************************************************
*  Copyright notice
*
*  (c) <f:format.date format="Y">now</f:format.date> {extension.emconf.1.author} <{extension.emconf.1.author_email}>
*  All rights reserved
*
*  This script is part of the TYPO3 project. The TYPO3 project is
*  free software; you can redistribute it and/or modify
*  it under the terms of the GNU General Public License as published by
*  the Free Software Foundation; either version 2 of the License, or
*  (at your option) any later version.
*
*  The GNU General Public License can be found at
*  http://www.gnu.org/copyleft/gpl.html.
*
*  This script is distributed in the hope that it will be useful,
*  but WITHOUT ANY WARRANTY; without even the implied warranty of
*  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
*  GNU General Public License for more details.
*
*  This copyright notice MUST APPEAR in all copies of the script!
***************************************************************/
<f:alias map="{extensionName: '{sav:function(name:\'removeUnderscore\', arguments:\'{extension.general.1.extensionKey}\')}'}">
/**
 * Plugin '{extension.emconf.1.title}' for the '{extension.general.1.extensionKey}' extension.
 *
 * @author {extension.emconf.1.author} <{extension.emconf.1.author_email}>
 * @package TYPO3
 * @subpackage tx_{extensionName}
 */
class tx_{extensionName}_pi1 extends tslib_pibase {

	public $prefixId = 'tx_{extensionName}_pi1';		// Same as class name
	public $scriptRelPath = 'Classes/class.tx_{extensionName}_pi1.php';	// Path to this script relative to the extension dir.
	public $extKey = '{extension.general.1.extensionKey}';	// The extension key.
	            
	public function main($content, $conf) {

	  // Creates the SavLibraryPlus controller
	  $controller = t3lib_div::makeInstance('Tx_SavLibraryPlus_Controller_Controller');

	  // Gets the extension configuration manager
	  $extensionConfigurationManager = $controller->getExtensionConfigurationManager();

	  // Injects the extension in the extension configuration manager
	  $extensionConfigurationManager->injectExtension($this);

	  // Injects the typoScript configuration in the extension configuration manager
	  $extensionConfigurationManager->injectTypoScriptConfiguration($conf);

	  // Sets the debug variable. Use debug ONLY for development
	  $controller->setDebug({f:if(condition:extension.general.1.debug, then:extension.general.1.debug, else:0)});

	  // Renders the form
	  $out = $controller->render();
	          
	  return $out;
	}

}

if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/{extension.general.1.extensionKey}/Classes/class.tx_{extensionName}_pi1.php'])	{
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/{extension.general.1.extensionKey}/Classes/class.tx_{extensionName}_pi1.php']);
}
</f:alias>
?>
