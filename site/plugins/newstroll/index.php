<?php

load([
    'Newstroll\\Groups'        => __DIR__ . '/Groups.php',
    'Newstroll\\Newstroll'     => __DIR__ . '/Newstroll.php',
    'Newstroll\\Subscriptions' => __DIR__ . '/Subscriptions.php'
]);

function newstroll()
{
    return new Newstroll\Newstroll(option('newstroll.key'));
}

