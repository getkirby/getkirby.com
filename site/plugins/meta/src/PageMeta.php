<?php

namespace Kirby\Meta;

use Kirby\Cms\Asset;
use Kirby\Cms\Field;
use Kirby\Cms\File;
use Kirby\Http\Response;
use Kirby\Toolkit\A;
use Kirby\Toolkit\F;
use Kirby\Toolkit\Html;
use Kirby\Toolkit\Tpl;

use Imagick;

class PageMeta {

    protected $page;
    protected $metadata = [];

    public $defaults = [
        'robots' => true,
    ];

    public function __construct($page) {
        $this->page = $page;

        // Get metadata from page model
        if (method_exists($this->page, 'metadata') === true) {
            $this->metadata = $this->page->metadata();
        }
    }

    public function __call($name, $arguments)
    {
        return $this->get(strtolower($name));
    }

    public function get(string $key, bool $fallback = false): Field
    {
        // From content file...
        $key   = strtolower($key);
        $field = $this->page->content()->get($key);

        if ($field->exists() === true) {
            return $field;
        }

        // From page model...
        if (array_key_exists($key, $this->metadata) === true) {
            return new Field($this->page, $key, $this->metadata[$key]);
        }

        // From site as fallback...
        if ($fallback === true) {
            $fallback = site()->content()->get($key);

            if ($fallback->exists()) {
                return $fallback;
            }
        }

        return new Field($this->page, $key, null);
    }

    public function jsonld(): string
    {
        $html = [];
        $json = [
            '@context' => 'https://schema.org',
            '@graph' => [
                [
                    '@type' => 'Organization',
                    'name' => 'Kirby',
                    'url' => url(),
                    'logo' => url('/assets/images/kirby-signet.svg'),
                    'sameAs' => [
                        'https://twitter.com/getkirby',
                        'https://instagram.com/getkirby',
                    ],
                ],
                [
                    '@type' => 'WebSite',
                    'url' => url(),
                    'potentialAction' => [
                        [
                            '@type' => 'SearchAction',
                            'target' => url('search') . '?q={search_term_string}',
                            'query-input' => 'required name=search_term_string',
                        ],
                    ],
                ],
            ],
        ];

        return Tpl::load(__DIR__ . '/templates/json.php', compact('json'));
    }

    public function opensearch(): string
    {
        return Html::tag('link', null, [
            'rel'   => 'search',
            'type'  => 'application/opensearchdescription+xml',
            'title' => site()->title(),
            'href'  => url('/open-search.xml'),
        ]) . PHP_EOL;
    }

    public function priority(): float
    {
        $priority = $this->get('priority')->or(0.5)->value();
        return (float)min(1, max(0, $priority));
    }

    public function robots(): string
    {
        $html   = [];
        $robots = $this->get('robots', true);

        if ($robots->isNotEmpty()) {
            $html[] = Html::tag('meta', null, [
                'name' => 'robots',
                'content' => $robots->value(),
            ]);
        }

        $html[] = Html::tag('link', null, [
            'rel' => 'canonical',
            'href' => $this->page->url(),
        ]);

        return implode(PHP_EOL, $html) . PHP_EOL;
    }

    public function social(): string
    {
        $html = [];
        $meta = [];
        $og   = [];
        $site = site();

        // Basic OpenGraph tags
        $og['og:site_name'] = $site->title()->value();
        $og['og:url']       = $this->page->url();
        $og['og:type']      = 'website';
        $og['og:title']     = $this->get('ogtitle')->or($this->page->title());

        // Meta and OpenGraph description
        $description = $this->get('description', true);
        if ($description->isNotEmpty()) {
            $og['og:description'] = $description->excerpt(200);
            $meta['description']  = $description->excerpt(160);
        }

        $twitterCard = $this->get('twittercard', true);
        if ($twitterCard->isNotEmpty()) {
            $meta['twitter:card'] = $twitterCard->value();
        }

        // Image
        if ($thumbnail = $this->thumbnail()) {
            $og['og:image'] = url($thumbnail->url());

            if ($thumbnail->alt()->isNotEmpty()) {
                $og['og:image:alt'] = $thumbnail->alt()->value();
            }
        } else if ($meta['twitter:card'] === 'summary_large_image') {
            $meta['twitter:card'] = 'summary';
        }

        // Twitter settings
        $twitterSite = $this->get('twittersite', true);
        if ($twitterSite->isNotEmpty()) {
            $meta['twitter:site'] = $twitterSite->value();
        }

        $twitterCreator = $this->get('twittercreator', true);
        if ($twitterCreator->isNotEmpty()) {
            $meta['twitter:creator'] = $twitterCreator->value();
        }

        return Tpl::load(__DIR__ . '/templates/social.php', compact('meta', 'og'));
    }

    public function thumbnail(): ?File
    {
        // Overrule auto-generated image if custom one is set:
        // In content file...
        $custom = $this->page->content()->get('ogimage');

        if ($custom->exists() && ($image = $custom->toFile())) {
            return $image;
        }

        // In page model...
        if ($this->metadata['ogimage'] ?? null) {
            return $this->metadata['ogimage'];
        }

        // Otherwise go with auto-generated image
        return new File([
            'parent'   => $this->page,
            'filename' => 'og:image',
            'url'      => '/' . $this->page->id() . '/opengraph.png'
        ]);
    }

    public static function renderThumbnail(string $id)
    {
        // Get page for which the thumbnail should be generated
        $page = page(urldecode($id));

        if ($page === null) {
            return null;
        }

        $data = [];

        // Get data from page model
        if (method_exists($page, 'metadata') === true) {
            $data = $page->metadata()['thumbnail'] ?? [];
        }

        // Get data from content file
        if ($page->thumbnail()->exists()) {
            $yaml = $page->thumbnail()->yaml()[0];

            /**
             * thumnail: image.png
             */
            if (is_string($yaml) === true) {
                $data['image'] = $yaml;

            /**
             * thumnail:
             *   -
             *   lead: Something interesting
             *   image: image.png
             */
            } else {
                $data = array_merge($data, $yaml);
            }

            // If image is still a string and not a file object yet,
            // try to find image in the page's files
            if ($data['image'] ?? null) {
                if (is_string($data['image']) === true) {
                    $image = $page->file($data['image']);

                    if ($image === null) {
                        $image = new Asset('assets/icons/' . $data['image']);
                    }

                    $data['image'] = $image;
                }
            }
        }

        // Create canvas
        $canvas = imagecreatetruecolor(1200, 628);

        // Define colors and fonts
        $black  = imagecolorallocate($canvas, 0, 0, 0);
        $gray   = imagecolorallocate($canvas, 119, 119, 119);
        $white  = imagecolorallocate($canvas, 255, 255, 255);
        $yellow = imagecolorallocate($canvas, 253, 197, 0);

        $sans = __DIR__ . '/assets/Inter-Regular.otf';
        $bold = __DIR__ . '/assets/Inter-Bold.otf';
        $mono = __DIR__ . '/assets/RobotoMono.ttf';

        // Add background
        $width = 1200;
        $height = 628;
        imagefilledrectangle($canvas, 0, 0, $width, $height, $white);

        // Margin and initial y coordinate
        $margin = $y = 60;

        // Lead text
        [$x, $y] = imagettftext(
            $canvas,
            $size = 28,
            0,
            $margin,
            $y += $size,
            $gray,
            $mono,
            $data['lead'] ?? $page->metaLead(null, 'The CMS')
        );

        // Line
        $y += 25;
        imagesetthickness($canvas, 4);
        imageline($canvas, $x, $y, $width - $margin, $y, $black);

        // Title text
        $title  = $data['title'] ?? $page->title();
        $length = strlen($title);
        $size   = $length < 12 ? 74 : ($length < 24 ? 64 : 58);
        $title  = wordwrap($title, $size > 60 ? 20 : 25, "\n");
        $lines  = substr_count($title, "\n") + 1;

        [$x, $y] = imagettftext(
            $canvas,
            $size,
            0,
            $margin - 5,
            $y += $size + 45,
            $black,
            $sans,
            $title
        );
        $y += $margin;

        // Logo
        $logo = imagecreatefrompng(__DIR__ . '/assets/logo.png');
        imagecopyresampled(
            $canvas,
            $logo,
            $width - $margin - imagesx($logo),
            $height - $margin - 10 - imagesy($logo),
            0,
            0,
            imagesx($logo),
            imagesy($logo),
            imagesx($logo),
            imagesy($logo)
        );

        if ($image = $data['image'] ?? null) {
            $image = url($image->url());
        } else {
            $image = null;
        }

        // Image or domain
        if ($image && F::extension($image) !== 'svg') {

            // Convert SVG to image string
            if (strpos(pathinfo($image)['extension'], 'svg') !== false) {

                $im = new Imagick();
                $box = 280 - ($lines * 50);
                $svg = file_get_contents($image);
                $im->setResolution(460, 460);
                $im->readImageBlob($svg);
                $im->setImageFormat('jpeg');
                $im->resizeImage($box, $box, imagick::FILTER_LANCZOS, 1);
                $data = $im->getImageBlob();
                $image = imagecreatefromstring($data);
                $y = $height - imagesy($image) - $margin - 10;

            // Load other formats as image string via curl
            } else {
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $image);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_BINARYTRANSFER, 1);
                $data = curl_exec($ch);
                curl_close($ch);
                $image = imagecreatefromstring($data);
            }

            // Set size (auto with max-width)
            $w = imagesx($image);
            $max = $width - (3 * $margin) - imagesx($logo);
            if ($w > $max) $w = $max;
            $h = (imagesy($image) / imagesx($image)) * $w;
            imagecopyresampled(
                $canvas,
                $image,
                $margin,
                $y,
                0,
                0,
                $w,
                $h,
                imagesx($image),
                imagesy($image)
            );

        } else {
            $y = $height - $margin - 15;
            imagesetthickness($canvas, 3);
            imageline($canvas, $x - 5, $y, 342, $y, $yellow);
            imagettftext(
                $canvas,
                32,
                0,
                $margin,
                $y -= 5,
                $black,
                $bold,
                'getkirby.com'
            );
        }

        // Render
        ob_start();
        imagepng($canvas);
        $body = ob_get_clean();
        imagedestroy($canvas);

        return new Response($body, 'image/png');
    }

}
