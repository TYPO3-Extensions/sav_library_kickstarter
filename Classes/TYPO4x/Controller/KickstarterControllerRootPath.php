<?php

/***************************************************************
*  Copyright notice
*
*  (c) 2010 Laurent Foulloy <yolf.typo3@orange.fr>
*  All rights reserved
*
*  This class is a backport of the corresponding class of FLOW3.
*  All credits go to the v5 team.
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
 * Backend Module of the SAV Library Kickstarter extension
 *
 * @package     SavLibraryKickstarter
 * @author      Laurent Foulloy <yolf.typo3@orange.fr>
 */
class Tx_SavLibraryKickstarter_Controller_KickstarterControllerRootPath extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {

  /**
   * The partial root directory
   *
   * @var string
   */
  protected $partialRootPath = 'EXT:sav_library_kickstarter/Resources/Private/Partials/TYPO4x';

  /**
   * The layout root directory
   *
   * @var string
   */
  protected $layoutRootPath = 'EXT:sav_library_kickstarter/Resources/Private/Layouts/TYPO4x';
  
  /**
   * The default template root directory
   *
   * @var string
   */
  protected $templateRootPath = 'EXT:sav_library_kickstarter/Resources/Private/Templates/TYPO4x'; 
    
	/**
	 * The default view object to use if none of the resolved views can render
	 * a response for the current request.
	 *
	 * @var string
	 * @api
	 */
	protected $defaultViewObjectName = 'Tx_SavLibraryKickstarter_Compatibility_TemplateView';

	/**
	 * Initializes the controller before invoking an action method.
	 *
	 * Override this method to solve tasks which all actions have in
	 * common.
	 *
	 * @return void
	 * @api
	 */
	protected function initializeAction() {
		$extbaseFrameworkConfiguration = $this->configurationManager->getConfiguration(\TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface::CONFIGURATION_TYPE_FRAMEWORK);
    $extbaseFrameworkConfiguration['view']['templateRootPath'] = $this->templateRootPath;
    $extbaseFrameworkConfiguration['view']['layoutRootPath'] = $this->layoutRootPath;
    $extbaseFrameworkConfiguration['view']['partialRootPath'] = $this->partialRootPath;
    $this->configurationManager->setConfiguration($extbaseFrameworkConfiguration);	  
	}	
}
?>
