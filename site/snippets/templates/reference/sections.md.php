<?php

$sections = $sections->filter(function ($section) {
	return $section->children()->listed()->count() > 0 && $section->id() !== 'docs/reference/panel/samples';
});

$html = $sections->toArray(function ($section) use ($headingLevel) {
	if ($section->intendedTemplate()->name() === 'reference-quicklink') {
		$section = $section->link()->toPage();
	}

	return trim(
		snippet(
			name: [
				'templates/reference/section/' . $section->slug() . '.md',
				'templates/reference/section.md'
			],
			data: [
				'headingLevel' => $headingLevel ?? 3,
				'section'      => $section,
			],
			return: true
		)
	);
});

echo implode(markdownBreak(), $html);

