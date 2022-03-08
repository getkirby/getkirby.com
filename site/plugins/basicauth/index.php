<?php

Kirby::plugin('getkirby/basicauth', [
    'hooks' => [
        'route:before' => function () {
            $users = (array)option('basicauth.users', []);

            // skip authentication
            if (empty($users) === true) {
                return;
            }

            $validate = function () use ($users) {
                $auth = kirby()->request()->auth();

                if (!$auth) {
                    return false;
                }

                if (array_key_exists($auth->username(), $users) === false) {
                    return false;
                }

                return $users[$auth->username()] === $auth->password();
            };

            if ($validate() !== true) {
                header('WWW-Authenticate: Basic realm="Login"');
                header('HTTP/1.0 401 Unauthorized');
                die(option('basicauth.error', 'Unauthorized'));
            }
        }
    ]

]);
