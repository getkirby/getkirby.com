Caddy does not support `.htaccess` files, so Kirby's rewrite rules and security settings have to go into your `Caddyfile`. Caddy loads this file from the current directory, so run Caddy from the folder that contains it or pass the path with `caddy run --config /path/to/Caddyfile`:

```caddy "Caddyfile"
(common) {
	php_fastcgi php:9000 # Adjust to your setup
	file_server
	encode zstd gzip
}

(kirby) {
	@blocked {
		path /content/* /site/* /kirby/* /.*
	}
	error @blocked "Not found" 404
	handle_errors {
		rewrite * /error # This should reference your Kirby error page
		import common
	}
}

mydomain.com { # Adjust to your setup
	import common
	import kirby
	root * /usr/share/caddy # Adjust to your setup
	tls name@user.com # Adjust to your setup
}
```

For a line-by-line explanation of this config, see our (link: docs/cookbook/development-deployment/caddy text: Kirby meets Caddy) cookbook recipe.
