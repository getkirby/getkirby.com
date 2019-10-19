## Pagination
<since v="3.3.0">

Options in the <?= $field ?> picker are paginated. You can set the number of items per pagination page in the picker using the `limit` property. The default setting is `20`.

```yaml
fields:
  <?= $field ?>:
    type: <?= $field . PHP_EOL ?>
    label: Select an item
    limit: 10
```
</since>
