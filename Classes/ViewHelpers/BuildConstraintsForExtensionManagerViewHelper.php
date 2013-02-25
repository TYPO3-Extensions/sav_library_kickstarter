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
 * A view helper for building the ORDER BY clause of a relation table.
 *
 * = Examples =
 *
 * <code title="BuildConstraintsForExtensionManager">
 * <sav:BuildConstraintsForExtensionManager />
 * </code>
 *
 * Output:
 * the contraints
 *
 * @package SavLibraryKickstarter
 * @subpackage ViewHelpers
 * @author Laurent Foulloy <yolf.typo3@orange.fr>
 * @version $Id: 
 */
class Tx_SavLibraryKickstarter_ViewHelpers_BuildConstraintsForExtensionManagerViewHelper extends Tx_Fluid_Core_ViewHelper_AbstractViewHelper {

	/**
	 * @param string $dependencies
	 * @param string $default
   * @return string the options array
	 * @author Laurent Foulloy <yolf.typo3@orange.fr>
	 */
	public function render($dependencies, $default = 'sav_library_plus') {

		// Processes the depencies
		$contraints = '';
		if (empty($dependencies)) {
			$dependencies = $default;
		}
		$dependenciesArray = explode(',', $dependencies);
		if (!in_array($default, $dependenciesArray)) {
			$dependenciesArray[] = $default;
		}
    foreach ($dependenciesArray as $dependency) {
    	$constraints .= chr(9) . chr(9) . chr(9) . '\'' . $dependency . '\' => \'\',' . chr(10);
    }
    // Removes last new line
    $constraints = substr($constraints, 0, -1);
    
		return $constraints;
	}

}
?>

