<?php

/***************************************************************
*  Copyright notice
*
*  (c) 2011 Laurent Foulloy <yolf.typo3@orange.fr>
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

/**
 * Autoloader
 *
 * @package SavLibraryPlus
 * @version $ID:$
 */

class Tx_SavLibraryKickstarter_Utility_Autoloader {
  
  protected static $classAliases = array(
    // CMS
    'TYPO3\\CMS\\Backend\\Utility\\IconUtility' => 't3lib_iconWorks',  
    'TYPO3\CMS\Core\Utility\VersionNumberUtility' => 't3lib_utility_VersionNumber',
    // Fluid
    'TYPO3\\CMS\\Fluid\\Core\\Parser\\TemplateParser' => 'Tx_Fluid_Core_Parser_TemplateParser',  
  	'TYPO3\\CMS\\Fluid\\ViewHelpers\\Form\\SelectViewHelper' => 'Tx_Fluid_ViewHelpers_Form_SelectViewHelper',
    'TYPO3\\CMS\\Fluid\\View\\TemplateView' => 'Tx_Fluid_View_TemplateView', 
    'TYPO3\\CMS\\Fluid\\ViewHelpers\\Be\\AbstractBackendViewHelper' => 'Tx_Fluid_ViewHelpers_Be_AbstractBackendViewHelper',
    // Extbase
    'TYPO3\\CMS\\Extbase\\Configuration\\ConfigurationManagerInterface'=> 'Tx_Extbase_Configuration_ConfigurationManagerInterface',   
    'TYPO3\\CMS\\Extbase\\Mvc\\Controller\\ActionController' => 'Tx_Extbase_MVC_Controller_ActionController',
    // SAV Library Kickstarter
    'SAV\\SavLibraryKickstarter\\CodeGenerator\\AbstractCodeGenerator' => 'Tx_SavLibraryKickstarter_CodeGenerator_AbstractCodeGenerator',
  	'SAV\\SavLibraryKickstarter\\CodeGenerator\\CodeGeneratorForSavLibrary' => 'Tx_SavLibraryKickstarter_CodeGenerator_CodeGeneratorForSavLibrary',
  	'SAV\\SavLibraryKickstarter\\CodeGenerator\\CodeGeneratorForSavLibraryPlus' => 'Tx_SavLibraryKickstarter_CodeGenerator_CodeGeneratorForSavLibraryPlus',
    'SAV\\SavLibraryKickstarter\\Compatibility\\TemplateParserBuilder' => 'Tx_SavLibraryKickstarter_Compatibility_TemplateParserBuilder',	
  	'SAV\\SavLibraryKickstarter\\Compatibility\\TemplateView' => 'Tx_SavLibraryKickstarter_Compatibility_TemplateView', 	 
		'SAV\\SavLibraryKickstarter\\Configuration\\ConfigurationManager' => 'Tx_SavLibraryKickstarter_Configuration_ConfigurationManager',
  	'SAV\\SavLibraryKickstarter\\Controller\\KickstarterControllerRootPath' => 'Tx_SavLibraryKickstarter_Controller_KickstarterControllerRootPath',
		'SAV\SavLibraryKickstarter\Compatibility\ExtensionManager' => 'Tx_SavLibraryKickstarter_Compatibility_ExtensionManager',
  	'SAV\SavLibraryKickstarter\Parser\ContentParser' => 'Tx_SavLibraryKickstarter_Parser_ContentParser',
  	'SAV\\SavLibraryKickstarter\\Utility\\Conversion' => 'Tx_SavLibraryKickstarter_Utility_Conversion',
  	'SAV\\SavLibraryKickstarter\\Utility\\ItemManager' => 'Tx_SavLibraryKickstarter_Utility_ItemManager',
  );
  
  static public function register() {
    spl_autoload_register(array(__CLASS__, 'autoload'));
  }
 
  static public function autoload($class) {
    if ((strpos($class, 'TYPO3\\') === 0 || strpos($class, 'SAV\\SavLibraryKickstarter') === 0) && array_key_exists($class, self::$classAliases)) { 
      class_alias(self::$classAliases[$class], $class);
    }     
  }
  
}
?>
