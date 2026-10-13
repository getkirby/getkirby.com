![Kirby Karbon](.github/karbon-banner.png)

<h1 align="center">Kirby Karbon</h1>
<p align="center">Serves a carbon.txt for your Kirby site, editable in the Panel.</p>

Editors keep the data in the Panel. The plugin turns it into a valid carbon.txt (syntax version 0.5) at `/carbon.txt` and `/.well-known/carbon.txt`.

carbon.txt is a small, machine-readable file that points to your organisation's sustainability disclosures and lists the providers your site runs on. Tools such as the [Green Web Foundation](https://www.thegreenwebfoundation.org) read it to verify green hosting claims.

## Installation

### Composer

```bash
composer require lex-zander/kirby-karbon
```

### Manual

Download the plugin and copy it to `site/plugins/karbon`.

## Setup

Add the plugin's tab to your site blueprint, `site/blueprints/site.yml`:

```yaml
tabs:
  content:
    # your existing tab(s)
  carbontxt: tabs/karbon
```

The Panel then shows a **carbon.txt** tab on the site page with these fields:

| Field | Written to carbon.txt as | Notes |
| --- | --- | --- |
| Last updated | `last_updated` | Read-only. Set automatically, see below. |
| Disclosures | `[org] disclosures` | Document type and URL are required. Domain, valid until and title are optional. |
| Upstream services | `[upstream] services` | Domain is required. Service type is optional and can have several values. |

## Output

With a few entries, `/carbon.txt` looks like this:

```toml
version = "0.5"
last_updated = 2026-09-27

[org]
disclosures = [
	{ doc_type = "web-page", url = "https://example.com/sustainability", domain = "example.com" },
	{ doc_type = "annual-report", url = "https://example.com/emissions-2025.pdf", valid_until = 2026-12-31, title = "Emissions Report 2025" }
]

[upstream]
services = [
	{ domain = "hetzner.com", service_type = ["virtual-private-servers", "object-storage"] }
]
```

You can check the result with the [carbon.txt validator](https://carbontxt.org/tools/validator).

## How it behaves

- **Last updated** is set to the current date whenever the disclosures or upstream services change. Other edits on the site page don't touch it. Until the carbon.txt data is saved for the first time, the field is empty and `last_updated` is left out of the file.
- **Incomplete entries are skipped** instead of producing an invalid file. A disclosure needs a document type and an absolute `http://` or `https://` URL. A service needs a domain.
- **Domains are cleaned up.** `https://www.example.com/path` becomes `www.example.com`, as the spec expects a domain without protocol or path.
- **Invalid dates are left out.** A `valid_until` that isn't a real date is dropped rather than written as a wrong one.
- **Multi-language sites:** the fields are not translatable. carbon.txt describes the organisation, not a language version, so it's the same for every language. Edit it in the default language.

## Good to know

- **A physical `carbon.txt` wins.** If a file named `carbon.txt` exists in your web root, your web server delivers it directly and the plugin's route is never reached. Delete the file to use the plugin.
- **`/.well-known/` on nginx:** some nginx configurations block all paths that start with a dot. If `/.well-known/carbon.txt` returns a 403 or 404, allow `.well-known` in your server config, or use `/carbon.txt`.
- **Panel languages:** the Panel labels are translated into English and German. Other Panel languages currently show the raw translation keys.

## Support

Kirby Karbon is free. If it's useful to you, you can support its development on [Ko-fi](https://ko-fi.com/axelzander).

## License

[MIT](LICENSE.md)
