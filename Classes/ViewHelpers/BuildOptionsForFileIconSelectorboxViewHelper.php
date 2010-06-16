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
 * <code title="BuildOptionsForFileIconSelectorbox">
 * <sav:BuildOptionsForFileIconSelectorbox />
 * </code>
 *
 * Output:
 * the options
 *
 * @package SavLibraryKickstarter
 * @subpackage ViewHelpers
 */
class Tx_SavLibraryKickstarter_ViewHelpers_BuildOptionsForFileIconSelectorboxViewHelper extends Tx_Fluid_Core_ViewHelper_AbstractViewHelper {

	/**
	 *
   * @return string the options array
	 * @author Laurent Foulloy <yolf.typo3@orange.fr>
	 */
	public function render() {
	
    $options = array (
      'default' => Tx_Extbase_Utility_Localization::translate('kickstarter.newTablesItem.defIcon.white', 'sav_library_kickstarter'),
      'default_black' => Tx_Extbase_Utility_Localization::translate('kickstarter.newTablesItem.defIcon.black', 'sav_library_kickstarter'),
      'default_gray4' => Tx_Extbase_Utility_Localization::translate('kickstarter.newTablesItem.defIcon.gray', 'sav_library_kickstarter'),
      'default_blue' => Tx_Extbase_Utility_Localization::translate('kickstarter.newTablesItem.defIcon.blue', 'sav_library_kickstarter'),
      'default_green' => Tx_Extbase_Utility_Localization::translate('kickstarter.newTablesItem.defIcon.green', 'sav_library_kickstarter'),
      'default_red' => Tx_Extbase_Utility_Localization::translate('kickstarter.newTablesItem.defIcon.red', 'sav_library_kickstarter'),
      'default_yellow' => Tx_Extbase_Utility_Localization::translate('kickstarter.newTablesItem.defIcon.yellow', 'sav_library_kickstarter'),
      'default_purple' => Tx_Extbase_Utility_Localization::translate('kickstarter.newTablesItem.defIcon.purple', 'sav_library_kickstarter'),
    );
    return $options;
	}

}
?>

