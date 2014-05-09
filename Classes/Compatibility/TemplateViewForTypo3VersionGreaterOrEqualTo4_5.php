<?php

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
class Tx_SavLibraryKickstarter_Compatibility_TemplateView extends Tx_Fluid_View_TemplateView {

	public function initializeView() {
    $this->templateParser = Tx_SavLibraryKickstarter_Compatibility_TemplateParserBuilder::build();	
	}

}
