<?php

use Kirby\Cms\App;
use Kirby\Content\Field;
use Kirby\Reference\Reflectable\ReflectableFieldOptions;
use Kirby\Toolkit\Collection;
use Kirby\Toolkit\Obj;

class ReferencePanelFieldPage extends ReferenceArticlePage
{
	protected ReflectableFieldOptions|null $options = null;

	/**
	 * Returns the blueprint options of the field
	 */
	public function options(): ReflectableFieldOptions
	{
		return $this->options ??= ReflectableFieldOptions::factory(
			$this->name()
		);
	}

	public function read(): Field
	{
		return parent::read()->or('docs/guide/blueprints/fields');
	}

	/**
	 * Returns the table of contents incl. the heading of the
	 * options table, which is rendered by the template and
	 * therefore isn't part of the text field
	 */
	public function toc(): Collection
	{
		return $this->text()->toToc('h2')->prepend(
			'#field-options',
			new Obj([
				'id'   => '#field-options',
				'text' => 'Field options'
			])
		);
	}

	public function source(): string|null
	{
		$root  = App::instance()->root('kirby');
		$class = 'src/Form/Field/' . ucfirst($this->name()) . 'Field.php';
		$def   = 'config/fields/' . $this->name() . '.php';
		$url   = option('github.url') . '/kirby/tree/' . App::version();

		if (file_exists($root . '/' . $class) === true) {
			return $url . '/' . $class;
		}

		if (file_exists($root . '/' . $def) === true) {
			return $url . '/' . $def;
		}

		return null;
	}
}
