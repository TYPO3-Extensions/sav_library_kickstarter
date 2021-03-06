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
 * A view helper for creating aliases.
 *
 * This view helper has exactly the same syntax as the fluid alias viewhelper.
 * The main difference is that obect accessor may contain other object accesor
 * Therefore {a.b.{c.d}.e} is allowed
 *
 * @package SavLibraryKickstarter
 * @subpackage ViewHelpers
 * @author Laurent Foulloy <yolf.typo3@orange.fr>
 * @version $Id:
 */
class ParseViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper {

	/**
	 *
	 * @param string $string
	 * @return string Rendered string
	 * @author Laurent Foulloy <yolf.typo3@orange.fr>
	 */
	public function render($string = NULL) {
	
    if ($string === NULL) {
      $string = $this->renderChildren();
    }
    
    foreach($this->templateVariableContainer->getAllIdentifiers() as $identifier) {
      $arguments[$identifier] = $this->templateVariableContainer->get($identifier);
    }
		$output = $this->parseValue($string, $arguments);
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
    $templateParser = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('SAV\\SavLibraryKickstarter\\Parser\\TemplateParser');
    $content = $template;
    while (preg_match('/([^\{]*)(\{[^\{]+?\})/', $content, $match)) {
      if ($match[1]) {
        $content = str_replace($match[0], $templateParser->parseTemplate($match[0], $arguments), $content);
      } else {
        $content = $templateParser->parseTemplate($match[0], $arguments);
      }
    }
    return $content;
	}

}
?>

