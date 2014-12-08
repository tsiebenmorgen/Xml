<?php

namespace de\webomotion;

require_once dirname(__FILE__) . '/Exception.php';

/**
 * Diese Exception sollte immer dann geworfen werden, wenn
 * XPath::gquery() false zurückgibt.
 */
class InvalidXPathException extends Exception {
  const MSG = '%s::%s: invalid xpath (%s).';

  public function __construct($xpath) {
    $msg              = '';
    $className        = $this->getClassName();
    $functionName     = $this->getFunctionName();

    if (!is_null($className)) {
      $msg.= $className . '::';
    }
    if (!is_null($functionName)) {
      $msg.= $functionName . ': ';
    }
    $this->message = $msg . 'invalid xpath: ' . $xpath;
  }
}
