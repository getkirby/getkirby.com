<?php

namespace Kirby\Algolia;

// PHP dependencies
use Exception;

// Vendor dependencies
use AlgoliaSearch\Client as AlgoliaClient;

// Kirby dependencies
use Kirby\Toolkit\A;
use Kirby\Cms\Page;
use Kirby\Cms\Field;

/**
 * Kirby Algolia Class
 *
 * @author Lukas Bestle <lukas@getkirby.com>
 * @license MIT
 * @link https://getkirby.com
 */
class Search
{

    // Singleton class instance
    public static $instance;

    // Algolia client instance
    protected $algolia;

    // Config settings
    protected $options;

    // Caches
    protected $indexCache = [];

    /**
     * Class constructor
     */
    public function __construct()
    {
        $this->options = option('algolia');

        if (isset($this->options['app'], $this->options['key']) === false) {
            throw new Exception('Please set your Algolia API credentials in the Kirby configuration.');
        }

        $this->algolia = new AlgoliaClient($this->options['app'], $this->options['key']);
    }

    /**
     * Returns a singleton instance of the Algolia class
     *
     * @return Algolia
     */
    public static function instance(): self
    {
        return static::$instance = static::$instance ?? new static;
    }

    /**
     * Sends a search query to Algolia and returns a paginated collection of results
     *
     * @param  string     $query   Search query
     * @param  integer    $page    Pagination page to return (starts at 1, not 0!)
     * @param  array      $options Search parameters to override the default settings
     *                             See https://www.algolia.com/doc/php#full-text-search-parameters
     * @return Collection
     */
    public function search(string $query = null, $page = 1, array $options = []): Results
    {
        $defaults = $this->options['options'] ?? [];
        $options  = array_merge($defaults, $options);

        // Set the page parameter
        // Algolia uses zero based page indexes while Kirby's pagination starts at 1
        $options['page'] = ($page)? $page - 1 : 0;

        // Start the search
        $results = $this->getIndex()->search($query, $options);

        // Return a collection of the results
        return new Results($results);
    }

    /**
     * Indexes everything and replaces the current index
     *
     * Uses atomical re-indexing:
     * https://www.algolia.com/doc/faq/index-configuration/how-can-i-update-all-the-objects-of-my-index
     */
    public function index()
    {
        // Get the settings from the main index
        $mainIndex = $this->getIndex();
        $settings  = $mainIndex->getSettings();

        // Make sure that we don't copy over slaves
        $settings['slaves'] = [];

        // Save the settings into a fresh temp index
        $tempIndex = $this->getIndex(true);
        $tempIndex->setSettings($settings);
        $tempIndex->clearIndex();

        // Add all objects back in
        $queue = [];

        foreach(site()->index()->filter([$this, 'isIndexable']) as $p) {
            $queue[] = $this->formatPage($p);

            // Always upload objects in batches of 100 for performance reasons
            if (count($queue) >= 100) {
                $tempIndex->saveObjects($queue);
                $queue = [];
            }
        }

        // Upload the remaining objects
        $tempIndex->saveObjects($queue);

        // Move the temp index to the main index
        $this->algolia->moveIndex($this->getIndexName(true), $this->getIndexName());
    }

    /**
     * Inserts a page into the index
     * Used by Panel hooks
     *
     * @param Page $page Kirby page
     */
    public function insertPage(Page $page)
    {
        if (static::isIndexable($page) === false) {
            return false;
        }

        $this->getIndex()->saveObject(static::formatPage($page));
    }

    /**
     * Updates a page in the index
     * Used by Panel hooks
     *
     * @param Page $page Kirby page
     */
    public function updatePage(Page $page)
    {
        if (static::isIndexable($page) === false) {
            // Delete the page from the index
            $this->deletePage($page);
            return false;
        }

        $this->getIndex()->saveObject(static::formatPage($page));
    }

    /**
     * Moves a page in the index
     * Used by Panel hooks
     *
     * @param Page $oldPage Kirby page object before the move
     * @param Page $newPage Kirby page object after the move
     */
    public function movePage(Page $oldPage, Page $newPage)
    {
        // Delete the old object
        $this->deletePage($oldPage);

        // Insert the new object
        $this->insertPage($newPage);
    }

    /**
     * Deletes a page from the index
     *
     * @param Page|string $id Kirby page or page ID
     */
    public function deletePage($id)
    {
        if ($id instanceof Page) {
            $id = $id->id();
        }

        $this->getIndex()->deleteObject($id);
    }

    /**
     * Deletes a page and all its children from the index
     * Used by Panel hooks
     *
     * @param Page|string $page Kirby page or page ID
     */
    public function deletePageRecursive($page)
    {
        if (is_string($page)) {
            $page = page($page);
        }

        if (!$page) {
            return false;
        }

        $this->deletePage($page);

        foreach ($page->children() as $p) {
            $this->deletePageRecursive($p);
        }
    }

    /**
     * Checks if a specific page should be included in the Algolia index
     * Uses the configuration option algolia.templates
     *
     * @param  Page    $page Kirby page
     * @return boolean
     */
    public static function isIndexable(Page $page)
    {
        $templates    = option('algolia')['templates'] ?? [];
        $pageTemplate = $page->intendedTemplate()->name();

        // Quickly whitelist simple definitions
        // Example: array('project')
        if (in_array($pageTemplate, $templates, true)) {
            return true;
        }

        // Sort out pages whose template is not defined
        if (!isset($templates[$pageTemplate])) {
            return false;
        }

        $template = $templates[$pageTemplate];

        // Check if the template is defined as a boolean
        // Example: array('project' => true, 'contact' => false)
        if (is_bool($template)) {
            return $template;
        }

        // Skip every value that is not a boolean or array for consistency
        if (!is_array($template)) {
            return false;
        }

        // Check for the custom filter function
        // Example: array('project' => array('filter' => function($page) {...}))
        if (isset($template['filter'])) {
            $filter = $template['filter'];
            if (is_callable($filter) && !call_user_func($filter, $page)) {
                return false;
            }
        }

        // No rule was violated, the page is indexable
        return true;
    }

    /**
    * Converts a page into a data array for Algolia
    * Uses the configuration options algolia.fields and algolia.templates
    *
    * @param  Page  $page Kirby page
    * @return array
    */
    public static function formatPage(Page $page)
    {
        $fields       = option('algolia')['fields']    ?? ['url', 'intendedTemplate'];
        $templates    = option('algolia')['templates'] ?? [];

        $pageTemplate = $page->intendedTemplate()->name();

        // Merge fields with the default fields and make array structure consistent
        if (isset($templates[$pageTemplate]['fields'])) {
            $fields = array_merge(
                static::cleanUpFields($fields),
                static::cleanUpFields($templates[$pageTemplate]['fields'])
            );
        } else {
            $fields = static::cleanUpFields($fields);
        }

        // Build resulting data array
        $data = ['objectID' => $page->id()];

        foreach ($fields as $name => $operation) {
            if (is_callable($operation)) {
                // Custom function
                $data[$name] = call_user_func($operation, $page);
            } elseif(is_string($operation)) {
                // Field method without parameters
                $result = $page->$name();

                if(is_a($result, Field::class) === false) {
                    $result = new Field($page, $name, $result);
                }

                $result = $result->$operation();

                // Make sure that the result is not an object
                $data[$name] = (is_object($result))? (string)$result : $result;
            } elseif(is_array($operation)) {
                // Field method with parameters
                $result = $page->$name();

                // Skip invalid definitions
                if(!isset($operation[0])) {
                    $data[$name] = (string)$result;
                    continue;
                }

                if(!($result instanceof Field)) {
                    $result = new Field($page, $name, $result);
                }

                $parameters  = array_slice($operation, 1);
                $operation   = $operation[0];
                $result      = call_user_func_array(array($result, $operation), $parameters);

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
    *
    * @return int
    */
    public function objectCount() {
        return site()->index()->filter()->count();
    }

    /**
    * Returns the correct Algolia index (temporary or main)
    *
    * @param  boolean             $temp If true, returns the temporary index
    * @return AlgoliaSearch\Index
    */
    protected function getIndex($temp = false) {
        $index = $this->getIndexName($temp);

        if(isset($this->indexCache[$index])) return $this->indexCache[$index];
        return $this->indexCache[$index] = $this->algolia->initIndex($index);
    }

    /**
    * Returns the name of the correct Algolia index (temporary or main)
    *
    * @param  boolean $temp If true, returns the name of the temporary index
    * @return string
    */
    protected function getIndexName($temp = false) {
        $index = $this->options['index'] ?? 'kirby';

        if ($temp) {
            return $this->options['index.temp'] ?? $index . '_temp';
        } else {
            return $index;
        }
    }

    /**
    * Makes an array of fields and operations consistent
    * for formatPage()
    *
    * @param  array $fields
    * @return array
    */
    protected static function cleanUpFields($fields) {
        $result = array();

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
}
