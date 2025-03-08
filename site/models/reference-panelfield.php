<?php

use Kirby\Cms\App;

class ReferencePanelFieldPage extends ReferenceArticlePage
{
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
