<?php

namespace de\webomotion;

require_once dirname(__FILE__) . '/Exception.php';

/**
 * Diese Exception sollte immer dann geworfen werden, wenn is_file()
 * für einen gegebenen Filepath false zurückgibt.
 */
class FileNotFoundException extends Exception {
  public function __construct($filePath) {
    $msg              = '';
    $className        = $this->getClassName();
    $functionName     = $this->getFunctionName();

    if (!is_null($className)) {
      $msg.= $className . '::';
    }
    if (!is_null($functionName)) {
      $msg.= $functionName . ': ';
    }
    $this->message = $msg . ' invalid filepath: ' . $filePath;
  }
}
