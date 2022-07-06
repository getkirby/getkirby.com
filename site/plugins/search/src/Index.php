<?php

namespace Kirby\Search;

use Algolia\AlgoliaSearch\SearchClient as Algolia;
use Exception;
use Kirby\Toolkit\A;
use Kirby\Cms\Page;
use Kirby\Cms\Field;

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

	/**
	 * Singleton class instance
	 *
	 * @var \Kirby\Algolia\Index
	 */
	public static $instance;

	/**
	 * Algolia client instance
	 *
	 * @var \Algolia\AlgoliaSearch\SearchClient
	 */
	protected $algolia;

	/**
	 * Algolia index
	 */
	protected $index;

	/**
	 * Config settings
	 *
	 * @var array
	 */
	protected $options = [];

	/**
	 * Class constructor
	 */
	public function __construct()
	{
		$this->options = option('search.algolia', []);

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
	 * Returns a singleton instance of the Algolia class
	 *
	 * @return \Kirby\Algolia\Search
	 */
	public static function instance(): self
	{
		return static::$instance = static::$instance ?? new static;
	}

	/**
	 * Sends a search query to Algolia and returns 
	 * a paginated collection of results
	 *
	 * @param  string $query   Search query
	 * @param  int	$page	Pagination page to return (starts at 1, not 0!)
	 * @param  array  $options Search parameters to override the default settings
	 *  See https://www.algolia.com/doc/api-client/methods/search/
	 * @return \Kirby\Algolia\Results
	 */
	public function search(string $query = null, int $page = 1, array $options = []): Results
	{
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

	/**
	 * Indexes everything and replaces the current index
	 *
	 * Uses atomical re-indexing:
	 * https://www.algolia.com/doc/api-reference/api-methods/replace-all-objects/
	 */
	public function index()
	{
		$pages   = site()->index()->filter([$this, 'isIndexable']);
		$objects = $pages->map([$this, 'format']);
		$this->index->replaceAllObjects($objects);
	}

	/**
	 * Checks if a specific page should be included in the Algolia index
	 * Uses the configuration option algolia.templates
	 *
	 * @param  Page	$page Kirby page
	 * @return boolean
	 */
	public function isIndexable(Page $page)
	{
		$templates	= $this->options['templates'] ?? [];
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
	* @param  \Kirby\Cms\Page  $page
	* @return array
	*/
	public function format(Page $page)
	{
		$fields = $this->options['fields'] ?? ['url', 'intendedTemplate'];
		$templates = $this->options['templates'] ?? [];
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
				$result	  = call_user_func_array(array($result, $operation), $parameters);

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
