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
 * @subpackage  t
 * @author      Laurent Foulloy <yolf.typo3@orange.fr>
 */
class Tx_SavLibraryKickstarter_Controller_KickstarterController extends Tx_Extbase_MVC_Controller_ActionController {

	/**
	 * The reference to the configuration manager
	 *
	 * @var Tx_SavLibraryKickstarter_Configuration_ConfigurationManager
	 */
	protected $configurationManager;

	/**
	 * extensionList action for this controller.
	 *
	 * @return string The rendered view
	 */
	public function extensionListAction() {
    $this->view->assign('extensionList', $this->getConfigurationList());
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
    $configurationManager->getCodeGenerator()->setFlashMessages($this->flashMessages);
    $configurationManager->getCodeGenerator()->installExtension();
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
    $configurationManager->getCodeGenerator()->setFlashMessages($this->flashMessages);
    $configurationManager->getCodeGenerator()->uninstallExtension();
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
    $configurationManager->getCodeGenerator()->buildExtension();
    $configurationManager->getCodeGenerator()->setFlashMessages($this->flashMessages);
    $configurationManager->getCodeGenerator()->checkDbUpdate();
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
    $configurationManager->getCodeGenerator()->buildExtension();
    $configurationManager->getCodeGenerator()->setFlashMessages($this->flashMessages);
    $configurationManager->getCodeGenerator()->checkDbUpdate();
    $configurationManager->getSectionManager()->getItem('general')->getItem(1)->replace(array('extensionMustbeUpgraded' => false));
    $configurationManager->saveConfiguration();
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
    $configurationManager->getSectionManager()->getItem('general')->deleteItem('section');
    $configurationManager->getSectionManager()->getItem('general')->deleteItem('itemKey');
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
	 * @param boolean $showFieldDefinition Displays the field definition if true
	 * @return string The rendered view
	 */
	public function newTablesEditSectionAction($extKey, $section, $itemKey, $fieldKey = NULL, $showFieldDefinition = false) {
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
    $this->view->assign('extKey', $extKey);
    $this->view->assign('itemKey', $itemKey);
    $this->view->assign('fieldKey', $fieldKey);
    $this->view->assign('extension', $configuration);
    $this->view->assign('showFieldDefinition', $showFieldDefinition);
    $this->view->assign('folderLabels', $folderLabels);
	}

	/**
	 * existingTablesEditSection action for this controller.
	 *
	 * @param string $extKey The extension key
	 * @param string $section The section name
	 * @param integer $itemKey The key of the item to edit
	 * @param integer $fieldKey The key of the field to edit
	 * @param boolean $showFieldDefinition Displays the field definition if true
	 * @return string The rendered view
	 */
	public function existingTablesEditSectionAction($extKey, $section, $itemKey, $fieldKey = NULL, $showFieldDefinition = false) {
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
    $this->view->assign('extKey', $extKey);
    $this->view->assign('itemKey', $itemKey);
    $this->view->assign('fieldKey', $fieldKey);
    $this->view->assign('extension', $configuration);
    $this->view->assign('showFieldDefinition', $showFieldDefinition);
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
          'type' => 'showOnly',
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
	 * Save submitted action.
	 *
	 * @return none
	 */
  protected function saveSubmitAction() {
    // Gets arguments
    $arguments = $this->request->getArguments();
    $extKey = $arguments['extKey'];
    $section = $arguments['general']['section'];
    $itemKey = $arguments['general']['itemKey'];

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
    $sectionManager->getItem('general')->addItem(1)->replace($arguments['general']);

    $sectionManager->getItem($section)->getItem($itemKey)->replace($arguments[$section]);

    // Saves he configuration
    $configurationManager->saveConfiguration();

    // Redirects to the section action
    $this->redirect($section . 'EditSection', NULL, NULL, array('extKey' => $extKey, 'section' => $section, 'itemKey' => $itemKey, 'fieldKey' => ($fieldKey ? $fieldKey : NULL), 'showFieldDefinition' => $showFieldDefinition));
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
    $showFieldDefinition = $arguments['general']['showFieldDefinition'];

    // Gets the configuration and the section managers
    $configurationManager = t3lib_div::makeInstance('Tx_SavLibraryKickstarter_Configuration_ConfigurationManager', $extKey);
    $configurationManager->loadConfiguration();
    $sectionManager = $configurationManager->getSectionManager();

    // Saves the configuration
    $sectionManager->getItem('general')->addItem(1)->replace($arguments['general']);
    $sectionManager->getItem($section)->getItem($itemKey)->replace($arguments[$section]);
    $configurationManager->saveConfiguration();

    // Buids the extension
    $configurationManager->getCodeGenerator()->buildExtension();
    $sectionManager->getItem('general')->getItem(1)->addItem(array('isGeneratedExtension' => 1));
    $configurationManager->getCodeGenerator()->setFlashMessages($this->flashMessages);
    $configurationManager->getCodeGenerator()->setHiddenArguments($arguments['general']);
    $configurationManager->getCodeGenerator()->checkDbUpdate();

    // Redirects to the section action
    $this->redirect($section . 'EditSection', NULL, NULL, array('extKey' => $extKey, 'section' => $section, 'itemKey' => $itemKey, 'fieldKey' => ($fieldKey ? $fieldKey : NULL), 'showFieldDefinition' => $showFieldDefinition));
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
    $configurationManager->getCodeGenerator()->buildExtension();

    // Redirects to the new section action
    $this->redirect($section . 'EditSection', NULL, NULL, array('extKey' => $newExtKey, 'section' => $section, 'itemKey' => $itemKey));
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
    $configurationManager->getCodeGenerator()->checkDbUpdate();

    // Redirects to the section action
    $this->redirect($section . 'EditSection', NULL, NULL, array('extKey' => $extKey, 'section' => $section, 'itemKey' => $itemKey));
  }

	/**
	 * editFieldConfiguration action for this controller.
	 *
	 * @param string $extKey The extension key
	 * @param string $section The section name
	 * @param integer $itemKey The key of the item to edit
	 * @param integer $fieldKey The key of the field to edit
	 * @return string The rendered view
	 */
	public function editFieldConfigurationAction($extKey, $section, $itemKey, $fieldKey) {
    $this->redirect($section . 'EditSection', NULL, NULL, array('extKey' => $extKey, 'section' => $section, 'itemKey' => $itemKey, 'fieldKey' => $fieldKey));
	}

	/**
	 * editFieldDefinition action for this controller.
	 *
	 * @param string $extKey The extension key
	 * @param string $section The section name
	 * @param integer $itemKey The key of the item to edit
	 * @param integer $fieldKey The key of the field to edit
	 * @return string The rendered view
	 */
	public function editFieldDefinitionAction($extKey, $section, $itemKey, $fieldKey) {
    $this->redirect($section . 'EditSection', NULL, NULL, array('extKey' => $extKey, 'section' => $section, 'itemKey' => $itemKey, 'fieldKey' => $fieldKey, 'showFieldDefinition' => true));
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
    $viewKey = $sectionManager->getItem($section)->getItem($itemKey)->getItemAndSetToZeroIfNull('viewKey');
    $fromItem = $sectionManager->getItem($section)->getItem($itemKey)->getItem('fields')->getItem($fieldKey);
    $fromPosition = $fromItem->getItem('order')->getItem($viewKey);
    if ($fromPosition > 1) {
      $toPosition = $fromPosition - 1;
      $toItem = $sectionManager->getItem($section)->getItem($itemKey)->getItem('fields')->find(array('order' => $viewKey), $toPosition);
      $fromItem->replace(array('order' => array($viewKey => $toPosition)));
      $toItem->replace(array('order' => array($viewKey => $fromPosition)));
    } else {
      $count = $sectionManager->getItem($section)->getItem($itemKey)->getItem('fields')->count();
      foreach($sectionManager->getItem($section)->getItem($itemKey)->getItem('fields') as $key => $field) {
        $position = $field->addItem('order')->getItem($viewKey);
        $field->replace(array('order' => array($viewKey => ((int)($position + $count - 2) % $count) + 1) ));
      }
    }
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
    $viewKey = $sectionManager->getItem($section)->getItem($itemKey)->getItemAndSetToZeroIfNull('viewKey');
    $fromItem = $sectionManager->getItem($section)->getItem($itemKey)->getItem('fields')->getItem($fieldKey);
    $fromPosition = $fromItem->getItem('order')->getItem($viewKey);
    $count = $sectionManager->getItem($section)->getItem($itemKey)->getItem('fields')->count();
    if ($fromPosition < $count) {
      $toPosition = $fromPosition + 1;
      $toItem = $sectionManager->getItem($section)->getItem($itemKey)->getItem('fields')->find(array('order' => $viewKey), $toPosition);
      $fromItem->replace(array('order' => array($viewKey => $toPosition)));
      $toItem->replace(array('order' => array($viewKey => $fromPosition)));
    } else {
      $count = $sectionManager->getItem($section)->getItem($itemKey)->getItem('fields')->count();
      foreach($sectionManager->getItem($section)->getItem($itemKey)->getItem('fields') as $key => $field) {
        $position = $field->getItem('order')->getItem($viewKey);
        $field->replace(array('order' => array($viewKey => ((int)$position % $count) + 1) ));
      }
    }
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
      if ($views->count() > 0) {
        foreach ($views as $viewKey => $view) {
         $sectionManager->getItem($section)->getItem($itemKey)->getItem('fields')->getItem($fieldKey)->addItem('order')->addItem(array($viewKey => $fieldKey));
        }
      } else {
         $sectionManager->getItem($section)->getItem($itemKey)->getItem('fields')->getItem($fieldKey)->addItem('order')->addItem(array($viewKey => $fieldKey));
      }
    }
    // Saves the configuration and redirects to the section
    $configurationManager->saveConfiguration();
    $this->redirect($section . 'EditSection', NULL, NULL, array('extKey' => $extKey, 'section' => $section, 'itemKey' => $itemKey, 'fieldKey' => $fieldKey, 'showFieldDefinition' => true));
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
	 * addNewFolderAction action for this controller.
	 *
	 * @param string $extKey The extension key
	 * @param string $section The section name
	 * @param integer $itemKey The key of the item to edit
	 * @param integer $folderKey The key of the folder to edit
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
    // Deletes the field
    $sectionManager->getItem($section)->getItem($itemKey)->getItem('folders')->deleteItem($folderKey);
    // Reorders the folders if any
    if ($sectionManager->getItem($section)->getItem($itemKey)->addItem('folders')->count() > 0) {
      $sectionManager->getItem($section)->getItem($itemKey)->getItem('folders')->reIndex('order');
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
    $this->redirect($section . 'EditSection', NULL, NULL, array('extKey' => $extKey, 'section' => $section, 'itemKey' => $itemKey, 'fieldKey' => $fieldKey, 'showFieldDefinition' => true));
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
    $this->redirect($section . 'EditSection', NULL, NULL, array('extKey' => $extKey, 'section' => $section, 'itemKey' => $itemKey, 'fieldKey' => $fieldKey, 'showFieldDefinition' => true));
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
    foreach (t3lib_div::get_dirs(PATH_typo3conf . 'ext/') as $extensionKey) {
      $configurationManager = t3lib_div::makeInstance('Tx_SavLibraryKickstarter_Configuration_ConfigurationManager', $extensionKey);

      if (!$configurationManager->isSavLibraryKickstarterExtension()) {
        $configurationManager->checkForUpgrade();
      }
      if ($configurationManager->isSavLibraryKickstarterExtension()) {
        $configurationManager->loadConfiguration();
        $configurationManager->getSectionManager()->getItem('general')->getItem(1)->addItem(array('isLoadedExtension' => $configurationManager->isLoadedExtension()));
        $configurationManager->getSectionManager()->getItem('general')->getItem(1)->addItem(array('currentLibraryVersion' => $configurationManager->getCurrentLibraryVersion()));
        // Checks if the extension must be upgraded
        if ($configurationManager->getCurrentLibraryVersion() != $configurationManager->getSectionManager()->getItem('general')->getItem(1)->getItem('libraryVersion')) {
          $configurationManager->getSectionManager()->getItem('general')->getItem(1)->replace(array('extensionMustbeUpgraded' => true));
        }
        $extensionList[] = $configurationManager->getConfiguration();
      }
    }
    return $extensionList;
  }
}
?>
