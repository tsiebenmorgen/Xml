Xml
=======

Die Xml-Klasse ist eine Fassade für die DOM-Erweiterung von PHP. Sie stellt eine vereinfachte Schnittstelle
bereit, um aus XML-Dateien oder XML-Code über XPath-Queries Attributewerte und Tagcontent auszulesen oder direkt
auf DOMElement-Objekte zuzugreifen.

__Beispiel, um auf den herkömmlichen Weg mit der DOM-Erweiterung von PHP einen Attributwert zu ermitteln:__

```php
$doc = new DOMDocument();
$doc->load('/path/to/file');

$xpath    = new DOMXPath($doc);
$nodeList = $xpath->query('/xpath/to/node/attribute::name');

if ($nodeList instanceof DOMNodeList) {
  if (($nodeList->length > 0) && ($nodeList->item(0) instanceof DOMAttr)) {
    $value = $nodeList->item(0)->value;
  } else {
    $value = null;
  }
} else {
  throw new Exception('exception message');
}
```
<br/>
__Beispiel, um mit der Xml-Klasse einen Attributwert zu ermitteln:__

```php

require_once '/path/to/xml/class';

use de\webomotion\Xml;

$xml   = new Xml('/path/to/file');
$value = $xml->get('/xpath/to/node/attribute::name');
```
<br/>

####Rückgabewerte:
Die `get()`-Methode kann Attributwerte, Tagcontent oder `DOMElement`-Instanzen zurückgeben:

1. __Attributewerte:__ Endet die XPath-Query mit `/attribute::name` wird der Wert von `DOMAttr->value` zurückgegeben.
   Je nachdem auf wie viele `DOMAttr`-Instanzen die XPath-Query passt:
  1. __genau ein__ `DOMAttr`: Es wird ein `string` zurückgegeben.
  2. __mehrere__ `DOMAttr`: Es wird ein `array` zurückgegeben. Jedes Element des `array` ist ein `string`.
  3. __kein__ `DOMAttr`: Es wird `null` zurückgegeben.
2. __Tagcontent__: Endet die XPath-Query mit `/text()` wird der Wert von `DOMText->wholeText` zurückgegeben.
   Je nachdem auf wie viele `DOMText`-Instanzen die XPath-Query passt:
  1. __genau ein__ `DOMText`: Es wird ein `string` zurückgegeben.
  2. __mehrere__ `DOMText`: Es wird ein `array` zurückgegeben. Jedes Element des `array` ist ein `string`.
  3. __kein__ `DOMText`: Es wird `null` zurückgegeben.
3. __`DOMElement`-Instanzen__: Endet die XPath-Query weder auf `/attribute::name` noch auf `/text()` wird eine
  Instanz  von `DOMElement` zurückgegeben. Je nachdem auf wie viele `DOMElement`-Instanzen die XPath-Query passt:
  1. __genau ein__ `DOMElement`: Es wird ein `DOMElement` zurückgegeben.
  2. __mehrere__ `DOMElement`: Es wird ein `array` zurückgegeben. Jedes Element des `array` ist ein `DOMElement`.
  3. __kein__ `DOMElement`: Es wird `null` zurückgegeben.

__HINWEISE:__

1. Mit dem optionalen zweiten Parameter `$forceNode=true` können auch in den Fällen, bei denen die
   XPath-Queries auf `/attribute::name` oder `/text()` enden die Rückgabe von `DOMAttr`- bzw. `DOMText`-Instanzen
   erzwungen werden.
2. Möchte man in jedem Fall ein `array` als Rückgabewert, kann man statt der `get()`- Methode die `getAll()`-Methode
   verwenden. Es wird dann ein `array` mit 0, 1 oder n `string` bzw. Instanzen von `DOMAttr`, `DOMText` oder
   `DOMElement` zurückgegeben.


TODO:
=====
* DOM modifizieren
* Umgang mit namespaces
