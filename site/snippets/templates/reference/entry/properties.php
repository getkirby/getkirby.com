<?php

if ($page->properties()->isNotEmpty()) {
	$properties = $page->properties()->split('|');
	$name  = $properties[0];
	$class = $properties[1] ?? $page->class();

	if (isset($properties[2])) {
		$intro = 'The `' . $name . '` parameter is an array of `' . $class . '` objects or an array of arrays, where each array contains the properties to create a `' . $class . '` object. Pass the following data for each ' . $properties[2] . ':';
	} else {
		$intro = 'For the `' . $name . '` parameter, you pass an array with the following data, which will be used to set up the `' . $class . '` object:';
	}

	echo kirbytag('properties', $name, [
		'class' => $class,
		'intro' => $intro
	]);
}
