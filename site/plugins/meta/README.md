# Meta plugin for getkirby.com

Generates meta tags, OpenGraph images, `robots.txt`, `sitemap.xml` and `open-search.xml`.

## Metadata

Each key is read from the page's content file, then from the `metadata()` method of the page model (lowercase keys), then from `site.txt`.

| Key           | Used for                                                                 |
| ------------- | ------------------------------------------------------------------------ |
| `description` | Meta and OpenGraph description                                           |
| `ogtitle`     | OpenGraph title (default: `title`)                                       |
| `ogimage`     | Custom OpenGraph image                                                   |
| `thumbnail`   | Generated OpenGraph image, see below                                     |
| `robots`      | e.g. `noindex, nofollow`                                                 |
| `priority`    | Sitemap priority, 0.0–1.0 (default: 0.5, no fallback to `site.txt`)      |
| `changefreq`  | Sitemap [change frequency](https://www.sitemaps.org/protocol.html)       |

## OpenGraph image

A page uses its `ogimage`, else its `opengraph.png` file, else a generated image at `/{page}/opengraph.png`.

The generated image is rendered from `src/templates/opengraph.typ` with [Typst](https://typst.app) and cached in `site/cache/opengraph`. It shows a lead (default: breadcrumb of parent titles, or "The CMS"), the title and an optional page image:

```yaml
Thumbnail: screenshot.png
```

```yaml
Thumbnail:
  -
  lead: Guide / Panel
  title: Basic blueprint knowledge
  image: screenshot.png
```

```php
public function metadata(): array
{
	return [
		'thumbnail' => [
			'lead'  => 'Reference / Class',
			'title' => $this->name(),
			'image' => $this->image()
		]
	];
}
```

Requires the Typst CLI. Set its path if PHP can't find it:

```php
'kirby.meta.typst' => '/path/to/typst'
```
