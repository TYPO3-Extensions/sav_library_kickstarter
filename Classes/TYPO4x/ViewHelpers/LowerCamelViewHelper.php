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
 * A view helper for transforming a string to LowerCamel case.
 *
 * = Examples =
 *
 * <code title="lowerCamel">
 * <sav:lowerCamel string="sav_library_kickstarter" />
 * </code>
 *
 * Output:
 * savLibraryKickstarter
 *
 * @package SavLibraryKickstarter
 * @subpackage ViewHelpers
 * @author Laurent Foulloy <yolf.typo3@orange.fr>
 * @version $Id: 
 */
require_once(t3lib_extMgm::extPath('sav_library_kickstarter') . 'Classes/ViewHelpers/LowerCamelViewHelper.php');

class Tx_SavLibraryKickstarter_ViewHelpers_LowerCamelViewHelper extends \SAV\SavLibraryKickstarter\ViewHelpers\LowerCamelViewHelper {
}
?>

