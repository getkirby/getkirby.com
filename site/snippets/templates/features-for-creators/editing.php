<?php

snippet('templates/features/section', [
	'id'    => 'editing',
	'title' => 'Next level editing',
	'intro' => 'Write with style, stay in style',
	'text'  => 'Structure your content like never before.',
	'figure' => 'templates/features-for-creators/editing-figure',
	'voice' => 'brendan-dawes',
	'features' => [
		[
			'title' => 'Writing',
			'text' => 'You will love the flexibility and intuitive features of our blocks field. Write without distraction and add formatting you can trust. The result will be clean, accessible and polished for any medium.',
			'link' => '/docs/reference/panel/fields/blocks'
		],
		[
			'title' => 'Auto-saving',
			'text' => 'Don’t worry about unsaved changes. The Panel stores them for you automatically – even when you go offline – and you can save them later.'
		],
		[
			'title' => 'Extensible',
			'text' => 'Add new block types: You need a call-to-action button, product previews or a table block? No problem! Let your content shine with powerful custom block plugins.',
			'link' => '/docs/reference/panel/fields/blocks#custom-block-types'
		],
		[
			'title' => 'Full control',
			'text' => 'While you are focusing on content editing, designers and developers can take over from there and fully control the markup and design for each block type. Nothing happens by accident and all content stays structured.'
		],
	]
]);
