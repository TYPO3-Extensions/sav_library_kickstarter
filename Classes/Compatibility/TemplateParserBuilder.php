<?php


/*                                                                        *
 * This script is part of the TYPO3 project - inspiring people to share!  *
 *                                                                        *
 * TYPO3 is free software; you can redistribute it and/or modify it under *
 * the terms of the GNU General Public License version 2 as published by  *
 * the Free Software Foundation.                                          *
 *                                                                        *
 * This script is distributed in the hope that it will be useful, but     *
 * WITHOUT ANY WARRANTY; without even the implied warranty of MERCHAN-    *
 * TABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General      *
 * Public License for more details.                                       *
 *                                                                        */

/**
 */
/**
 * Build a template parser.
 * Use this class to get a fresh instance of a correctly initialized Fluid template parser.
 */
class Tx_SavLibraryKickstarter_Compatibility_TemplateParserBuilder {
	
	/**
	 * Gets an object manager which is correctly initialized. 
	 *
	 * @return mixed The object manager
	 */	
	static public function getObjectManager() {
		if (class_exists('Tx_Fluid_Compatibility_ObjectManager')) {
      // For TYPO3 > 4.4
  		return t3lib_div::makeInstance('Tx_Fluid_Compatibility_ObjectManager');
    } else {
		  return t3lib_div::makeInstance('Tx_Extbase_Object_ObjectManager');
    }		
	}	
	
	/**
	 * Creates a new TemplateParser which is correctly initialized. This is the correct
	 * way to get a Fluid parser instance.
	 *
	 * @return Tx_Fluid_Core_TemplateParser A correctly initialized Template Parser
	 */
	static public function build() {
		$templateParser = t3lib_div::makeInstance('Tx_SavLibraryKickstarter_Core_Parser_TemplateParser');
		$templateParser->injectObjectManager(self::getObjectManager());

    Tx_Fluid_Core_Parser_TemplateParser::$SCAN_PATTERN_SHORTHANDSYNTAX_OBJECTACCESSORS = Tx_SavLibraryKickstarter_Core_Parser_TemplateParser::$SCAN_PATTERN_SHORTHANDSYNTAX_OBJECTACCESSORS;

		return $templateParser;
	}
}

?>
