## Length restrictions

You can control the maximal and/or minimal length of the entered text by using the `maxlength` and/or `minlength` option. A handy indicator of the current text length will be displayed in the upper right corner.

```yaml
fields:
  name:
	label: Name
	type: <?= $field . PHP_EOL ?>
	minlength: 10
	maxlength: 1000
```
