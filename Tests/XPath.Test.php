<?php

require_once dirname(__FILE__) . '/../XPath.php';

use de\webomotion\XPath;

/**
 * Tests für die XPath-Klasse
 *
 * @author Thomas Siebenmorgen <tsiebenmorgen@webomotion.de>
 */
class XPathTest extends PHPUnit_Framework_TestCase {
  private $absoluteAttributeQuery = '/kml/attribute::xmlns';
  private $relativeAttributeQuery = './attribute::xmlns';
  private $relativeTextQuery      = './text()';
  
  public function testToString() {
    $xpath = new XPath($this->absoluteAttributeQuery);

    $this->assertEquals($this->absoluteAttributeQuery, (string) $xpath);
  }

  public function testGetIsAttribute() {
    $xpath = new XPath($this->absoluteAttributeQuery);

    $this->assertEquals($xpath->isAttribute, true);
  }

  public function testGetBasename() {
    $xpath = new XPath($this->absoluteAttributeQuery);

    $this->assertEquals($xpath->basename, 'attribute::xmlns');
  }

  public function testGetBasename2() {
    $xpath = new XPath($this->relativeTextQuery);

    $this->assertEquals($xpath->basename, 'text()');
  }

  public function testGetDirname() {
    $xpath = new XPath($this->absoluteAttributeQuery);

    $this->assertEquals($xpath->dirname, '/kml');
  }

  public function testGetDirname2() {
    $xpath = new XPath($this->relativeTextQuery);

    $this->assertEquals($xpath->dirname, '.');
  }

  public function testGetIsText() {
    $xpath = new XPath($this->relativeTextQuery);

    $this->assertEquals($xpath->isText, true);
  }

  public function testGetIsAbsoluteFalse() {
    $xpath = new XPath($this->relativeTextQuery);

    $this->assertEquals($xpath->isAbsolute, false);
  }

  public function testGetIsRelative() {
    $xpath = new XPath($this->relativeTextQuery);

    $this->assertEquals($xpath->isRelative, true);
  }

  public function testGetIsAbsolute() {
    $xpath = new XPath($this->absoluteAttributeQuery);

    $this->assertEquals($xpath->isAbsolute, true);
  }

  public function testGetIsAbsolute2() {
    $xpath = new XPath($this->relativeAttributeQuery);

    $this->assertEquals($xpath->isAbsolute, false);
  }

  /**
   * @exception deßwebootion\UndefinedPropertyException
   */
  public function testGetUndefinedProperty() {
    $xpath = new XPath($this->relativeAttributeQuery);

    $xpath->isFoo;
  }

  public function testGetIsRelativeFalse() {
    $xpath = new XPath($this->absoluteAttributeQuery);

    $this->assertEquals($xpath->isRelative, false);
  }

  public function testGetIsTextFalse() {
    $xpath = new XPath($this->absoluteAttributeQuery);

    $this->assertEquals($xpath->isText, false);
  }
}
