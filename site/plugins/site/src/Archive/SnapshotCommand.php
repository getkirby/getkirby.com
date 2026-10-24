<?php

namespace Kirby\Archive;

use Exception;
use Kirby\CLI\CLI;
use Kirby\CLI\Command;
use Kirby\Filesystem\Dir;
use Kirby\Filesystem\F;
use Kirby\Toolkit\Str;

/**
 * `kirby archive:snapshot https://v5.getkirby.com`
 * on an archive branch with the `archived` option
 */
class SnapshotCommand extends Command
{
	public static function args(): array
	{
		return [
			'url' => [
				'description' => 'Public URL of the snapshot, e.g. https://v5.getkirby.com',
				'required'    => true
			],
			'include' => [
				'longPrefix'  => 'include',
				'description' => 'Only include pages in these comma-separated sections, e.g. `docs`'
			],
			'server' => [
				'longPrefix'  => 'server',
				'description' => 'Crawl an already running copy of the site, e.g. https://getkirby.test (default: start a PHP server)'
			],
			'urls' => [
				'longPrefix'  => 'urls',
				'description' => 'File with the paths or URLs to crawl, one per line (default: all pages of this site)'
			],
			'output' => [
				'longPrefix'  => 'output',
				'description' => 'Folder for the snapshot (default: `snapshot` in the site root)'
			],
			'fallback' => [
				'longPrefix'   => 'fallback',
				'description'  => 'Where paths that are not in the snapshot are looked up',
				'defaultValue' => 'https://getkirby.com'
			],
			'workers' => [
				'longPrefix'   => 'workers',
				'description'  => 'Number of pages rendered in parallel',
				'castTo'       => 'int',
				'defaultValue' => 8
			],
			'fresh' => [
				'longPrefix'  => 'fresh',
				'description' => 'Discard the previous crawl instead of resuming it',
				'noValue'     => true
			]
		];
	}

	public static function command(CLI $cli): void
	{
		$kirby = $cli->kirby();
		$root  = $cli->arg('output') ?: $kirby->root('index') . '/snapshot';
		$paths = null;

		if ($file = $cli->arg('urls')) {
			if (is_file($file) === false) {
				throw new Exception('The file ' . $file . ' does not exist');
			}

			$paths = Str::split(F::read($file), "\n");
		} elseif ($kirby->option('archived') !== true) {
			$cli->out('<yellow>The `archived` option is not enabled, the snapshot will contain the regular site.</yellow>');
		}

		if ($cli->arg('fresh') === true) {
			Dir::remove($root . '/public');
		}

		if ($origin = $cli->arg('server')) {
			$origin = rtrim($origin, '/');
		} else {
			$server = new Server(
				root: $kirby->root('index'),
				router: $kirby->root('kirby') . '/router.php',
				workers: $cli->arg('workers')
			);

			$origin = $server->start();
			register_shutdown_function($server->stop(...));
		}

		$snapshot = new Snapshot(
			url: rtrim($cli->arg('url'), '/'),
			root: $root,
			include: Str::split($cli->arg('include')),
			fallback: rtrim($cli->arg('fallback'), '/'),
			workers: $cli->arg('workers')
		);

		$start    = microtime(true);
		$drawn    = 0;
		$progress = $cli->progress();
		$cli->out('Crawling ' . $origin . ' …');

		$crawler = $snapshot->crawl($origin, $paths, function (int $done, int $queued) use ($progress, &$drawn) {
			// redraw at most ten times a second, but always at the end
			if ($queued > 0 && microtime(true) - $drawn < 0.1) {
				return;
			}

			$drawn = microtime(true);
			$total = $done + $queued;
			$progress->total($total)->current($done, $done . '/' . $total);
		});

		$report = $snapshot->write();

		$cli->success(count($crawler->results) . ' URLs crawled in ' . round(microtime(true) - $start) . 's');
		$cli->out('Static site: ' . $root . '/public (' . Dir::niceSize($root . '/public') . ')');
		$cli->out('nginx config: ' . $root . '/nginx.conf');
		$cli->out('Report: ' . $root . '/report.json');

		if ($report['errors'] !== []) {
			$cli->br();
			$cli->out('<red>' . count($report['errors']) . ' URLs failed:</red>');

			foreach (array_slice($report['errors'], 0, 10, true) as $url => $result) {
				$cli->out('- ' . $result['status'] . ' ' . $url . ' (linked from ' . ($result['from'] ?? '–') . ')');
			}
		}

		if ($report['unresolved'] !== []) {
			$cli->br();
			$cli->out(count($report['unresolved']) . ' linked paths are not in the snapshot and will be looked up on ' . $cli->arg('fallback') . ', e.g.:');

			foreach (array_slice($report['unresolved'], 0, 10, true) as $path => $count) {
				$cli->out('- ' . $path . ' (' . $count . '×)');
			}
		}
	}

	public static function description(): string|null
	{
		return 'Renders the site into a static snapshot for archived docs';
	}
}
