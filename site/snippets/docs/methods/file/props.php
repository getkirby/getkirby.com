## The `$props` parameter

Property       | Type     | Required      | Description |
--             | --       | --            | --          |
`blueprint`    | `array`  | <code></code> | Blueprint definition |
`content`      | `array`  | <code></code> | Field values |
`filename`     | `string` | <code></code> |  |
`parent`       | <a href="<?= referenceLookup('Kirby\Cms\Model')->url() ?>">`Kirby\Cms\Model`</a> | `required` | `$site`, `$page` or `$user` |
`root`         | `string` | <code></code> |  |
`source`       | `string` | `required` |  |
`template`     | `string` | <code></code> |  |
`translations` | `array`  | <code></code> | Language codes with subarrays of field values   |
`url`          | `string` | <code></code> |  |
