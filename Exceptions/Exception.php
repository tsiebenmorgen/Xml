<?php

namespace de\webomotion;

/**
 * Diese Exception erweitert die Standardexception um Funktionen, die
 * für abgeleitete Exceptions Werte für angepasste Exception-Messages
 * zurückgeben.
 */
class Exception extends \Exception {
  /**
   * Gibt die Position des Arguments zurück, das an die Funktion
   * übergeben wurde, die die Exception geworfen hat.
   *
   * @param $v Argument
   * @return int
   */
  protected function getArgumentPosition($v) {
    $trace = $this->getTrace();

    if (isset($trace[0]['args']) && in_array($v, $trace[0]['args'])) {
      return (array_search($v, $trace[0]['args']) + 1);
    } else {
      return null;
    }
  }

  /**
   * Gibt den Namen der Klasse zurück, in der die Exception geworfen
   * wurde.
   *
   * @return string
   */
  protected function getClassName() {
    $trace = $this->getTrace();

    if (isset($trace[0]['class'])) {
      return $trace[0]['class'];
    } else {
      return null;
    }
  }

  /**
   * Gibt den Namen der Funktion zurück, in der die Exception geworfen
   * wurde.
   *
   * @return string
   */
  protected function getFunctionName() {
    $trace = $this->getTrace();

    if (isset($trace[0]['function'])) {
      return $trace[0]['function'];
    } else {
      return null;
    }
  }
}
