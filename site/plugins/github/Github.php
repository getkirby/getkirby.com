<?php

namespace Kirby\Github;

use InvalidArgumentException;
use Kirby\Exception\Exception;
use Kirby\Http\Remote;
use Kirby\Http\Url;

class Github
{
	public static function createBranch(
		string $repo,
		string $branch
	): Remote {
		$response = static::request($repo, 'git/refs', 'post', [
			'data' => json_encode([
				'ref' => $branch = 'refs/heads/' . $branch,
				'sha' => static::sha($repo)
			])
		]);

		if ($response->code() !== 200 && $response->code() !== 201) {
			throw new Exception('Failed to create branch');
		}

		return $response;
	}

	public static function createFile(
		string $repo,
		string $path,
		string $content,
		string $branch,
		string $commit
	): Remote {
		$response = static::request($repo, 'contents/' . $path, 'put', [
			'data' => json_encode([
				'message' => $commit,
				'branch'  => $branch,
				'content' => base64_encode($content)
			])
		]);

		if ($response->code() !== 200 && $response->code() !== 201) {
			throw new Exception('Failed to create file');
		}

		return $response;
	}

	public static function createPr(
		string $repo,
		string $branch,
		string $title,
	): Remote {
		$response = static::request($repo, 'pulls', 'post', [
			'data' => json_encode([
				'title'   => $title,
				'head'    => $branch,
				'base'    => 'main'
			])
		]);

		if ($response->code() !== 200 && $response->code() !== 201) {
			throw new Exception('Failed to create pull request');
		}

		return $response;
	}

	public static function release(string $repo): Remote
	{
		return static::request(
			$repo,
			'releases/latest'
		);
	}


	public static function request(
		string $repo,
		string $endpoint,
		string $method = 'get',
		array $payload = []
	): Remote {
		$key = option('keys.github') ?? $_ENV['GITHUB_TOKEN'];

		if ($key === null || $key === '') {
			throw new InvalidArgumentException('Missing GitHub API token');
		}

		$repo    = Url::path($repo);
		$headers = [
			'Authorization'        => 'token ' . $key,
			'User-Agent'           => 'Kirby',
			'Accept:'              => 'application/vnd.github+json',
			'X-GitHub-Api-Version' => '2022-11-28'
		];

		return Remote::$method(
			'https://api.github.com/repos/' . $repo . '/' . $endpoint,
			[
				'headers' => $headers,
				...$payload
			]
		);
	}

	protected static function sha(string $repo): string
	{
		$response = static::request($repo, 'git/refs/heads');
		return $response->json()[0]['object']['sha'];
	}
}
