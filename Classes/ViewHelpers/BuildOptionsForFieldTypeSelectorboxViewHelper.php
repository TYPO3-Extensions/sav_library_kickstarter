<?php
namespace SAV\SavLibraryKickstarter\ViewHelpers;
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
class BuildOptionsForFieldTypeSelectorboxViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper {

	/**
	 *
   * @return string the options array
	 * @author Laurent Foulloy <yolf.typo3@orange.fr>
	 */
	public function render() {
	
    $options = array (
      'Unknown' => \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate('kickstarter.field.fieldType.Unknown', 'sav_library_kickstarter'),
      'Checkbox' => \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate('kickstarter.field.fieldType.Checkbox', 'sav_library_kickstarter'),
      'Checkboxes' => \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate('kickstarter.field.fieldType.Checkboxes', 'sav_library_kickstarter'),
      'Currency' => \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate('kickstarter.field.fieldType.Currency', 'sav_library_kickstarter'),
    	'Date' => \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate('kickstarter.field.fieldType.Date', 'sav_library_kickstarter'),
      'DateTime' => \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate('kickstarter.field.fieldType.DateTime', 'sav_library_kickstarter'),
      'Files' => \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate('kickstarter.field.fieldType.Files', 'sav_library_kickstarter'),
      'Graph' => \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate('kickstarter.field.fieldType.Graph', 'sav_library_kickstarter'),
      'Integer' => \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate('kickstarter.field.fieldType.Integer', 'sav_library_kickstarter'),
      'Link' => \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate('kickstarter.field.fieldType.Link', 'sav_library_kickstarter'),
      'RadioButtons' => \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate('kickstarter.field.fieldType.RadioButtons', 'sav_library_kickstarter'),
      'RelationOneToManyAsSelectorbox' => \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate('kickstarter.field.fieldType.RelationOneToManyAsSelectorbox', 'sav_library_kickstarter'),
      'RelationManyToManyAsDoubleSelectorbox' => \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate('kickstarter.field.fieldType.RelationManyToManyAsDoubleSelectorbox', 'sav_library_kickstarter'),
      'RelationManyToManyAsSubform' => \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate('kickstarter.field.fieldType.RelationManyToManyAsSubform', 'sav_library_kickstarter'),
      'RichTextEditor' => \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate('kickstarter.field.fieldType.RichTextEditor', 'sav_library_kickstarter'),
      'Selectorbox' => \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate('kickstarter.field.fieldType.Selectorbox', 'sav_library_kickstarter'),
      'ShowOnly' => \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate('kickstarter.field.fieldType.ShowOnly', 'sav_library_kickstarter'),
      'String' => \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate('kickstarter.field.fieldType.String', 'sav_library_kickstarter'),
      'Text' => \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate('kickstarter.field.fieldType.Text', 'sav_library_kickstarter'),
    );
    return $options;
	}

}
?>

