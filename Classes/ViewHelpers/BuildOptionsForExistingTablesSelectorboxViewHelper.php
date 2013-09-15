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
 * A view helper for building the options for the field type selector.
 *
 * = Examples =
 *
 * <code title="BuildOptionsForFieldTypeSelectorbox">
 * <sav:BuildOptionsForFieldTypeSelectorbox />
 * </code>
 *
 * Output:
 * the options
 *
 * @package SavLibraryKickstarter
 * @subpackage ViewHelpers
 */
class Tx_SavLibraryKickstarter_ViewHelpers_BuildOptionsForExistingTablesSelectorboxViewHelper extends Tx_Fluid_Core_ViewHelper_AbstractViewHelper {

	/**
	 *
   * @return string the options array
	 * @author Laurent Foulloy <yolf.typo3@orange.fr>
	 */
	public static function render() {
	
    $options = array (
      '' => '',
      'tt_content' => Tx_Extbase_Utility_Localization::translate('kickstarter.existingTablesItem.tablename.tt_content', 'sav_library_kickstarter'),
      'fe_users' => Tx_Extbase_Utility_Localization::translate('kickstarter.existingTablesItem.tablename.fe_users', 'sav_library_kickstarter'),
      'fe_groups' => Tx_Extbase_Utility_Localization::translate('kickstarter.existingTablesItem.tablename.fe_groups', 'sav_library_kickstarter'),
      'be_users' => Tx_Extbase_Utility_Localization::translate('kickstarter.existingTablesItem.tablename.be_users', 'sav_library_kickstarter'),
      'be_groups' => Tx_Extbase_Utility_Localization::translate('kickstarter.existingTablesItem.tablename.be_groups', 'sav_library_kickstarter'),
      'pages' => Tx_Extbase_Utility_Localization::translate('kickstarter.existingTablesItem.tablename.pages', 'sav_library_kickstarter'),
    );

		foreach($GLOBALS['TCA'] as $tableKey => $table) {
			if(!$options[$tableKey]) {
				$options[$tableKey] = $tableKey.' (' . $GLOBALS['LANG']->sL($table['ctrl']['title']) . ')';
			}
		}
		asort($options);

    return $options;
	}

}
?>

