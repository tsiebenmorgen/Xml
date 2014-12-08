<?php namespace de\webomotion;

require_once dirname(__FILE__) . '/Exceptions/UndefinedPropertyException.php';

use \DOMXPath;

class XPath {
  const QUERY_IS_ATTRIBUTE = '/^attribute\:\:([a-zA-Z]+)$/';
  const QUERY_IS_TEXT      = '/^text\(\)$/';
  const QUERY_IS_RELATIVE  = '/^\./';
  const GET_DIRNAME        = '/^(.+)(\/)?([^\/]+)$/U';
  const GET_BASENAME       = '/^(?:.+)(?:\/)?([^\/]+)$/U';

  private $_strQuery = '';
  private $_xml = null;

  public function __construct(Xml $xml, $str) {
    $this->_xml = $xml;
    $this->_strQuery = (string) $str;
  }

  public function __get($name) {
    switch ($name) {
      case 'basename':
        return preg_replace(self::GET_BASENAME, '$1', $this->_strQuery);
      case 'dirname':
        return preg_replace(self::GET_DIRNAME, '$1', $this->_strQuery);
      case 'isAbsolute':
        return !$this->isRelative;
      case 'isAttribute':
        return (bool) preg_match(self::QUERY_IS_ATTRIBUTE, $this->basename);
      case 'isText':
        return (bool) preg_match(self::QUERY_IS_TEXT, $this->basename);
      case 'isRelative':
        return (bool) preg_match(self::QUERY_IS_RELATIVE, $this->dirname);
      case default:
        throw new UndefinedPropertyException($name);
    }
  }

  public function __toString() {
    return (string) $this->_strQuery;
  }

  public function execute() {
    $DOMXPath = new DOMXPath($this->_xml->doc);
    if ($this->isRelative) {
      return $DOMXPath->query((string) $this, $this->_xml->context);
    } else {
      return $DOMXPath->query((string) $this, $this->_xml->doc->documentElement);
    }
  }
}
