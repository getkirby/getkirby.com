<?php

namespace Kirby\Search;

use Kirby\Cms\App;
use Kirby\Cms\Page;
use Kirby\Content\Field;

/**
 * Represents a search entry (page) to be indexed
 *
 * @package   Kirby Search
 * @author    Lukas Bestle <lukas@getkirby.com>,
 *            Nico Hoffmann <nico@getkirby.com>
 * @link      https://getkirby.com
 * @license   MIT
 */
class Entry
{
	protected App $kirby;
	public function __construct(
		protected Page $page,
		protected Search $search
	) {
		$this->kirby = App::instance();
	}

	protected function fields(): array
	{
		$fields    = $this->kirby->option('search.fields', ['title', 'url']);
		$templates = $this->templates();
		$template  = $this->template();

		$fields = static::fieldsToUniformArray($fields);

		// get template-specific fields
		if ($templateFields = $templates[$template]['fields'] ?? null) {
			$fields = [
				...$fields,
				...static::fieldsToUniformArray($templateFields)
			];
		}

		// Make sure that the fields are sorted alphabetically for consistence
		ksort($fields);

		return $fields;
	}

	/**
	 * Make sure the field's name is always the key,
	 * even if only a string in a non-associative array was given
	 */
	protected static function fieldsToUniformArray(array $fields): array
	{
		$result = [];

		foreach ($fields as $name => $props) {
			if (is_int($name) === true) {
				$name  = $props;
				$props = null;
			}

			$result[$name] = $props;
		}

		return $result;
	}

	/**
	 * Checks if a specific page should be included in the Algolia index
	 * Uses the configuration option algolia.templates
	 */
	public function isIndexable(): bool
	{
		$templates = $this->templates();
		$template  = $this->template();

		// Quickly include a template
		// Example: ['project']
		if (in_array($template, $templates, true) === true) {
			return true;
		}

		// if template isn't listed, exclude it
		if (isset($templates[$template]) === false) {
			return false;
		}

		$template = $templates[$template];

		// Check if the template is defined as a boolean
		// Example: ['project' => true, 'contact' => false]
		if (is_bool($template) === true) {
			return $template;
		}

		// Closure
		if (is_callable($template) === false) {
			return $template($this->page);
		}

		// No rule was violated, the page is indexable
		return true;
	}

	/**
	 * Returns the template name of the page
	 */
	protected function template(): string
	{
		return $this->page->intendedTemplate()->name();
	}

	/**
	 * Returns the config for templates from options
	 */
	protected function templates(): array
	{
		return $this->kirby->option('search.templates', []);
	}

	/**
	 * Converts the page into a data array for Algolia
	 * Uses the configuration options algolia.fields and algolia.templates
	 */
	public function toData(): array
	{
		$data = ['objectID' => $this->page->id()];

		// loop through field definitions and generate
		// actual field data to put into the index
		foreach ($this->fields() as $name => $method) {
			$data[$name] = match (true) {
				// custom function
				is_callable($method)
					=> $method($this->page),
				// field method with/without parameters
				is_string($method) || is_array($method)
					=> $this->toDataFromFieldMethod($name, $method),
				// no or invalid operation, convert to string
				default
				=> (string)$this->page->$name()
			};
		}

		return $data;
	}

	/**
	 * Resolves the field and its method to a result value
	 * to be included in the index for the field
	 */
	protected function toDataFromFieldMethod(
		string $name,
		string|array $method
	): string {
		$field = $this->page->$name();

		if ($field instanceof Field === false) {
			$field = new Field($this->page, $name, $field);
		}

		if (is_string($method) === true) {
			return $field->$method();
		}

		$args   = array_slice($method, 1);
		$method = $method[0];
		return $field->$method(...$args);
	}
}
