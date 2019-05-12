## The `$props` parameter

Property | Type | Required | Description |
--|--|--|--|
`blueprint` | `array` | <code></code> | Blueprint definition |
`content` | `array` | <code></code> | Field values |
`dirname` | `string` | <code></code> |  |
`draft` | `bool` | <code></code> | If `true`, the page will be created as draft |
`model` | `string` | <code></code> | Page model |
`num` | `mixed` | <code></code> | Sorting number. `null` for unlisted pages. |
`parent` | <a href="<?= referenceLookup('Kirby\Cms\Page')->url() ?>">`Kirby\Cms\Page`</a> | <code></code> | Parent page |
`root` | `string` | <code></code> |  |
`slug` | `string` | `required` |  |
`template` | `string` | <code></code> |  |
`translations` | `array` | <code></code> | Language codes with subarrays of field values |
`url` | `string` | <code></code> |  |
