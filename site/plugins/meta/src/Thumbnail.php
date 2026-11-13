<?php

namespace Kirby\Meta;

use Exception;
use Kirby\Cms\App;
use Kirby\Cms\File;
use Kirby\Cms\Page;
use Kirby\Filesystem\F;
use Kirby\Http\Remote;
use Kirby\Http\Response;
use Kirby\Toolkit\Str;
use Throwable;

/**
 * Creates a dynamic OpenGraph thumbnail for a page with Typst
 *
 * @author    Nico Hoffmann <nico@getkirby.com>
 * @link      https://getkirby.com
 * @license   https://opensource.org/licenses/MIT
 */
class Thumbnail
{
	public const TEMPLATE = __DIR__ . '/templates/opengraph.typ';

	protected File|null $image;
	protected string $lead;
	protected string $title;

	public function __construct(
		protected string $id
	) {
		$this->id = urldecode($id);
		$this->data();
	}

	protected static function cache(): string
	{
		return App::instance()->root('cache') . '/opengraph';
	}

	protected function data(): void
	{
		$page = $this->page();

		if ($page === null) {
			return;
		}

		$data = [];

		// Get data from page model
		if (method_exists($page, 'metadata') === true) {
			$data = $page->metadata()['thumbnail'] ?? [];
		}

		// Get data from content file
		if ($page->thumbnail()->exists()) {
			$yaml = $page->thumbnail()->yaml()[0];
			$data = match (is_string($yaml)) {
				/**
				 * thumnail: image.png
				 */
				true  => [...$data, 'image' => $yaml],
				/**
				 * thumnail:
				 *   -
				 *   lead: Something interesting
				 *   image: image.png
				 */
				false => [...$data, ...$yaml]
			};

			// If image is still a string and not a file object yet,
			// try to find image in the page's files
			if ($img = $data['image'] ?? null) {
				if (is_string($img) === true) {
					$data['image'] = $page->file($img);
				}
			}
		}

		// Some virtual pages have HTML in their titles
		$this->lead  = static::removeEmoji(Str::unhtml($data['lead'] ?? $page->metaLead(null, 'The CMS')));
		$this->title = static::removeEmoji(Str::unhtml($data['title'] ?? $page->title()));
		$this->image = $data['image'] ?? null;
	}

	/**
	 * Returns File object for thumbnail
	 */
	public static function file(
		Page $page,
		PageMeta $meta
	): File|null {
		// Priotize custom thumbnail over auto-generated:
		// If defined in...

		// Content file
		if ($file = $page->content()->get('ogimage')->toFile()) {
			return $file;
		}

		// Page model
		if ($file = $meta->data['ogimage'] ?? null) {
			return $file;
		}

		// Default filename
		if ($file = $page->image('opengraph.png')) {
			return $file;
		}

		// Archived docs are served as static snapshot
		// without auto-generated images
		if (isArchived() === true) {
			return null;
		}

		// Otherwise go with auto-generated image
		return new File([
			'parent'   => $page,
			'filename' => 'og:image',
			'url'      => '/' . $page->id() . '/opengraph.png'
		]);
	}

	protected function hasImage(): bool
	{
		return
			isset($this->image) &&
			$this->image !== null &&
			$this->image !== false;
	}

	/**
	 * Image path relative to the index root;
	 * remote images get cached locally for Typst
	 */
	protected function imagePath(): string|null
	{
		if ($this->hasImage() === false) {
			return null;
		}

		// formats Typst can read
		$extension = strtolower($this->image->extension());

		if (in_array($extension, ['gif', 'jpeg', 'jpg', 'png', 'svg', 'webp'], true) === false) {
			return null;
		}

		$kirby = App::instance();
		$index = $kirby->root('index');
		$root  = $this->image->root();

		if (is_file($root) === false) {
			$root = static::cache() . '/remote/' . sha1($this->image->url()) . '.' . $extension;

			if (is_file($root) === false) {
				try {
					$response = Remote::get($this->image->url());
				} catch (Throwable) {
					return null;
				}

				if ($response->code() !== 200) {
					return null;
				}

				F::write($root, $response->content());
			}
		}

		if (str_starts_with($root, $index . '/') === false) {
			return null;
		}

		return substr($root, strlen($index));
	}

	/**
	 * Inputs for the Typst template
	 */
	protected function inputs(): array
	{
		$inputs = [
			'lead'  => $this->lead,
			'title' => $this->title,
			// picks the background pattern
			'seed'  => abs(crc32($this->id)),
		];

		if ($image = $this->imagePath()) {
			$inputs['image'] = $image;
		}

		return $inputs;
	}

	/**
	 * Returns page for which the thumbnail should be generated
	 */
	public function page(): Page|null
	{
		return page($this->id);
	}

	/**
	 * Rendered PNG, cached until inputs or template change
	 */
	protected function png(): string
	{
		$inputs = $this->inputs();
		$image  = App::instance()->root('index') . ($inputs['image'] ?? '');
		$key    = sha1(json_encode([
			$inputs,
			md5_file(static::TEMPLATE),
			is_file($image) ? filemtime($image) : null
		]));
		$file   = static::cache() . '/' . $key . '.png';

		if (is_file($file) === true) {
			return F::read($file);
		}

		$png = $this->render($inputs);
		F::write($file, $png);

		return $png;
	}

	protected static function removeEmoji(string $string): string
	{
		$string = preg_replace('/[\x{1F600}-\x{1F64F}]/u', '', $string);
		$string = preg_replace('/[\x{1F300}-\x{1F5FF}]/u', '', $string);
		$string = preg_replace('/[\x{1F680}-\x{1F6FF}]/u', '', $string);
		$string = preg_replace('/[\x{2600}-\x{26FF}]/u', '', $string);
		$string = preg_replace('/[\x{2700}-\x{27BF}]/u', '', $string);
		return preg_replace('/\s\s+/', ' ', $string);
	}

	/**
	 * Renders the PNG with the Typst CLI
	 */
	protected function render(array $inputs): string
	{
		$kirby   = App::instance();
		$command = [
			$kirby->option('kirby.meta.typst', 'typst'),
			'compile',
			'--root', $kirby->root('index'),
			'--font-path', __DIR__ . '/assets',
			'--ignore-system-fonts',
			'--format', 'png',
			'--ppi', '72',
		];

		foreach ($inputs as $key => $value) {
			$command[] = '--input';
			$command[] = $key . '=' . $value;
		}

		$command[] = static::TEMPLATE;
		$command[] = '-';

		$process = proc_open(
			$command,
			[1 => ['pipe', 'w'], 2 => ['pipe', 'w']],
			$pipes
		);

		if ($process === false) {
			throw new Exception('Could not start Typst');
		}

		$png    = stream_get_contents($pipes[1]);
		$errors = stream_get_contents($pipes[2]);
		fclose($pipes[1]);
		fclose($pipes[2]);

		if (proc_close($process) !== 0) {
			throw new Exception('Typst could not render the OpenGraph image: ' . $errors);
		}

		return $png;
	}

	/**
	 * Generates the thumnail and returns it as Response
	 */
	public function response(): Response|null
	{
		if ($this->page() === null) {
			return new Response('Page not found', 'text/plain', 404);
		}

		return new Response($this->png(), 'image/png');
	}
}
