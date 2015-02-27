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
 * A view helper for creating comments.
 *
 * = Examples =
 *
 * <code title="Comment">
 * <f:comment>This is a comment</f:comment>
 * </code>
 *
 * Output:
 * None
 *
 * @package SavLibraryKickstarter
 * @subpackage ViewHelpers
 * @author Laurent Foulloy <yolf.typo3@orange.fr>
 * @version $Id:
 */
class CommentViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper {

	/**
	 *
	 * @param boolean If TRUE the comment should be displayed
   * @return string Either the comment or a null string
	 * @author Laurent Foulloy <yolf.typo3@orange.fr>
	 */
	public function render($show = FALSE) {
    if ($show) {
      return $this->renderChildren();
    } else {
		  return '';
    }
	}

}
?>

