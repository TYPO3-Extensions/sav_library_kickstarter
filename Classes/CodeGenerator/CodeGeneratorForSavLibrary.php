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
 * This class generates the code for a front end plugin.
 *
 * It is based on the same idea developed by Ingmar Schlecht for the extbase_kickstater.
 * Code templates are used to build the file contents. They are processed by a fluid parser.
 *
 * @package SavLibraryKickstarter
 * @version $ID:$
 */
class Tx_SavLibraryKickstarter_CodeGenerator_CodeGeneratorForSavLibrary extends Tx_SavLibraryKickstarter_CodeGenerator_AbstractCodeGenerator {

  const CODE_TEMPLATES_DIRECTORY = 'Resources/Private/CodeTemplates/ForSavLibrary/';

	/**
	 * Builds all the file for the extension.
	 *
	 * return none
	 */
	public function buildExtension() {
    // Sets the file directory for the root files
    $fileDirectory = $this->extensionDirectory;

    // Generates the icons
 		$this->generateFile('icons.t');

		// Generates ext_emconf.php
		$fileContents = $this->generateFile('extEmconf.phpt');
		t3lib_div::writeFile($fileDirectory . 'ext_emconf.php', $fileContents);

		// Generates ext_localconf.php
		$fileContents = $this->generateFile('extLocalconf.phpt');
		t3lib_div::writeFile($fileDirectory . 'ext_localconf.php', $fileContents);

		// Generates ext_tables.php
		$fileContents = $this->generateFile('extTables.phpt');
		t3lib_div::writeFile($fileDirectory . 'ext_tables.php', $fileContents);

		// Generates ext_tables.sql
		$fileContents = $this->generateFile('extTables.sqlt');
		t3lib_div::writeFile($fileDirectory . 'ext_tables.sql', $fileContents);

		// Generates flexforms
		$fileContents = $this->generateFile('Configuration/Flexforms/ExtensionFlexform.xmlt');
		t3lib_div::writeFile($fileDirectory . 'flexform_ds_pi1.xml', $fileContents);

		// Generates TCA
		$fileContents = $this->generateFile('Configuration/TCA/tca.phpt');
		t3lib_div::writeFile($fileDirectory . 'tca.php', $fileContents);

		// Generates locallang_db.xml file
		$fileContents = $this->generateFile('Resources/Private/Language/locallang_db.xmlt');
		t3lib_div::writeFile($fileDirectory . 'locallang_db.xml', $fileContents);

		// Generates the pi1 directory
		t3lib_div::mkdir_deep($this->extensionDirectory, 'pi1');
		$fileDirectory = $this->extensionDirectory . 'pi1/';

		// Generate locallang.xml file if it does not exist
		if (!file_exists($fileDirectory . 'locallang.xml')) {
		  $fileContents = $this->generateFile('Resources/Private/Language/locallang.xmlt');
		  t3lib_div::writeFile($fileDirectory . 'locallang.xml', $fileContents);
    }

		// Generates the pi file
		$fileContents = $this->generateFile('Classes/class.tx_extension_pi1.phpt');
		t3lib_div::writeFile($fileDirectory . 'class.tx_' . str_replace('_','', $this->extensionKey) . '_pi1.php', $fileContents);

		// Generates the XML file
		$fileContents = $this->generateFile('Configuration/SavLibrary/tx_extension_pi1.xmlt', null, $this->getXmlArray());
		t3lib_div::writeFile($fileDirectory . 'tx_' . str_replace('_','', $this->extensionKey) . '_pi1.xml', $fileContents);

		// Generates the res directory
		t3lib_div::mkdir_deep($this->extensionDirectory, 'res');
		$fileDirectory = $this->extensionDirectory . 'res/';

	}

	/**
	 * Builds the array to be used for generating the XML file in pi1 directory.
	 * This method was taken from the "old" generator implemented in sav_library.
	 * It will probably change in the next version.
	 *
	 * return array The array
	 */
  protected function getXmlArray() {

    $extension = $this->sectionManager->getItemsAsArray();

    // Converts special characters
    array_walk_recursive($extension, 'Tx_SavLibraryKickstarter_CodeGenerator_CodeGeneratorForSavLibrary::htmlspecialchars');

    // Generates the version
    $xmlArray['version'] = $GLOBALS[TYPO3_CONF_VARS]['EXTCONF']['sav_library']['version'];

    // Generates the extension key
    $xmlArray['extensionKey'] = $this->extensionKey;

    // Generates forms
    if (is_array($extension['forms'])) {
      $xmlArray['forms'] = $extension['forms'];
    }

    // Generates queries
    if (is_array($extension['queries'])) {
      foreach ($extension['queries'] as $queryKey => $query) {
        $xmlArray['queries'][$queryKey] = $query;
        if ($query['whereTags']) {
          foreach($query['whereTags'] as $whereTagKey => $whereTag) {
            $xmlArray['queries'][$queryKey]['whereTags'][$whereTagKey]['title'] = $this->cryptTag($whereTag['title']);
          }
        }
      }
    }

    // Generates views
    if (is_array($extension['views'])) {
      foreach ($extension['views'] as $viewKey => $view) {

        // Generates the templates
        if ($view['type'] == 'list' || $view['type'] == 'special' ) {
          if($view['itemTemplate']) {
            $xmlArray['templates'][$viewKey]['itemTemplate'] = $view['itemTemplate'];
          }
          if($view['viewTemplate']) {
            $xmlArray['templates'][$viewKey]['viewTemplate'] = $view['viewTemplate'];
          }
        }

        // Checks if it's a print view
        if ($view['type'] == 'special' && $view['subtype'] == 'print') {
          if($view['itemsBeforePageBreak']) {
            $xmlArray['templates'][$viewKey]['itemsBeforePageBreak'] = $view['itemsBeforePageBreak'];
          }
          if($view['itemsBeforeFirstPageBreak']) {
            $xmlArray['templates'][$viewKey]['itemsBeforeFirstPageBreak'] = $view['itemsBeforeFirstPageBreak'];
          }
        }

        // Checks if it's an update view
        // If a submit icon is added, create a field _submitted_data_ to save the submitted data
        if ($view['type'] == 'special' && $view['subtype'] == 'update') {
          foreach ($extension['forms'] as $keyForm => $form) {
            if ($form['specialView'] == $viewKey) {
              $xmlArray['forms'][$keyForm]['updateView'] = $viewKey;
              $xmlArray['forms'][$keyForm]['specialView'] = 0;
              break;
            }
          }
        }

        // Processes folders
        if ($view['folders']) {
          $opt_showFolders = array(
            0 => array('label' => '0'),
          );
          foreach ($view['folders'] as $folderKey => $folder) {
            $folderConfiguration['label'] = $folder['label'];
            $folderConfiguration['configuration'] = $folder['configuration'];
            $opt_showFolders[] = $folderConfiguration;
          }
        }

        // Gets the list of the fields organized by folders
        unset($showFolders);
        unset($showFields);
        if (isset($extension['newTables'])) {
          $title[$viewKey]['configuration']['field'] = $view['viewTitleBar'];
          foreach($extension['newTables'] as $tableKey => $table) {
            $tableRootName = 'tx_' . str_replace('_', '', $this->extensionKey);
            $tableName = $tableRootName . ($table['tablename'] ? '_' . $table['tablename'] : '');
            // Puts the fields in the right order for the view
            $tempo = $table['fields'];
            unset($orderedFields);
            foreach ($tempo as $fieldKey => $field) {
              // Generates the title
              if (preg_match('/###(' . $field['fieldname'] . ')(?(?=[:]):([^#]+))###/', $view['viewTitleBar'], $matches) && $field['type'] != 'showOnly') {
                $title[$viewKey]['configuration']['field'] = str_replace($matches[0], '###' . $tableName . '.' . $field['fieldname'] . '###', $title[$viewKey]['configuration']['field']);
              }

              if (preg_match_all('/([^=]+)=([^;#]+);?/', $matches[2], $matches) && $field['type'] != 'showOnly') {

                foreach ($matches[0] as $keyMatch => $match) {
                  $title[$viewKey]['configuration'][strtolower($matches[1][$keyMatch])] = $matches[2][$keyMatch];
                }
              }
              if ($field['selected'][$viewKey]) {
                $orderedFields[$field['order'][$viewKey]] = $fieldKey;
              }
            }

            if (isset($orderedFields)) {
              ksort($orderedFields);
              unset($table['fields']);
              foreach ($orderedFields as $fieldKey => $field) {
                $table['fields'][$field] = $tempo[$field];
              }
              foreach ($table['fields'] as $fieldKey => $field) {
                if ($field['folders'][$viewKey ]) {
                  if ($view['folders']) {
                    $showFolders[$field['folders'][$viewKey ]][] = array('table' => $tableKey, 'field' => $fieldKey, 'wizArray' => 'newTables', 'tableName' => $tableName);
                  } else {
                    $showFields[] = array('table' => $tableKey, 'field' => $fieldKey, 'wizArray' => 'newTables', 'tableName' => $tableName);
                    $extension['newTables'][$tableKey]['fields'][$fieldKey]['folders'][$viewKey] = 0;
                  }
                } else {
                  $showFields[] = array('table' => $tableKey, 'field' => $fieldKey, 'wizArray' => 'newTables', 'tableName' => $tableName);
                }
              }
            }
          }
        }

        if (isset($extension['existingTables'])) {
          if (!$title[$viewKey]['configuration']['field']) {
            $title[$viewKey]['configuration']['field'] = $view['viewTitleBar'];
          }
          foreach($extension['existingTables'] as $tableKey => $table) {
            $tableName = $table['tablename'];

            // Puts the fields in the right order for the view
            $tempo = $table['fields'];
            unset($orderedFields);


            foreach ($tempo as $fieldKey => $field) {

              if ($field['type'] != 'showOnly') {

                // Generates the additional TCA information
                $prefix = 'tx_' . str_replace('_', '', $this->extensionKey) . '_';
                  $column = $field;
                  $column['fieldname'] = $prefix . $field['fieldname'];
                  $columns[$prefix . $field['fieldname']] = $column;

                // Generates the title
                if (preg_match('/###(' . $field['fieldname'] . ')(?(?=[:]):([^#]+))###/', $view['viewTitleBar'], $matches)) {
                  $title[$viewKey]['configuration']['field'] = str_replace($matches[0], '###' . $tableName . '.' . $field['fieldname'] . '###',$title[$viewKey]['configuration']['field']);
                }

                if (preg_match_all('/([^=]+)=([^;#]+);?/', $matches[2], $matches)) {
                  foreach ($matches[0] as $keyMatch => $match){
                    $title[$viewKey]['configuration'][strtolower($matches[1][$keyMatch])] = $matches[2][$keyMatch];
                  }
                }
              }
              if ($field['selected'][$viewKey]) {
                $orderedFields[$field['order'][$viewKey]] = $fieldKey;
              }
            }

            if (isset($orderedFields)) {
              ksort($orderedFields);
              unset($table['fields']);
              foreach ($orderedFields as $fieldKey => $field) {
                $table['fields'][$field] = $tempo[$field];
              }
              foreach ($table['fields'] as $fieldKey => $field) {
                if ($field['folders'][$viewKey]) {
                  if ($view['folders']) {
                    $showFolders[$field['folders'][$viewKey]][] = array('table' => $tableKey, 'field' => $fieldKey, 'wizArray' => 'existingTables', 'tableName' => $tableName);
                  } else {
                    $showFields[] = array('table' => $tableKey, 'field' => $fieldKey, 'wizArray' => 'existingTables', 'tableName' => $tableName);
                    $extension['existingTables'][$tableKey]['fields'][$fieldKey]['folders'][$viewKey] = 0;
                  }
                } else {
                  $showFields[] = array('table' => $tableKey, 'field' => $fieldKey, 'wizArray' => 'existingTables', 'tableName' => $tableName);
                }
              }
            }

            // Generates the TCA
            if ($columns) {
              $xmlArray['TCA'][$tableName] = $columns;
            }
          }
        }

        // Generates the views
        if (isset($showFolders)) {
          ksort($showFolders);
        } else {
          if (isset($showFields)) {
            $showFolders[0] = $showFields;
            $opt_showFolders[0] = '0';
          }
        }

        if (isset($showFolders)) {
          $configTemp = array();
          $relTable = array();
          foreach ($showFolders as $folderKey => $folder) {

            $folderName = $opt_showFolders[$folderKey]['label'];
            // Gets the folder config parameter
            $xmlArray['views'][$viewKey][$this->cryptTag($folderName)]['configuration'] = $this->getConfig($opt_showFolders[$folderKey]['configuration']) +
              array ('label' => $folderName);

            // Generates the title
            if ($view['viewTitleBar'] && !is_array($title[$viewKey])) {
              $title[$viewKey]['configuration']['field'] = $view['viewTitleBar'];
              $title[$viewKey]['configuration']['type'] = 'input';
            }
            $xmlArray['views'][$viewKey][$this->cryptTag($folderName)]['title'] = $title[$viewKey];


            // Generates the addPrintIcon information
            if ($view['addPrintIcon']) {
              $xmlArray['views'][$viewKey][$this->cryptTag($folderName)]['addPrintIcon'] = $view['addPrintIcon'];
              if ($view['viewForPrintIcon']) {
                $xmlArray['views'][$viewKey][$this->cryptTag($folderName)]['viewForPrintIcon'] = $view['viewForPrintIcon'];
              }
            }

            // Processes the folders
            foreach($folder as $key => $value) {
              $config = array();
              $table = $extension[$value['wizArray']][$value['table']];
              $field = $extension[$value['wizArray']][$value['table']]['fields'][$value['field']];

              $fieldName = (($value['wizArray'] == 'existingTables' && $field['type'] != 'showOnly') ? 'tx_' . str_replace('_', '', $this->extensionKey) . '_' . $field['fieldname'] : $field['fieldname']);
              $name = $value['tableName'] . '.' . $fieldName;
              // Generates the field
              if ($field['selected'][$viewKey]) {

                // Sets the user configuration parameters
                $config['table'] = $value['tableName'];
                $config['field'] = $fieldName;

                if ($view['type'] == 'list' || $view['type'] == 'special') {
                  $config['tagname'] = 1;
                }

                // Checks if it is a subform
                if ($field['type'] == 'relationManyToManyAsSubform') {
                  $relTable[$field['conf_rel_table']] = $this->cryptTag($name);
                }

                $config = $this->getConfig($field['configuration'][$viewKey]) + $config;
                $configTemp[$this->cryptTag($name)] = array('label' => $folderName, 'configuration' => $config);
              }
            }
          }

          // Processes the $configTemp to take into account the subforms
          unset($temp);
          if(is_array($configTemp)) {

            foreach($configTemp as $keyTemp => $valTemp) {

              // Checks if the field is associated with a subform
              if (array_key_exists($valTemp['configuration']['table'], $relTable)) {

                if (is_array($xmlArray['views'][$viewKey][$this->cryptTag($valTemp['label'])]['fields'][$relTable[$valTemp['configuration']['table']]])) {
                  $xmlArray['views'][$viewKey][$this->cryptTag($valTemp['label'])]['fields'][$relTable[$valTemp['configuration']['table']]]['configuration'][$this->cryptTag('0')]['fields'][$keyTemp]['configuration'] = $valTemp['configuration'];
                } else {
                  // Checks if the folder is the same as the folder of the subform
                  if ($valTemp['label'] == $configTemp[$relTable[$valTemp['configuration']['table']]]['label']) {
                    // Keeps the config for future use
                    $temp[$keyTemp] = $valTemp['configuration'];
                  } else {
                    // just sets the config
                    $xmlArray['views'][$viewKey][$this->cryptTag($valTemp['label'])]['fields'][$keyTemp]['configuration'] = $valTemp['configuration'];
                  }
                }
              } else {
                $xmlArray['views'][$viewKey][$this->cryptTag($valTemp['label'])]['fields'][$keyTemp]['configuration'] = (array) $xmlArray['views'][$viewKey][$this->cryptTag($valTemp['label'])]['fields'][$keyTemp]['configuration'] + $valTemp['configuration'];
                if (array_search($keyTemp, $relTable) && is_array($temp)) {
                  foreach($temp as $key => $value) {
                    if ($value['table'] == array_search($keyTemp, $relTable)) {
                      $xmlArray['views'][$viewKey][$this->cryptTag($valTemp['label'])]['fields'][$relTable[$value['table']]]['configuration'][$this->cryptTag('0')]['fields'][$key]['configuration'] = $value;
                      unset($temp[$key]);
                    }
                  }
                }
              }
            }
          }
        }
      }
    }

  return $xmlArray;
  }

	/**
	 * Gets the configuration of a field.
	 *
	 * @param array $fieldConf The field.
	 * return array The configuration
	 */
  protected function getConfig($fieldConf) {

    $config = array();

    // Replaces \; by a temporary tag
    $fieldConf = str_replace('\;','###!!!!!!###', htmlspecialchars_decode($fieldConf));
    $params = explode(';', $fieldConf);

    foreach ($params as $param) {
      // Removes comments
      if (preg_match('/^\/\//', trim($param))) {
        continue;
      }

		  if (trim($param)) {
		    // Replaces the temporary tag by ;
		    $param = str_replace('###!!!!!!###', ';', $param);

  		  $pos = strpos($param, '=');
  		  if ($pos === false) {
  		    throw new RuntimeException('Missing equal sign in ' . $param);
        } else {
          $exp = strtolower(trim(substr($param, 0, $pos)));
          // If there is a dot, crypts the tag
          if (strpos($exp, '.') !== false) {
            $exp = $this->cryptTag($exp);
          }
          // Removes trailing spaces
          $configuration = htmlspecialchars(ltrim(substr($param, $pos+1)));
          $configuration  = preg_replace('/\s+([\n\r])/', '$1', $configuration );
          $config[$exp] = $configuration;
        }
      }
    }

  return $config;
	}

	/**
	 * Crypts a tag with a md5 algorithm.
	 *
	 * @param string $tag The tag to crypt.
	 * return string The crypted tag
	 */
  protected function cryptTag($tag) {
    return 'a' . md5($tag);
  }

	/**
	 * Method called by array_walk_recursive to convert special characters.
	 *
	 * @param mixed $item The item
	 * @return string The rendered view
	 */
  public static function htmlspecialchars(&$item) {
    if (is_string($item)) {
      $item = htmlspecialchars($item);
    }
    return $item;
  }

}
?>
