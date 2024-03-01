<?php

namespace Kirby\Meta;

use GdImage;
use Kirby\Cms\File;
use Kirby\Cms\Page;
use Kirby\Http\Response;

/**
 * Creates a dynamic OpenGraph thumbnail for a page
 *
 * @package   Kirby Meta
 * @author    Nico Hoffmann <nico@getkirby.com>
 * @link      https://getkirby.com
 * @license   https://opensource.org/licenses/MIT
 */
class Thumbnail
{
	const PATTERNS = [
		'abyss',
		'beach',
		'blobs',
		'darkness',
		'deepsea',
		'lagoon',
		'lava',
		'pinkblue',
		'purple',
		'rainforest',
		'sea',
		'sky',
		'space',
		'turmoil',
		'viscera'
	];

	protected GdImage $canvas;
	protected int $width  = 1200;
	protected int $height = 630;
	protected int $offset = 50;

	protected string $lead;
	protected string $title;
	protected File|null $image;

	public function __construct(
		protected string $id
	) {
		$this->id = urldecode($id);
		$this->data();
	}

	protected function addBackground(): void
	{
		$this->addPattern();
		$this->addFrame();
	}

	protected function addFrame(): void
	{
		$radius = 20;
		$white  = imagecolorallocate($this->canvas, 255, 255, 255);

		// Filling rectangles
		imagefilledrectangle(
			$this->canvas,
			$this->offset + $radius,
			$this->offset,
			$this->width - $this->offset - $radius,
			$this->height - ($this->hasImage() ? 0 : $this->offset),
			$white
		);
		imagefilledrectangle(
			$this->canvas,
			$this->offset,
			$this->offset + $radius,
			$this->offset + $radius - 1,
			$this->height - ($this->hasImage() ? 0 : $this->offset + $radius),
			$white
		);
		imagefilledrectangle(
			$this->canvas,
			$this->width - $this->offset - $radius + 1,
			$this->offset + $radius,
			$this->width - $this->offset,
			$this->height - ($this->hasImage() ? 0 : $this->offset + $radius),
			$white
		);

		// Corners
		imagefilledarc(
			$this->canvas,
			$this->offset + $radius - 1,
			$this->offset + $radius - 1,
			$radius * 2,
			$radius * 2,
			180,
			270,
			$white,
			IMG_ARC_PIE
		);
		imagefilledarc(
			$this->canvas,
			$this->width - $this->offset - $radius + 1,
			$this->offset + $radius - 1,
			$radius * 2,
			$radius * 2,
			270,
			360,
			$white,
			IMG_ARC_PIE
		);

		if ($this->hasImage() === false) {
			imagefilledarc(
				$this->canvas,
				$this->offset + $radius - 1,
				$this->height - $this->offset - $radius + 1,
				$radius * 2,
				$radius * 2,
				90,
				180,
				$white,
				IMG_ARC_PIE
			);
			imagefilledarc(
				$this->canvas,
				$this->width - $this->offset - $radius + 1,
				$this->height - $this->offset - $radius + 1,
				$radius * 2,
				$radius * 2,
				360,
				90,
				$white,
				IMG_ARC_PIE
			);
		}
	}

	protected function addPattern(): void
	{
		$seed    = abs(crc32($this->id));
		$pattern = static::PATTERNS[$seed % count(static::PATTERNS)];
		$root    = dirname(__DIR__, 4) . '/assets/patterns';
		$pattern = imagecreatefromjpeg($root . '/' . $pattern . '.jpg');
		$width   = imagesx($this->canvas);
		$height  = imagesy($this->canvas);

		// pattern
		imagecopy(
			$this->canvas,
			$pattern,
			0,
			0,
			$seed % (imagesx($pattern) - $width),
			$seed % (imagesy($pattern) - $height),
			$width,
			$height
		);

		// dark overlay
		imagefilledrectangle(
			$this->canvas,
			0,
			0,
			$width,
			$height,
			// semi-transparent black
			imagecolorallocatealpha($this->canvas, 0, 0, 0, 100)
		);
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

		$this->lead  = static::removeEmoji($data['lead'] ?? $page->metaLead(null, 'The CMS'));
		$this->title = static::removeEmoji($data['title'] ?? $page->title());
		$this->image = $data['image'] ?? null;
	}

	/**
	 * Returns File object for thumbnail
	 */
	public static function file(
		Page $page,
		PageMeta $meta
	): File|null
	{
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
	 * Returns page for which the thumbnail should be generated
	 */
	public function page(): Page|null
	{
		return page($this->id);
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
	 * Generates the thumnail and returns it as Response
	 */
	public function response(): Response|null
	{
		// Create canvas
		$this->canvas = imagecreatetruecolor($this->width, $this->height);

		// Define colors and fonts
		$black = imagecolorallocate($this->canvas, 0, 0, 0);
		$gray  = imagecolorallocate($this->canvas, 153, 153, 153);
		$sans  = __DIR__ . '/assets/Inter-Regular.otf';
		$bold  = __DIR__ . '/assets/Inter-Bold.otf';
		$logo  = imagecreatefrompng(__DIR__ . '/assets/logo.png');

		$this->addBackground();

		$margin  = $y = $this->offset * 2;

		// Lead text
		[$x, $y] = imagettftext(
			$this->canvas,
			$size = 32,
			0,
			$margin,
			$y += $size,
			$gray,
			$sans,
			$this->lead
		);

		$length = strlen($this->title);
		$size   = $length < 24 ? 62 : 54;
		$title  = wordwrap($this->title, $size > 60 ? 17 : 22, "\n");

		[$x, $y] = imagefttext(
			$this->canvas,
			$size,
			0,
			$margin - 5,
			$y += $size + 35,
			$black,
			$bold,
			$title,
			['linespacing' => .915]
		);

		$y += $this->offset;

		if ($this->hasImage()) {
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, url($this->image->url()));
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			$data = curl_exec($ch);
			curl_close($ch);
			$image = imagecreatefromstring($data);

			// Set size (auto with max-width)
			$max = $this->width - (5 * $this->offset) - imagesx($logo);
			$w   = min(imagesx($image), $max);
			$h   = (imagesy($image) / imagesx($image)) * $w;

			imagecopyresampled(
				$this->canvas,
				$image,
				$margin,
				$y,
				0,
				0,
				(int)$w,
				(int)$h,
				imagesx($image),
				imagesy($image)
			);
		}

		// Logo
		imagecopyresampled(
			$this->canvas,
			$logo,
			$this->width - $margin - imagesx($logo),
			$this->height - ($this->hasImage() ? $this->offset : $margin) - imagesy($logo),
			0,
			0,
			imagesx($logo),
			imagesy($logo),
			imagesx($logo),
			imagesy($logo)
		);

		// Render
		ob_start();
		imagepng($this->canvas);
		$body = ob_get_clean();
		imagedestroy($this->canvas);

		return new Response($body, 'image/png');
	}
}
