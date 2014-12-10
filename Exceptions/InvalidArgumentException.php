<?php

namespace de\webomotion;

require_once dirname(__FILE__) . '/Exception.php';

/**
 * Diese Exception sollte immer dann geworfen werden, wenn
 * ein an eine Funktion bzw. Methode übergebenes Argument einen anderen
 * Typ als den erwarteten hat.
 */
class InvalidArgumentException extends Exception {
  public function __construct($v, array $types = null) {
    $msg              = '';
    $className        = $this->getClassName();
    $functionName     = $this->getFunctionName();
    $argumentPosition = $this->getArgumentPosition($v);

    if (!is_null($className)) {
      $msg.= $className . '::';
    }
    if (!is_null($functionName)) {
      $msg.= $functionName . ': ';
    }
    $msg.= 'invalid type of argument ';
    if (!is_null($argumentPosition)) {
      $msg.= '#' . $argumentPosition;
    }
    $msg.= '. ';
    if (!is_null($types)) {
      $msg.= 'Allowed types are ' . implode(', ', $types) . '. ';
    }
    $this->message = $msg . gettype($v) . ' given.';
  }
}
