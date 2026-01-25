<?php

namespace Newstroll;

class Subscriptions
{
	public function __construct(public Newstroll $client)
	{
	}

	public function create(
		string $email,
		int $group,
		string $status = 'pending',
		array $personalizations = [],
		bool $sendMail = true
	): array {
		return $this->client->post('subscription', [
			...$personalizations,
			'email'     => $email,
			'groups_id' => $group,
			'status'    => $status,
			'sendMail'  => $sendMail
		]);
	}

	public function delete(string $id): array|null
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
		string|null $status = null,
		int|null $group = null,
		string|null $email = null
	): array {
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
		string|null $status = null,
		array $personalizations = [],
		string|null $surname = null
	): array {
		return $this->client->put('subscription/' . $id, [
			...$personalizations,
			'status'  => $status,
			'surname' => $surname
		]);
	}
}
