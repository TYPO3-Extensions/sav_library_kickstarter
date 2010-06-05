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
 * A view helper to check if the string contains "DO NOT CREATE".
 *
 * = Examples =
 *
 * <code title="RemoveIfContainsDoNotCreate">
 * <sav:CheckForDoNotCreate>
 * blabla DO NOT CREATE
 * </sav:RemoveIfContainsDoNotCreate>
 * </code>
 *
 * Output:
 *
 *
 * @package SavLibraryKickstarter
 * @subpackage ViewHelpers
 * @author Laurent Foulloy <yolf.typo3@orange.fr>
 * @version $Id: 
 */
class Tx_SavLibraryKickstarter_ViewHelpers_RemoveIfContainsDoNotCreateViewHelper extends Tx_Fluid_Core_ViewHelper_AbstractViewHelper {

	/**
	 *
	 * @param string $string String to analyze
   * @return string Converted string
	 * @author Laurent Foulloy <yolf.typo3@orange.fr>
	 */
	public function render($string = NULL) {
    if ($string === NULL) {
		  $string = $this->renderChildren();
    }
    if (strpos($string, 'DO NOT CREATE') === false) {
		  return $string;
    } else {
      return '';
    }
	}

}
?>

