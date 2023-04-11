<?php

namespace Kirby\Search;

use Algolia\AlgoliaSearch\SearchClient as Algolia;
use Exception;
use Kirby\Cms\App;
use Kirby\Cms\Page;
use Kirby\Cms\Field;
use Kirby\Cms\Site;

/**
 * Kirby Search Index
 *
 * @author Lukas Bestle <lukas@getkirby.com>
 * @author Nico Hoffmann <nico@getkirby.com>
 * @license MIT
 * @link https://getkirby.com
 */
class Index
{
    public static Index $instance;
    protected Algolia $algolia;
    protected $index;
    protected App $kirby;
    protected array $options = [];

    /**
     * Class constructor
     */
    public function __construct()
    {
        $this->kirby   = App::instance();
        $this->options = $this->kirby->option('search.algolia', []);

        if (isset($this->options['app'], $this->options['key']) === false) {
            throw new Exception('Please set your Algolia API credentials in the Kirby configuration.');
        }

        $this->algolia = Algolia::create(
            $this->options['app'],
            $this->options['key']
        );

        $this->index = $this->algolia->initIndex($this->options['index']);
    }


    /**
     * Makes an array of fields and operations consistent
     * for formatPage()
     */
    protected static function cleanUpFields(array $fields): array
    {
        $result = [];

        foreach($fields as $name => $operation) {
            // Make sure the name is always the key, even if no operation was given
            if(is_int($name)) {
                $name = $operation;
                $operation = null;
            }

            $result[$name] = $operation;
        }

        // Make sure that the fields are sorted alphabetically for consistence
        ksort($result);
        return $result;
    }

    /**
     * Returns a singleton instance of the Algolia class
     */
    public static function instance(): static
    {
        return static::$instance ??= new static;
    }

    /**
     * Indexes everything and replaces the current index
     *
     * Uses atomical re-indexing:
     * https://www.algolia.com/doc/api-reference/api-methods/replace-all-objects/
     */
    public function index(): void
    {
        $pages   = $this->site()->index()->filter([$this, 'isIndexable']);
        $objects = $pages->map([$this, 'format']);
        $this->index->replaceAllObjects($objects);
    }

    /**
     * Checks if a specific page should be included in the Algolia index
     * Uses the configuration option algolia.templates
     */
    public function isIndexable(Page $page): bool
    {
        $templates    = $this->options['templates'] ?? [];
        $pageTemplate = $page->intendedTemplate()->name();

        // Quickly whitelist simple definitions
        // Example: array('project')
        if (in_array($pageTemplate, $templates, true) === true) {
            return true;
        }

        // Sort out pages whose template is not defined
        if (isset($templates[$pageTemplate]) === false) {
            return false;
        }

        $template = $templates[$pageTemplate];

        // Check if the template is defined as a boolean
        // Example: array('project' => true, 'contact' => false)
        if (is_bool($template) === true) {
            return $template;
        }

        // Skip every value that is not a boolean or array for consistency
        if (is_array($template) === false) {
            return false;
        }

        // Check for the custom filter function
        // Example: array('project' => array('filter' => function($page) {...}))
        if ($filter = $template['filter']) {
            if (
                is_callable($filter) &&
                call_user_func($filter, $page) === false
            ) {
                return false;
            }
        }

        // No rule was violated, the page is indexable
        return true;
    }

    /**
    * Converts a page into a data array for Algolia
    * Uses the configuration options algolia.fields and algolia.templates
    */
    public function format(Page $page): array
    {
        $fields       = $this->options['fields'] ?? ['url', 'intendedTemplate'];
        $templates    = $this->options['templates'] ?? [];
        $pageTemplate = $page->intendedTemplate()->name();

        // Merge fields with the default fields and
        // make array structure consistent
        $fields = static::cleanUpFields($fields);

        if (isset($templates[$pageTemplate]['fields'])) {
            $fields = array_merge(
                $fields,
                static::cleanUpFields($templates[$pageTemplate]['fields'])
            );
        }

        // Build resulting data array
        $data = ['objectID' => $page->id()];

        foreach ($fields as $name => $operation) {
            if (is_callable($operation)) {
                // Custom function
                $data[$name] = call_user_func($operation, $page);
            } elseif(is_string($operation) === true) {
                // Field method without parameters
                $result = $page->$name();

                if($result instanceof Field) {
                    $result = new Field($page, $name, $result);
                }

                $result = $result->$operation();

                // Make sure that the result is not an object
                $data[$name] = (is_object($result))? (string)$result : $result;
            } elseif(is_array($operation) === true) {
                // Field method with parameters
                $result = $page->$name();

                // Skip invalid definitions
                if(isset($operation[0]) === false) {
                    $data[$name] = (string)$result;
                    continue;
                }

                if($result instanceof Field === false) {
                    $result = new Field($page, $name, $result);
                }

                $parameters  = array_slice($operation, 1);
                $operation   = $operation[0];
                $result      = call_user_func_array([$result, $operation], $parameters);

                // Make sure that the result is not an object
                $data[$name] = (is_object($result))? (string)$result : $result;
            } else {
                // No or invalid operation, convert to string
                $data[$name] = (string)$page->$name();
            }
        }

        return $data;
    }

    /**
     * Returns the number of indexable pages
     */
    public function objectCount(): int {
        return $this->site()->index()->filter()->count();
    }

    /**
     * Sends a search query to Algolia and returns
     * a paginated collection of results
     *
     * @param  string $query   Search query
     * @param  int    $page    Pagination page to return (starts at 1, not 0!)
     * @param  array  $options Search parameters to override the default settings
     *  See https://www.algolia.com/doc/api-client/methods/search/
     */
    public function search(
        string $query = null,
        int $page = 1,
        array $options = []
    ): Results {
        $defaults = $this->options['options'] ?? [];
        $options  = array_merge($defaults, $options);

        // Set the page parameter
        // Algolia uses zero based page indexes while
        // Kirby's pagination starts at 1
        $options['page'] = $page ? $page - 1 : 0;

        // Get results response
        $response = $this->index->search($query, $options);

        // Return collection of the results
        return Results::from($response);
    }

    protected function site(): Site
    {
        return $this->kirby->site();
    }
}
