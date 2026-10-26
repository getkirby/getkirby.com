<?php

namespace Kirby\Archive;

use Exception;
use Kirby\Toolkit\Str;

/**
 * Runs the site on PHP's built-in web server
 * with several workers
 */
class Server
{
	/**
	 * Prints the paths of all pages except separators,
	 * which get random slugs; the constants from the
	 * site's `index.php` are needed to load it
	 */
	protected const PAGES = <<<'PHP'
		preg_match_all('!define\(\'(\w+)\', (true|false)\)!', file_get_contents('index.php'), $constants, PREG_SET_ORDER);

		foreach ($constants as [, $name, $value]) {
			define($name, $value === 'true');
		}

		require 'kirby/bootstrap.php';

		foreach ((new Kirby())->site()->index() as $page) {
			if ($page->intendedTemplate()->name() !== 'separator') {
				echo '/' . $page->uri() . PHP_EOL;
			}
		}
		PHP;

	/**
	 * @var resource|null
	 */
	protected $process = null;

	public function __construct(
		protected string $root,
		protected string $router,
		protected int $workers = 8,
		protected string $php = PHP_BINARY
	) {
	}

	/**
	 * Returns the paths of all pages of the site,
	 * listed with the PHP binary of the server
	 */
	public function pages(): array
	{
		$process = proc_open(
			[$this->php, '-d', 'pcre.jit=0', '-r', static::PAGES],
			[1 => ['pipe', 'w']],
			$pipes,
			$this->root
		);

		$output = stream_get_contents($pipes[1]);

		if (proc_close($process) !== 0) {
			throw new Exception('The pages of the site could not be listed: ' . trim($output));
		}

		return Str::split($output, "\n");
	}

	/**
	 * Starts the server on a free port
	 * and returns its origin
	 */
	public function start(): string
	{
		$socket = stream_socket_server('tcp://127.0.0.1:0');
		$host   = stream_socket_get_name($socket, false);
		fclose($socket);

		// some PHP builds fail to allocate memory for PCRE's
		// JIT and print a warning into the pages (e.g. PHP 8.0
		// in Herd on macOS)
		$this->process = proc_open(
			[$this->php, '-d', 'opcache.enable_cli=1', '-d', 'pcre.jit=0', '-S', $host, $this->router],
			[1 => ['file', '/dev/null', 'w'], 2 => ['file', '/dev/null', 'w']],
			$pipes,
			$this->root,
			[...getenv(), 'PHP_CLI_SERVER_WORKERS' => (string)$this->workers]
		);

		// wait until the server accepts connections
		for ($i = 0; $i < 100; $i++) {
			if ($connection = @stream_socket_client('tcp://' . $host)) {
				fclose($connection);
				return 'http://' . $host;
			}

			usleep(100000);
		}

		$this->stop();

		throw new Exception('The PHP server could not be started');
	}

	public function stop(): void
	{
		if ($this->process === null) {
			return;
		}

		// the workers would outlive the main process
		exec('pkill -TERM -P ' . proc_get_status($this->process)['pid']);

		proc_terminate($this->process);
		proc_close($this->process);

		$this->process = null;
	}
}
