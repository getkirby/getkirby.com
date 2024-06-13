Apache works out of the box. (link: docs/cookbook/development-deployment/nginx text: nginx), (link: docs/cookbook/development-deployment/caddy text: Caddy) and (link: docs/cookbook/development-deployment/ddev text: DDEV) work with our Cookbook recipes. Other servers can be used by advanced users.

If you want to use PHP's built-in server, you have to start it up with Kirby's router:

```php
php -S localhost:8000 kirby/router.php
```
