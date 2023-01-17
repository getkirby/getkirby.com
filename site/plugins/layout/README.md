# Kirby Layouts plugin

This plugin extends Kirby’s new snippets with slots and loads layout snippets from `site/layouts`

**This version of the plugin requires Kirby 3.9.0 and helps to migrate from the old layout plugin to our new snippets. We recommend to use native snippets instead.**

## Installation

### Download

Download and copy this repository to `/site/plugins/layouts`.

### Git submodule

```
git submodule add https://github.com/getkirby/layouts.git site/plugins/layouts
```

### Composer

```
composer require getkirby/layouts
```

## How it works

You can create full HTML layouts in a new `/site/layouts` folder. Layouts can define slots, which will then be filled with content by templates. Layouts are based on our new snippets with slots and work exactly the same way. The only difference is the folder location. You can learn more about our snippets with slots in our docs: http://getkirby.test/docs/guide/templates/snippets#passing-slots-to-snippets

#### /site/layouts/default.php

```html
<html>
	<head>
		<title><?= $page->title() ?></title>
	</head>
	<body>
		<?= $slot ?>
	</body>
</html>
```

#### /site/templates/my-template.php

```html
<?php layout() ?>

<h1>Hello world</h1>
<p>This will end up in the default slot</p>
```

### Choosing a layout

To use a specific layout, you can pass its name to the `layout()` method.

#### /site/layouts/blog.php

```html
<html>
	<head>
		<title>Blog</title>
	</head>
	<body>
		<h1>Blog</h1>
		<?= $slot ?>
	</body>
</html>
```

#### /site/templates/blog.php

```html
<?php layout('blog') ?>

<!-- some articles -->
```

## Working with slots

You can add as many different slots to your layout as you need. The default slot goes without a specific name. Every other slot needs a unique name. Slots in layouts can define default content, which will be rendered if the slot is not used in the template.

Read more: http://getkirby.test/docs/guide/templates/snippets#passing-slots-to-snippets

## What’s Kirby?

- **[getkirby.com](https://getkirby.com)** – Get to know the CMS.
- **[Try it](https://getkirby.com/try)** – Take a test ride with our online demo. Or download one of our kits to get started.
- **[Documentation](https://getkirby.com/docs/guide)** – Read the official guide, reference and cookbook recipes.
- **[Issues](https://github.com/getkirby/kirby/issues)** – Report bugs and other problems.
- **[Feedback](https://feedback.getkirby.com)** – You have an idea for Kirby? Share it.
- **[Forum](https://forum.getkirby.com)** – Whenever you get stuck, don't hesitate to reach out for questions and support.
- **[Discord](https://chat.getkirby.com)** – Hang out and meet the community.
- **[Mastodon](https://mastodon.social/@getkirby)** – Spread the word.
- **[Instagram](https://www.instagram.com/getkirby/)** – Share your creations: #madewithkirby.

---

## License

MIT

## Credits

- [Kirby Team](https://getkirby.com)
