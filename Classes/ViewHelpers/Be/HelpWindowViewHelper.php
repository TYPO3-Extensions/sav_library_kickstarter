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
 * A view helper for creating links to external targets.
 *
 * = Examples =
 * 
 * <code>
 * <f:link.external uri="http://www.typo3.org" target="_blank">external link</f:link.external>
 * </code>
 *
 * Output:
 * <a href="http://www.typo3.org" target="_blank">external link</a>
 *
 * @package Fluid
 * @subpackage ViewHelpers
 * @version $Id: ExternalViewHelper.php 1492 2009-10-21 16:02:16Z bwaidelich $
 * @license http://www.gnu.org/licenses/lgpl.html GNU Lesser General Public License, version 3 or later
 * @scope prototype
 */
class Tx_SavLibraryKickstarter_ViewHelpers_Be_HelpWindowViewHelper extends Tx_Fluid_Core_ViewHelper_AbstractTagBasedViewHelper {

	/**
	 * @var string
	 */
	protected $tagName = 'a';

	/**
	 * Arguments initialization
	 *
	 * @return void
	 * @author Bastian Waidelich <bastian@typo3.org>
	 */
	public function initializeArguments() {
		parent::initializeArguments();
		$this->registerUniversalTagAttributes();	
	}

	/**
	 * @param string $cshTag the tag in the csh file
	 * @return string Rendered link
	 * @author Sebastian Kurfürst <sebastian@typo3.org>
	 * @author Bastian Waidelich <bastian@typo3.org>
	 */
	public function render($cshTag) {
		$this->tag->addAttribute('href', '#');
  	if (t3lib_utility_VersionNumber::convertVersionNumberToInteger(TYPO3_version)	< 6000000) {
			$helpUrl = 'view_help.php?';
		}	else {
			$helpUrl = 'mod.php?M=help_cshmanual&';			
		}				
		$this->tag->addAttribute('onclick', 'vHWin=window.open(\'' . $helpUrl . 'tfID=xEXT_sav_library_kickstarter_' . t3lib_div::lcfirst($cshTag) . '.*\',\'viewFieldHelp\',\'height=400,width=600,status=0,menubar=0,scrollbars=1\');vHWin.focus();return false;');
		$skinnedIcon = t3lib_iconWorks::skinImg($GLOBALS['BACK_PATH'], 'gfx/helpbubble.gif', '');
		$this->tag->setContent('<img'.$skinnedIcon.' class="typo3-csh-icon" alt="' . t3lib_div::lcfirst($cshTag) . '" height="16" hspace="2" width="16">');

		return $this->tag->render();
	}
}


?>
