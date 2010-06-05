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
 * A view helper for executing private functions.
 *
 * = Examples =
 *
 * <code title="function">
 * <sav:function name="upperCamel" arguments="tx_savlibraryexample_test" />
 * </code>
 *
 * Output:
 * TxSavlibraryexampleTest
 *
 * @package SavLibraryMvc
 * @subpackage ViewHelpers
 * @author Laurent Foulloy <yolf.typo3@orange.fr>
 * @version $Id:
 */
class Tx_SavLibraryKickstarter_ViewHelpers_FunctionViewHelper extends Tx_Fluid_Core_ViewHelper_AbstractViewHelper {

// TODO: Clean and comment

	/**
	 *
	 * @param string $name The function name
	 * @param mixed $arguments The arguments
   * @return string the type for the variable
	 * @author Laurent Foulloy <yolf.typo3@orange.fr>
   * @version     SVN: $Id$
	 */
	public function render($name = NULL, $arguments = NULL) {
    $children = $this->renderChildren();
    if (!empty($children)){
      if (method_exists($this, $name)) {
        $method = new ReflectionMethod('Tx_SavLibraryKickstarter_ViewHelpers_FunctionViewHelper', $name);
        if (!$method->isPrivate()) {
          throw new RuntimeException('Only private method can be called. The method "'. $name . '" is not private !');
        } else {
          return $this->$name($children, $arguments);
        }
      } else {
        throw new RuntimeException('The function "'. $name . '" does not exist !');
      }
    } elseif (method_exists($this, $name)) {
      $method = new ReflectionMethod('Tx_SavLibraryKickstarter_ViewHelpers_FunctionViewHelper', $name);
      if (!$method->isPrivate()) {
        throw new RuntimeException('Only private method can be called. The method "'. $name . '" is not private !');
      } else {
        return $this->$name($arguments);
      }
    } else {
      throw new RuntimeException('The function "'. $name . '" does not exist !');
    }
	}

	/**
	 * Converts a string to utf8
	 *
	 * @param string $string The string to convert
	 * @return string The string in utf8
	 */
	private function stringToUtf8($string) {
    return Tx_SavLibraryKickstarter_Utility_Conversion::stringToUtf8($string);
  }

	/**
	 * Converts a string to upperCamel
	 *
	 * @param string $string The string to convert
	 * @return string The string in upper Camel case
	 */
	private function upperCamel($string) {
    return Tx_SavLibraryKickstarter_Utility_Conversion::upperCamel($string);
	}

	/**
	 * Converts a string to lowerCamel
	 *
	 * @param string $string The string to convert
	 * @return string The string in lower Camel case
	 */
	private function lowerCamel($string) {
    return Tx_SavLibraryKickstarter_Utility_Conversion::lowerCamel($string);
	}

	/**
	 * Returns true if the arguments is null
	 *
	 * @param mixed $argument The argument
	 * @return mixed 
	 */
	private function setTrueIfNull($argument) {
    if (is_null($argument)) {
      return true;
    } else {
      return $argument;
    }
	}

	/**
	 * Returns true if the arguments[index] in the argument[input] is an array of integer
	 *
	 * @param array $arguments The argument array
	 * @return boolean
	 */
	private function isArrayOfInteger($arguments) {
    $notInteger = 0;
    foreach ($arguments['input'] as $key => $value) {
      $notInteger += t3lib_div::testInt($value[$arguments['index']]) ? 0 : 1;
    }
    return $notInteger ? false : true;
	}

	/**
	 * Returns true if the arguments[needle] is in the argument[haystack] 
	 *
	 * @param array $arguments The argument array
	 * @return boolean
	 */
	private function in_array($arguments) {
    return in_array($arguments['needle'], explode(',', $arguments['haystack']));
	}

	/**
	 * Returns the current value of an array
	 *
	 * @param array $argument The argument
	 * @return mixed
	 */
	private function current($argument) {
    return current($argument);
	}

	/**
	 * Returns true if the argument is an array
	 *
	 * @param mixed $argument The argument
	 * @return boolean
	 */
	private function isArray($argument) {
    return is_array($argument);
	}

	/**
	 * Returns true if the argument is an integer
	 *
	 * @param mixed $argument The argument
	 * @return boolean
	 */
	private function isInteger($argument) {
    return is_integer($argument);
	}
	
	/**
	 * Returns the md5 value of a string as integer
	 *
	 * @param string $string The argument
	 * @return integer
	 */
	private function md5int($string) {
    return t3lib_div::md5int($string);
	}

	/**
	 * Retmoves the underscore in a string
	 *
	 * @param string $string The argument
	 * @return string
	 */
	private function removeUnderscore($string) {
    return str_replace('_','', $string);
	}

	/**
	 * Counts the number of lines in a string
	 *
	 * @param string $string The argument
	 * @return integer
	 */
	private function countLines($string) {
    return substr_count($string, chr(10)) + 1;
  }

	/**
	 * Indents a string by a number of tab
	 *
	 * @param string $string The argument
	 * @param integer $count The number of tab
	 * @return string
	 */
  private function indent($string, $count) {
		$lines = explode(chr(10), $string);
		$glue = chr(10) . str_repeat(chr(9), $count);
		return implode($glue, $lines);
  }

	/**
	 * Removes empty lines in a string
	 *
	 * @param string $string The argument
	 * @return string
	 */
	private function removeEmptyLines($string) {
    $string = preg_replace('/([\t ]+[\r]?[\n])+/', '', $string);
    $string = preg_replace('/\n\n\n+/', chr(10).chr(10), $string);
    return $string;
	}
	
	/**
	 * Removes CR-LF in a string
	 *
	 * @param string $string The argument
	 * @return string
	 */
	private function removeLineFeed($string) {
    $string = preg_replace('/[\n\r]+/', '', $string);
    return $string;
	}

	/**
	 * Adds slashes
	 *
	 * @param string $string The argument
	 * @return string
	 */
	private function addSlashes($string) {
    $string = addslashes($string);
    return $string;
	}

	/**
	 * Returns an empty string
	 *
	 * @return string
	 */
	private function nothing() {
    return '';
	}

	/**
	 * Copies a file given by $arguments['source'] from the extension $arguments['sourceExtension']
	 * into the file $arguments['destination'] from the extension $arguments['destinationExtension']
	 * @return none
	 */
	private function copyFile($arguments) {
    if ($arguments['sourceExtension']) {
      $sourceExtensionDirectory = Tx_SavLibraryKickstarter_Configuration_ConfigurationManager::getExtensionDir($arguments['sourceExtension']);
    } else {
      $sourceExtensionDirectory = Tx_SavLibraryKickstarter_Configuration_ConfigurationManager::getExtensionDir('sav_library_kickstarter');
    }
    if ($arguments['destinationExtension']) {
      $destinationExtensionDirectory = Tx_SavLibraryKickstarter_Configuration_ConfigurationManager::getExtensionDir($arguments['destinationExtension']);
    } else {
      $destinationExtensionDirectory = Tx_SavLibraryKickstarter_Configuration_ConfigurationManager::getExtensionDir('sav_library_kickstarter');
    }
    if (! copy($sourceExtensionDirectory . $arguments['source'], $destinationExtensionDirectory . $arguments['destination'])) {
      throw new RuntimeException('Copy failed.');
    }
  }
}
?>

