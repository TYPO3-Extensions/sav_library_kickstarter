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
 * View helper which renders the flash messages with HTML output.
 *
 * Same as renderFlashMessages but the output is not passed through htmlspecialchars.
 *
 *
 * = Examples =
 *
 * <code title="Simple">
 * <f:renderFlashHtmlessages />
 * </code>
 * Renders an ul-list of flash messages.
 *
 * <code title="Output with css class">
 * <f:renderFlashHtmlMessages class="specialClass" />
 * </code>
 *
 * Output:
 * <ul class="specialClass">
 *  ...
 * </ul>
 *
 * @version $Id: RenderFlashHtmlMessagesViewHelper.php 1734 2009-11-25 21:53:57Z stucki $
 * @license http://www.gnu.org/licenses/lgpl.html GNU Lesser General Public License, version 3 or later
 * @scope prototype
 */
class Tx_SavLibraryKickstarter_ViewHelpers_RenderFlashHtmlMessagesViewHelper extends Tx_Fluid_Core_ViewHelper_TagBasedViewHelper {

	/**
	 * @var string
	 */
	protected $tagName = 'ul';

	/**
	 * Initialize arguments
	 *
	 * @return void
	 * @author Sebastian Kurfürst <sbastian@typo3.org>
	 * @api
	 */
	public function initializeArguments() {
		$this->registerUniversalTagAttributes();
	}

	/**
	 * Render method.
	 *
	 * @return string rendered Flash Messages, if there are any.
	 * @author Sebastian Kurfürst <sbastian@typo3.org>
	 * @api
	 */
	public function render() {
		$flashMessages = $this->controllerContext->getFlashMessages()->getAllAndFlush();
		if (count($flashMessages) > 0) {
			$tagContent = '';
			foreach ($flashMessages as $singleFlashMessage) {
				$tagContent .=  '<li>' . $singleFlashMessage . '</li>';
			}
			$this->tag->setContent($tagContent);
			return $this->tag->render();
		}
		return '';
	}
}

?>
