<?php

namespace Kirby\Github;

use Generator;
use Goedemiddag\LinkHeaderParser\LinkHeaderFactory;
use InvalidArgumentException;
use Kirby\Exception\Exception;
use Kirby\Http\Remote;
use Kirby\Http\Url;

@include_once __DIR__ . '/vendor/autoload.php';

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
		return static::requestRaw(
			'https://api.github.com/repos/' . Url::path($repo) . '/' . $endpoint,
			$method,
			$payload
		);
	}

	public static function requestCollection(
		string $repo,
		string $endpoint
	): Generator {
		// start with a plain direct request
		$url = 'https://api.github.com/repos/' . Url::path($repo) . '/' . $endpoint;

		// follow `next` pagination links from the responses until we have reached the end
		do {
			$response = static::requestRaw($url);

			// provide each item to the calling method via `Generator`
			foreach ($response->json() as $item) {
				yield $item;
			}

			// extract the next pagination page if there is one
			$links = LinkHeaderFactory::fromHeader($response->headers()['link'] ?? '');
			$url   = $links->getLink('next')?->uri;
		} while ($url !== null);
	}

	public static function requestRaw(
		string $url,
		string $method = 'get',
		array $payload = []
	): Remote {
		$key = option('keys.github') ?: getenv('GITHUB_TOKEN');

		if ($key === null || $key === '') {
			throw new InvalidArgumentException('Missing GitHub API token');
		}

		$headers = [
			'Authorization'        => 'token ' . $key,
			'User-Agent'           => 'Kirby',
			'Accept'               => 'application/vnd.github+json',
			'X-GitHub-Api-Version' => '2022-11-28'
		];

		return Remote::$method(
			$url,
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
