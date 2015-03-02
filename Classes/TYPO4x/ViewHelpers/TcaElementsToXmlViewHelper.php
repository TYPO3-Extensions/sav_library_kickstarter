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
 * A view helper for building the a XML code associated with TCA elements.
 *
 * = Examples =
 *
 * <code title="TcaElementsToXml">
 * <sav:TcaElementsToXml />
 * </code>
 *
 * Output:
 * the options
 *
 * @package SavLibraryKickstarter
 * @subpackage ViewHelpers
 */
require_once(t3lib_extMgm::extPath('sav_library_kickstarter') . 'Classes/ViewHelpers/TcaElementsToXmlViewHelper.php');

class Tx_SavLibraryKickstarter_ViewHelpers_TcaElementsToXmlViewHelper extends \SAV\SavLibraryKickstarter\ViewHelpers\TcaElementsToXmlViewHelper {
}
?>
