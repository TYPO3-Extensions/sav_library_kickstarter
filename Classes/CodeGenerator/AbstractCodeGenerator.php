<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2010 Laurent Foulloy (yolf.typo3@orange.fr)
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
 * This abstract class generates the code for a front end plugin.
 * 
 * It is based on the same idea developed by Ingmar Schlecht for the extbase_kickstater.
 * Code templates are used to build the file contents. They are processed by a fluid parser.
 *
 * @package SavLibraryKickstarter
 * @version $ID:$
 */
abstract class Tx_SavLibraryKickstarter_CodeGenerator_AbstractCodeGenerator {

  protected $codeTemplatesDirectory = 'Resources/Private/CodeTemplates/ForSavLibrary/';

	/**
	 * @var Tx_SavLibraryKickstarter_Configuration_SectionManager
	 */
	protected $sectionManager;

	/**
	 * @var string
	 */
	protected $extensionDirectory;

	/**
	 * @var string
	 */
	protected $extensionKey;
		
	/**
	 * Constructor.
	 *
	 * return none
	 */
	public function __construct($sectionManager) {
    $this->sectionManager = $sectionManager;
    $this->extensionKey = $this->sectionManager->getItem('general')->getItem(1)->getItem('extensionKey');
    $this->extensionDirectory = PATH_typo3conf . 'ext/' . $this->extensionKey . '/';
	}
	
	/**
	 * Builds all the files for the extension.
	 *
	 * return none
	 */
	public function buildExtension() {
	}

	/**
	 * Gets the content of a file.
	 *
	 * @param string $templateFilePath The relative template file path
	 * return string The file content
	 */
	public function getFileContent($templateFilePath) {
    $fileContent = file_get_contents(t3lib_extMgm::extPath('sav_library_kickstarter') . $this->codeTemplatesDirectory . $templateFilePath);
		return $fileContent;
  }

	/**
	 * Generates a file using a file template.
	 *
	 * @param string $templateFilePath The relative template file path
	 * @param integer $itemKey The itemKey used for the file generation
	 * @param array $extensionArray The extension array
	 * return string The parsed file content
	 */
	public function generateFile($templateFilePath, $itemKey = NULL, $extensionArray = NULL) {
    $arguments = array(
      'extension' => ($extensionArray === NULL ? $this->sectionManager->getItemsAsArray() : $extensionArray)
    );
    if ($itemKey !== NULL) {
      $arguments = array_merge(
        $arguments,
        array(
          'itemKey' => $itemKey
        )
      );
    }
    $fileContent = $this->getFileContent($templateFilePath);
    return Tx_SavLibraryKickstarter_Parser_ContentParser::parse($fileContent, $arguments);
  }

}
?>
