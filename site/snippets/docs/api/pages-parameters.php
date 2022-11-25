| Parameter | Example | Description |
| - | - | - |
| `limit`  | `?limit=5` | Limits the number of returned pages. |
| `offset` | `?offset=10` | Sets a manual offset. Use the page option together with limit for easier pagination. |
| `page`   | `?page=2` | Starts the collection at the given page. Only works when the limit is set. |
| `pretty` | `?pretty=true` | Pretty prints the result. Only useful for debugging. |
| `select` | `?select=id,title` | Defines the fields that will be returned for each page. |
| `status` | `?status=all` | Filters the pages by status (`all`, `listed`, `unlisted`, `published`, `draft`). |
