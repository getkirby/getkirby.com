<?php

namespace Kirby\Archive;

use Exception;

/**
 * Runs the site on PHP's built-in web server
 * with several workers
 */
class Server
{
	/**
	 * @var resource|null
	 */
	protected $process = null;

	public function __construct(
		protected string $root,
		protected string $router,
		protected int $workers = 8
	) {
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

		$this->process = proc_open(
			[PHP_BINARY, '-d', 'opcache.enable_cli=1', '-S', $host, $this->router],
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
