| Parameter | Type | Required | Description |
| - | - | - | - |
| `code` | `string` | ✓ | Needs to be a unique language code (i.e. de, fr, ch, etc.) |
| `name` | `string` | × | If not passed, the code will be used as name |
| `locale` | `string` | × | PHP locale string |
| `direction` | `string` | × | "ltr" or "rtl". "ltr" will be used as default. |
| `url` | `string` | × | Custom Url path setting for the language. If not set, the language code will be used as Url path. |
