Apache works out of the box. For nginx and Caddy, see our (link: docs/guide/quickstart#web-server-configuration text: config examples). (link: docs/cookbook/development-deployment/ddev text: DDEV) works with our Cookbook recipe. Other servers can be used by advanced users.

If you want to use PHP's built-in server, you have to start it up with Kirby's router:

```php
php -S localhost:8000 kirby/router.php
```
