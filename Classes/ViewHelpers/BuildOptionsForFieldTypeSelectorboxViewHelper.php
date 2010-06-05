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
class Tx_SavLibraryKickstarter_ViewHelpers_BuildOptionsForFieldTypeSelectorboxViewHelper extends Tx_Fluid_Core_ViewHelper_AbstractViewHelper {

	/**
	 *
   * @return string the options array
	 * @author Laurent Foulloy <yolf.typo3@orange.fr>
	 */
	public function render() {
	
    $options = array (
      'unknown' => Tx_Extbase_Utility_Localization::translate('kickstarter.field.fieldType.unknown', 'sav_library_kickstarter'),
      'checkbox' => Tx_Extbase_Utility_Localization::translate('kickstarter.field.fieldType.checkbox', 'sav_library_kickstarter'),
      'checkboxes' => Tx_Extbase_Utility_Localization::translate('kickstarter.field.fieldType.checkboxes', 'sav_library_kickstarter'),
      'date' => Tx_Extbase_Utility_Localization::translate('kickstarter.field.fieldType.date', 'sav_library_kickstarter'),
      'datetime' => Tx_Extbase_Utility_Localization::translate('kickstarter.field.fieldType.datetime', 'sav_library_kickstarter'),
      'files' => Tx_Extbase_Utility_Localization::translate('kickstarter.field.fieldType.files', 'sav_library_kickstarter'),
      'graph' => Tx_Extbase_Utility_Localization::translate('kickstarter.field.fieldType.graph', 'sav_library_kickstarter'),
      'integer' => Tx_Extbase_Utility_Localization::translate('kickstarter.field.fieldType.integer', 'sav_library_kickstarter'),
      'link' => Tx_Extbase_Utility_Localization::translate('kickstarter.field.fieldType.link', 'sav_library_kickstarter'),
      'radioButtons' => Tx_Extbase_Utility_Localization::translate('kickstarter.field.fieldType.radioButtons', 'sav_library_kickstarter'),
      'relationOneToManyAsSelectorbox' => Tx_Extbase_Utility_Localization::translate('kickstarter.field.fieldType.relationOneToManyAsSelectorbox', 'sav_library_kickstarter'),
      'relationManyToManyAsDoubleSelectorbox' => Tx_Extbase_Utility_Localization::translate('kickstarter.field.fieldType.relationManyToManyAsDoubleSelectorbox', 'sav_library_kickstarter'),
      'relationManyToManyAsSubform' => Tx_Extbase_Utility_Localization::translate('kickstarter.field.fieldType.relationManyToManyAsSubform', 'sav_library_kickstarter'),
      'richTextEditor' => Tx_Extbase_Utility_Localization::translate('kickstarter.field.fieldType.richTextEditor', 'sav_library_kickstarter'),
      'selectorbox' => Tx_Extbase_Utility_Localization::translate('kickstarter.field.fieldType.selectorbox', 'sav_library_kickstarter'),
      'showOnly' => Tx_Extbase_Utility_Localization::translate('kickstarter.field.fieldType.showOnly', 'sav_library_kickstarter'),
      'string' => Tx_Extbase_Utility_Localization::translate('kickstarter.field.fieldType.string', 'sav_library_kickstarter'),
      'text' => Tx_Extbase_Utility_Localization::translate('kickstarter.field.fieldType.text', 'sav_library_kickstarter'),
    );
    return $options;
	}

}
?>

