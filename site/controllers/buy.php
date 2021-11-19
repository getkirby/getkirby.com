<?php

use Kirby\Paddle\Checkout;

return function ($page) {
    $checkout = new Checkout();
    return [
        'banner'    => banner(),
        'discounts' => $checkout->discounts(),
        'product'   => $checkout->product(),
        'questions' => $page->find('answers')->children()
    ];
};
