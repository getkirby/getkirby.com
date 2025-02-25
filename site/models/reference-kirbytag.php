<?php

use Kirby\Content\Field;
use Kirby\Reference\ReferencePage;
use Kirby\Reference\Reflectable\ReflectableKirbytag;

class ReferenceKirbytagPage extends ReferencePage
{
	public function metadata(): array
	{
		return array_replace_recursive(parent::metadata(), [
			'ogtitle' => $this->title() . ' KirbyTag',
			'thumbnail' => [
				'lead'  => 'Reference / KirbyTag'
			]
		]);
	}

	public function title(): Field
	{
		return new Field($this, 'title', '&#40;' . $this->name() . ': …&#41;');
	}

	public function reflection(): ReflectableKirbytag
	{
		return new ReflectableKirbytag(name: $this->name());
	}
}
