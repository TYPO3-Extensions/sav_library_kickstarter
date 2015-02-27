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
 * A view helper for creating anchors.
 *
 * = Examples =
 *
 * <code title="empty">
 * <f:link.empty key="test" />
 * </code>
 *
 * Output:
 *
 * @package SavLibraryKickstarter
 * @subpackage ViewHelpers
 */
require_once(t3lib_extMgm::extPath('sav_library_kickstarter') . 'Classes/ViewHelpers/Link/EmptyViewHelper.php');

class Tx_SavLibraryKickstarter_ViewHelpers_Link_EmptyViewHelper extends \SAV\SavLibraryKickstarter\ViewHelpers\Link\EmptyViewHelper {
}
?>
