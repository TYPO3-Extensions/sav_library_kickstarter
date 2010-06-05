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
 * <code title="BuildTableName">
 * <sav:BuildTableName />
 * </code>
 *
 * Output:
 * the oprtions
 *
 * @package SavLibraryKickstarter
 * @subpackage ViewHelpers
 * @author Laurent Foulloy <yolf.typo3@orange.fr>
 * @version $Id:
 */
class Tx_SavLibraryKickstarter_ViewHelpers_BuildTableNameViewHelper extends Tx_Fluid_Core_ViewHelper_AbstractViewHelper {

	/**
	 * @param string $shortName
	 * @param string $extensionKey
	 * @param string $prefix
	 * @param boolean $shortNameOnly
	 * @return string the table name
	 */
	public function render($shortName, $extensionKey, $prefix = '', $shortNameOnly = false) {
    if ($prefix != '') {
      $prefix = $prefix . '_';
    }
    if ($shortNameOnly === true) {
      return $shortName;
    } else {
      return $prefix . 'tx_'  . str_replace('_', '', $extensionKey) . ($shortName ? '_' . $shortName : '');
    }
	}

}
?>

