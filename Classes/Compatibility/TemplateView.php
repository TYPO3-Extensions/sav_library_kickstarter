<?php
namespace SAV\SavLibraryKickstarter\Compatibility;
/*                                                                        *
 * This script is backported from the TYPO3 Flow package "TYPO3.Fluid".   *
 *                                                                        *
 * It is free software; you can redistribute it and/or modify it under    *
 * the terms of the GNU Lesser General Public License, either version 3   *
 * of the License, or (at your option) any later version.                 *
 *                                                                        *
 * The TYPO3 project - inspiring people to share!                         *
 *                                                                        */

/**
 * The main template view. Should be used as view if you want Fluid Templating
 *
 * @api
 */
class TemplateView extends \TYPO3\CMS\Fluid\View\TemplateView {

	public function initializeView() {
    $this->templateParser = \SAV\SavLibraryKickstarter\Compatibility\TemplateParserBuilder::build();	
    $this->injectTemplateCompiler($this->objectManager->get('SAV\\SavLibraryKickstarter\\Core\\Compiler\\TemplateCompiler'));
	}

}
