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
 * <code title="BuildOptionsForRenderTypeSelectorbox">
 * <sav:BuildOptionsForFieldTypeSelectorbox />
 * </code>
 *
 * Output:
 * the options
 *
 * @package SavLibraryKickstarter
 * @subpackage ViewHelpers
 */
class Tx_SavLibraryKickstarter_ViewHelpers_BuildOptionsForRenderTypeSelectorboxViewHelper extends Tx_Fluid_Core_ViewHelper_AbstractViewHelper {

	/**
	 *
   * @return string the options array
	 * @author Laurent Foulloy <yolf.typo3@orange.fr>
	 */
	public function render() {
	
    $options = array (
      'String' => Tx_Extbase_Utility_Localization::translate('kickstarter.field.fieldType.String', 'sav_library_kickstarter'),
      'Checkbox' => Tx_Extbase_Utility_Localization::translate('kickstarter.field.fieldType.Checkbox', 'sav_library_kickstarter'),
      'Checkboxes' => Tx_Extbase_Utility_Localization::translate('kickstarter.field.fieldType.Checkboxes', 'sav_library_kickstarter'),
      'Date' => Tx_Extbase_Utility_Localization::translate('kickstarter.field.fieldType.Date', 'sav_library_kickstarter'),
      'DateTime' => Tx_Extbase_Utility_Localization::translate('kickstarter.field.fieldType.DateTime', 'sav_library_kickstarter'),
      'Files' => Tx_Extbase_Utility_Localization::translate('kickstarter.field.fieldType.Files', 'sav_library_kickstarter'),
      'Graph' => Tx_Extbase_Utility_Localization::translate('kickstarter.field.fieldType.Graph', 'sav_library_kickstarter'),
      'Integer' => Tx_Extbase_Utility_Localization::translate('kickstarter.field.fieldType.Integer', 'sav_library_kickstarter'),
      'Link' => Tx_Extbase_Utility_Localization::translate('kickstarter.field.fieldType.Link', 'sav_library_kickstarter'),
      'RadioButtons' => Tx_Extbase_Utility_Localization::translate('kickstarter.field.fieldType.RadioButtons', 'sav_library_kickstarter'),
      'RelationOneToManyAsSelectorbox' => Tx_Extbase_Utility_Localization::translate('kickstarter.field.fieldType.RelationOneToManyAsSelectorbox', 'sav_library_kickstarter'),
      'RelationManyToManyAsDoubleSelectorbox' => Tx_Extbase_Utility_Localization::translate('kickstarter.field.fieldType.RelationManyToManyAsDoubleSelectorbox', 'sav_library_kickstarter'),
      'RelationManyToManyAsSubform' => Tx_Extbase_Utility_Localization::translate('kickstarter.field.fieldType.RelationManyToManyAsSubform', 'sav_library_kickstarter'),
      'RichTextEditor' => Tx_Extbase_Utility_Localization::translate('kickstarter.field.fieldType.RichTextEditor', 'sav_library_kickstarter'),
      'Selectorbox' => Tx_Extbase_Utility_Localization::translate('kickstarter.field.fieldType.Selectorbox', 'sav_library_kickstarter'),
      'Text' => Tx_Extbase_Utility_Localization::translate('kickstarter.field.fieldType.Text', 'sav_library_kickstarter'),
    );
    return $options;
	}

}
?>

