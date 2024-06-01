<?php

return [
	/**
	 * Checks whether the page is the current page in a menu context,
	 * considering redirects to other pages
	 */
	'isActiveInMenu' => function (bool $hasSubmenu = false) {
		$currentPage = $this->site()->page();

		// catch cases where the menu URL points to a child
		// to avoid marking both the ancestor and child as active
		if ($hasSubmenu === true && $this->isAncestorOf($currentPage) === true) {
			return false;
		}

		// otherwise use the menu URL for the comparison
		return $this->menuUrl() === $this->site()->page()?->url();
	},

	/**
	 * Final URL after redirects to be used in menus;
	 * fallback if the page model doesn't override it
	 */
	'menuUrl' => fn () => $this->url()
];
