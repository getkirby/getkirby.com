<?php

namespace Newstroll;

class Groups
{
    public Newstroll $client;

    public function __construct(Newstroll $client)
    {
        $this->client = $client;
    }

    public function list(
        string $title = null
    ): array
    {
        return $this->client->get('group', [
            'title' => $title
        ]);
    }
}
