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
 * A node which handles object access. This means it handles structures like {object.accessor.bla}
 *
 * @version $Id: ObjectAccessorNode.php 1734 2009-11-25 21:53:57Z stucki $
 * @package Fluid
 * @subpackage Core\Parser\SyntaxTree
 * @license http://www.gnu.org/licenses/lgpl.html GNU Lesser General Public License, version 3 or later
 * @scope prototype
 */
class Tx_SavLibraryKickstarter_Core_Parser_SyntaxTree_ObjectAccessorNode extends Tx_Fluid_Core_Parser_SyntaxTree_ObjectAccessorNode {

	/**
	 * Gets a property path from a given object or array.
	 *
	 * If propertyPath is "bla.blubb", then we first call getProperty($object, 'bla'),
	 * and on the resulting object we call getProperty(..., 'blubb').
	 *
	 * For arrays the keys are checked likewise.
	 *
	 * @param mixed $subject An object or array
	 * @param string $propertyPath
	 * @return mixed Value of the property
	 */
	protected function getPropertyPath($subject, $propertyPath, Tx_Fluid_Core_Rendering_RenderingContextInterface $renderingContext) {
    // Added to parse the inner accessors if any
		if (preg_match('/^(?P<Start>[^{]*)(?P<ObjectAccessor>{.*})(?P<End>[^}]*)$/', $propertyPath, $matchedVariables) > 0) {
      $templateParser = Tx_SavLibraryKickstarter_Compatibility_TemplateParserBuilder::build();
      $parsedTemplate = $templateParser->parse($matchedVariables['ObjectAccessor']);
      $propertyPath = $matchedVariables['Start'] . $parsedTemplate->render($renderingContext) . $matchedVariables['End'];
    }

    $subject = parent::getPropertyPath($subject, $propertyPath, $renderingContext);
    
		return $subject;
	}

}
?>
