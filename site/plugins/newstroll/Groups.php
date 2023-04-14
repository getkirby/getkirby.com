<?php

namespace Newstroll;

class Groups
{
    public function __construct(public Newstroll $client)
    {
    }

    public function list(string $title = null): array
    {
        return $this->client->get('group', ['title' => $title]);
    }
}
