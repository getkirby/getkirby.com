<?php

snippet('templates/plugins/section', [
	'id'      => 'search',
	'icon'    => 'search',
	'title'   => 'Search',
	'layout'  => 'cards',
	'columns' => 2,
	'plugins' => $plugins->filter('subcategory', '')->pluck('id')
]);
