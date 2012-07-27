<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2010 Laurent Foulloy <yolf.typo3@orange.fr>
*  All rights reserved
*
*  This class is a backport of the corresponding class of FLOW3.
*  All credits go to the v5 team.
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
 * Backend Module of the SAV Library Kickstarter extension
 *
 * @package     SavLibraryKickstarter
 * @author      Laurent Foulloy <yolf.typo3@orange.fr>
 */
class Tx_SavLibraryKickstarter_Controller_KickstarterController extends Tx_Extbase_MVC_Controller_ActionController {

	/**
	 * @var boolean
	 */
  protected $extensionsNeedTobeUpgraded = false;

	/**
	 * Inializes the view, by injecting a template parser which takes into
	 * account accessors containing accessors.
	 *
	 * @return none
	 */
	protected function initializeView(Tx_Extbase_MVC_View_ViewInterface $view) {
    $view->injectTemplateParser(Tx_SavLibraryKickstarter_Compatibility_TemplateParserBuilder::build());
    if (version_compare($GLOBALS['TYPO_VERSION'], '4.6', '>=')) {
    	$view->injectTemplateCompiler($this->objectManager->get('Tx_SavLibraryKickstarter_Core_Compiler_TemplateCompiler'));
    }
	}

	/**
	 * extensionList action for this controller.
	 *
	 * @return string The rendered view
	 */
	public function extensionListAction() {
    $this->view->assign('extensionList', $this->getConfigurationList());
    $this->view->assign('extensionsNeedTobeUpgraded', $this->extensionsNeedTobeUpgraded);    
    $this->view->assign('savLibraryKickstarterVersion', Tx_SavLibraryKickstarter_Configuration_ConfigurationManager::getSavLibraryKickstarterVersion());
  }

	/**
	 * createExtension action for this controller.
	 *
	 * @param none
	 * @return string The rendered view
	 */
	public function createExtensionAction() {
    $this->view->assign('extensionList', $this->getConfigurationList());
    $this->view->assign('savLibraryKickstarterVersion', Tx_SavLibraryKickstarter_Configuration_ConfigurationManager::getSavLibraryKickstarterVersion());
    $this->view->assign('itemKey', 1);
  }

	/**
	 * copyExtension action for this controller.
	 *
	 * @param string $extKey
	 * @return string The rendered view
	 */
	public function copyExtensionAction($extKey) {
    $this->view->assign('extensionList', $this->getConfigurationList());
    $this->view->assign('savLibraryKickstarterVersion', Tx_SavLibraryKickstarter_Configuration_ConfigurationManager::getSavLibraryKickstarterVersion());
    $this->view->assign('extKey', $extKey);
    $this->view->assign('itemKey', 1);
	}

	/**
	 * editExtension action for this controller.
	 *
	 * @param string $extKey
	 * @return string The rendered view
	 */
	public function editExtensionAction($extKey) {
    $configurationManager = t3lib_div::makeInstance('Tx_SavLibraryKickstarter_Configuration_ConfigurationManager', $extKey);
    $configurationManager->loadConfiguration();
    $section = $configurationManager->getSectionManager()->getItem('general')->getItem(1)->getItem('section');
    if (!empty($section)) {
      $itemKey = $configurationManager->getSectionManager()->getItem('general')->getItem(1)->getItem('itemKey');
    } else {
      $section = 'emconf';
      $itemKey = 1;
    }
    $this->redirect($section . 'EditSection', NULL, NULL, array('extKey' => $extKey, 'section' => $section, 'itemKey' => $itemKey));
	}

	/**
	 * installExtension action for this controller.
	 *
	 * @param string $extKey
	 * @return string The rendered view
	 */
	public function installExtensionAction($extKey) {
    $configurationManager = t3lib_div::makeInstance('Tx_SavLibraryKickstarter_Configuration_ConfigurationManager', $extKey);
    $configurationManager->loadConfiguration();
    $configurationManager->injectFlashMessages($this->flashMessages);
    $configurationManager->getExtensionManager()->installExtension();
    $this->redirect('extensionList');
	}

	/**
	 * installExtension action for this controller.
	 *
	 * @param string $extKey
	 * @return string The rendered view
	 */
	public function uninstallExtensionAction($extKey) {
    $configurationManager = t3lib_div::makeInstance('Tx_SavLibraryKickstarter_Configuration_ConfigurationManager', $extKey);
    $configurationManager->loadConfiguration();
    $configurationManager->injectFlashMessages($this->flashMessages);
    $configurationManager->getExtensionManager()->uninstallExtension();
    $this->redirect('extensionList');
	}

	/**
	 * generateExtension action for this controller.
	 *
	 * @param string $extKey
	 * @return string The rendered view
	 */
	public function generateExtensionAction($extKey) {
    $configurationManager = t3lib_div::makeInstance('Tx_SavLibraryKickstarter_Configuration_ConfigurationManager', $extKey);
    $configurationManager->loadConfiguration();
    $configurationManager->injectFlashMessages($this->flashMessages);
    $configurationManager->getCodeGenerator()->buildExtension();
    $configurationManager->getExtensionManager()->checkDbUpdate();
    $this->redirect('extensionList');
	}

	/**
	 * upgradeExtension action for this controller.
	 *
	 * @param string $extKey
	 * @return string The rendered view
	 */
	public function upgradeExtensionAction($extKey) {
    $configurationManager = t3lib_div::makeInstance('Tx_SavLibraryKickstarter_Configuration_ConfigurationManager', $extKey);
    $configurationManager->loadConfiguration();
    $configurationManager->checkForUpgrade();
    $configurationManager->injectFlashMessages($this->flashMessages);
    $configurationManager->getCodeGenerator()->buildExtension();
    $configurationManager->getExtensionManager()->checkDbUpdate();
    $configurationManager->getSectionManager()->getItem('general')->getItem(1)->replace(array('extensionMustbeUpgraded' => false));
    $configurationManager->saveConfiguration();
    $this->redirect('extensionList');
	}

	/**
	 * upgradeExtensions action for this controller.
	 *
	 * @param string $extKey
	 * @return string The rendered view
	 */
	public function upgradeExtensionsAction() {
	
    foreach (t3lib_div::get_dirs(PATH_typo3conf . 'ext/') as $extensionKey) {
      $configurationManager = t3lib_div::makeInstance('Tx_SavLibraryKickstarter_Configuration_ConfigurationManager', $extensionKey);

      if ($configurationManager->isSavLibraryKickstarterExtension()) {    	
        // Checks if the extension must be upgraded
        $configurationManager->loadConfiguration();
        if ($configurationManager->getCurrentLibraryVersion() != $configurationManager->getSectionManager()->getItem('general')->getItem(1)->getItem('libraryVersion')) {
        	$configurationManager->checkForUpgrade();       
        	$configurationManager->injectFlashMessages($this->flashMessages);
    			$configurationManager->getCodeGenerator()->buildExtension();
    			$configurationManager->getExtensionManager()->checkDbUpdate();
    			$configurationManager->getSectionManager()->getItem('general')->getItem(1)->replace(array('extensionMustbeUpgraded' => false));
    			$configurationManager->saveConfiguration();
    			$this->redirect('upgradeExtensions');    			
        }
      }
    }
    $this->redirect('extensionList');
  }		
	
	/**
	 * addItem action for this controller.
	 *
	 * @param string $extKey The extension key
	 * @param string $section The section name
	 * @return string The rendered view
	 */
	public function addItemAction($extKey, $section) {
    $configurationManager = t3lib_div::makeInstance('Tx_SavLibraryKickstarter_Configuration_ConfigurationManager', $extKey);
    $configurationManager->loadConfiguration();
    $itemKey = $configurationManager
      ->getSectionManager()
      ->getItem($section)
      ->addItem(NULL)
      ->addItem(array('title' =>  Tx_Extbase_Utility_Localization::translate('kickstarter.new', 'sav_library_kickstarter')))
      ->getItemIndex();
    $configurationManager->saveConfiguration();
    $this->redirect($section . 'EditSection', NULL, NULL, array('extKey' => $extKey, 'section' => $section, 'itemKey' => $itemKey));
	}

	/**
	 * deleteItem action for this controller.
	 *
	 * @param string $extKey The extension key
	 * @param string $section The section name
	 * @param integer $itemKey The key of the item to delete
	 * @return string The rendered view
	 */
	public function deleteItemAction($extKey, $section, $itemKey) {
    $configurationManager = t3lib_div::makeInstance('Tx_SavLibraryKickstarter_Configuration_ConfigurationManager', $extKey);
    $configurationManager->loadConfiguration();
    $configurationManager->getSectionManager()->getItem($section)->deleteItem($itemKey);
    $configurationManager->getSectionManager()->getItem('general')->getItem(1)->deleteItem('section');
    $configurationManager->getSectionManager()->getItem('general')->getItem(1)->deleteItem('itemKey');
    $configurationManager->saveConfiguration();
    $this->redirect('editExtension', NULL, NULL, array('extKey' => $extKey));
	}

	/**
	 * emconfEditSection action for this controller.
	 *
	 * @param string $extKey The extension key
	 * @param string $section The section name
	 * @param integer $itemKey The key of the item to edit
	 * @return string The rendered view
	 */
	public function emconfEditSectionAction($extKey = NULL, $section = NULL, $itemKey = NULL) {
    // Loads the configuration
    $configurationManager = t3lib_div::makeInstance('Tx_SavLibraryKickstarter_Configuration_ConfigurationManager', $extKey);

    $configurationManager->loadConfiguration();
    // Assigns view variables
    $this->view->assign('savLibraryKickstarterVersion', Tx_SavLibraryKickstarter_Configuration_ConfigurationManager::getSavLibraryKickstarterVersion());
    $this->view->assign('extensionNotLoaded', !$configurationManager->isLoadedExtension());
    $this->view->assign('extKey', $extKey);
    $this->view->assign('itemKey', $itemKey);
    $this->view->assign('extension', $configurationManager->getConfiguration());
	}

	/**
	 * newTablesEditSection action for this controller.
	 *
	 * @param string $extKey The extension key
	 * @param string $section The section name
	 * @param integer $itemKey The key of the item to edit
	 * @param integer $fieldKey The key of the field to edit
	 * @param boolean $showFieldConfiguration Displays the field definition if true
	 * @return string The rendered view
	 */
	public function newTablesEditSectionAction($extKey, $section, $itemKey, $fieldKey = NULL, $showFieldConfiguration = false) {
    // Loads the configuration and gets the section manager
    $configurationManager = t3lib_div::makeInstance('Tx_SavLibraryKickstarter_Configuration_ConfigurationManager', $extKey);
    $configurationManager->loadConfiguration();
    $sectionManager = $configurationManager->getSectionManager();

    foreach ($sectionManager->getItem($section) as $tableKey => $table) {

      foreach ($table->getItem('fields') as $key => $field) {
        $item = $sectionManager->getItem($section)->getItem($tableKey)->addItem('fields')->addItem($key)->addItem('order');
        if ($sectionManager->getItem('views')->count() > 0) {
          foreach ($sectionManager->getItem('views') as $viewKey => $view) {
            if (!$item->itemExists($viewKey)) {
              $item->addItem(array($viewKey => $key));
            } elseif ($sectionManager->getItem($section)->getItem($tableKey)->getItem('fields')->getItem($key)->getItem('viewKey') == 0) {
              $sectionManager->getItem($section)->getItem($tableKey)->getItem('fields')->getItem($key)->addItem(array('viewKey' => 1));
            }     
          }
        } else {
          if (!$item->itemExists(0)) {
            $item->addItem(array(0 => $key));
          }
          $sectionManager->getItem($section)->getItem($tableKey)->getItem('fields')->getItem($key)->addItem(array('viewKey' => 0));
        }     
      }
      if ($sectionManager->getItem('views')->count() == 0) {
        $sectionManager->getItem($section)->getItem($tableKey)->addItem(array('viewKey' => 0));
      } elseif ($sectionManager->getItem($section)->getItem($tableKey)->getItem('viewKey') == 0) {
        $sectionManager->getItem($section)->getItem($tableKey)->addItem(array('viewKey' => 1));
      }      
    }

    // Orders the section according to the view
    if ($sectionManager->getItem($section)->getItem($itemKey)->addItem('fields')->count() > 0) {
      $viewKey = $sectionManager->getItem($section)->getItem($itemKey)->getItem('viewKey');
      $sectionManager->getItem($section)->getItem($itemKey)->getItem('fields')->reIndex(array('order' => $viewKey));
    }
  
    // Saves the configuration
    $configurationManager->saveConfiguration();

    // Sets the folder labels
    foreach ($sectionManager->getItem('views') as $viewKey => $view) {
      if ($view->itemExists('folders') && $view->getItem('folders') !== NULL) {
        $folderLabels[$viewKey][0] = '';
        foreach ($view->getItem('folders')->sortby('order') as $folderKey => $folder) {
          $folderLabels[$viewKey][$folderKey] = $folder['label'];
        }
      }
    }
    $configuration = $configurationManager->getConfiguration();

    $this->view->assign('savLibraryKickstarterVersion', Tx_SavLibraryKickstarter_Configuration_ConfigurationManager::getSavLibraryKickstarterVersion());
    $this->view->assign('extensionNotLoaded', !$configurationManager->isLoadedExtension());
    $this->view->assign('extKey', $extKey);
    $this->view->assign('itemKey', $itemKey);
    $this->view->assign('fieldKey', $fieldKey);
    $this->view->assign('extension', $configuration);
    $this->view->assign('showFieldConfiguration', $showFieldConfiguration);
    $this->view->assign('folderLabels', $folderLabels);
	}

	/**
	 * existingTablesEditSection action for this controller.
	 *
	 * @param string $extKey The extension key
	 * @param string $section The section name
	 * @param integer $itemKey The key of the item to edit
	 * @param integer $fieldKey The key of the field to edit
	 * @param boolean $showFieldConfiguration Displays the field definition if true
	 * @return string The rendered view
	 */
	public function existingTablesEditSectionAction($extKey, $section, $itemKey, $fieldKey = NULL, $showFieldConfiguration = false) {
    // Loads the configuration and gets the section manager
    $configurationManager = t3lib_div::makeInstance('Tx_SavLibraryKickstarter_Configuration_ConfigurationManager', $extKey);
    $configurationManager->loadConfiguration();
    $sectionManager = $configurationManager->getSectionManager();

    foreach ($sectionManager->getItem($section) as $tableKey => $table) {
      foreach ($table->getItem('fields') as $key => $field) {
        $item = $sectionManager->getItem($section)->getItem($tableKey)->addItem('fields')->addItem($key)->addItem('order');
        if ($sectionManager->getItem('views')->count() > 0) {
          foreach ($sectionManager->getItem('views') as $viewKey => $view) {
            if (!$item->itemExists($viewKey)) {
              $item->addItem(array($viewKey => $key));
            } elseif ($sectionManager->getItem($section)->getItem($tableKey)->getItem('fields')->getItem($key)->getItem('viewKey') == 0) {
              $sectionManager->getItem($section)->getItem($tableKey)->getItem('fields')->getItem($key)->addItem(array('viewKey' => 1));
            }
          }
        } else {
          if (!$item->itemExists(0)) {
            $item->addItem(array(0 => $key));
          }
          $sectionManager->getItem($section)->getItem($tableKey)->getItem('fields')->getItem($key)->addItem(array('viewKey' => 0));
        }
      }
      if ($sectionManager->getItem('views')->count() == 0) {
        $sectionManager->getItem($section)->getItem($tableKey)->addItem(array('viewKey' => 0));
      } elseif ($sectionManager->getItem($section)->getItem($tableKey)->getItem('viewKey') == 0) {
        $sectionManager->getItem($section)->getItem($tableKey)->addItem(array('viewKey' => 1));
      }
    }

    $configurationManager->saveConfiguration();

    if ($sectionManager->getItem($section)->getItem($itemKey)->addItem('fields')->count() > 0) {
      $viewKey = $sectionManager->getItem($section)->getItem($itemKey)->getItem('viewKey');
      $sectionManager->getItem($section)->getItem($itemKey)->getItem('fields')->sortby(array('order' => $viewKey));
    }
    // Sets the folder labels
    foreach ($sectionManager->getItem('views') as $viewKey => $view) {
      if ($view->itemExists('folders') && $view->getItem('folders') !== NULL) {
        $folderLabels[$viewKey][0] = '';
        foreach ($view->getItem('folders')->sortby('order') as $folderKey => $folder) {
          $folderLabels[$viewKey][$folderKey] = $folder['label'];
        }
      }
    }

    $configuration = $configurationManager->getConfiguration();
    $this->view->assign('savLibraryKickstarterVersion', Tx_SavLibraryKickstarter_Configuration_ConfigurationManager::getSavLibraryKickstarterVersion());
    $this->view->assign('extensionNotLoaded', !$configurationManager->isLoadedExtension());
    $this->view->assign('extKey', $extKey);
    $this->view->assign('itemKey', $itemKey);
    $this->view->assign('fieldKey', $fieldKey);
    $this->view->assign('extension', $configuration);
    $this->view->assign('showFieldConfiguration', $showFieldConfiguration);
    $this->view->assign('folderLabels', $folderLabels);
	}

	/**
	 * existingTablesImportFields action for this controller.
	 *
	 * @param string $extKey The extension key
	 * @param string $section The section name
	 * @param integer $itemKey The key of the item to edit
	 * @return string The rendered view
	 */
	public function existingTablesImportFieldsAction($extKey, $section, $itemKey) {
    // Loads the configuration and gets the section manager
    $configurationManager = t3lib_div::makeInstance('Tx_SavLibraryKickstarter_Configuration_ConfigurationManager', $extKey);
    $configurationManager->loadConfiguration();
    $sectionManager = $configurationManager->getSectionManager();

    $tableName = $sectionManager->getItem($section)->getItem($itemKey)->getItem('tablename');
    $columns = $GLOBALS['TCA'][$tableName]['columns'];
    if (is_array($columns)) {
      foreach ($columns as $columnKey => $column) {
        $item = $sectionManager->getItem($section)->getItem($itemKey)->addItem('fields')->addItem(NULL);
        $item->addItem('order');
        $item->addItem(array(
          'fieldname' => $columnKey,
          'title' => $GLOBALS['LANG']->sL($column['label']),
          'type' => 'ShowOnly',
        ));
      }

      if ($sectionManager->getItem('views')->count() == 0) {
        $sectionManager->getItem($section)->getItem($itemKey)->addItem(array('viewKey' => 0));
      } elseif ($sectionManager->getItem($section)->getItem($itemKey)->getItem('viewKey') == 0) {
        $sectionManager->getItem($section)->getItem($itemKey)->addItem(array('viewKey' => 1));
      }
    }
    $configurationManager->saveConfiguration();
    // Sets the folder labels
    foreach ($sectionManager->getItem('views') as $viewKey => $view) {
      if ($view->itemExists('folders') && $view->getItem('folders') !== NULL) {
        $folderLabels[$viewKey][0] = '';
        foreach ($view->getItem('folders')->sortby('order') as $folderKey => $folder) {
          $folderLabels[$viewKey][$folderKey] = $folder['label'];
        }
      }
    }

    $configuration = $configurationManager->getConfiguration();
    $this->view->assign('savLibraryKickstarterVersion', Tx_SavLibraryKickstarter_Configuration_ConfigurationManager::getSavLibraryKickstarterVersion());
    $this->view->assign('extensionNotLoaded', !$configurationManager->isLoadedExtension());
    $this->view->assign('extKey', $extKey);
    $this->view->assign('itemKey', $itemKey);
    $this->view->assign('fieldKey', $fieldKey);
    $this->view->assign('extension', $configuration);
    $this->view->assign('folderLabels', $folderLabels);
    $this->redirect($section . 'EditSection', NULL, NULL, array('extKey' => $extKey, 'section' => $section, 'itemKey' => $itemKey));
	}

	/**
	 * viewsEditSection action for this controller.
	 *
	 * @param string $extKey The extension key
	 * @param string $section The section name
	 * @param integer $itemKey The key of the item to edit
	 * @return string The rendered view
	 */
	public function viewsEditSectionAction($extKey, $section, $itemKey) {
    $configurationManager = t3lib_div::makeInstance('Tx_SavLibraryKickstarter_Configuration_ConfigurationManager', $extKey);
    $configurationManager->loadConfiguration();
    // Sorts the folders if any
    if ($configurationManager->getSectionManager()->getItem($section)->getItem($itemKey)->addItem('folders')->count() > 0) {
      $configurationManager->getSectionManager()->getItem($section)->getItem($itemKey)->getItem('folders')->sortby('order');
    }
    $configuration = $configurationManager->getConfiguration();

    $this->view->assign('savLibraryKickstarterVersion', Tx_SavLibraryKickstarter_Configuration_ConfigurationManager::getSavLibraryKickstarterVersion());
    $this->view->assign('extensionNotLoaded', !$configurationManager->isLoadedExtension());
    $this->view->assign('extKey', $extKey);
    $this->view->assign('itemKey', $itemKey);

    $viewType = $configurationManager->getSectionManager()->getItem($section)->getItem($itemKey)->getItem('type');
    switch($viewType) {
      case 'list':
        break;
      case 'single':
      case 'edit':
        $configuration[$section][$itemKey]['foldersAllowed'] = 1;
        break;
    }
    $this->view->assign('extension', $configuration);
	}

	/**
	 * queriesEditSection action for this controller.
	 *
	 * @param string $extKey The extension key
	 * @param string $section The section name
	 * @param integer $itemKey The key of the item to edit
	 * @return string The rendered view
	 */
	public function queriesEditSectionAction($extKey, $section, $itemKey) {
    $configurationManager = t3lib_div::makeInstance('Tx_SavLibraryKickstarter_Configuration_ConfigurationManager', $extKey);
    $configurationManager->loadConfiguration();
    $configuration = $configurationManager->getConfiguration();
    $this->view->assign('savLibraryKickstarterVersion', Tx_SavLibraryKickstarter_Configuration_ConfigurationManager::getSavLibraryKickstarterVersion());
    $this->view->assign('extensionNotLoaded', !$configurationManager->isLoadedExtension());
    $this->view->assign('extKey', $extKey);
    $this->view->assign('itemKey', $itemKey);
    $this->view->assign('extension', $configuration);
  }

	/**
	 * formsEditSection action for this controller.
	 *
	 * @param string $extKey The extension key
	 * @param string $section The section name
	 * @param integer $itemKey The key of the item to edit
	 * @return string The rendered view
	 */
	public function formsEditSectionAction($extKey, $section, $itemKey) {
    $configurationManager = t3lib_div::makeInstance('Tx_SavLibraryKickstarter_Configuration_ConfigurationManager', $extKey);
    $configurationManager->loadConfiguration();
    $configuration = $configurationManager->getConfiguration();
    $this->view->assign('savLibraryKickstarterVersion', Tx_SavLibraryKickstarter_Configuration_ConfigurationManager::getSavLibraryKickstarterVersion());
    $this->view->assign('extensionNotLoaded', !$configurationManager->isLoadedExtension());
    $this->view->assign('extKey', $extKey);
    $this->view->assign('itemKey', $itemKey);
    $this->view->assign('extension', $configuration);

    // Build the options
    $option = array();
    $options['list'][0] = ' ';
    $options['single'][0] = ' ';
    $options['edit'][0] = ' ';
    $options['special'][0] = ' ';
    foreach($configuration['views'] as $key => $view) {
      $options[$view['type']][$key] = $view['title'];
    }
    $options['query'][0] = ' ';
    foreach($configuration['queries'] as $key => $query) {
      $options['query'][$key] = $query['title'];
    }
    $this->view->assign('options', $options);
	}

 	/**
	 * changeViewAction action for this controller.
	 *
	 * @param string $extKey The extension key
	 * @param string $section The section name
	 * @param integer $itemKey The key of the item to edit
	 * @param integer $viewKey The key of the view to edit
	 * @return string The rendered view
	 */
	public function changeViewAction($extKey, $section, $itemKey, $viewKey) {
    $configurationManager = t3lib_div::makeInstance('Tx_SavLibraryKickstarter_Configuration_ConfigurationManager', $extKey);
    $configurationManager->loadConfiguration();
    $configurationManager->getSectionManager()->getItem($section)->getItem($itemKey)->replace(array('viewKey' => $viewKey));
    $configurationManager->getSectionManager()->getItem($section)->getItem($itemKey)->getItem('fields')->replaceAll((array('viewKey' => $viewKey)));
    $configurationManager->saveConfiguration();
    $this->redirect($section . 'EditSection', NULL, NULL, array('extKey' => $extKey, 'section' => $section, 'itemKey' => $itemKey));
	}

 	/**
	 * changeFolderAction action for this controller.
	 *
	 * @param string $extKey The extension key
	 * @param string $section The section name
	 * @param integer $itemKey The key of the item to edit
	 * @param integer $viewKey The key of the view to edit
	 * @param integer $folderKey The key of the folder to change
	 * @return string The rendered view
	 */
	public function changeFolderAction($extKey, $section, $itemKey, $viewKey, $folderKey) {
    $configurationManager = t3lib_div::makeInstance('Tx_SavLibraryKickstarter_Configuration_ConfigurationManager', $extKey);
    $configurationManager->loadConfiguration();
    $configurationManager->getSectionManager()->getItem($section)->getItem($itemKey)->replace(array('folderKeys' => array($viewKey => $folderKey)));
    $configurationManager->saveConfiguration();
    $this->redirect($section . 'EditSection', NULL, NULL, array('extKey' => $extKey, 'section' => $section, 'itemKey' => $itemKey));
	}
	
	/**
	 * changeConfigurationViewAction action for this controller.
	 *
	 * @param string $extKey The extension key
	 * @param string $section The section name
	 * @param integer $itemKey The key of the item to edit
	 * @param integer $fieldKey The key of the field to edit
	 * @param integer $viewKey The key of the view to edit
	 * @return string The rendered view
	 */
	public function changeConfigurationViewAction($extKey, $section, $itemKey, $fieldKey, $viewKey) {
    $configurationManager = t3lib_div::makeInstance('Tx_SavLibraryKickstarter_Configuration_ConfigurationManager', $extKey);
    $configurationManager->loadConfiguration();
    $configurationManager->getSectionManager()->getItem($section)->getItem($itemKey)->getItem('fields')->getItem($fieldKey)->replace(array('viewKey' => $viewKey));
    $configurationManager->saveConfiguration();
    $this->redirect($section . 'EditSection', NULL, NULL, array('extKey' => $extKey, 'section' => $section, 'itemKey' => $itemKey, 'fieldKey' => $fieldKey));
	}

	/**
	 * save action for this controller.
	 *
	 * @return string The rendered view
	 */
	public function saveAction() {
    // Gets the submitted action key
    $arguments = $this->request->getArguments();
    $submitAction = key($arguments['submitAction']);

    // Builds the submitted action method and calls it if it exists
    $submitActionMethodName = $submitAction . 'SubmitAction';
    if (method_exists($this, $submitActionMethodName)) {
      $this->$submitActionMethodName();
    } else {
      throw new RuntimeException('The submit action method "' . $submitActionMethodName . '" is not known !');
    }
	}

	/**
	 * Overwrite submitted action.
	 *
	 * @return none
	 */
  protected function overwriteSubmitAction() {
    $this->saveSubmitAction(false);
  }
	
	/**
	 * Save submitted action.
	 *
	 * @param boolean $checkLibraryType
	 * @return none
	 */
  protected function saveSubmitAction($chekLibraryType = true) {
    // Gets arguments
    $arguments = $this->request->getArguments();
    $extKey = $arguments['extKey'];
    $section = $arguments['general']['section'];
    $itemKey = $arguments['general']['itemKey'];
    $fieldKey = $arguments['general']['fieldKey'];
    $showFieldConfiguration = $arguments['general']['showFieldConfiguration'];
		$libraryType = $arguments['general']['libraryType'];

    // Gets the configuration and the section managers
    $configurationManager = t3lib_div::makeInstance('Tx_SavLibraryKickstarter_Configuration_ConfigurationManager', $extKey);
    $configurationManager->loadConfiguration();
    $sectionManager = $configurationManager->getSectionManager();

    // Special processing for the title of existing tables
    if (is_array($arguments['existingTables'])) {
      $options = Tx_SavLibraryKickstarter_ViewHelpers_BuildOptionsForExistingTablesSelectorboxViewHelper::render();
      $arguments['existingTables']['title'] = $options[$arguments['existingTables']['tablename']];
    }
    // Special processing for new version
    if (is_array($arguments['general']['version'])) {
    	$version = explode('.', $sectionManager->getItem('emconf')->getItem(1)->getItem('version'));
    	if ($arguments['general']['version']['x'] == 1) {
    		$version[0]++;
    		$version[1] = 0;
    		$version[2] = 0;
      }
    	if ($arguments['general']['version']['y'] == 1) {
    		$version[1]++;
    		$version[2] = 0;
      }
    	if ($arguments['general']['version']['z'] == 1) {
    		$version[2]++;
      }
      $sectionManager->getItem('emconf')->getItem(1)->replace(array('version' => implode('.', $version)));
      unset($arguments['general']['version']);
    }
    
    // Gets the current library type 
    $currentLibraryType = $sectionManager->getItem('general')->addItem(1)->getItem('libraryType');

    // Checks if the library type has been changed
    if ($section == 'emconf') {
    	if($checkLibraryType === true) {
	    	if ($currentLibraryType != $libraryType) {
		    	// Builds the new directory if needed 
	    		$configurationManager->buildConfigurationDirectory($extKey, $libraryType);	
	    		    	
	    		// Gets the library name
		    	$libraryName = Tx_SavLibraryKickstarter_Configuration_ConfigurationManager::getLibraryName($libraryType);  
    	
		    	// Checks if a configuration already exists
		    	if ($configurationManager->configurationFileExists($extKey, $libraryName)) {
		    		// The type is unchanged, overload must be used
		    		$this->flashMessageContainer->add(Tx_Extbase_Utility_Localization::translate('kickstarter.overwriteRequired', 'sav_library_kickstarter'));
		    		unset($arguments['general']['libraryType']);
		    	} else {
		 	   		// Changes the library type file
		 	   		$libraryName = Tx_SavLibraryKickstarter_Configuration_ConfigurationManager::getLibraryName($libraryType);  
		    		t3lib_div::writeFile(Tx_SavLibraryKickstarter_Configuration_ConfigurationManager::getLibraryTypeFileName($extKey), $libraryName);   		
		    	}
	    	}
	    } else {
	    	// Builds the new directory if needed 
	    	$configurationManager->buildConfigurationDirectory($extKey, $libraryType);

	    	// Changes the library type file
		 	  $libraryName = Tx_SavLibraryKickstarter_Configuration_ConfigurationManager::getLibraryName($libraryType);  
	    	t3lib_div::writeFile(Tx_SavLibraryKickstarter_Configuration_ConfigurationManager::getLibraryTypeFileName($extKey), $libraryName);   			    	
	    }
    }
  
    $sectionManager->getItem('general')->addItem(1)->replace($arguments['general']);
    
    // Processes the subforms
    $subforms = $arguments['subforms'];
    foreach ($subforms as $relationTableKey => $subform) {
    	$sectionManager->getItem(key($subform))->getItem($relationTableKey)->replace(current($subform));
    }

    // Processes the section fields
    $sectionManager->getItem($section)->getItem($itemKey)->replace($arguments[$section]);

    // Saves he configuration
    $configurationManager->saveConfiguration();

    // Redirects to the section action
    $this->redirect($section . 'EditSection', NULL, NULL, array('extKey' => $extKey, 'section' => $section, 'itemKey' => $itemKey, 'fieldKey' => ($fieldKey ? $fieldKey : NULL), 'showFieldConfiguration' => $showFieldConfiguration));
  }

	/**
	 * load submitted action.
	 *
	 * @return none
	 */
  protected function loadSubmitAction() {
    // Gets arguments
    $arguments = $this->request->getArguments();
    $extKey = $arguments['extKey'];
    $section = $arguments['general']['section'];
    $itemKey = $arguments['general']['itemKey'];
    $fieldKey = $arguments['general']['fieldKey'];
    $showFieldConfiguration = $arguments['general']['showFieldConfiguration'];
            
    // Gets the configuration manager
    $configurationManager = t3lib_div::makeInstance('Tx_SavLibraryKickstarter_Configuration_ConfigurationManager', $extKey);
    
	  $libraryName = Tx_SavLibraryKickstarter_Configuration_ConfigurationManager::getLibraryName($arguments['general']['libraryType']);  
        	
	  // Checks if a configuration already exists
	  if ($configurationManager->configurationFileExists($extKey, $libraryName)) {
	 	  // Changes the library type file
	    t3lib_div::writeFile(Tx_SavLibraryKickstarter_Configuration_ConfigurationManager::getLibraryTypeFileName($extKey), $libraryName);   		
	  } else {
	  	// The type is unchanged : no configuration file
	    $this->flashMessageContainer->add(Tx_Extbase_Utility_Localization::translate('kickstarter.noConfigurationFile', 'sav_library_kickstarter'));	
		}
	
    // Redirects to the section action
    $this->redirect($section . 'EditSection', NULL, NULL, array('extKey' => $extKey, 'section' => $section, 'itemKey' => $itemKey, 'fieldKey' => ($fieldKey ? $fieldKey : NULL), 'showFieldConfiguration' => $showFieldConfiguration));
  }  
  
	/**
	 * createExtension submitted action.
	 *
	 * @return none
	 */
  protected function createExtensionSubmitAction() {
    // Gets arguments
    $arguments = $this->request->getArguments();
    $extKey = strtolower($arguments['extKey']);
    $section = $arguments['general']['section'];
    $itemKey = $arguments['general']['itemKey'];

    // Gets the configuration and the section managers
    $configurationManager = t3lib_div::makeInstance('Tx_SavLibraryKickstarter_Configuration_ConfigurationManager', $extKey);
    $configurationManager->loadConfiguration();
    $sectionManager = $configurationManager->getSectionManager();

    // Creates all sections
    $sectionManager->addItem('general')->addItem(1)->addItem(array('extensionKey' => $extKey));
    $sectionManager->addItem('general')->addItem(1)->addItem(array('libraryVersion' => $configurationManager->getCurrentLibraryVersion()));
    $sectionManager->addItem('general')->addItem(1)->addItem(array('debug' => '0'));
    $sectionManager->addItem('emconf')->addItem(1)->addItem(array('version' => '0.0.0'));
    $sectionManager->addItem('newTables');
    $sectionManager->addItem('views');
    $sectionManager->addItem('queries');
    $sectionManager->addItem('forms');

    // Creates the configuration directory
    $configurationManager->createConfigurationDir($extKey);

    // Replaces the section arguments and saves
    $sectionManager->getItem('general')->getItem(1)->replace($arguments['general']);
    $sectionManager->getItem($section)->getItem($itemKey)->replace($arguments[$section]);
    $configurationManager->saveConfiguration();

    // Redirects to the section
    $this->redirect($section . 'EditSection', NULL, NULL, array('extKey' => $extKey, 'section' => $section, 'itemKey' => $itemKey));
  }

	/**
	 * genrateExtension submitted action.
	 *
	 * @return none
	 */
  protected function generateExtensionSubmitAction() {
    // Gets arguments
    $arguments = $this->request->getArguments();
    $extKey = $arguments['extKey'];
    $section = $arguments['general']['section'];
    $itemKey = $arguments['general']['itemKey'];
    $fieldKey = ($arguments['general']['fieldKey'] ? $arguments['general']['fieldKey'] : NULL);
    $showFieldConfiguration = $arguments['general']['showFieldConfiguration'];

    // Gets the configuration and the section managers
    $configurationManager = t3lib_div::makeInstance('Tx_SavLibraryKickstarter_Configuration_ConfigurationManager', $extKey);
    $configurationManager->loadConfiguration();
    $sectionManager = $configurationManager->getSectionManager();

    // Saves the configuration
    $sectionManager->getItem('general')->addItem(1)->replace($arguments['general']);
    $sectionManager->getItem($section)->getItem($itemKey)->replace($arguments[$section]);
    if ($configurationManager->getSectionManager()->getItem('general')->getItem(1)->getItem('libraryVersion') === NULL) {
    	$configurationManager->getSectionManager()->getItem('general')->getItem(1)->replace(array('libraryVersion' => $configurationManager->getCurrentLibraryVersion())); 
    }

    $configurationManager->saveConfiguration();

    // Buids the extension
    $configurationManager->injectFlashMessages($this->flashMessages);
    $configurationManager->getCodeGenerator()->buildExtension();
    $sectionManager->getItem('general')->getItem(1)->addItem(array('isGeneratedExtension' => 1));
    $configurationManager->getExtensionManager()->injectGeneralArguments($arguments['general']);
    $configurationManager->getExtensionManager()->checkDbUpdate();
    
    // Clears the cache
    t3lib_extMgm::removeCacheFiles();

    // Redirects to the section action
    $this->redirect($section . 'EditSection', NULL, NULL, array('extKey' => $extKey, 'section' => $section, 'itemKey' => $itemKey, 'fieldKey' => ($fieldKey ? $fieldKey : NULL), 'showFieldConfiguration' => $showFieldConfiguration));
  }

	/**
	 * copyExtension submitted action.
	 *
	 * @return none
	 */
  protected function copyExtensionSubmitAction() {
    // Gets arguments
    $arguments = $this->request->getArguments();
    $extKey = $arguments['extKey'];
    $section = $arguments['general']['section'];
    $itemKey = $arguments['general']['itemKey'];

    // Gets the configuration and the section managers
    $configurationManager = t3lib_div::makeInstance('Tx_SavLibraryKickstarter_Configuration_ConfigurationManager', $extKey);
    $configurationManager->loadConfiguration();
    $sectionManager = $configurationManager->getSectionManager();

    // Sets the new extension key
    $newExtKey = $arguments['newExtKey'];
    $configurationManager->setExtensionKey($newExtKey);
    // Replaces the table name by its new name in all fields
    foreach($sectionManager->getItems() as $walkSectionKey => $walkSection) {
      $walkSection->walkItem('Tx_SavLibraryKickstarter_Controller_KickstarterController::changeTableNames', array('newExtensionKey' => $newExtKey, 'oldExtensionKey' => $extKey));
    }
    // Creates the configuration directory and generates the extension
    $configurationManager->createConfigurationDir($newExtKey);
    $configurationManager->saveConfiguration();
    $configurationManager->injectFlashMessages($this->flashMessages);
    $configurationManager->getCodeGenerator()->buildExtension();

    // Redirects to the new section action
    $this->redirect($section . 'EditSection', NULL, NULL, array('extKey' => $newExtKey, 'section' => $section, 'itemKey' => $itemKey));
  }

 	/**
	 * showAllFieldsSubmit action for this controller.
	 *
	 * @param none
	 * 
	 * @return none
	 */
	public function showAllFieldsSubmitAction() {
    // Gets arguments
    $arguments = $this->request->getArguments();
    $extKey = $arguments['extKey'];
    $section = $arguments['general']['section'];
    $itemKey = $arguments['general']['itemKey'];	
    	
    // Gets the configuration manager		
    $configurationManager = t3lib_div::makeInstance('Tx_SavLibraryKickstarter_Configuration_ConfigurationManager', $extKey);
    $configurationManager->loadConfiguration();
    $configurationManager->getSectionManager()->getItem($section)->getItem($itemKey)->replace(array('showAllFields' => 1));
    $configurationManager->saveConfiguration();
    $this->redirect($section . 'EditSection', NULL, NULL, array('extKey' => $extKey, 'section' => $section, 'itemKey' => $itemKey));
	}  
  
 	/**
	 * showFieldsNotInFoldersSubmit action for this controller.
	 *
	 * @param none
	 * 
	 * @return none
	 */
	public function showFieldsNotInFoldersSubmitAction() {
    // Gets arguments
    $arguments = $this->request->getArguments();
    $extKey = $arguments['extKey'];
    $section = $arguments['general']['section'];
    $itemKey = $arguments['general']['itemKey'];	
    	
    // Gets the configuration manager		
    $configurationManager = t3lib_div::makeInstance('Tx_SavLibraryKickstarter_Configuration_ConfigurationManager', $extKey);
    $configurationManager->loadConfiguration();
    $configurationManager->getSectionManager()->getItem($section)->getItem($itemKey)->replace(array('showAllFields' => 0));
    $configurationManager->saveConfiguration();
    $this->redirect($section . 'EditSection', NULL, NULL, array('extKey' => $extKey, 'section' => $section, 'itemKey' => $itemKey));
	}
	  
	/**
	 * Method called by walkItem to change the table name.
	 *
	 * @param mixed $item The item
	 * @param integer $key The item key
	 * @param mixed The arguments
	 * @return string The rendered view
	 */
  public static function changeTableNames($item, $key, $arguments) {
    $item = preg_replace('/'. $arguments['oldExtensionKey'] . '/m', $arguments['newExtensionKey'], $item);
    // Adds the domain to existing tables with "short table names".
    $item = preg_replace('/'. str_replace('_', '', $arguments['oldExtensionKey']) . '/m', str_replace('_', '', $arguments['newExtensionKey']), $item);
    return $item;
  }

	/**
	 * SortFields submitted action.
	 *
	 * @return none
	 */
  protected function sortFieldsSubmitAction() {
    // Gets arguments
    $arguments = $this->request->getArguments();
    $extKey = $arguments['extKey'];
    $section = $arguments['general']['section'];
    $itemKey = $arguments['general']['itemKey'];

    // Gets the configuration and the section managers
    $configurationManager = t3lib_div::makeInstance('Tx_SavLibraryKickstarter_Configuration_ConfigurationManager', $extKey);
    $configurationManager->loadConfiguration();
    $sectionManager = $configurationManager->getSectionManager();

    // Gets the view key from the selectorbox, sorts by this key and saves.
    $currentViewKey = $sectionManager->getItem($section)->getItem($itemKey)->getItem('viewKey');
    $selectedViewKey = $arguments[$section]['viewSelectorbox'];

    // Changes the order
    foreach ($configurationManager->getSectionManager()->getItem($section)->getItem($itemKey)->getItem('fields') as $fieldKey => $field) {
      $order = $sectionManager->getItem($section)->getItem($itemKey)->getItem('fields')->getItem($fieldKey)->getItem('order')->getItem($selectedViewKey);
      $sectionManager->getItem($section)->getItem($itemKey)->getItem('fields')->getItem($fieldKey)->getItem('order')->replace(array($currentViewKey => $order));
    }

    // Saves the configuration
    $configurationManager->saveConfiguration();

    // Redirects to the section action
    $this->redirect($section . 'EditSection', NULL, NULL, array('extKey' => $extKey, 'section' => $section, 'itemKey' => $itemKey));
  }

	/**
	 * copyFields submitted action.
	 *
	 * @return none
	 */
  protected function copyFieldsSubmitAction() {
    // Gets arguments
    $arguments = $this->request->getArguments();
    $extKey = $arguments['extKey'];
    $section = $arguments['general']['section'];
    $itemKey = $arguments['general']['itemKey'];

    // Gets the configuration and the section managers
    $configurationManager = t3lib_div::makeInstance('Tx_SavLibraryKickstarter_Configuration_ConfigurationManager', $extKey);
    $configurationManager->loadConfiguration();
    $sectionManager = $configurationManager->getSectionManager();

    // Gets the view key from the selectorbox, sorts by this key and saves.
    $currentViewKey = $sectionManager->getItem($section)->getItem($itemKey)->getItem('viewKey');
    $selectedViewKey = $arguments[$section]['viewSelectorbox'];

    // Copy the field configuration
    foreach ($configurationManager->getSectionManager()->getItem($section)->getItem($itemKey)->getItem('fields') as $fieldKey => $field) {
      $fieldConfiguration = $sectionManager->getItem($section)->getItem($itemKey)->getItem('fields')->getItem($fieldKey)->getItem('configuration')->getItem($selectedViewKey);
      $sectionManager->getItem($section)->getItem($itemKey)->getItem('fields')->getItem($fieldKey)->getItem('configuration')->replace(array($currentViewKey => $fieldConfiguration));
    }

    // Saves the configuration
    $configurationManager->saveConfiguration();

    // Redirects to the section action
    $this->redirect($section . 'EditSection', NULL, NULL, array('extKey' => $extKey, 'section' => $section, 'itemKey' => $itemKey));
  }

	/**
	 * updateDb submitted action.
	 *
	 * @return none
	 */
  protected function updateDbSubmitAction() {
    // Gets arguments
    $arguments = $this->request->getArguments();
    $extKey = $arguments['extKey'];
    $section = $arguments['general']['section'];
    $itemKey = $arguments['general']['itemKey'];

    // Gets the configuration and the section managers
    $configurationManager = t3lib_div::makeInstance('Tx_SavLibraryKickstarter_Configuration_ConfigurationManager', $extKey);
    $configurationManager->loadConfiguration();
    $sectionManager = $configurationManager->getSectionManager();

    // Updates the database
    $configurationManager->getExtensionManager()->injectGeneralArguments($arguments['general']);
    $configurationManager->getExtensionManager()->checkDbUpdate();

    // Redirects to the section action
    $this->redirect($section . 'EditSection', NULL, NULL, array('extKey' => $extKey, 'section' => $section, 'itemKey' => $itemKey));
  }

	/**
	 * editFieldConfiguration action for this controller.
	 *
	 * @param string $extKey The extension key
	 * @param string $section The section name
	 * @param integer $itemKey The key of the item to edit
	 * @param integer $viewKey The key of the view
	 * @param integer $folderKey The key of the folder
	 * @param integer $fieldKey The key of the field to edit
	 * @return string The rendered view
	 */
	public function editFieldConfigurationAction($extKey, $section, $itemKey, $viewKey, $folderKey=0, $fieldKey) {		
    $configurationManager = t3lib_div::makeInstance('Tx_SavLibraryKickstarter_Configuration_ConfigurationManager', $extKey);
    $configurationManager->loadConfiguration();
    $configurationManager->getSectionManager()->getItem($section)->getItem($itemKey)->addItem('activeFields')->replace(array($viewKey => array($folderKey => $fieldKey)));
    $configurationManager->saveConfiguration();		
    $this->redirect($section . 'EditSection', NULL, NULL, array('extKey' => $extKey, 'section' => $section, 'itemKey' => $itemKey, 'fieldKey' => $fieldKey, 'showFieldConfiguration' => true));
	}

	/**
	 * moveUpField action for this controller.
	 *
	 * @param string $extKey The extension key
	 * @param string $section The section name
	 * @param integer $itemKey The key of the item to edit
	 * @param integer $fieldKey The key of the field to edit
	 * @return string The rendered view
	 */
	public function moveUpFieldAction($extKey, $section, $itemKey, $fieldKey) {
    $configurationManager = t3lib_div::makeInstance('Tx_SavLibraryKickstarter_Configuration_ConfigurationManager', $extKey);
    $configurationManager->loadConfiguration();
    $sectionManager = $configurationManager->getSectionManager();

    // Gets the item
    $item = $sectionManager->getItem($section)->getItem($itemKey);    
    $viewKey = $item->getItemAndSetToZeroIfNull('viewKey');

		// Gets the folder key if it exits
		$folderKeys = $item->getItem('folderKeys');
		if (is_null($folderKeys) === false) {
			$folderKey = $folderKeys->getItem($viewKey);
		} else {
			$folderKey = null;
		}
     
    // Gets the fields in the view
    $fields = $item->getItem('fields');
    $fieldsInView = array();
    $keyList = array();
    foreach($fields as $key => $field) {
    	if (is_null($folderKey) || $field->getItem('folders')->getItem($viewKey) == $folderKey) {
    		$fieldsInView[$key] = $field;
    		$fieldKeysInView[] = $key;
    	}
    }

		// Gets the from position and the from item
		$fromPositionInView = array_search($fieldKey, $fieldKeysInView);  
    
    // Processes the items depending on the from position in the view
    if ($fromPositionInView > 0) {
    	// Gets the from item and order
    	$fromItem = $fieldsInView[$fieldKey];   
    	$fromOrder = $fromItem->getItem('order')->getItem($viewKey); 	
    	// Gets the to poisition, item and order
    	$toPositionInView = $fromPositionInView - 1;
    	$toItem = $fieldsInView[$fieldKeysInView[$toPositionInView]];
    	$toOrder = $toItem->getItem('order')->getItem($viewKey);  
    	// Replaces the orders 
    	$fromItem->replace(array('order' => array($viewKey => $toOrder)));
    	$toItem->replace(array('order' => array($viewKey => $fromOrder)));   	
    } else {
    	// Gets the rotated toOrder array
      $count = count($fieldKeysInView);
      $rotatedToOrders = array();
      foreach($fieldKeysInView as $positionInView => $fieldKeyInView) {
      	$rotatedKey = $fieldKeysInView[($positionInView + $count - 1) % $count];
      	$rotatedToOrders[$positionInView] = $item->getItem('fields')->getItem($rotatedKey)->addItem('order')->getItem($viewKey);
      }
      // Sets the new order key 
      foreach($fieldKeysInView as $positionInView => $fieldKeyInView) {
      	$fromItem = $fieldsInView[$fieldKeyInView];
        $fromItem->replace(array('order' => array($viewKey => $rotatedToOrders[$positionInView])));
      }    	
    }

    // Saves and redirects to the section
    $configurationManager->saveConfiguration();
    $this->redirect($section . 'EditSection', NULL, NULL, array('extKey' => $extKey, 'section' => $section, 'itemKey' => $itemKey, 'fieldKey' => $fieldKey));
  }

	/**
	 * moveDownField action for this controller.
	 *
	 * @param string $extKey The extension key
	 * @param string $section The section name
	 * @param integer $itemKey The key of the item to edit
	 * @param integer $fieldKey The key of the field to edit
	 * @return string The rendered view
	 */
	public function moveDownFieldAction($extKey, $section, $itemKey, $fieldKey) {
	  $configurationManager = t3lib_div::makeInstance('Tx_SavLibraryKickstarter_Configuration_ConfigurationManager', $extKey);
    $configurationManager->loadConfiguration();
    $sectionManager = $configurationManager->getSectionManager();
    // Gets the item
    $item = $sectionManager->getItem($section)->getItem($itemKey);    
    $viewKey = $item->getItemAndSetToZeroIfNull('viewKey');
    
			// Gets the folder key if it exits
		$folderKeys = $item->getItem('folderKeys');
		if (is_null($folderKeys) === false) {
			$folderKey = $folderKeys->getItem($viewKey);
		} else {
			$folderKey = null;
		}
		   
    // Gets the fields in the view
    $fields = $item->getItem('fields');
    $fieldsInView = array();
    $keyList = array();
    foreach($fields as $key => $field) {
    	if (is_null($folderKey) || $field->getItem('folders')->getItem($viewKey) == $folderKey) {
    		$fieldsInView[$key] = $field;
    		$fieldKeysInView[] = $key;
    	}
    }
		
		// Gets the from position and the from item
		$fromPositionInView = array_search($fieldKey, $fieldKeysInView);  
    
    // Processes the items depending on the from position in the view
    $count = count($fieldKeysInView);
    if ($fromPositionInView < $count - 1) {
    	// Gets the from item and order
    	$fromItem = $fieldsInView[$fieldKey];   
    	$fromOrder = $fromItem->getItem('order')->getItem($viewKey); 	
    	// Gets the to poisition, item and order
    	$toPositionInView = $fromPositionInView + 1;
    	$toItem = $fieldsInView[$fieldKeysInView[$toPositionInView]];
    	$toOrder = $toItem->getItem('order')->getItem($viewKey);  
    	// Replaces the orders 
    	$fromItem->replace(array('order' => array($viewKey => $toOrder)));
    	$toItem->replace(array('order' => array($viewKey => $fromOrder)));   	
    } else {
    	// Gets the rotated toOrder array
      $count = count($fieldKeysInView);
      $rotatedToOrders = array();
      foreach($fieldKeysInView as $positionInView => $fieldKeyInView) {
      	$rotatedKey = $fieldKeysInView[($positionInView + 1) % $count];
      	$rotatedToOrders[$positionInView] = $item->getItem('fields')->getItem($rotatedKey)->addItem('order')->getItem($viewKey);
      }
      // Sets the new order key 
      foreach($fieldKeysInView as $positionInView => $fieldKeyInView) {
      	$fromItem = $fieldsInView[$fieldKeyInView];
        $fromItem->replace(array('order' => array($viewKey => $rotatedToOrders[$positionInView])));
      }    	
    }

    // Saves and redirects to the section
    $configurationManager->saveConfiguration();
    $this->redirect($section . 'EditSection', NULL, NULL, array('extKey' => $extKey, 'section' => $section, 'itemKey' => $itemKey, 'fieldKey' => $fieldKey));
  }

	/**
	 * addNewField action for this controller.
	 *
	 * @param string $extKey The extension key
	 * @param string $section The section name
	 * @param integer $itemKey The key of the item to edit
	 * @param integer $fieldKey The key of the field to edit
	 * @return string The rendered view
	 */
	public function addNewFieldAction($extKey, $section, $itemKey, $fieldKey = NULL) {
    // Loads the configuration and gets the section manager
    $configurationManager = t3lib_div::makeInstance('Tx_SavLibraryKickstarter_Configuration_ConfigurationManager', $extKey);
    $configurationManager->loadConfiguration();
    $sectionManager = $configurationManager->getSectionManager();
    // Adds the item at the end if no field key is provided
    if ($fieldKey === NULL) {
      // Adds the field and gets its key
      $fieldKey = $sectionManager->getItem($section)->getItem($itemKey)->addItem('fields')->addItem($fieldKey)->getItemIndex();
      // Sets the default values
      $sectionManager->getItem($section)->getItem($itemKey)->getItem('fields')->getItem($fieldKey)->addItem(array(
        'fieldname' => Tx_Extbase_Utility_Localization::translate('kickstarter.new', 'sav_library_kickstarter'),
        'title' => Tx_Extbase_Utility_Localization::translate('kickstarter.new', 'sav_library_kickstarter'),
        'type' => 'unknown',
        )
      );
      // Sets the view key
      $viewKey = $sectionManager->getItem($section)->getItem($itemKey)->getItemAndSetToZeroIfNull('viewKey');
      $sectionManager->getItem($section)->getItem($itemKey)->getItem('fields')->getItem($fieldKey)->addItem(array('viewKey' => $viewKey));
      // Adds the order in each view if any
      $views = $sectionManager->getItem('views');
      $count = $sectionManager->getItem($section)->getItem($itemKey)->getItem('fields')->count();
      if ($views->count() > 0) {
        foreach ($views as $viewKey => $view) {
         $sectionManager->getItem($section)->getItem($itemKey)->getItem('fields')->getItem($fieldKey)->addItem('order')->addItem(array($viewKey => $count));
        }
      } else {
         $sectionManager->getItem($section)->getItem($itemKey)->getItem('fields')->getItem($fieldKey)->addItem('order')->addItem(array($viewKey => $count));
      }
    }
    // Saves the configuration and redirects to the section
    $configurationManager->saveConfiguration();
    $this->redirect($section . 'EditSection', NULL, NULL, array('extKey' => $extKey, 'section' => $section, 'itemKey' => $itemKey, 'fieldKey' => $fieldKey, 'showFieldConfiguration' => true));
  }

	/**
	 * deleteFieldAction action for this controller.
	 *
	 * @param string $extKey The extension key
	 * @param string $section The section name
	 * @param integer $itemKey The key of the item to delete
	 * @param integer $fieldKey The key of the field to delete
	 * @return string The rendered view
	 */
	public function deleteFieldAction($extKey, $section, $itemKey, $fieldKey = NULL) {
    // Loads the configuration and gets the section manager
    $configurationManager = t3lib_div::makeInstance('Tx_SavLibraryKickstarter_Configuration_ConfigurationManager', $extKey);
    $configurationManager->loadConfiguration();
    $sectionManager = $configurationManager->getSectionManager();
    // Deletes the field
    $sectionManager->getItem($section)->getItem($itemKey)->getItem('fields')->deleteItem($fieldKey);
    // Reorders the fields if any
    if ($sectionManager->getItem($section)->getItem($itemKey)->addItem('fields')->count() > 0) {
      $views = $sectionManager->getItem('views');
      // Reorders each view if any
      if ($views->count() > 0) {
        foreach ($views as $viewKey => $view) {
         $sectionManager->getItem($section)->getItem($itemKey)->getItem('fields')->reIndex(array('order' => $viewKey));
        }
      } else {
         $sectionManager->getItem($section)->getItem($itemKey)->getItem('fields')->reIndex(array('order' => 0));
      }
    }
    // Saves the configuration and redirects to the section
    $configurationManager->saveConfiguration();
    $this->redirect($section . 'EditSection', NULL, NULL, array('extKey' => $extKey, 'section' => $section, 'itemKey' => $itemKey, 'fieldKey' => $fieldKey));
  }

	/**
	 * addNewViewWithConditionAction action for this controller.
	 *
	 * @param string $extKey The extension key
	 * @param string $section The section name
	 * @param integer $itemKey The key of the item to edit
	 * @param string $viewType The type of the view
	 * @param integer $viewWithConditionKey The key of the view to add
	 * @return string The rendered view
	 */
	public function addNewViewWithConditionAction($extKey, $section, $itemKey, $viewType, $viewWithConditionKey = NULL) {
    // Loads the configuration and gets the section manager
    $configurationManager = t3lib_div::makeInstance('Tx_SavLibraryKickstarter_Configuration_ConfigurationManager', $extKey);
    $configurationManager->loadConfiguration();
    $sectionManager = $configurationManager->getSectionManager();
    // Adds the folder at the end if no key is provided
    if ($viewWithConditionKey === NULL) {
      $viewWithCondition = $sectionManager->getItem($section)->getItem($itemKey)->addItem('viewsWithCondition');
      $viewWithCondition->addItem($viewType)->addItem($viewWithConditionKey)->addItem(array('key' => $viewWithCondition->count(), 'condition' => ''));
    }
    // Saves the configuration and redirects to the section
    $configurationManager->saveConfiguration();
    $this->redirect($section . 'EditSection', NULL, NULL, array('extKey' => $extKey, 'section' => $section, 'itemKey' => $itemKey));
  }

	/**
	 * deleteFolderAction action for this controller.
	 *
	 * @param string $extKey The extension key
	 * @param string $section The section name
	 * @param integer $itemKey The key of the item to edit
	 * @param string $viewType The type of the view
	 * @param integer $viewWithConditionKey The key of the view to add
	 * @return string The rendered view
	 */
	public function deleteViewWithConditionAction($extKey, $section, $itemKey, $viewType, $viewWithConditionKey) {
    // Loads the configuration and gets the section manager
    $configurationManager = t3lib_div::makeInstance('Tx_SavLibraryKickstarter_Configuration_ConfigurationManager', $extKey);
    $configurationManager->loadConfiguration();
    $sectionManager = $configurationManager->getSectionManager();
    // Deletes the field
    $sectionManager->getItem($section)->getItem($itemKey)->getItem('viewsWithCondition')->addItem($viewType)->deleteItem($viewWithConditionKey);

    // Saves the configuration and redirects to the section
    $configurationManager->saveConfiguration();
    $this->redirect($section . 'EditSection', NULL, NULL, array('extKey' => $extKey, 'section' => $section, 'itemKey' => $itemKey));
  }
  
	/**
	 * addNewFolderAction action for this controller.
	 *
	 * @param string $extKey The extension key
	 * @param string $section The section name
	 * @param integer $itemKey The key of the item to edit
	 * @param integer $folderKey The key of the folder to add
	 * @return string The rendered view
	 */
	public function addNewFolderAction($extKey, $section, $itemKey, $folderKey = NULL) {
    // Loads the configuration and gets the section manager
    $configurationManager = t3lib_div::makeInstance('Tx_SavLibraryKickstarter_Configuration_ConfigurationManager', $extKey);
    $configurationManager->loadConfiguration();
    $sectionManager = $configurationManager->getSectionManager();
    // Adds the folder at the end if no key is provided
    if ($folderKey === NULL) {
      $folders = $sectionManager->getItem($section)->getItem($itemKey)->addItem('folders');
      $folders->addItem($folderKey)->addItem(array('label' => '', 'configuration' => '', 'order' => $folders->count()));
    }
    // Saves the configuration and redirects to the section
    $configurationManager->saveConfiguration();
    $this->redirect($section . 'EditSection', NULL, NULL, array('extKey' => $extKey, 'section' => $section, 'itemKey' => $itemKey));
  }

	/**
	 * moveUpFolder action for this controller.
	 *
	 * @param string $extKey The extension key
	 * @param string $section The section name
	 * @param integer $itemKey The key of the item to edit
	 * @param integer $folderKey The key of the folder to move up
	 * @return string The rendered view
	 */
	public function moveUpFolderAction($extKey, $section, $itemKey, $folderKey) {
    $configurationManager = t3lib_div::makeInstance('Tx_SavLibraryKickstarter_Configuration_ConfigurationManager', $extKey);
    $configurationManager->loadConfiguration();
    $sectionManager = $configurationManager->getSectionManager();
    $fromItem = $sectionManager->getItem($section)->getItem($itemKey)->getItem('folders')->getItem($folderKey);
    $fromPosition = $fromItem->getItem('order');
    if ($fromPosition > 1) {
      $toPosition = $fromPosition - 1;
      $toItem = $sectionManager->getItem($section)->getItem($itemKey)->getItem('folders')->find('order', $toPosition);
      $fromItem->replace(array('order' => $toPosition));
      $toItem->replace(array('order' => $fromPosition));
    } else {
      $count = $sectionManager->getItem($section)->getItem($itemKey)->getItem('folders')->count();
      foreach ($sectionManager->getItem($section)->getItem($itemKey)->getItem('folders') as $key => $field) {
        $position = $field->getItem('order');
        $field->replace(array('order' => ((int)($position + $count - 2) % $count) + 1));
      }
    }
    $configurationManager->saveConfiguration();
    $this->redirect($section . 'EditSection', NULL, NULL, array('extKey' => $extKey, 'section' => $section, 'itemKey' => $itemKey));
  }

	/**
	 * moveDownFolder action for this controller.
	 *
	 * @param string $extKey The extension key
	 * @param string $section The section name
	 * @param integer $itemKey The key of the item to edit
	 * @param integer $folderKey The key of the folder to move down
	 * @return string The rendered view
	 */
	public function moveDownFolderAction($extKey, $section, $itemKey, $folderKey) {
    $configurationManager = t3lib_div::makeInstance('Tx_SavLibraryKickstarter_Configuration_ConfigurationManager', $extKey);
    $configurationManager->loadConfiguration();
    $sectionManager = $configurationManager->getSectionManager();
    $fromItem = $sectionManager->getItem($section)->getItem($itemKey)->getItem('folders')->getItem($folderKey);
    $fromPosition = $fromItem->getItem('order');
    $count = $sectionManager->getItem($section)->getItem($itemKey)->getItem('folders')->count();
    if ($fromPosition < $count) {
      $toPosition = $fromPosition + 1;
      $toItem = $sectionManager->getItem($section)->getItem($itemKey)->getItem('folders')->find('order', $toPosition);
      $fromItem->replace(array('order' => $toPosition));
      $toItem->replace(array('order' => $fromPosition));
    } else {
      $count = $sectionManager->getItem($section)->getItem($itemKey)->getItem('folders')->count();
      foreach ($sectionManager->getItem($section)->getItem($itemKey)->getItem('folders') as $key => $field) {
        $position = $field->getItem('order');
        $field->replace(array('order' => ((int)$position % $count) + 1));
      }
    }
    $configurationManager->saveConfiguration();
    $this->redirect($section . 'EditSection', NULL, NULL, array('extKey' => $extKey, 'section' => $section, 'itemKey' => $itemKey));
  }

	/**
	 * deleteFolderAction action for this controller.
	 *
	 * @param string $extKey The extension key
	 * @param string $section The section name
	 * @param integer $itemKey The key of the item to edit
	 * @param integer $folderKey The key of the folder to delete
	 * @return string The rendered view
	 */
	public function deleteFolderAction($extKey, $section, $itemKey, $folderKey) {
    // Loads the configuration and gets the section manager
    $configurationManager = t3lib_div::makeInstance('Tx_SavLibraryKickstarter_Configuration_ConfigurationManager', $extKey);
    $configurationManager->loadConfiguration();
    $sectionManager = $configurationManager->getSectionManager();

    // Deletes the folder
    $sectionManager->getItem($section)->getItem($itemKey)->getItem('folders')->deleteItem($folderKey);
    
    // Deletes the folder input for the view in all field of the newTables 
    foreach($sectionManager->getItem('newTables') as $tableKey => $table) {
      foreach($table->getItem('fields') as $fieldKey => $field) {
        if ($field->getItem('folders') !== NULL && $field->getItem('folders')->getItem($itemKey) == $folderKey)  {
          $field->getItem('folders')->deleteItem($itemKey);
        }
      }
      
      // Delete the foldeKeys input
      if ($table->getItem('folderKeys') !== NULL && $table->getItem('folderKeys')->getItem($itemKey) == $folderKey) {
        $table->getItem('folderKeys')->deleteItem($itemKey);
      }
    }
    
    // Deletes the folder input  for the view in all field of the existingTables 
    foreach($sectionManager->getItem('existingTables') as $tableKey => $table) {
      foreach($table->getItem('fields') as $fieldKey =>$field) {
        $field->getItem('folders')->deleteItem($itemKey);
      }
    }
      
    // Reorders the folders if any
    $counter = 1;
    if ($sectionManager->getItem($section)->getItem($itemKey)->addItem('folders')->count() > 0) {
      $sortedFoldersByOrder = $sectionManager->getItem($section)->getItem($itemKey)->getItem('folders')->sortBy('order');
      foreach ($sortedFoldersByOrder as $folderKey => $folder) {
        $folder->replace(array('order' => $counter++));
      }   
    } 

    // Saves the configuration and redirects to the section
    $configurationManager->saveConfiguration();
    $this->redirect($section . 'EditSection', NULL, NULL, array('extKey' => $extKey, 'section' => $section, 'itemKey' => $itemKey));
  }

	/**
	 * addNewWhereTagAction action for this controller.
	 *
	 * @param string $extKey The extension key
	 * @param string $section The section name
	 * @param integer $itemKey The key of the item to edit
	 * @param integer $whereTagKey The key of the whereTag to create
	 * @return string The rendered view
	 */
	public function addNewWhereTagAction($extKey, $section, $itemKey, $whereTagKey = NULL) {
    // Loads the configuration and gets the section manager
    $configurationManager = t3lib_div::makeInstance('Tx_SavLibraryKickstarter_Configuration_ConfigurationManager', $extKey);
    $configurationManager->loadConfiguration();
    $sectionManager = $configurationManager->getSectionManager();
    // Adds the folder at the end if no key is provided
    if ($whereTagKey === NULL) {
      $whereTags = $sectionManager->getItem($section)->getItem($itemKey)->addItem('whereTags');
      $whereTags->addItem($whereTagKey)->addItem(array('title' => '', 'where' => '', 'order' => ''));
    }
    // Saves the configuration and redirects to the section
    $configurationManager->saveConfiguration();
    $this->redirect($section . 'EditSection', NULL, NULL, array('extKey' => $extKey, 'section' => $section, 'itemKey' => $itemKey));
  }

	/**
	 * deleteWhereTagAction action for this controller.
	 *
	 * @param string $extKey The extension key
	 * @param string $section The section name
	 * @param integer $itemKey The key of the item to edit
	 * @param integer $whereTagKey The key of the folder to delete
	 * @return string The rendered view
	 */
	public function deleteWhereTagAction($extKey, $section, $itemKey, $whereTagKey) {
    // Loads the configuration and gets the section manager
    $configurationManager = t3lib_div::makeInstance('Tx_SavLibraryKickstarter_Configuration_ConfigurationManager', $extKey);
    $configurationManager->loadConfiguration();
    $sectionManager = $configurationManager->getSectionManager();
    // Deletes the whereTag
    $sectionManager->getItem($section)->getItem($itemKey)->getItem('whereTags')->deleteItem($whereTagKey);
    // Saves the configuration and redirects to the section
    $configurationManager->saveConfiguration();
    $this->redirect($section . 'EditSection', NULL, NULL, array('extKey' => $extKey, 'section' => $section, 'itemKey' => $itemKey));
  }

	/**
	 * addNewBoxItemAction action for this controller.
	 *
	 * @param string $extKey The extension key
	 * @param string $section The section name
	 * @param integer $itemKey The key of the item to edit
	 * @param integer $fieldKey The key of the field to edit
	 * @param integer $boxItemKey The key of the folder to edit
	 * @return string The rendered view
	 */
	public function addNewBoxItemAction($extKey, $section, $itemKey, $fieldKey, $boxItemKey = NULL) {
    // Loads the configuration and gets the section manager
    $configurationManager = t3lib_div::makeInstance('Tx_SavLibraryKickstarter_Configuration_ConfigurationManager', $extKey);
    $configurationManager->loadConfiguration();
    $sectionManager = $configurationManager->getSectionManager();
    // Adds the boxItem at the end if no key is provided
    if ($boxItemKey === NULL) {
      $boxItem = $sectionManager->getItem($section)->getItem($itemKey)->getItem('fields')->getItem($fieldKey)->addItem('items');
      $boxItem->addItem($boxItemKey)->addItem(array('label' => '', 'value' => ''));
    }
    // Saves the configuration and redirects to the section
    $configurationManager->saveConfiguration();
    $this->redirect($section . 'EditSection', NULL, NULL, array('extKey' => $extKey, 'section' => $section, 'itemKey' => $itemKey, 'fieldKey' => $fieldKey, 'showFieldConfiguration' => true));
  }

	/**
	 * deleteBoxItemAction action for this controller.
	 *
	 * @param string $extKey The extension key
	 * @param string $section The section name
	 * @param integer $itemKey The key of the item to edit
	 * @param integer $fieldKey The key of the field to edit
	 * @param integer $boxItemKey The key of the folder to delete
	 * @return string The rendered view
	 */
	public function deleteBoxItemAction($extKey, $section, $itemKey, $fieldKey, $boxItemKey) {
    // Loads the configuration and gets the section manager
    $configurationManager = t3lib_div::makeInstance('Tx_SavLibraryKickstarter_Configuration_ConfigurationManager', $extKey);
    $configurationManager->loadConfiguration();
    $sectionManager = $configurationManager->getSectionManager();
    // Deletes the field
    $sectionManager->getItem($section)->getItem($itemKey)->getItem('fields')->getItem($fieldKey)->getItem('items')->deleteItem($boxItemKey);
    // Reindexess the box Items if any
    if ($sectionManager->getItem($section)->getItem($itemKey)->getItem('fields')->getItem($fieldKey)->addItem('items')->count() > 0) {
      $sectionManager->getItem($section)->getItem($itemKey)->getItem('fields')->getItem($fieldKey)->getItem('items')->reIndexKeys();
    }
    // Saves the configuration and redirects to the section
    $configurationManager->saveConfiguration();
    $this->redirect($section . 'EditSection', NULL, NULL, array('extKey' => $extKey, 'section' => $section, 'itemKey' => $itemKey, 'fieldKey' => $fieldKey, 'showFieldConfiguration' => true));
  }

	/**
	 * assignForEditItemAction Assignement for EditItem actions.
	 *
	 * @param string $extKey The extension key
	 * @param string $section The section name
	 * @param integer $itemKey The key of the item to edit
	 * @return string The rendered view
	 */
	protected function assignForEditItemAction($extKey, $section, $itemKey) {
    $configurationManager = t3lib_div::makeInstance('Tx_SavLibraryKickstarter_Configuration_ConfigurationManager', $extKey);
    $configurationManager->loadConfiguration();
    $sectionManager = $configurationManager->getSectionManager();
    $viewKey = $sectionManager->getItem($section)->getItem($itemKey)->getItem('viewKey');
    if (! empty($itemKey)) {
      $sectionManager->getItem($section)->getItem($itemKey)->getItem('fields')->sortby(array('order' => $viewKey));
    }
    $configuration = $configurationManager->getConfiguration();
    $this->view->assign('savLibraryKickstarterVersion', Tx_SavLibraryKickstarter_Configuration_ConfigurationManager::getSavLibraryKickstarterVersion());
    $this->view->assign('extKey', $extKey);
    $this->view->assign('itemKey', $itemKey);
    $this->view->assign('extension', $configuration);
    return $configuration;
	}

	/**
	 * Gets the configuration list.
	 *
	 * @param none
	 * return array the configuration list
	 */
  public function getConfigurationList() {
    $extensionList = array();
    $this->extensionsNeedTobeUpgraded = false;
    foreach (t3lib_div::get_dirs(PATH_typo3conf . 'ext/') as $extensionKey) {
      $configurationManager = t3lib_div::makeInstance('Tx_SavLibraryKickstarter_Configuration_ConfigurationManager', $extensionKey);

      if (!$configurationManager->isSavLibraryKickstarterExtension()) {
        $configurationManager->checkForUpgrade();
      }
      if ($configurationManager->isSavLibraryKickstarterExtension()) {
        $configurationManager->loadConfiguration();
        $configurationManager->getSectionManager()->getItem('general')->getItem(1)->addItem(array('isLoadedExtension' => $configurationManager->isLoadedExtension()));
        $configurationManager->getSectionManager()->getItem('general')->getItem(1)->addItem(array('currentLibraryVersion' => $configurationManager->getCurrentLibraryVersion()));
      
    		// Changes the extension version if needed
    		$extensionVersion = $configurationManager->getExtensionVersion($extensionKey);
    		if ($configurationManager->getSectionManager()->getItem('emconf')->getItem(1)->getItem('version') != $extensionVersion) {
		    	$configurationManager->getSectionManager()->getItem('emconf')->getItem(1)->replace(array('version' => $extensionVersion));
        	$configurationManager->saveConfiguration();	
    		}	    	
        
        // Checks if the extension must be upgraded
        if ($configurationManager->getCurrentLibraryVersion() != $configurationManager->getSectionManager()->getItem('general')->getItem(1)->getItem('libraryVersion')) {
          $configurationManager->getSectionManager()->getItem('general')->getItem(1)->replace(array('extensionMustbeUpgraded' => true));
          $this->extensionsNeedTobeUpgraded = true;
        }
        $extensionList[] = $configurationManager->getConfiguration();
      }
    }
    return $extensionList;
  }
}
?>
