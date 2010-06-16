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
 * A view helper for creating aliases.
 *
 * This view helper has exactly the same syntax as the fluid alias viewhelper.
 * The main difference is that obect accessor may contain other object accesor
 * Therefore {a.b.{c.d}.e} is allowed
 *
 * @package SavLibraryKickstarter
 * @subpackage ViewHelpers
 */
class Tx_SavLibraryKickstarter_ViewHelpers_AliasViewHelper extends Tx_Fluid_Core_ViewHelper_AbstractViewHelper {

	/**
	 *
	 * @param array $map
	 * @return string Rendered string
	 * @author Laurent Foulloy <yolf.typo3@orange.fr>
	 * @version $Id:
	 */
	public function render(array $map) {

    foreach($this->templateVariableContainer->getAllIdentifiers() as $identifier) {
      $arguments[$identifier] = $this->templateVariableContainer->get($identifier);
    }
		foreach ($map as $aliasName => $value) {
			$this->templateVariableContainer->add($aliasName, $this->parseValue($value, $arguments));
		}
		$output = $this->renderChildren();

		foreach ($map as $aliasName => $value) {
			$this->templateVariableContainer->remove($aliasName);
		}
		return $output;
	}

	/**
	 *
	 * @param string $template The template string to render
	 * @param array $arguments Argument array used to parse the template
   * @return string Parsed template
	 * @author Laurent Foulloy <yolf.typo3@orange.fr>
	 */
	protected function parseValue($template, $arguments) {

    // Replaces patterns by markers
    $patterns = array();
    $index = 0;
    while (preg_match('/\{[^\{]+?\}/', $template, $match)) {
      $patterns[$index] = $match[0];
      $template = preg_replace('/\{[^\{]+?\}/', '#' . $index++ . '#', $template, 1);
    }

    // Processes the paterns
    if ($index > 0) {
      $templateParser = t3lib_div::makeInstance('Tx_SavLibraryKickstarter_Parser_TemplateParser');
      foreach ($patterns as $patternKey => $pattern) {
        while (preg_match('/#([0-9]+)#/', $pattern, $match)) {
          $pattern = str_replace($match[0], $patterns[$match[1]], $pattern);
        }
        $patterns[$patternKey] = $templateParser->parseTemplate($pattern, $arguments);
      }
      $template = $patterns[$index -1 ];
    }
    
    return $template;
	}

}
?>

