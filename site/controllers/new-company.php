<?php

function customerSubscribe(string $email, bool $hasNewsletter): bool
{
    try {
        newstroll()->subscriptions()->create(
            $email,
            option('newstroll.list'),
            $hasNewsletter ? 'confirmed' : 'pending'
        );
        return true;
    } catch (Throwable $e) {
        return false;
    }
}

function customerTransfer(string $email, string $hash, bool $hasData, bool $hasNewsletter): bool
{
    $response = Remote::post(option('hub.url') . '/consent', [
        'data' => [
            'email'         => $email,
            'hasData'       => $hasData,
            'hasNewsletter' => $hasNewsletter,
            'hash'          => $hash,
        ]
    ]);

    return $response->code() === 200;
}

function customerVerify(string $email, string $hash, bool $hasData, bool $hasNewsletter): bool
{
    $data = [
        'email'         => $email,
        'hasData'       => $hasData,
        'hasNewsletter' => $hasNewsletter
    ];

    $query    = http_build_query($data);
    $checksum = hash_hmac('sha256', $query, option('hub.key'));

    if ($email && $hash && $hash === $checksum) {
        return true;
    }

    return false;
}


return function ($page) {
    $email         = (string)get('email');
    $hash          = (string)get('hash');
    $hasData       = (bool)get('hasData');
    $hasNewsletter = (bool)get('hasNewsletter');
    $error         = [];

    if (customerVerify($email, $hash, $hasData, $hasNewsletter) === false) {
        $email = $hash = $hasData = $hasNewsletter = false;
    }

    // submit the form
    if ($email !== false && kirby()->request()->is('POST')) {
        if (get('data') === 'transfer' && $hasData === true) {
            if (customerTransfer($email, $hash, $hasData, $hasNewsletter) === false) {
                $error[] = 'Your agreement could not be saved';
            }
        }

        if (get('newsletter') === 'subscribe') {
            if (customerSubscribe($email, $hasNewsletter) === false) {
                $error[] = 'Your subscription could not be confirmed';
            }
        }

        if (empty($error) === true) {
            go($page->url() . '?thank=you');
        }
    }

    return [
        'email'         => $email,
        'error'         => $error,
        'hash'          => $hash,
        'hasData'       => $hasData,
        'hasNewsletter' => $hasNewsletter,
    ];
};
