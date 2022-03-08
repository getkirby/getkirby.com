<?php

namespace Newstroll;

class Subscriptions
{
    public Newstroll $client;

    public function __construct(Newstroll $client)
    {
        $this->client = $client;
    }

    public function create(
        string $email,
        int $group,
        string $status = 'pending',
        array $personalizations = [],
        bool $sendMail = true
    ): array
    {
        return $this->client->post('subscription', array_merge($personalizations, [
            'email'     => $email,
            'groups_id' => $group,
            'status'    => $status,
            'sendMail'  => $sendMail
        ]));
    }

    public function delete(string $id): ?array
    {
        return $this->client->delete('subscription/' . $id);
    }

    public function get(string $id): array
    {
        return $this->client->get('subscription/' . $id);
    }

    public function list(
        int $offset = 0,
        int $limit = 1000,
        string $status = null,
        int $group = null,
        string $email = null
    ): array
    {
        return $this->client->get('subscription', [
            'offset'    => $offset,
            'limit'     => $limit,
            'status'    => $status,
            'groups_id' => $group,
            'email'     => $email
        ]);
    }

    public function update(
        string $id,
        string $status = null,
        array $personalizations = [],
        string $surname = null
    ): array
    {
        return $this->client->put('subscription/' . $id, array_merge($personalizations, [
            'status'  => $status,
            'surname' => $surname
        ]));
    }
}
