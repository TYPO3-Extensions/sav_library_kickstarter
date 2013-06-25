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
class Tx_SavLibraryKickstarter_CodeGenerator_CodeGeneratorForSavLibraryPlus extends Tx_SavLibraryKickstarter_CodeGenerator_AbstractCodeGenerator {

  protected $codeTemplatesDirectory = 'Resources/Private/CodeTemplates/ForSavLibraryPlus/';

	/**
	 * Builds all the file for the extension.
	 *
	 * return none
	 */
	public function buildExtension() {
    // Sets the file directory for the root files
    $fileDirectory = $this->extensionDirectory;

		// Generates the Configuration/TCA directory
		t3lib_div::mkdir_deep($this->extensionDirectory, 'Resources/Private/Icons');
		
    // Generates the icons
 		$this->generateFile('icons.t');

		// Generates ext_emconf.php
		$fileContents = $this->generateFile('extEmconf.phpt');
		t3lib_div::writeFile($fileDirectory . 'ext_emconf.php', $fileContents);

		// Generates ext_localconf.php
		if ( !$this->sectionManager->getItem('general')->getItem(1)->getItem('keepExtLocalConf') || 
				($this->sectionManager->getItem('general')->getItem(1)->getItem('keepExtLocalConf') && !file_exists($this->extensionDirectory . 'ext_localconf.php'))) {
			$fileContents = $this->generateFile('extLocalconf.phpt');
			t3lib_div::writeFile($fileDirectory . 'ext_localconf.php', $fileContents);
		}

		// Generates ext_tables.php
		$fileContents = $this->generateFile('extTables.phpt');
		t3lib_div::writeFile($fileDirectory . 'ext_tables.php', $fileContents);

		// Generates ext_tables.sql
		$fileContents = $this->generateFile('extTables.sqlt');
		t3lib_div::writeFile($fileDirectory . 'ext_tables.sql', $fileContents);

		// Generates the Configuration/TCA directory
		t3lib_div::mkdir_deep($this->extensionDirectory, 'Configuration/TCA');
		$fileDirectory = $this->extensionDirectory . 'Configuration/TCA/';

		// Generates TCA
		$fileContents = $this->generateFile('Configuration/TCA/tca.phpt');
		t3lib_div::writeFile($fileDirectory . 'tca.php', $fileContents);

		// Generates the Configuration/Flexforms directory
		t3lib_div::mkdir_deep($this->extensionDirectory, 'Configuration/Flexforms');
		$fileDirectory = $this->extensionDirectory . 'Configuration/Flexforms/';
		
		// Generates flexforms
		$fileContents = $this->generateFile('Configuration/Flexforms/ExtensionFlexform.xmlt');
		t3lib_div::writeFile($fileDirectory . 'ExtensionFlexform.xml', $fileContents);
		
		// Generates the Configuration/SavLibraryPlus directory
		t3lib_div::mkdir_deep($this->extensionDirectory, 'Configuration/Library');
		$fileDirectory = $this->extensionDirectory . 'Configuration/Library/';
		
		$fileContents = $this->generateFile('Configuration/Library/SavLibraryPlus.xmlt', null, $this->getXmlArray());
		t3lib_div::writeFile($fileDirectory . 'SavLibraryPlus.xml', $fileContents);

		// Generates the Resources/Private/Language directory
		t3lib_div::mkdir_deep($this->extensionDirectory, 'Resources/Private/Language');
		$fileDirectory = $this->extensionDirectory . 'Resources/Private/Language/';
		
		// Generate locallang.xml file if it does not exist
		if (!file_exists($fileDirectory . 'locallang.xml')) {
		  $fileContents = $this->generateFile('Resources/Private/Language/locallang.xmlt');
		  t3lib_div::writeFile($fileDirectory . 'locallang.xml', $fileContents);
    }
			// Generate locallang.xlf file if it does not exist
		if (!file_exists($fileDirectory . 'locallang.xlf')) {
		  $fileContents = $this->generateFile('Resources/Private/Language/locallang.xlft');
		  t3lib_div::writeFile($fileDirectory . 'locallang.xlf', $fileContents);
    }
    
		// Generates locallang_db.xml file
		$fileContents = $this->generateFile('Resources/Private/Language/locallang_db.xmlt');
		t3lib_div::writeFile($fileDirectory . 'locallang_db.xml', $fileContents);
		// Generates locallang_db.xlf file
		$fileContents = $this->generateFile('Resources/Private/Language/locallang_db.xlft');
		t3lib_div::writeFile($fileDirectory . 'locallang_db.xlf', $fileContents);
		
		// Generates the pi1 directory
		t3lib_div::mkdir_deep($this->extensionDirectory, 'Classes');
		$fileDirectory = $this->extensionDirectory . 'Classes/';
		
		// Generates the pi file
		$fileContents = $this->generateFile('Classes/class.tx_extension_pi1.phpt');
		t3lib_div::writeFile($fileDirectory . 'class.tx_' . str_replace('_','', $this->extensionKey) . '_pi1.php', $fileContents);

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
    $xmlArray['general'] = array();
    $xmlArray['general']['version'] = $GLOBALS[TYPO3_CONF_VARS]['EXTCONF']['sav_library_plus']['version'];

    // Generates the extension key
    $xmlArray['general']['extensionKey'] = $this->extensionKey;

    // Generates forms
    if (is_array($extension['forms'])) {

      // Copies the forms array and unset the viewsWithCondition field
      $xmlArray['forms'] = $extension['forms'];
      
      // Processes the viewsWithCondition field
      foreach($xmlArray['forms'] as $formKey => $form) {
        foreach($form['viewsWithCondition'] as $viewsWithConditionKey => $viewsWithCondition) {
          // Processes each view
          foreach($viewsWithCondition as $viewWithConditionKey => $viewWithCondition) {
            $xmlArray['forms'][$formKey]['viewsWithCondition'][$viewsWithConditionKey][$viewWithConditionKey] += array('config' => $this->getConfig($viewWithCondition['condition']));
          }
        }
      }
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
      $relationTable = array();    	
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

        // Checks if it's an form view
        // If a submit icon is added, create a field _submitted_data_ to save the submitted data
        if ($view['type'] == 'special' && $view['subtype'] == 'form') {
          foreach ($extension['forms'] as $keyForm => $form) {
            if ($form['specialView'] == $viewKey) {
              $xmlArray['forms'][$keyForm]['formView'] = $viewKey;
              $xmlArray['forms'][$keyForm]['specialView'] = 0;
              break;
            }
          }
        }

        // Processes folders
        $sortedFolders = array();
        if ($view['folders']) {
          $opt_showFolders = array(
            0 => array('label' => '0'),
          );          
          foreach ($view['folders'] as $folderKey => $folder) {
            $folderConfiguration['label'] = $folder['label'];
            $folderConfiguration['configuration'] = $folder['configuration'];          
            $opt_showFolders[$folderKey] = $folderConfiguration;
            $sortedFolders[$folder['order']] = $folderKey;
          }
          ksort($sortedFolders);
        }       
 
        // Gets the list of the fields organized by folders
        unset($showFolders);
        unset($showFields);
        if (isset($extension['newTables'])) {
          $title[$viewKey]['configuration']['field'] = $view['viewTitleBar'];
          foreach($extension['newTables'] as $tableKey => $table) {
            $tableRootName = 'tx_' . str_replace('_', '', $this->extensionKey);
            $tableName = $tableRootName . ($table['tablename'] ? '_' . $table['tablename'] : '');

						// Adds save and new in the general configuration
						if ($table['save_and_new']) {
							$xmlArray['general']['saveAndNew'][$tableName] = 1;
						}
            // Puts the fields in the right order for the view
            $tempo = $table['fields'];
            unset($orderedFields);
            foreach ($tempo as $fieldKey => $field) {
         
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

              if ($field['type'] != 'ShowOnly') {

                // Generates the additional TCA information
                $prefix = 'tx_' . str_replace('_', '', $this->extensionKey) . '_';
                  $column = $field;
                  $column['fieldname'] = $prefix . $field['fieldname'];
                  $columns[$prefix . $field['fieldname']] = $column;

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
            $sortedFolders[0] = 0;
          }
        }

        if (isset($showFolders)) {
          foreach ($sortedFolders as $sortedFolderKey => $folderKey) {
          	$fieldConfiguration = array();

          	// Gets the folder fields
						$folderFields = $showFolders[$folderKey];
     
            $folderName = $opt_showFolders[$folderKey]['label'];
            $cryptedFolderName = $this->cryptTag($folderName);
            
            // Gets the folder config parameter
            $xmlArray['views'][$viewKey][$cryptedFolderName]['configuration'] = $this->getConfig($opt_showFolders[$folderKey]['configuration']) +
              array ('label' => $folderName);

            // Generates the title
            if ($view['viewTitleBar'] && !is_array($title[$viewKey])) {
              $title[$viewKey]['configuration']['field'] = $view['viewTitleBar'];
              $title[$viewKey]['configuration']['type'] = 'input';
            }
            $xmlArray['views'][$viewKey][$cryptedFolderName]['title'] = $title[$viewKey];


            // Generates the addPrintIcon information
            if ($view['addPrintIcon']) {
              $xmlArray['views'][$viewKey][$cryptedFolderName]['addPrintIcon'] = $view['addPrintIcon'];
              if ($view['viewForPrintIcon']) {
                $xmlArray['views'][$viewKey][$cryptedFolderName]['viewForPrintIcon'] = $view['viewForPrintIcon'];
              }
            }

            // Processes the folders
            foreach($folderFields as $folderFieldKey => $folderField) {
            	$config = array();

              // Gets the field
							$wizArrayKey = $folderField['wizArray'];
							$tableKey = $folderField['table'];
							$fieldKey = $folderField['field'];
              $field = $extension[$wizArrayKey][$tableKey]['fields'][$fieldKey];
              
              $fieldName = (($wizArrayKey == 'existingTables' && $field['type'] != 'ShowOnly') ? 'tx_' . str_replace('_', '', $this->extensionKey) . '_' . $field['fieldname'] : $field['fieldname']);
							$tableName = $folderField['tableName'];
              $fullFieldName = $tableName . '.' . $fieldName;
              $cryptedFullFieldName = $this->cryptTag($fullFieldName);

              // Generates the field
              if ($field['selected'][$viewKey]) {

                // Sets the user configuration parameters
              	$config['tableName'] = $tableName;
                $config['fieldName'] = $fieldName;
                $config['fieldType'] = $field['type'];

                // Checks if the type is showOnly
                if ($field['type'] == 'ShowOnly') {
                  $config['renderType'] = ($field['conf_render_type'] ? $field['conf_render_type'] : 'String');
                }
                
                // Checks if it is a subform
                if ($field['type'] == 'RelationManyToManyAsSubform') {            
                	$relationTable[$viewKey][$field['conf_rel_table']] = $cryptedFullFieldName;                  
                }
                
                // Checks if its a subform field
                if (array_key_exists($tableName, $relationTable[$viewKey])) {
                	$relationTableKey = $relationTable[$viewKey][$tableName];
                	$subformConfiguration[$viewKey][$relationTableKey] = array_merge(
                		(array)$subformConfiguration[$viewKey][$relationTableKey], 
                		array(
											$cryptedFullFieldName => array(
												'configuration' => $this->getConfig($field['configuration'][$viewKey]) + $config
											)
										)
									);		                	
                } else {	                
									$fieldConfiguration[$cryptedFullFieldName] = array(
										'configuration' => $this->getConfig($field['configuration'][$viewKey]) + $config
									);		
                }					                
              }
            }
   
          $xmlArray['views'][$viewKey][$cryptedFolderName]['fields'] = $fieldConfiguration;
        
          }          
        }
      }

			// Adds the subform configuraition     
      foreach ($extension['views'] as $viewKey => $view) {     
      	if (is_array($subformConfiguration[$viewKey])) {
      		foreach ($subformConfiguration[$viewKey] as $subformKey => $subform) {		
						$arrayToAdd['configuration'][$this->cryptTag('0')]['fields'] = $subform;	
						$this->addConfiguration($xmlArray['views'][$viewKey], $subformKey, $arrayToAdd);		      			
      		}
      	} 
      }

    }

//print('<pre>' . print_r($xmlArray,1) . '</pre>');	
//die();	  
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
 //           $exp = $this->cryptTag($exp);
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
//    return 'a' . md5($tag);
    return 'a' . t3lib_div::md5int($tag);
  }

	/**
	 * Method called by array_walk_recursive to convert special characters and
	 * remove trailing spaces
	 * @param mixed $item The item
	 * @return string The rendered view
	 */
  public static function htmlspecialchars(&$item) {
    if (is_string($item)) {
      $item = htmlspecialchars($item);
      $item  = preg_replace('/\s+([\n\r])/', '$1', $item );
    }
    return $item;
  }

	/**
	 * Searches recursively a configuration if an aray, given à key
	 *  
	 * @param array $arrayToSearchIn
	 * @param string $key
	 * @return array or false
	 */  
  public function searchConfiguration($arrayToSearchIn, $key) {
    foreach ($arrayToSearchIn as $itemKey => $item) {
      if ($itemKey == $key) {
        return $item;
      } elseif (is_array($item)) {
        $configuration = $this->searchConfiguration($item, $key);
        if ($configuration != false) {
          return $configuration;
        }
      }
    }
    return false;
  }  

	/**
	 * Adds a configuration to the right palce after a recursive search, given à key
	 *  
	 * @param array $arrayToSearchIn
	 * @param string $key
	 * @param array $arrayToAdd
	 * @return array or false
	 */  
  public function addConfiguration(&$arrayToSearchIn, $key, $arrayToAdd) {  	
    foreach ($arrayToSearchIn as $itemKey => $item) {
      if ($itemKey == $key) {
				$x = $arrayToSearchIn[$itemKey];
      	$arrayToSearchIn[$itemKey]['configuration'] = array_replace($arrayToSearchIn[$itemKey]['configuration'], $arrayToSearchIn[$itemKey]['configuration'] + $arrayToAdd['configuration']);
      	return true;
      } elseif (is_array($item)) {
        $configuration = $this->addConfiguration($arrayToSearchIn[$itemKey], $key, $arrayToAdd);
        if ($configuration != false) {
          return true;
        }
      }
    }
    return false;
  }    
}
?>
