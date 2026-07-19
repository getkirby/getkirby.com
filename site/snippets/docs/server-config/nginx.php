nginx does not support `.htaccess` files, so Kirby's rewrite rules and security settings have to go into your nginx config. Create a new `server` block, e.g. in `nginx/conf.d/kirby.conf`:

```nginx "nginx/conf.d/kirby.conf"
server {
  listen 8080; # Can be omitted if nginx runs on port 80
  index index.php index.html;
  server_name localhost; # Adjust to your domain setup
  root /usr/share/nginx/html; # Adjust to your setup

  default_type text/plain;
  add_header X-Content-Type-Options nosniff;

  rewrite ^/(content|site|kirby)/(.*)$ /error last;
  rewrite /\.(?!well-known/) /error last;
  rewrite ^/(?!app\.webmanifest)[^/]+$ /index.php last;

  location / {
    try_files $uri $uri/ /index.php$is_args$args;
  }

  location ~* \.php$ {
    try_files $uri =404;
    fastcgi_pass php:9000; # Adjust to your setup
    include fastcgi.conf;
    fastcgi_split_path_info ^(.+\.php)(/.+)$;
    fastcgi_param PATH_INFO $fastcgi_path_info;
    fastcgi_param SERVER_PORT 8080; # Only needed if the external port differs from the listen port
  }
}
```

For a line-by-line explanation of this config and notes on TLS certificates, see our (link: docs/cookbook/development-deployment/nginx text: Kirby meets nginx) cookbook recipe.
