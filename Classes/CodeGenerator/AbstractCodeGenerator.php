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
class Tx_SavLibraryKickstarter_CodeGenerator_AbstractCodeGenerator {

  const CODE_TEMPLATES_DIRECTORY = 'Resources/Private/CodeTemplates/ForSavLibrary/';

	/**
	 * @var Tx_SavLibraryKickstarter_Configuration_SectionManager
	 */
	protected $sectionManager;

	/**
	 * @var Tx_Extbase_MVC_Controller_FlashMessages
	 */
	protected $flashMessages;
	
	/**
	 * @var array
	 */
	protected $hiddenArguments;

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
	 * Set flash Messages.
	 *
	 * return none
	 */
	public function setFlashMessages($flashMessages) {
    $this->flashMessages = $flashMessages;
	}


	/**
	 * Set hidden arguments.
	 *
	 * @param array $hiddenArguments The arguments to be used as hidden for checkDbUpdates
	 * return none
	 */
	public function setHiddenArguments($hiddenArguments) {
    $this->hiddenArguments = $hiddenArguments;
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
    $fileContent = file_get_contents(t3lib_extMgm::extPath('sav_library_kickstarter') . self::CODE_TEMPLATES_DIRECTORY . $templateFilePath);
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

		return Tx_SavLibraryKickstarter_Parser_TemplateParser::parseTemplate($fileContent, $arguments);
  }

	/**
	 * Creates the extension manager.
	 *
	 * return SC_mod_tools_em_index The extension manager.
	 */
  private function createExtensionManager() {
    require_once(PATH_t3lib . '../typo3/mod/tools/em/class.em_index.php');
    $extensionManager = t3lib_div::makeInstance('SC_mod_tools_em_index');
    $extensionManager->typePaths = Array (
      'L' => 'typo3conf/ext/'
		);
		return $extensionManager;
  }
  
	/**
	 * Installs the extension.
	 *
	 * @param string $extensionKey
	 * return none
	 */
  public function installExtension($extensionKey = NULL) {
    if ($extensionKey === NULL) {
      $extensionKey = $this->extensionKey;
    }
    // Creates the extension manager
    $extensionManager = $this->createExtensionManager();
    // Installs the extension
    $extensionManager->installExtension($extensionKey);
    // Clear the caches
		$tce = t3lib_div::makeInstance('t3lib_TCEmain');
		$tce->stripslashes_values = 0;
		$tce->start(Array(),Array());
		$tce->clear_cacheCmd('all');
    $extensionManager->removeCacheFiles();
		$GLOBALS['BE_USER']->writelog(5, 1, 0, 0, 'Extension list has been changed, extension %s has been installed', array($extensionKey));
  }

	/**
	 * Uninstalls the extension
	 *
	 * @param string $extensionKey
	 * return none
	 */
  public function uninstallExtension($extensionKey = NULL) {
    if ($extensionKey === NULL) {
      $extensionKey = $this->extensionKey;
    }
    // Creates the extension manager
    $extensionManager = $this->createExtensionManager();
		// Removes the extension from the installed extensions
		$installedExtensions = current($extensionManager->getInstalledExtensions());
		if (array_key_exists($extensionKey, $installedExtensions)) {
      $newInstalledExtensions = $extensionManager->removeExtFromList($extensionKey, $installedExtensions);
      if ($newInstalledExtensions != -1) {
        $extensionManager->writeNewExtensionList($newInstalledExtensions);
        // Clears the caches
        $extensionManager->removeCacheFiles();
				$tce = t3lib_div::makeInstance('t3lib_TCEmain');
				$tce->stripslashes_values = 0;
				$tce->start(Array(),Array());
				$tce->clear_cacheCmd('all');
				$GLOBALS['BE_USER']->writelog(5, 1, 0, 0, 'Extension list has been changed, extension %s has been removed', array($extensionKey));
      } else {
        $this->flashMessages->add(Tx_Extbase_Utility_Localization::translate('error.extensionHasDependencies', 'sav_library_kickstarter'));
      }
    }
  }
  
	/**
	 * Cheks the if database must be updated.
	 * If true a flash message is added.
	 *
	 * @param string $extensionKey
	 * return none
	 */
	public function checkDbUpdate($extensionKey = NULL) {
    if ($extensionKey === NULL) {
      $extensionKey = $this->extensionKey;
    }

    // Creates the extension manager
    $extensionManager = $this->createExtensionManager();

    // Gets the installed extensions and gets the updates form.
		$installedExtensions = current($extensionManager->getInstalledExtensions());
    $updateMessage = $extensionManager->updatesForm($extensionKey,$installedExtensions[$extensionKey]);

    if ($updateMessage) {
      // Adds hidden arguments to retreive the section and the itemKey when updating
      $updateMessage .= $this->createHiddenTag(array('[general][section]' => $this->hiddenArguments['section']));
      $updateMessage .= $this->createHiddenTag(array('[general][itemKey]' => $this->hiddenArguments['itemKey']));
      $updateMessage .= $this->createHiddenTag(array('[submitAction][updateDb]' => 1));

      // Adds the message
      $this->flashMessages->add('<form>' . $updateMessage . '</form>');
    }
	}


	/**
	 * Cheks the if database must be updated.
	 * If true a flash message is added.
	 *
	 * @param array $argument
	 * return none
	 */
	private function CreateHiddenTag($argument) {
    return '<input type="hidden" name="tx_savlibrarykickstarter_' .
          strtolower(t3lib_div::_GET('M')) .
          key($argument) . '" value="' . current($argument) . '" />';
	}
}
?>
