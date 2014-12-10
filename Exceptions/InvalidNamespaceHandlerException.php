<?php

namespace de\webomotion;

require_once dirname(__FILE__) . '/Exception.php';

/**
 * Diese Exception sollte immer dann geworfen werden, wenn
 * ein an eine Funktion bzw. Methode übergebenes Argument einen anderen
 * Typ als den erwarteten hat.
 */
class InvalidNamespaceHandlerException extends Exception {
  public function __construct() {
    $msg              = '';
    $className        = $this->getClassName();
    $functionName     = $this->getFunctionName();

    if (!is_null($className)) {
      $msg.= $className . '::';
    }
    if (!is_null($functionName)) {
      $msg.= $functionName . ': ';
    }
    $this->message = $msg . 'invalid function as namespace handler.';
  }
}
