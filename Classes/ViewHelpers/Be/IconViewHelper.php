<?php
/*                                                                        *
 * This script belongs to the FLOW3 package "Fluid".                      *
 *                                                                        *
 * It is free software; you can redistribute it and/or modify it under    *
 * the terms of the GNU Lesser General Public License as published by the *
 * Free Software Foundation, either version 3 of the License, or (at your *
 * option) any later version.                                             *
 *                                                                        *
 * This script is distributed in the hope that it will be useful, but     *
 * WITHOUT ANY WARRANTY; without even the implied warranty of MERCHAN-    *
 * TABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU Lesser       *
 * General Public License for more details.                               *
 *                                                                        *
 * You should have received a copy of the GNU Lesser General Public       *
 * License along with the script.                                         *
 * If not, see http://www.gnu.org/licenses/lgpl.html                      *
 *                                                                        *
 * The TYPO3 project - inspiring people to share!                         *
 *                                                                        */

/**
 * View helper which returns an icon
 *
 * = Examples =

 * <code title="Default">
 * <f:be.buttons.icon icon="new_el" title="Create new Foo" />
 * </code>
 *
 * Output:
 * The "new_el" icon is returned.
 *
 * @package     Fluid
 * @subpackage  ViewHelpers\Be\Buttons
 * @author		Steffen Kamper <info@sk-typo3.de>
 * @author		Bastian Waidelich <bastian@typo3.org>
 * @license     http://www.gnu.org/copyleft/gpl.html
 * @version     SVN: $Id:
 *
 */
class Tx_SavLibraryKickstarter_ViewHelpers_Be_IconViewHelper extends Tx_Fluid_ViewHelpers_Be_AbstractBackendViewHelper {

	/**
	 * Renders an icon link as known from the TYPO3 backend
	 *
	 * @param string $icon Icon to be used. See self::allowedIcons for a list of allowed icon names
	 * @param string $title Title attribute of the icon
	 * @param string $alt Alt attribute of the icon
	 * @param string $class Class attribute of the icon
	 * @param string $dir Directory path for the icon
	 * @param string $type The file type for the icon (png,gif (default), ...)
	 * @return string the rendered icon link
	 */
	public function render($icon = 'closedok', $title = '', $alt = '', $class = '', $dir = 'gfx/', $type = 'gif') {
		$skinnedIcon = t3lib_iconWorks::skinImg($GLOBALS['BACK_PATH'], $dir . $icon . '.' . $type, '');
		$class = ($class ? ' class="' . $class . '"' : '');
		return '<img' . $class . $skinnedIcon . '" title="' . htmlspecialchars($title) . '" alt="' . htmlspecialchars($alt) . '" />';
	}
}
?>
