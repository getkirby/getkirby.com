# Kirby OAuth

Kirby’s OAuth plugin makes it easy to authenticate users via third party platforms such as Github.

## Supported providers

So far, the plugin only supports Github as OAuth provider. More providers can follow later.

## Installation

### Download

Download and copy this repository to `/site/plugins/oauth`.

### Git submodule

```
git submodule add https://github.com/getkirby/oauth.git site/plugins/oauth
```

### Composer

```
composer require getkirby/oauth
```

## Setup

### Configuration

You need to register an OAuth application on Github first before you can use the plugin.

Once your Github OAuth app is created, Github will provide you with a client ID and a client secret. Those need to be added to your config file.

#### Security

We don't recommend to store your Github app credentials directly in the main config. Instead you can use a domain-specific config, which is only loaded on your server. This config file should be ignored and not added to your Github repo. Otherwise your keys will be exposed.

```php "/site/config/config.yourdomain.com.php"
<?php

return [
	'oauth.github.clientId' => 'xxx',
	'oauth.github.clientSecret' => 'xxx',
];
```

Add the domain specific config to your gitignore …

``` ".gitignore"
/site/config/config.yourdomain.com.php
```

### Routes

The OAuth class can be used in many different ways. Here's an example how to setup a simple login and logout for your frontend.

```php "/site/config/config.php"
<?php

return [
	'routes' => [
		[
			'pattern' => 'oauth/login',
			'action'  => function () {
				$oauth = new Oauth();
				$oauth->login();

				go('/');
			}
		],
		[
			'pattern' => 'oauth/logout',
			'action'  => function () {
				$oauth = new Oauth();
				$oauth->logout();

				go('/');
			}
		],
	]
```

### In your templates

```php
<?php if ($oauth->isLoggedIn()) : ?>
	<?php dump($oauth->user()) ?>
	<a href="<?= url('oauth/logout') ?>">Logout</a>
<?php else : ?>
	<a href="<?= url('oauth/login') ?>">Login with Github</a>
<?php endif ?>
```

## License

MIT

## What's Kirby?

- **[getkirby.com](https://getkirby.com)** – Get to know the CMS.
- **[Try it](https://getkirby.com/try)** – Take a test ride with our online demo. Or download one of our kits to get started.
- **[Documentation](https://getkirby.com/docs/guide)** – Read the official guide, reference and cookbook recipes.
- **[Issues](https://github.com/getkirby/kirby/issues)** – Report bugs and other problems.
- **[Feedback](https://feedback.getkirby.com)** – You have an idea for Kirby? Share it.
- **[Forum](https://forum.getkirby.com)** – Whenever you get stuck, don't hesitate to reach out for questions and support.
- **[Discord](https://chat.getkirby.com)** – Hang out and meet the community.
- **[YouTube](https://youtube.com/kirbyCasts)** - Watch the latest video tutorials visually with Bastian.
- **[Twitter](https://twitter.com/getkirby)** – Spread the word.
- **[Instagram](https://www.instagram.com/getkirby/)** – Share your creations: #madewithkirby.

---

© 2009-2022 Bastian Allgeier
[getkirby.com](https://getkirby.com) · [License agreement](./LICENSE.md)
