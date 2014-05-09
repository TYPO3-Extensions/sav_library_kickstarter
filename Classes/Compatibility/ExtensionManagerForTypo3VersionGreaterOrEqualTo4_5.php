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
class Tx_SavLibraryKickstarter_Compatibility_ExtensionManager {

	/**
	 * @var Tx_Extbase_MVC_Controller_FlashMessages
	 */
	protected $flashMessages;

	/**
	 * @var array
	 */
	protected $generalArguments;

	/**
	 * XML handling class for the TYPO3 Extension Manager
	 *
	 * @var tx_em_Tools_XmlHandler
	 */
	public $xmlHandler;

	/**
	 * Class for printing extension lists
	 *
	 * @var tx_em_Extensions_List
	 */
	public $extensionList;

	/**
	 * Class for extension details
	 *
	 * @var tx_em_Extensions_Details
	 */
	public $extensionDetails;

	/**
	 * Class for install
	 *
	 * @var tx_em_Install
	 */
	public $install;
	
	/**
	 * Class for terConnection
	 *
	 * @var tx_em_Connection_Ter
	 */
	public $terConnection;
		
	/**
	 * Constructor.
	 *
	 * return none
	 */
	public function __construct($extensionKey) {
	  $this->extensionKey = $extensionKey;

  	$this->xmlHandler = t3lib_div::makeInstance('tx_em_Tools_XmlHandler');
  	$this->extensionList = t3lib_div::makeInstance('tx_em_Extensions_List', $this);
  	$this->extensionDetails = t3lib_div::makeInstance('tx_em_Extensions_Details', $this);
  	$this->install = t3lib_div::makeInstance('tx_em_Install', $this);
  	$this->terConnection = t3lib_div::makeInstance('tx_em_Connection_Ter', $this);
	}

	/**
	 * injects arguments.
	 *
	 * return none
	 */
	public function injectGeneralArguments($generalArguments) {
    $this->generalArguments = $generalArguments;
	}

	/**
	 * Sets flash Messages.
	 *
	 * return none
	 */
	public function injectFlashMessages($flashMessages) {
    $this->flashMessages = $flashMessages;
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

    // Gets the installed extension
		list($installedExtensions) = $this->extensionList->getInstalledExtensions();

		// check if it is already installed and loaded with sufficient version
		if (isset($installedExtensions[$extensionKey])) {

			if (!t3lib_extMgm::isLoaded($extensionKey)) {
				if (!t3lib_extMgm::isLocalconfWritable()) {
          $this->flashMessages->add($GLOBALS['LANG']->getLL('ext_import_p_localconf'));
          return;
				}

        // Adds the extension to the list
				$newInstalledExtensions = $this->extensionList->addExtToList($extensionKey, $installedExtensions);
				if ($newInstalledExtensions != -1) {
					$this->install->writeNewExtensionList($newInstalledExtensions);
          tx_em_Tools::refreshGlobalExtList();
					$this->install->forceDBupdates($extensionKey, $installedExtensions[$extensionKey]);
				}
			}
		} else {
      $this->flashMessages->add($GLOBALS['LANG']->getLL('ext_import_ext_not_loaded'));
      return;
    }

    // Clears the caches
		$tce = t3lib_div::makeInstance('t3lib_TCEmain');
		$tce->stripslashes_values = 0;
		$tce->start(array(), array());
		$tce->clear_cacheCmd('all');
    t3lib_extMgm::removeCacheFiles();
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

		// Removes the extension from the installed extensions
		list($installedExtensions) = $this->extensionList->getInstalledExtensions();
		if (array_key_exists($extensionKey, $installedExtensions)) {
      $newInstalledExtensions = $this->extensionList->removeExtFromList($extensionKey, $installedExtensions);
      if ($newInstalledExtensions != -1) {
        $this->install->writeNewExtensionList($newInstalledExtensions);
        // Clears the caches
        t3lib_extMgm::removeCacheFiles();
				$tce = t3lib_div::makeInstance('t3lib_TCEmain');
				$tce->stripslashes_values = 0;
				$tce->start(array(), array());
				$tce->clear_cacheCmd('all');
				$GLOBALS['BE_USER']->writelog(5, 1, 0, 0, 'Extension list has been changed, extension %s has been removed', array($extensionKey));
      } else {
        $this->flashMessages->add(Tx_Extbase_Utility_Localization::translate('error.extensionHasDependencies', 'sav_library_kickstarter'));
      }
    }
  }

	/**
	 * Downloads the extension
	 *
	 * @param string $extensionKey
	 * return none
	 */
  public function downloadExtension($extensionKey = NULL) {
    if ($extensionKey === NULL) {
      $extensionKey = $this->extensionKey;
    }

    // Gets the installed extensions
		list($installedExtensions) = $this->extensionList->getInstalledExtensions();
		
		// Gets the installed extension information
		$installedExtensionInformation = $installedExtensions[$extensionKey];
		
		// Gets the upload array
		$uploadArray = $this->extensionDetails->makeUploadarray($extensionKey, $installedExtensionInformation);		

		if (is_array($uploadArray)) {
			// Gets the TER commection
			$backUpData = $this->terConnection->makeUploadDataFromarray($uploadArray);
			$filename = 'T3X_' . $extensionKey . '-' . str_replace('.', '_', $installedExtensionInformation['EM_CONF']['version']) . '-z-' . date('YmdHi') . '.t3x';
			t3lib_div::cleanOutputBuffers();
			header('Content-Type: application/octet-stream');
			header('Content-Disposition: attachment; filename=' . $filename);
			echo $backUpData;
			exit;   
		}    
  } 		  
  
	/**
	 * Checks the if database must be updated.
	 * If TRUE a flash message is added.
	 *
	 * @param string $extensionKey
	 * return none
	 */
	public function checkDbUpdate($extensionKey = NULL) {
    if ($extensionKey === NULL) {
      $extensionKey = $this->extensionKey;
    }

    // Gets the installed extensions and gets the updates form.
		list($installedExtensions) = $this->extensionList->getInstalledExtensions();
    $updateMessage = $this->install->updatesForm($extensionKey, $installedExtensions[$extensionKey]);

    if ($updateMessage) {
      // Adds hidden arguments to retreive the section and the itemKey when updating
      $additionalUpdateMessage =
        $this->createHiddenTag(array('[general][section]' => $this->generalArguments['section'])) .
        $this->createHiddenTag(array('[general][itemKey]' => $this->generalArguments['itemKey'])).
        $this->createHiddenTag(array('[submitAction][updateDb]' => 1));
      
      $updateMessage = str_replace('</form>', $additionalUpdateMessage . '</form>', $updateMessage);

      // Adds the message
      $this->flashMessages->add($updateMessage);
    }
	}

	/**
	 * Checks the if database must be updated.
	 * If TRUE a flash message is added.
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
