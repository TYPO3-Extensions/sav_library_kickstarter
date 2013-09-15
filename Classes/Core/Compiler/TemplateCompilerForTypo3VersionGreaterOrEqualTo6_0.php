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
 * @license http://www.gnu.org/licenses/lgpl.html GNU Lesser General Public License, version 3 or later
 */
class Tx_SavLibraryKickstarter_Core_Compiler_TemplateCompiler extends \TYPO3\CMS\Fluid\Core\Compiler\TemplateCompiler {

	/**
	 * @param \TYPO3\CMS\Fluid\Core\Parser\SyntaxTree\ObjectAccessorNode $node
	 * @return array
	 * @see convert()
	 */
	protected function convertObjectAccessorNode(\TYPO3\CMS\Fluid\Core\Parser\SyntaxTree\ObjectAccessorNode $node) {  

		return array(
			'initialization' => '',
//			'execution' => sprintf('TYPO3\\CMS\\Fluid\\Core\\Parser\\SyntaxTree\\ObjectAccessorNode::getPropertyPath($renderingContext->getTemplateVariableContainer(), \'%s\', $renderingContext)', $node->getObjectPath())
			'execution' => sprintf('Tx_SavLibraryKickstarter_Core_Parser_SyntaxTree_ObjectAccessorNode::getPropertyPath($renderingContext->getTemplateVariableContainer(), \'%s\', $renderingContext)', $node->getObjectPath())
		);
	}

}

?>