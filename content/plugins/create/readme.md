# Kirby {{ plugin.name }} plugin

{{ plugin.description }}

## Installation

### Download

Download and copy this repository to `/site/plugins/{{ plugin.slug }}`.

### Git submodule

```
git submodule add https://github.com/{{ plugin.id }}.git site/plugins/{{ plugin.slug }}
```

### Composer

```
composer require {{ plugin.id }}
```

## Setup

<!-- Additional instructions on how to configure the plugin (e.g. blueprint setup, config options, etc.) -->

## Options

<!-- Document the options and APIs that this plugin offers -->

## Development

<!-- Add instructions on how to help working on the plugin (e.g. npm setup, Composer dev dependencies, etc.) -->

## License

{{ plugin.license }}

## Credits

- [{{ author.name }}]({{ author.homepage }})
