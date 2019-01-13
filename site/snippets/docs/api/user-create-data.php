| Parameter | Type | Required | Description |
| - | - | - | - |
| `email` | `string` | ✓ | Needs to be a unique and valid email address |
| `password` | `string` | ✓ | The password must at least be 8 characters long. The more characters the better. |
| `role` | `string` | ✓ | The name of the role (i.e. "editor") |
| `language` | `string` | ✓ | The language code (i.e. "de") |
| `name` | `string` | × | Optional display name, which will be used in the panel |
| `content` | `array` | × | Additional content fields. Must be defined as key/value object |
