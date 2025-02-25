<?php

namespace Kirby\Reference;

use DefaultPage;
use Kirby\Cms\App;
use Kirby\Content\Field;
use Kirby\Template\Template;
use Kirby\Toolkit\A;
use ReflectionClass;
use ReflectionFunctionAbstract;
use ReflectionUnionType;
use Reflector;
use Throwable;

abstract class ReflectionPage extends DefaultPage
{
	protected DocBlock|null $docBlock;
	protected array $parameters;
	protected Reflector $reflection;
	protected string|null $returns;
	protected array $throws;

	/**
	 * Returns how this entry would be called in code
	 */
	public function call(): string
	{
		if ($this->reflection() === null) {
			return $this->slug();
		}

		$parameters = array_column($this->parameters(), 'export');
		$parameters = implode(', ', $parameters);
		$call       = $this->name() . '(' . $parameters . ')';

		if ($return = $this->returnType()) {
			$call .= ': ' . $return;
		}

		return $call;
	}

	/**
	 * Returns deprecation information
	 */
	public function deprecated(): Field
	{
		if ($tag = $this->docBlock()?->getTag('deprecated')) {
			$value = $tag->getVersion() . '|' . $tag->getDescription();
			return new Field($this, 'deprecated', $value);
		}

		return parent::deprecated();
	}

	/**
	 * Gets the DocBlock information
	 */
	public function docBlock(): DocBlock|null
	{
		if (isset($this->docBlock) === true) {
			return $this->docBlock;
		}

		if ($reflection = $this->reflection()) {
			try {
				return $this->docBlock = new DocBlock($reflection->getDocComment());
			} catch (Throwable) {
			}
		}

		return $this->docBlock = null;
	}

	/**
	 * Returns an intro description
	 */
	public function intro(): Field
	{
		// prefer intro defined in content file
		if ($this->content()->has('intro')) {
			return $this->content()->get('intro');
		}

		// otherwise try to get summary from DocBlock in code
		if ($docBlock = $this->docBlock()) {
			$intro = trim($docBlock->getSummary());
			$intro = str_replace(PHP_EOL, ' ', $intro);

			if ($intro === '/') {
				$intro = null;
			}
		}

		return new Field($this, 'intro', $intro ?? null);
	}

	/**
	 * Check if this has been deprecated
	 */
	public function isDeprecated(): bool
	{
		return $this->deprecated()->isNotEmpty();
	}

	/**
	 * Check if this is marked as internal
	 */
	public function isInternal(): bool
	{
		return $this->docBlock()?->getTag('internal') !== null;
	}

	public function isMutable(): bool
	{
		return strpos($this->returns(), '$this') !== false;
	}

	public function isImmutable(): bool
	{
		return strpos($this->returns(), 'static') !== false ||
			   strpos($this->returns(), 'self') !== false;
	}

	/**
	 * Gets the line number where this starts in the code
	 */
	public function line(): int|null
	{
		$reflection = $this->reflection();

		if (
			$reflection instanceof ReflectionClass ||
			$reflection instanceof ReflectionFunctionAbstract
		) {
			return $reflection->getStartLine();
		}

		return null;
	}

	public function metadata(): array
	{
		return [
			'description' => strip_tags($this->intro()->kirbytags()),
			'thumbnail' => [
				'lead'  => $this->metaLead(page('docs/reference'), 'Reference')
			]
		];
	}

	/**
	 * Get the name of this entry
	 */
	public function name(): string
	{
		return preg_replace_callback(
			'!-([a-z])!',
			fn ($matches) => strtoupper($matches[1]),
			$this->slug()
		);
	}

	/**
	 * Returns URL to the code on GitHub
	 */
	public function onGitHub(string $path = ''): Field
	{
		if (empty($path) === false) {
			$url  = option('github.url') . '/kirby/tree/' . App::version();
			$url .= '/' . $path;

			if ($line = $this->line()) {
				$url .= '#L' . $line;
			}
		}

		return field($url ?? null);
	}

	/**
	 * Returns an array with all parameter info
	 */
	public function parameters(): array
	{
		if (isset($this->parameters) === true) {
			return $this->parameters;
		}

		$reflection = $this->reflection();

		if ($reflection instanceof ReflectionFunctionAbstract === false) {
			return $this->parameters = [];
		}

		return $this->parameters = A::map(
			$reflection->getParameters(),
			function ($parameter) {
				$name = $parameter->getName();
				$doc  = $this->docBlock()?->getParameter($name);

				if ($type = $parameter->getType()) {
					$this->typeName($type);
				} elseif ($doc) {
					$type = (string)$doc->getType();
				}

				$export = '$' . $name;

				if ($parameter->isVariadic() === true) {
					$export = '...' . $export;
				}

				$export   = trim($type . ' ' . $export);
				$default  = null;
				$optional = false;

				if ($parameter->isOptional() === true) {
					if ($parameter->isDefaultValueAvailable()) {
						$default = $parameter->getDefaultValue();
						$default = var_export($default, true);
						$default = str_replace('NULL', 'null', $default);
						$default = str_replace('array (' . PHP_EOL . ')', '[ ]', $default);
					} else {
						$default = 'null';
					}

					$optional  = true;
					$export   .= ' = ' . $default;
				}

				return [
					'name'        => '$' . $name,
					'default'     => $default,
					'description' => (string)$doc?->getDescription(),
					'export'      => $export,
					'required'    => $optional === false,
					'type'        => Types::factory($type ?? 'mixed', $this),
					'variadic'    => $parameter->isVariadic()
				];
			}
		);
	}

	/**
	 * Creates the reflection object
	 */
	protected function reflection(): Reflector|null
	{
		return null;
	}

	public function typeName($type): string
	{
		if ($type instanceof ReflectionUnionType) {
			return implode(
				'|',
				A::map($type->getTypes(), fn ($type) => $type->getName())
			);
		}

		return $type->getName();
	}

	public function returns(): string|null
	{
		if (isset($this->returns) === true) {
			return $this->returns;
		}

		if ($reflection = $this->reflection()) {
			// First, try to get return type from reflection
			if (
				$reflection instanceof ReflectionFunctionAbstract &&
				$reflection->hasReturnType() === true
			) {
				$type = $reflection->getReturnType();
				$name = $this->typeName($type);

				if ($type->allowsNull() === true) {
					$name .= '|null';
				}

				return $this->returns = $name;
			}

			// Otherwise, check DocBlock for return type
			if ($type = $this->docBlock()?->getReturnType()) {
				return $this->returns = trim((string)$type->getType());
			}
		}

		return $this->returns = null;
	}


	/**
	 * Returns a string of all return types
	 */
	public function returnType(): string|null
	{
		if ($return = $this->returns()) {
			return Types::factory($return, $this);
		}

		return null;
	}

	/**
	 * Returns in which version this entry was introduced;
	 * ignore any versions but the current major version
	 */
	public function since(): Field
	{

		if ($tag = $this->docBlock()?->getTag('since')) {
			$since   = $tag->getVersion();
			$current = $this->kirby()->version();

			if ((int)$since == (int)$current) {
				return parent::since()->value($since);
			}
		}

		return parent::since();
	}

	/**
	 * If a dedicated template exist, use it.
	 * Otherwise fall back to `reference-article` template.
	 */
	public function template(): Template
	{
		// If template exists, use it
		if ($this->intendedTemplate() === parent::template()) {
			return parent::template();
		}

		return $this->kirby()->template('reference-article');
	}

	/**
	 * Returns what exceptions can be thrown by this
	 */
	public function throws(): array
	{
		return $this->throws ??= A::map(
			$this->docBlock()?->getTagsByName('throws'),
			fn ($doc) => [
				'description' => $doc->getDescription(),
				'type'        => ltrim($doc->getType(), '\\'),
			]
		);
	}
}
