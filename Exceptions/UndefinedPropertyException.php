<?php

namespace de\webomotion;

require_once dirname(__FILE__) . '/Exception.php';

/**
 * Diese Exception sollte in den __get() und __set()-Methoden
 * geworfen werden, wenn $name nicht vorgesehen ist.
 */
class UndefinedPropertyException extends Exception {
  public function __construct($name) {
    $msg              = '';
    $className        = $this->getClassName();

    if (!is_null($className)) {
      $msg.= $className . '::';
    }
    $this->message = $msg. '$' . $name . ': undefined property.';
  }
}
