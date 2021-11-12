## Pagination
Options in the <?= $field ?> picker are paginated. You can set the number of items per pagination page in the picker using the `limit` property. The default setting is `20`.

```yaml
fields:
  <?= $field ?>:
    type: <?= $field . PHP_EOL ?>
    label: Select an item
    limit: 10
```


## Search
The <?= $field ?> picker shows a search field by default. If you want to remove it, you can switch it off with the `search` option:

```yaml
fields:
  <?= $field ?>:
    type: <?= $field . PHP_EOL ?>
    label: Select an item
    search: false
```
