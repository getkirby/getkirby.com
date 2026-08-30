<?php

use Kirby\Content\Field;
use Kirby\Reference\Reflectable\ReflectableKirbytag;

class ReferenceKirbytagPage extends ReferenceArticlePage
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

	public function reflection(): ReflectableKirbytag
	{
		return $this->reflection ??= new ReflectableKirbytag(
			name: $this->name()
		);
	}

	public function title(): Field
	{
		return new Field($this, 'title', '&#40;' . $this->name() . ': …&#41;');
	}
}
