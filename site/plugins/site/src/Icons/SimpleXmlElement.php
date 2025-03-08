<?php

namespace Kirby\Icons;

use SimpleXMLElement as BaseSimpleXmlElement;

class SimpleXmlElement extends BaseSimpleXmlElement
{
	public function prependChild(
		string $name,
		string $value
	): SimpleXMLElement|null {
		$dom = dom_import_simplexml($this);
		$new = $dom->insertBefore(
			$dom->ownerDocument->createElement($name, $value),
			$dom->firstChild
		);
		return simplexml_import_dom($new, $this::class);
	}
}
