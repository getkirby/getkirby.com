<?php

// fakes the parts of Kirby that `ServerTest::testPages()` needs,
// and only loads with the constants from the site's `index.php`
if (defined('KIRBY_HELPER_VIDEO') === false) {
	exit(1);
}

class Kirby
{
	public function index(): array
	{
		return [
			new Page('docs', 'docs'),
			new Page('docs/guide', 'guide'),
			new Page('docs/reference/objects/aBc', 'separator'),
		];
	}

	public function site(): static
	{
		return $this;
	}
}

class Page
{
	public function __construct(
		protected string $uri,
		protected string $template
	) {
	}

	public function intendedTemplate(): static
	{
		return $this;
	}

	public function name(): string
	{
		return $this->template;
	}

	public function uri(): string
	{
		return $this->uri;
	}
}
