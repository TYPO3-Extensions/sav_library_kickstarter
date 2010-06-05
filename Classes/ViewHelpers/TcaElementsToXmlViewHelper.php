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
 * A view helper for building the a XML code associated with TCA elements.
 *
 * = Examples =
 *
 * <code title="TcaElementsToXml">
 * <sav:TcaElementsToXml />
 * </code>
 *
 * Output:
 * the options
 *
 * @package SavLibraryKickstarter
 * @subpackage ViewHelpers
 */
class Tx_SavLibraryKickstarter_ViewHelpers_TcaElementsToXmlViewHelper extends Tx_Fluid_Core_ViewHelper_AbstractViewHelper {

	/**
	 * @var boolean
	 */
  protected $isFirstTag;
  
	/**
	 * @param string $TcaElements The TCA array elements
	 * @param integer $indent Number of tabs before
	 *
   * @return string the XML representation of the elements
	 * @author Laurent Foulloy <yolf.typo3@orange.fr>
	 */
	public function render($TcaElements = NULL, $indent=5) {
	
	  if ($TcaElements === NULL) {
		  $TcaElements = $this->renderChildren();
    }
    eval('$out = array(' . $TcaElements . ');');
    $this->isFirstTag = true;
    return substr($this->convetToXml($out, $indent), 0, -1);
	}

	/**
	 * Recursive function to convert the elements
	 *
	 * @param string $elements The TCA array elements
	 * @param integer $indent Number of tabs before
	 *
   * @return string the XML representation of the elements
	 * @author Laurent Foulloy <yolf.typo3@orange.fr>
	 */
  protected function convetToXml($elements, $indent) {
    $out = '';
    foreach($elements as $elementKey => $element) {

      if ($this->isFirstTag) {
        $prefix = '';
        $this->isFirstTag = false;
      } else {
        $prefix = str_repeat(chr(9), $indent);
      }

      if (is_numeric($elementKey)) {
        $tag = 'numIndex';
        $elementKey = ' index="' . $elementKey . '"';
      } else {
        $tag = $elementKey;
        $elementKey = '';
      }
      
      if (is_array($element)) {
        $type = ' type="array"';
        $out .= $prefix . '<' . $tag . $elementKey . $type . '>' . chr(10);
        $out .= $this->convetToXml($element, $indent + 1);
        $out .= $prefix . '</' . $tag . '>' . chr(10);
      } else {
        $type = '';
        if (is_integer($element)) {
          $type = ' type="integer"';
        }
        $out .= $prefix . '<' . $tag . $elementKey. $type . '>' . $element . '</' . $tag . '>' . chr(10);
      }
    }
    return $out;
  }
}
?>

