### Columns

Specifying the `column` option lets you change the number of option items that are displayed per row in the panel (1 till 5, default: 2).

```yaml
fields:
  category:
	label: Category
	type: <?= $field . PHP_EOL ?>
	options: children
	columns: 3
```
