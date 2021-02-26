# Metadata Plugin for getkirby.com

This plugins handles the generation of meta tags for search engines, social networks, browsers and beyond.

## How it works

The plugin tries looks for metadata from a pages content file (e.g. article.txt) by the corrsponding key. If the page does not contain the specific field, it looks in the pagel model, if it provides a `metadata()` method, that returns an array or metadata fields. If that also fails, it will fall back to default metadata, as stored in the `site.txt` file at the top-level of the content directory.

That way, every page will always be able to serve default values, even if the specific page or its model does not contain information like e.g. a thumbnail or a dedicated description.

## Available keys

**Description:** The description field is used for search engines as a plain meta tag and additionally added as an OpenGraph meta tag, which is used by social media networks like e.g. Facebook or Twitter.

**Thumbnail:** The thumbnail for sharing the page in a social network. If defining a custom thumbnail for a page, you should make sure to also add a text file containing an `alt` text for the corresponding image, because it is also used by social networks.

**Twittercard:** Defaults to the value set in `site.txt` and is "summary_large_image" by default. Set this to "summary", if you don’t want to display a large preview image.

**Robots:** Generates the "robots" meta tag, that gives specifix instructions to crawlers. By default, this tag is not preset, unless a default value is defined in `site.txt`. Use a value, that you would also use if you wrote the markup directly (e.g. `noindex, nofollow`)

**Title and Ogtitle:** By default, the metadata plugin will use the page’s `title` field. You can override this by defining an `ogtitle` field for a specific page. The `ogtitle` will then be used for OpenGraph metadata instead of the page title.

**Twittersite:** The twitter account, which the site belongs to.

**Twittercreator:** The twitter account, who created the current page.

**Priority:** The priority for telling search engines about the importance of pages of your site. Must be a float value between 0.0 and 1.0. This value will not fall back to `site.txt`, but rather use 0.5 as default, if not explicit priority was found in the page’s content or returned by its model.

**Changefreq:** Optional parameter, telling search engines how often a page changes. Possible values can be found in the (sitemaps protocol specification)[https://www.sitemaps.org/protocol.html].

## Using page models to automatically generate meta data

You might not want to enter all meta data manually, so page models are your friend. This holds especially true for pages, where you don’t want to copy existing fields or where an excerpt of the actual page content would not be suitable for generating meta data.

The following example adds a `metadata()` method to all Kosmos episodes, that takes care of generating useful metadata, if a Kosmos issue is shared in a social network and also provides an automatically generated description for search engines. All keys returned by the `metadata()` method must be lowercase. Any arry item can be a value of a closure, that will be called on the `$page` object, so you can use `$this` within the closure to refer to the current page.

You can still override values (e.g. `description`) by adding a description field to an episode’s `issue.txt` file if you want to customize any of these values.

```php
class IssuePage extends Page
{

    public function metadata(): array
    {
        return [
            'description' => function () {
                return 'Read issue no. ' . $this->uid() . ' of our montly newsletter online.';
            },
            'thumbnail' => function() {
                return $this->image();
            },
            'ogtitle' => 'Kirby Kosmos Episode ' . $this->uid(),
        ];
    }
}
```
