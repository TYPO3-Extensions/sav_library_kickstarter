<?php

/***************************************************************
*  Copyright notice
*
*  (c) 2009 Laurent Foulloy <yolf.typo3@orange.fr>
*  All rights reserved
*
*  This script is part of the TYPO3 project. The TYPO3 project is
*  free software; you can redistribute it and/or modify
*  it under the terms of the GNU General Public License as published by
*  the Free Software Foundation; either version 2 of the License, or
*  (at your option) any later version.
*
*  The GNU General Public License can be found at
*  http://www.gnu.org/copyleft/gpl.html.
*
*  This script is distributed in the hope that it will be useful,
*  but WITHOUT ANY WARRANTY; without even the implied warranty of
*  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
*  GNU General Public License for more details.
*
*  This copyright notice MUST APPEAR in all copies of the script!
***************************************************************/

/**
 * Render ViewHelper
 *
 * @package     SavLibraryKickstarter
 * @subpackage  ViewHelpers
 * @author Laurent Foulloy <yolf.typo3@orange.fr>
 * @version     SVN: $Id$
 */
class Tx_SavLibraryKickstarter_ViewHelpers_RenderViewHelper extends Tx_Fluid_Core_ViewHelper_AbstractViewHelper {

  const PARTIALS_DIRECTORY = 'Resources/Private/Partials/';

	/**
	 * Renders the content.
	 *
	 * @param string $partial Reference to a partial.
	 * @param array $arguments Arguments to pass to the partial.
	 * @param string $directory If not null, it replaces the PARTIALS_DIRECTORY constant.
	 * @return string Rendered string
	 */
	public function render($partial, $arguments = array(), $directory = NULL) {

    if ($directory === NULL) {
      $directory = self::PARTIALS_DIRECTORY;
    }
		$fileContent = file_get_contents(t3lib_extMgm::extPath('sav_library_kickstarter'). $directory . $partial);

    if ($fileContent === FALSE) {
      throw new RuntimeException('Unknown file name: "'. $directory . $partial . '".');
    }
    $templateParser = t3lib_div::makeInstance('Tx_SavLibraryKickstarter_Parser_TemplateParser');
    $templateParser->setViewHelperVariableContainer($this->viewHelperVariableContainer);
    $templateParser->setControllerContext($this->controllerContext);

		return $templateParser->parseTemplate($fileContent, $arguments);
	}
}


?>
