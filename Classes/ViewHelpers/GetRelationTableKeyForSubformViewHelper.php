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
 * A view helper for getting the relation table.
 *
 * = Examples =
 *
 * <code title="GetRelationTableKeyForSubform">
 * <sav:GetRelationTableForSubform />
 * </code>
 *
 * Output:
 * the oprtions
 *
 * @package SavLibraryMvc
 * @subpackage ViewHelpers
 * @author Laurent Foulloy <yolf.typo3@orange.fr>
 * @version $Id: 
 */
class Tx_SavLibraryKickstarter_ViewHelpers_GetRelationTableKeyForSubformViewHelper extends Tx_Fluid_Core_ViewHelper_AbstractViewHelper {

	/**
	 * @param array $arguments
	 * @param string $tableName
   * @return string the options array
	 * @author Laurent Foulloy <yolf.typo3@orange.fr>
	 */
	public function render($arguments, $tableName) {

    foreach ($arguments['newTables'] as $tableKey => $table) {
    	$realTableName = 'tx_' . str_replace('_', '', $arguments['general'][1]['extensionKey']) . '_' . $table['tablename'];
  	
    	if ($realTableName == $tableName) {
    		return $tableKey;
    	}  
    }	
		return 0;    
	}

}
?>

