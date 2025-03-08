<?php

namespace Kirby\Icons;

use SimpleXMLElement as BaseSimpleXmlElement;

class SimpleXmlElement extends BaseSimpleXmlElement
{
	/**
	 * Returns the inner XML of the element
	 */
	public function innerXml(): string
	{
		$dom      = dom_import_simplexml($this);
		$innerXML = '';

		foreach ($dom->childNodes as $child) {
			$innerXML .= $child->ownerDocument->saveXML($child);
		}

		return trim($innerXML);
	}

	/**
	 * Prepends a child to the element
	 */
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
