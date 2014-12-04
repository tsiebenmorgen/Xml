<?php

require_once dirname(__FILE__) . '/../Xml.php';

use de\webomotion\Xml;

/**
 * Tests für die Xml-Klasse
 *
 * @author Thomas Siebenmorgen <tsiebenmorgen@webomotion.de>
 */
class XmlTest extends PHPUnit_Framework_TestCase {
  protected $kmlFile;

  protected function setUp() {
    $srcDir        = dirname(__FILE__) . '/src';
    $this->gpxFile = $srcDir . '/camino-part-1.gpx';
    $this->kmlFile = $srcDir . '/camino-part-1.kml';
    $this->rssFile = $srcDir . '/symfony.rss';
    $this->xmlFile = $srcDir . '/container.xml';
  }

  public function testGetSetFormatOutput() {
    $xml = new Xml($this->kmlFile);
    $xml->formatOutput = true;
    $this->assertEquals($xml->formatOutput, true);
    $xml->formatOutput = false;
    $this->assertEquals($xml->formatOutput, false);

  }

  public function testGetSetPreserveWhiteSpace() {
    $xml = new Xml($this->kmlFile);
    $xml->preserveWhiteSpace = true;
    $this->assertEquals($xml->preserveWhiteSpace, true);
    $xml->preserveWhiteSpace = false;
    $this->assertEquals($xml->preserveWhiteSpace, false);

  }

  public function testGetDoc() {
    $doc = new DOMDocument();
    $doc->load($this->kmlFile);

    $xml = new Xml($doc);

    $this->assertEquals($xml->doc, $doc);
  }

  public function testGetContextNodeIsNull() {
    $xml = new Xml($this->gpxFile);

    $this->assertEquals($xml->context, null);

  }

  /**
   * @expectedException        Exception
   * @expectedExceptionMessage Xml::$context: Kein gültiger Kontext!
   */
  public function testSetInvalidContext() {
    $xml = new Xml($this->kmlFile);

    $xml->context = 'foo';
  }

  public function testGetSetContextNode() {
    $doc = new DOMDocument();
    $doc->load($this->kmlFile);

    $xml = new Xml($doc);

    $xml->context = $doc->documentElement;

    $this->assertInstanceOf('\DOMElement', $xml->context);
    $this->assertEquals($xml->context->tagName, 'kml');

    $xml->context = null;

    $this->assertEquals($xml->context, null);

    $doc = new DOMDocument();
    $doc->load($this->gpxFile);

    $xml = new Xml($doc);

    $xml->context = $doc->documentElement;

    $this->assertInstanceOf('\DOMElement', $xml->context);
    $this->assertEquals($xml->context->tagName, 'gpx');

    $xml->context = false;

    $this->assertEquals($xml->context, null);
  }

  public function testCreateXmlCodeWithDeclaration() {
    $str = '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>';
    $str.= '<root><test><foo name="bar">testchen</foo></test></root>';

    $xml = new Xml($str);

    $this->assertInstanceOf('de\webomotion\Xml', $xml);
  }

  public function testCreateXmlCode() {
    $str = '<root><test><foo name="bar">testchen</foo></test></root>';
    $xml = new Xml($str);

    $this->assertInstanceOf('de\webomotion\Xml', $xml);
  }

  public function testToString() {
    $str = '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>';
    $str.= '<root><test><foo name="bar">testchen</foo></test></root>';

    $xml = new Xml($str);

    $this->assertEquals($str, preg_replace('/\n/', '', (string) $xml));
  }

  public function testCreateNull() {
    $xml = new Xml();

    $this->assertInstanceOf('de\webomotion\Xml', $xml);
  }

  public function testCreateDOMDocument() {
    $doc = new DOMDocument();
    $doc->load($this->kmlFile);

    $xml = new Xml($doc);

    $this->assertInstanceOf('de\webomotion\Xml', $xml);
  }

  public function testCreateDOMElement() {
    $doc = new DOMDocument();
    $doc->load($this->kmlFile);

    $xml = new Xml($doc->documentElement);

    $this->assertInstanceOf('de\webomotion\Xml', $xml);
  }

  public function testCreateGpxFilePath() {
    $xml = new Xml($this->gpxFile);

    $this->assertInstanceOf('de\webomotion\Xml', $xml);
  }

  public function testCreateKmlFilePath() {
    $xml = new Xml($this->kmlFile);

    $this->assertInstanceOf('de\webomotion\Xml', $xml);
  }

  public function testCreateRssFilePath() {
    $xml = new Xml($this->rssFile);

    $this->assertInstanceOf('de\webomotion\Xml', $xml);
  }

  public function testCreateXmlFilePath() {
    $xml = new Xml($this->xmlFile);

    $this->assertInstanceOf('de\webomotion\Xml', $xml);
  }

  /**
   * @expectedException        Exception
   * @expectedExceptionMessage Xml::__construct: ungültiger Typ für Parameter #1
   */
  public function testCreateErrorInteger() {
    $xml = new Xml(1);
  }

  /**
   * @expectedException        Exception
   * @expectedExceptionMessage Xml::__construct: Parameter #1 ist kein gültiger Dateipfad!
   */
  public function testCreateInvalidFilePath() {
    $xml = new Xml($this->kmlFile . 'x');
  }
}
