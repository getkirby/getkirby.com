<?php

namespace Kirby\Search;

use Kirby\Cms\Page;
use Kirby\Content\Field;

/**
 * Represents an entry (page) to be indexed in Loupe
 * Handles page data preparation for search indexing
 *
 * @author Your Name
 * @license MIT
 */
class Entry
{
    public function __construct(
        protected Page   $page,
        protected Search $search
    )
    {
    }

    /**
     * Get fields configuration for this page
     */
    protected function fields(): array
    {
        $fields = $this->search->options['fields'] ?? ['title', 'url'];
        $templates = $this->templates();
        $template = $this->template();

        $fields = static::fieldsToUniformArray($fields);

        // Get template-specific fields
        if ($templateFields = $templates[$template]['fields'] ?? null) {
            $fields = [
                ...$fields,
                ...static::fieldsToUniformArray($templateFields)
            ];
        }

        // Sort fields alphabetically for consistency
        ksort($fields);

        return $fields;
    }

    /**
     * Normalize field configuration to uniform array format
     */
    protected static function fieldsToUniformArray(array $fields): array
    {
        $result = [];

        foreach ($fields as $name => $props) {
            if (is_int($name) === true) {
                $name = $props;
                $props = null;
            }

            $result[$name] = $props;
        }

        return $result;
    }

    /**
     * Check if this page should be included in the search index
     */
    public function isIndexable(): bool
    {
        $templates = $this->templates();
        $template = $this->template();

        // Quick include if template is in simple array
        if (in_array($template, $templates, true) === true) {
            return true;
        }

        // If template isn't configured, exclude it
        if (isset($templates[$template]) === false) {
            return false;
        }

        $templateConfig = $templates[$template];

        // Handle boolean configuration
        if (is_bool($templateConfig) === true) {
            return $templateConfig;
        }

        // Handle callable configuration
        if (is_callable($templateConfig) === true) {
            return $templateConfig($this->page);
        }

        return true;
    }

    /**
     * Get the template name of the page
     */
    protected function template(): string
    {
        return $this->page->intendedTemplate()->name();
    }

    /**
     * Get templates configuration from search options
     */
    protected function templates(): array
    {
        return $this->search->options['templates'] ?? [];
    }

    /**
     * Convert page to data array for Loupe indexing
     */
    public function toData(): array
    {
        $data = ['objectID' => $this->page->id()];

        foreach ($this->fields() as $name => $method) {
            $data[$name] = match (true) {
                // Custom function
                is_callable($method)
                => $method($this->page),
                // Field method with/without parameters
                is_string($method) || is_array($method)
                => $this->toDataFromFieldMethod($name, $method),
                // Default: convert to string
                default
                => (string)$this->page->$name()
            };
        }

        return $data;
    }

    /**
     * Resolve field method to actual value
     */
    protected function toDataFromFieldMethod(
        string       $name,
        string|array $method
    ): string
    {
        $field = $this->page->$name();

        if ($field instanceof Field === false) {
            $field = new Field($this->page, $name, $field);
        }

        if (is_string($method) === true) {
            return $field->$method();
        }

        $args = array_slice($method, 1);
        $method = $method[0];
        return $field->$method(...$args);
    }
}
