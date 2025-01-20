# Kirby Discord plugin

A simple wrapper to send Discord channel webhooks

## Installation

### Download

Download and copy this repository to `/site/plugins/discord`.

### Composer

```
composer require getkirby/discord
```

### Git submodule

```
git submodule add https://github.com/getkirby/discord.git site/plugins/discord
```

## How it works?

You need to setup a webhook for your channel on Discord first.

1. Click on the "Edit Channel" icon right next to the channel name in the sidebar
2. Go to "Integrations"
3. Go to "Webhooks"
4. Create a new webhook
5. Copy the webhook URL

```php
use Kirby\Discord\Discord;

Discord::submit(
  webhook: 'https://discord.com/api/webhooks/xxx/xxx',
  username: 'kirbybot',
  avatar: 'https://example.com/avatar.jpg',
  title: '🔥 Message Title',
  color: '#ebc747',
  description: 'Here goes some nice text',
  author: [
    'name' => 'Ron Swanson',
    'url'  => 'https://example.com',
    'icon' => 'https://example.com/someicon.png'
  ],
  fields: [
    [
      'name'  => 'This is a custom field',
      'value' => 'Add any value here'
    ],
    [
      'name'  => 'This is another one',
      'value' => 'https://canbeanurl.com'
    ],
  ],
  footer: 'Some text for the footer'
);
```

Check out this awesome webhook embed visualizer https://leovoel.github.io/embed-visualizer/ to get an idea what each parameter does. 

> [!IMPORTANT]
> Make sure to keep your webhook URL private. It's recommended to put it into a custom domain config that is not checked into git or store it in an ENV variable.

```php
// site/config/config.mydomain.com.php
return [
  'discord' [
    'mywebhook' => 'https://discord.com/api/webhooks/xxx/xxx'
  ]
];
```

Add the custom domain config to your .gitignore and install it manually on your server.

Access the webhook URL:
```php
Discord::submit(
  webhook: option('discord.mywebhook'),
  // see additional params above
);
```

## What’s Kirby?

- **[getkirby.com](https://getkirby.com)** – Get to know the CMS.
- **[Try it](https://getkirby.com/try)** – Take a test ride with our online demo. Or download one of our kits to get started.
- **[Documentation](https://getkirby.com/docs/guide)** – Read the official guide, reference and cookbook recipes.
- **[Issues](https://github.com/getkirby/kirby/issues)** – Report bugs and other problems.
- **[Feedback](https://feedback.getkirby.com)** – You have an idea for Kirby? Share it.
- **[Forum](https://forum.getkirby.com)** – Whenever you get stuck, don't hesitate to reach out for questions and support.
- **[Discord](https://chat.getkirby.com)** – Hang out and meet the community.
- **[Mastodon](https://mastodon.social/@getkirby)** – Follow us in the Fediverse.
- **[Bluesky](https://bsky.app/profile/getkirby.com)** – Follow us on Bluesky.
- **[Instagram](https://www.instagram.com/getkirby/)** – Share your creations: #madewithkirby.

---

## License

MIT

## Credits

- [Kirby Team](https://getkirby.com)
