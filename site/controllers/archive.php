<?php

return function ($kirby) {

    return [
        'versions' => array_filter($kirby->option('versions'), fn ($item) => $item['hasDocs'] ?? null === true),
    ];

};
