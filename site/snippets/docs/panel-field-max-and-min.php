## Max and min length

You can control the max and/or min length of the entered text by using the validate option. By adding the validators, a handy indicator of the current text length will be displayed in the upper right corner.

```yaml
fields:
  name:
    label: Name
    type: <?= $field . PHP_EOL ?>
    minlength: 10
    maxlength: 1000
```
