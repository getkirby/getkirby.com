<?php

$groups = $groups->toArray(function ($group) use ($headingLevel) {
	return trim(
		snippet(
			name: 'templates/reference/group.md',
			data: [
				'headingLevel' => $headingLevel ?? 2,
				'group'        => $group,
			],
			return: true
		)
	);
});

echo implode(markdownHorizontalRule(), $groups);
