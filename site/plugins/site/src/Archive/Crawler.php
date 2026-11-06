<?php

namespace Kirby\Archive;

use Closure;
use CurlHandle;
use Kirby\Filesystem\F;

/**
 * Mirrors a running site into static files,
 * following all same-origin links
 */
class Crawler
{
	/**
	 * Link patterns by file type; pages also
	 * use those of stylesheets and scripts
	 */
	public const LINKS = [
		'css' => [
			'!url\(\s*["\']?([^"\')]+)["\']?\s*\)!',
			'!@import\s+["\']([^"\']+)["\']!',
		],
		'html' => [
			'!\b(?:href|src)\s*=\s*["\']([^"\'<>]+)["\']!',
			'!\bcontent\s*=\s*["\']((?:https?:)?/[^"\'<>]*)["\']!',
		],
		'js' => [
			'!\bimport\s*(?:\(\s*|[\w*{}\s,$]+\s+from\s*)?["\']([^"\']+\.m?js[^"\']*)["\']!',
		]
	];

	/**
	 * Skipped pages with a query string
	 * and the page that linked to them
	 */
	public array $queries = [];

	/**
	 * Status of each URL, failed requests also
	 * with redirect location and linking page
	 */
	public array $results = [];

	protected array $queue = [];
	protected array $seen  = [];

	public function __construct(
		protected string $origin,
		protected string $root,
		protected string $url,
		protected array $include = [],
		protected int $workers = 8
	) {
	}

	/**
	 * Crawls the URLs and everything they link to
	 */
	public function crawl(array $urls, Closure|null $progress = null): void
	{
		foreach ($urls as $url) {
			$this->enqueue($url);
		}

		$this->run($this->workers, $progress);

		// retry failed requests one by one, as some only
		// fail under load (e.g. thumbs of the same image)
		foreach ($this->results as $url => $result) {
			if ($result['status'] === 0 || $result['status'] >= 500) {
				unset($this->results[$url]);
				$this->queue[] = $url;
			}
		}

		$this->run(1, $progress);
	}

	protected function enqueue(string $url, string|null $from = null): void
	{
		$url = $this->follow($url, $from);

		if ($url !== null && array_key_exists($url, $this->seen) === false) {
			$this->seen[$url] = $from;
			$this->queue[]    = $url;
		}
	}

	/**
	 * Returns the URL to fetch for a link
	 * or `null` if it isn't followed
	 */
	public function follow(string $url, string|null $from = null): string|null
	{
		$url = explode('#', $url)[0];

		if (str_starts_with($url . '/', $this->url . '/') === true) {
			$url = $this->origin . substr($url, strlen($this->url));
		}

		if (str_starts_with($url . '/', $this->origin . '/') === false) {
			return null;
		}

		$path = parse_url($url, PHP_URL_PATH) ?: '/';

		// files are stored without query (e.g. `?v=…`),
		// pages with a query can't be mirrored
		if (
			parse_url($url, PHP_URL_QUERY) !== null &&
			static::isFile($path) === false
		) {
			$this->queries[$url] ??= $from;
			return null;
		}

		return $this->includes($path) === true ? $url : null;
	}

	/**
	 * Whether the path is in the included sections;
	 * the home page and files like images always are
	 */
	public function includes(string $path): bool
	{
		if (
			$this->include === [] ||
			$path === '/' ||
			static::isFile($path) === true
		) {
			return true;
		}

		foreach ($this->include as $section) {
			if (str_starts_with($path . '/', '/' . trim($section, '/') . '/') === true) {
				return true;
			}
		}

		return false;
	}

	/**
	 * Whether the path is a file like `index.css`
	 * rather than a page like `releases/3.5`
	 */
	public static function isFile(string $path): bool
	{
		return preg_match('!\.[a-z][a-z0-9]*$!i', basename($path)) === 1;
	}

	/**
	 * Returns all links in a file of the given type
	 */
	public static function links(string $body, string $type): array
	{
		$patterns = match ($type) {
			'html'      => [...static::LINKS['html'], ...static::LINKS['css'], ...static::LINKS['js']],
			'css'       => static::LINKS['css'],
			'js', 'mjs' => static::LINKS['js'],
			default     => []
		};

		$links = [];

		if ($type === 'html') {
			// code examples contain markup that must not be followed
			$body = preg_replace('!<(pre|code)\b.*?</\1>!s', '', $body);

			preg_match_all('!\bsrcset\s*=\s*["\']([^"\']+)["\']!', $body, $matches);

			foreach ($matches[1] as $srcset) {
				foreach (explode(',', $srcset) as $candidate) {
					$links[] = explode(' ', trim($candidate))[0];
				}
			}
		}

		foreach ($patterns as $pattern) {
			preg_match_all($pattern, $body, $matches);
			$links = [...$links, ...$matches[1]];
		}

		return $links;
	}

	/**
	 * Returns the file to store a response in
	 */
	public function path(string $url, bool $html): string
	{
		$path = rawurldecode(parse_url($url, PHP_URL_PATH) ?: '/');
		$path = str_replace(['/../', '/./'], '/', $path);

		return $this->root . rtrim($path, '/') . ($html === true ? '/index.html' : '');
	}

	/**
	 * Resolves a link relative to the URL
	 * of the document it appears in
	 */
	public static function resolve(string $base, string $link): string
	{
		$link = trim(html_entity_decode($link));

		// absolute URLs, but also `mailto:`, `data:` etc.
		if (preg_match('!^[a-z][a-z0-9+.-]*:!i', $link) === 1) {
			return $link;
		}

		$parts  = parse_url($base);
		$origin = $parts['scheme'] . '://' . $parts['host'];
		$origin .= isset($parts['port']) ? ':' . $parts['port'] : '';
		$path   = $parts['path'] ?? '/';

		if (str_starts_with($link, '//') === true) {
			return $parts['scheme'] . ':' . $link;
		}

		if ($link === '' || str_starts_with($link, '#') === true) {
			return $base;
		}

		if (str_starts_with($link, '?') === true) {
			return $origin . $path . $link;
		}

		if (str_starts_with($link, '/') === false) {
			$link = substr($path, 0, strrpos($path, '/') + 1) . $link;
		}

		// remove `.` and `..` segments
		[$link, $query] = array_pad(explode('?', $link, 2), 2, null);
		$segments = [];

		foreach (explode('/', $link) as $segment) {
			if ($segment === '.') {
				continue;
			}

			if ($segment === '..') {
				if (count($segments) > 1) {
					array_pop($segments);
				}

				continue;
			}

			$segments[] = $segment;
		}

		return $origin . implode('/', $segments) . ($query !== null ? '?' . $query : '');
	}

	/**
	 * Stores a fetched response or records the failure
	 */
	protected function response(CurlHandle $handle): void
	{
		$url    = curl_getinfo($handle, CURLINFO_PRIVATE);
		$status = curl_getinfo($handle, CURLINFO_RESPONSE_CODE);
		$body   = curl_multi_getcontent($handle);

		// pages with PHP errors in them failed as well
		if (preg_match('!<b>(Fatal error|Warning|Notice|Deprecated)</b>:!', $body) === 1) {
			$status = 500;
		}

		if ($status !== 200) {
			$location = curl_getinfo($handle, CURLINFO_REDIRECT_URL) ?: null;

			$this->results[$url] = [
				'status'   => $status,
				'location' => $location,
				'from'     => $this->seen[$url]
			];

			if ($location !== null) {
				$this->enqueue($location, $url);
			}

			return;
		}

		$type = curl_getinfo($handle, CURLINFO_CONTENT_TYPE) ?? '';
		$file = $this->path($url, str_starts_with($type, 'text/html'));
		$body = $this->rewrite($body);

		F::write($file, $body);
		$this->visit($url, $file, $body);
	}

	/**
	 * Replaces the origin with the public URL,
	 * also in JSON with escaped slashes
	 */
	public function rewrite(string $text): string
	{
		return str_replace(
			[$this->origin, str_replace('/', '\/', $this->origin)],
			[$this->url, str_replace('/', '\/', $this->url)],
			$text
		);
	}

	/**
	 * Fetches the queued URLs and everything they link to
	 */
	protected function run(int $workers, Closure|null $progress = null): void
	{
		$multi  = curl_multi_init();
		$active = 0;

		while ($this->queue !== [] || $active > 0) {
			while ($active < $workers && $this->queue !== []) {
				$url = array_shift($this->queue);

				// reuse the response of a previous run
				if ($file = $this->stored($url)) {
					$this->visit($url, $file, F::read($file));
					continue;
				}

				// curl rejects unencoded spaces
				$handle = curl_init(str_replace(' ', '%20', $url));
				curl_setopt_array($handle, [
					CURLOPT_PRIVATE        => $url,
					CURLOPT_RETURNTRANSFER => true,
					CURLOPT_TIMEOUT        => 120
				]);

				curl_multi_add_handle($multi, $handle);
				$active++;
			}

			curl_multi_exec($multi, $running);

			if (curl_multi_select($multi, 1) === -1) {
				usleep(1000);
			}

			while ($info = curl_multi_info_read($multi)) {
				$this->response($info['handle']);
				curl_multi_remove_handle($multi, $info['handle']);
				$active--;
			}

			if ($progress !== null) {
				$progress(count($this->results), count($this->queue) + $active);
			}
		}

		curl_multi_close($multi);
	}

	/**
	 * Returns the file in which a previous
	 * run stored the response
	 */
	protected function stored(string $url): string|null
	{
		foreach ([false, true] as $html) {
			if (is_file($file = $this->path($url, $html)) === true) {
				return $file;
			}
		}

		return null;
	}

	/**
	 * Records a successful response
	 * and queues the links it contains
	 */
	protected function visit(string $url, string $file, string $body): void
	{
		$this->results[$url] = ['status' => 200];

		foreach (static::links($body, F::extension($file)) as $link) {
			$this->enqueue(static::resolve($url, $link), $url);
		}
	}
}
