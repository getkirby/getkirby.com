<?php

use Kirby\Cms\Page;
use Kirby\Toolkit\Str;

class DefaultPage extends Page
{
	/**
	 * Checks whether the page is the current page in a menu context,
	 * considering redirects to other pages
	 */
	public function isActive(bool $hasSubmenu = false): bool
	{
		$currentPage = $this->site()->page();

		// catch cases where the menu URL points to a child
		// to avoid marking both the ancestor and child as active
		if ($hasSubmenu === true && $this->isAncestorOf($currentPage) === true) {
			return false;
		}

		// otherwise use the menu URL for the comparison
		return $this->menuUrl() === $currentPage?->menuUrl();
	}

	/**
	 * Checks whether the page is the current page or one of its ancestors
	 * in a menu context, considering redirects to other pages
	 */
	public function isOpen(): bool
	{
		$currentPage = $this->site()->page();

		if (Str::startsWith($currentPage?->menuUrl(), $this->menuUrl() . '/') === true) {
			return true;
		}

		return parent::isOpen();
	}

	/**
	 * URL for the Markdown version of the page
	 */
	public function markdownUrl(): string
	{
		try {
			$this->representation('md');
			return $this->menuUrl() . '.md';
		} catch (Exception $e) {
			return $this->menuUrl();
		}
	}

	/**
	 * Final URL after redirects to be used in menus;
	 * fallback if the page model doesn't override it
	 */
	public function menuUrl(): string
	{
		return $this->url();
	}
}
