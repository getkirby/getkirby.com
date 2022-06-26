<?php

return [
    'discounts' => [
        5  => 5,
        10 => 10,
        15 => 15,
        // 20 => 20,
        // 25 => 25,
        // 50 => 30
    ],
    'product'        => 499826,
    'vendorAuthCode' => trim(F::read(__DIR__ . '/keys/paddle.txt')),
    'vendorId'       => 1129
];
