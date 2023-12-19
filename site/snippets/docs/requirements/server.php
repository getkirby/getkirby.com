- (link: https://httpd.apache.org/ text: Apache 2)
- (link: https://www.nginx.com/ text: Nginx)
- (link: https://www.litespeedtech.com/products/litespeed-web-server text: LiteSpeed)
- (link: https://caddyserver.com/ text: Caddy)
- (link: https://www.php.net/manual/en/features.commandline.webserver.php text: PHP Server)

If you want to use PHP's built-in server, you have to start it up with Kirby's router:

```php
php -S localhost:8000 kirby/router.php
```

Other servers (link: docs/reference/system/options/servers text: may work), but are not officially supported.
