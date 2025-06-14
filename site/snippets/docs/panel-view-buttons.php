<since v="5.0.0">
## View buttons

Kirby allows you to define what buttons to use for this <?= $field ?>. To select which (default) buttons to show on a particular view you can set the `buttons` option in the corresponding blueprint:

```yml
buttons:
  settings: true
```

By setting the value to `true`, you can reference existing buttons (from the (link: docs/reference/system/options/panel/panel-view-buttons#referencing-buttons text: core or `config.php` file) or even (link: docs/reference/plugins/extensions/panel-view-buttons text: Panel area plugin extensions)) by name and decide which ones to include and in what order.

### Create a new button

You can now also define your own custom buttons directly in a blueprint:

```yml
buttons:
  settings: true
  social:
    icon: mastodon
    text: Mastodon
    link: "https://mastodon.social/@getkirby"
    theme: purple-icon
```

The available options are based on the (link: https://lab.getkirby.com/public/lab/docs/k-view-button text: `k-view-button` component). Check out the (link: docs/reference/system/options/panel/panel-view-buttons text: config option documentation) for more details, e.g. in regard to available attributes or query support.

### Disable all buttons

```yml
buttons: false
```
</since>