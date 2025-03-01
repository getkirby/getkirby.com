<?php

namespace Kirby\Reference\Types;

use Kirby\Reference\Reflectable\Doc;
use Kirby\Toolkit\A;
use ReflectionClass;

class Context
{
	public Doc $doc;
	public array $templates = [];

	public function __construct(
		public string $class
	) {
		$reflection = new ReflectionClass($class);
		$this->doc  = Doc::factory($reflection);

		foreach ($this->doc->getTemplates() as $template) {
			$this->templates[$template->name] = null;
		}

		$this->extend();
	}

	public function extend(array $fill = []): array
	{
		foreach ($fill as $key => $type) {
			$key = array_keys($this->templates)[$key];
			$this->templates[$key] = $type;
		}

		if ($extends = $this->doc->getExtends()) {
			$fill    = A::map(
				$extends->genericTypes,
				fn ($type) => $this->templates[$type->name] ?? $type->name
			);

			$context   = new Context($extends->type);
			$templates = $context->extend($fill);

			$this->templates = [...$this->templates, ...$templates];
		}

		return $this->templates;
	}

	public function resolve(string $name): string
	{
		return $this->templates[$name] ?? $name;
	}
}
