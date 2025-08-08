<?php

foreach ($sections->unlisted() as $section) {
	echo markdownHeading($section->title(), $headingLevel ?? 3);

	foreach ($section->children()->listed() as $class) {
		echo '- ' . markdownLink($class->reflection()->name(), $class->markdownUrl()) . PHP_EOL;
	}

	echo PHP_EOL;
}
