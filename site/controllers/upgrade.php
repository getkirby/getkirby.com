<?php

return function($kirby, $page) {

  $error = null;

  if ($kirby->request()->is('post')) {

    $license  = get('key');
    $licenses = explode(PHP_EOL, F::read($kirby->root('config') . '/licenses.php'));
    $url      = null;
    $cache    = $kirby->root('site') . '/upgrades/' . sha1($license);

    if (file_exists($cache) === true) {
      return [
        'error' => 'The license has already been upgraded'
      ];
    }

    if (empty($license) === false && in_array($license, $licenses, true) === true) {
      $type  = Str::startsWith($license, 'K2-PRO') === true ? 'pro' : 'personal';
      $price = $type === 'pro' ? 0 : 59;
      $url   = Paddle::upgrade($price, $license);
      F::write($cache, $license);

    // PRO Upgrade before October 2017
    } elseif (Str::startsWith($license, 'K2-PRO') && Str::length($license) === 39) {
      $url = Paddle::upgrade(19);
      F::write($cache, $license);

      // Personal Upgrade before October 2017
    } elseif (Str::startsWith($license, 'K2-PERSONAL') && Str::length($license) === 44) {
      $url = Paddle::upgrade(79);
      F::write($cache, $license);

    }

    if ($url) {
      go($url);
    }

    $error = 'The license key cannot not be upgraded.';

  }

  return [
    'error' => $error
  ];

};
