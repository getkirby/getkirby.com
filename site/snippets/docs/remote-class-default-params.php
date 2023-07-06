| Key | Type | Default | Description
| ---- | ---- | ---- | ----
| agent | `string` | `null` | The user agent string to be sent with the HTTP request
| basicAuth | `string` | `null` | User name and password to use for the `Authorization` header (formatted as `USERNAME:PASSWORD`)
| body | `bool` | `true` | When `true` returns transfer as string instead of outputting it directly
| ca | `int|bool|string` | `Remote::CA_INTERNAL` | TLS CA to use, (link: docs/reference/system/options/remote#configuring-the-list-of-allowed-certificate-authorities-cas-for-https-requests text: see details)
| data | `array|string` | `[]`  | The data to be sent with the request
| encoding | `string` | `utf-8` | Accepted values: `null`, `''`, `identity`, `gzip`, `br`
| file | `string` | `null` | Path to file to be uploaded
| headers | `array` | `[]` | Array of headers to be sent with the request
| method | `string` | `GET` | HTTP method (`GET`, `POST`, `PUT`, `PATCH`, `DELETE`, `HEAD`)
| progress | `callback` | `null` | A callback which accepts 5 parameters, if you want to handle upload/download progress
| test | `bool` | `false` | When set to `true`, the cURL request is not initiated, and the `Remote` object returned
| timeout | `int` | `10` | Request/connect timeout
