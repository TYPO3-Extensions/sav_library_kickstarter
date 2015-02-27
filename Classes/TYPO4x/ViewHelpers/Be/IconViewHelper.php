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
require_once(t3lib_extMgm::extPath('sav_library_kickstarter') . 'Classes/ViewHelpers/Be/IconViewHelper.php');

class Tx_SavLibraryKickstarter_ViewHelpers_Be_IconViewHelper extends \SAV\SavLibraryKickstarter\ViewHelpers\Be\IconViewHelper {
}
?>
