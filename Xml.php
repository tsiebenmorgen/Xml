<?php
/**
 * Xml-Klasse - Eine Fassade für die DOM-Erweiterung von PHP
 *
 * @version 1.0
 * @author Thomas Siebenmorgen <tsiebenmorgen@webomotion.de>
 * @copyright 2010-2014 Thomas Siebenmorgen
 * @link http://www.webomotion.de
 */

namespace de\webomotion;

require_once dirname(__FILE__) . '/XPath.php';

use \DOMAttr;
use \DOMDocument;
use \DOMElement;
use \DOMNameSpaceNode;
use \DOMNode;
use \DOMText;
use \DOMXPath;
use \Exception;

/**
 * Eine Fassade für die DOM-Erweiterung von PHP, die eine vereinfachte
 * Schnittstelle bereitstellt, um via XPath Attributewerte und Tagcontent
 * auszulesen oder direkt auf DOMElemente zuzugreifen.
 *
 * @property-read DOMDocument $doc DOMDocument hinter der Fassade
 *
 * @property-write boolean $formatOutput
 * @property-write boolean $preserveWhiteSpace
 *
 * @property DOMNode $context Context für relative XPath
 */
class Xml {
  /**
   * @var DOMNode|null
   * Node, auf welchen sich relative XPath beziehen.
   */
  private $_ContextNode = null;

  /**
   * @var DOMDocument|null
   * DOMDocument, mit dem die Fassade arbeitet.
   */
  private $_DOMDocument = null;

  /**
   * @var DOMXPath|null
   * DOMXPath, mit dem die Fassade arbeitet.
   */
  private $_DOMXPath    = null;

  /**
   * @var callback|null
   * Funktion, zur Behandlung von Namespaces. Bisher wird der Namespace
   * entfernt, damit XPath-Queries ohne Namespace funktionieren.
   */
  private $_NS_Fn       = null;

  const ERR_CONTEXT_NOT_VALID = 'Kein gültiger Kontext!';
  const ERR_FILE_NOT_EXIST    = 'Die Datei existiert nicht!';
  const ERR_INVALID_PARAM     = 'Ungültiger Parameter: %s';
  const ERR_INVALID_NS_FN     = 'Ungültige Funktion als NamespaceHandler angegeben!';
  const ERR_ITEM_NOT_ATTR     = 'Das Element ist kein Attribut!';
  const ERR_ITEM_NOT_TEXT     = 'Das Element ist kein Text!';

  /**
   * Erzeugt ein XML-Objekt aus einem XML-Code, einem Dateipfad, einem
   * DOMDocument oder aus einem DOMElement.
   *
   * @param string|DOMDocument|DOMElement   $p
   * DOMDocument, DOMElement, ein Pfad zu einer XML-Datei oder ein
   * XML-String, auf den sich die Fassade bezieht.
   */
  public function __construct($p = null) {}

  /**
   * @ignore
   */
  public function __get($name) {}

  /**
   * @ignore
   */
  public function __set($name, $value) {}

  /**
   * Gibt den XML-Code hinter der Fassade zurück.
   *
   * @return string   XML-Code hinter der Fassade.
   */
  public function __toString() {}

  /**
   * Gibt die Ergebnisse der übergebenen XPath-Query zurück.
   *
   * @link https://github.com/tsiebenmorgen/Xml README on github
   *
   * @param   string     $xpath
   * XPath zum Node des gesuchten Werts im XML-Code.
   *
   * @param   boolean   $forceNode
   * Gibt an, ob der Node oder dessen Wert zurückgegeben werden soll.
   *
   * @return  mixed
   * Wert, auf die sich der übergebene XPath bezieht.
   */
  public function get($xpath, $forceNode = false) {}

  /**
   * Gibt die Ergebnisse der übergebenen XPath-Query zwingend als Array
   * zurück.
   *
   * @link https://github.com/tsiebenmorgen/Xml README on github
   *
   * @param   string     $xpath
   * XPath zum Node des gesuchten Werts im XML-Code.
   *
   * @param   boolean   $forceNode
   * Gibt an, ob der Node oder dessen Wert zurückgegeben werden soll.
   *
   * @return  array
   * Array mit den Werten, auf die sich der übergebene XPath bezieht.
   *
   */
  public function getAll($xpath, $forceNode = false) {}

  /**
   * Erzeugt aus dem übergebenen Dateipfad zu einer XML-Datei ein
   * entsprechendes DOMDocument-Objekt.
   *
   * @param   string        $strFile    Pfad zu einer XML-Datei.
   * @return  DOMDocument               DOMDocument aus der XML-Datei.
   */
  private function _createDOMDocumentFromFile($strFile) {}

  /**
   * Diese default Funktion zum Umgang mit Namespaces entfernt die
   * Namespaces aus dem DOMDocument, so dass XPath-Angaben ohne
   * Namespaces erfolgen können.
   *
   * @param   DOMDocument   $DOMDocument    DOMDocument, auf welches
   *                                        sich das XML-Objekt bezieht.
   * @return  void
   */
  private function _defaultNameSpaceHandlerFuntion(DOMDocument $DOMDocument) {}

  /**
   * Führt die gespeicherte Funktion zum Umgang mit Namespaces aus.
   *
   * @return  void
   */
  private function _executeNameSpaceHandlerFunction() {}

  /**
   * Gibt ein NodeList-Objekt aller Nodes zurück, auf die der übergebene
   * XPath passt.
   *
   * @uses    $_isPHPgt553
   * @param   XPath    $xpath   XPath-Objekt zu den gewünschten Nodes.
   * @return  NodeList          NodeList, die zum übergebenen XPath passt.
   */
  private function _getNodeListByXPath(XPath $xpath) {}

  /**
   * Gibt je nach übergebenen XPath die übergebene Node, den
   * Attributwert der Node oder den Content der Node zurück.
   *
   * @param   DOMNode   $DOMNode    DOMNode, aus dem der Rückgabewert
   *                                erzeugt werden soll.
   * @param   XPath     $xpath      XPath aus dem der Rückgabewert
   *                                ermittelt werden soll.
   * @return  string|DOMNode        Wert des Attributes oder des Contents
   *                                als String oder die DOMNode.
   */
  private function _getResultByXPath(DOMNode $DOMNode, XPath $xpath) {}

  /**
   * Speichert die übergebene Funktion zum Umgang mit Namespaces.
   *
   * @param   callable  $fn         Funktion zum Umgang mit Namespaces
   * @return  void
   */
  private function _registerNameSpaceHandlerFunction($fn) {}

  /**
   * Erstellt und speichert je nach übergebenen Parameter
   * das DOMDocument ab.
   *
   * @param string|DOMDocument|DOMElement   $p
   * DOMDocument, DOMElement, ein Pfad zu einer XML-Datei oder ein
   * XML-Code auf den sich die Fassade beziehen soll.
   * @return  void
   */
  private function _saveDOMDocument($p) {}

  /**
   * Speichert den DOMNode, auf den sich relative XPath beziehen sollen.
   *
   * @param   null|false|XPath|DOMNode  $ContextNode
   * @return  void
   */
  private function _setContextNode($ContextNode) {}
}
