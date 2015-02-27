<?php
namespace SAV\SavLibraryKickstarter\Compatibility;
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
 * Build a template parser.
 * Use this class to get a fresh instance of a correctly initialized Fluid template parser.
 */
class TemplateParserBuilder {
	
	/**
	 * Gets an object manager which is correctly initialized. 
	 *
	 * @return mixed The object manager
	 */	
	static public function getObjectManager() {
		return \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\\CMS\\Extbase\\Object\\ObjectManager');
	}
	
	/**
	 * Creates a new TemplateParser which is correctly initialized. This is the correct
	 * way to get a Fluid parser instance.
	 *
	 * @return Tx_Fluid_Core_TemplateParser A correctly initialized Template Parser
	 */
	static public function build() {
		$objectManager = self::getObjectManager();
	  $templateParser = $objectManager->get('SAV\\SavLibraryKickstarter\\Core\\Parser\\TemplateParser');
		\TYPO3\CMS\Fluid\Core\Parser\TemplateParser::$SCAN_PATTERN_SHORTHANDSYNTAX_OBJECTACCESSORS = \SAV\SavLibraryKickstarter\Core\Parser\TemplateParser::$SCAN_PATTERN_SHORTHANDSYNTAX_OBJECTACCESSORS;
		
		return $templateParser;
	}
}

?>
