<?php

namespace Newstroll;

use Exception;
use Kirby\Exception\NotFoundException;
use Kirby\Http\Remote;

class Newstroll
{
    public string $url = 'https://api.newstroll.de';
    public string $key;

    public function __construct(string $key)
    {
        $this->key = $key;
    }

    public function delete(string $path, array $data = []): ?array
    {
        return $this->request($path, [
            'method' => 'DELETE',
            'data'   => $data
        ]);
    }

    public function get(string $path, array $data = []): array
    {
        if (empty($data) === false) {
            $path = $path . '?' . http_build_query($data);
        }

        return $this->request($path, [
            'method' => 'GET',
        ]);
    }

    public function groups()
    {
        return new Groups($this);
    }

    public function post(string $path, array $data = []): array
    {
        return $this->request($path, [
            'method' => 'POST',
            'data'   => $data
        ]);
    }

    public function put(string $path, array $data = []): array
    {
        return $this->request($path, [
            'method' => 'PUT',
            'data'   => $data
        ]);
    }

    public function request(string $path, array $params = []): ?array
    {
        $response = Remote::request($this->url . '/' . $path, array_merge(
            [
                'ca' => Remote::CA_SYSTEM,
                'headers' => [
                    'Authorization: Bearer ' . $this->key
                ]
            ],
            $params
        ));

        switch ($response->code()) {
            case 404:
                throw new Exception('The entry could not be found');
            case 422:
                throw new Exception('Email is blacklisted or not valid');
            case 500:
                throw new Exception('Unable to process request');
        }

        return $response->json();
    }

    public function subscriptions()
    {
        return new Subscriptions($this);
    }

}
