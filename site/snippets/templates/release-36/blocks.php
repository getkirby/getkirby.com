<?php

snippet('templates/features/section', [
	'id'       => 'blocks',
	'title'    => 'Blocks',
	'intro'    => 'Now even more awesome',
	'text'     => 'The blocks field we introduced in Kirby 3.5 has lifted Kirby’s editing experience to another level. Now we are even taking it a step further.',
	'figure'   => 'templates/release-36/blocks-figure',
	'features' => [
		[
			'title' => 'Copy & Paste',
			'text' => 'It’s finally here! You can now copy and paste blocks between block and layout fields. Even HTML from websites, Word documents or other sources can be pasted to create beautiful, clean blocks.'
		],
		[
			'title' => 'Improved multi-select',
			'text'  => 'To copy multiple blocks, you can cmd+click or alt+click on all blocks you want to include in your selection. Delete them all at once or copy them with cmd+c or via the copy button.'
		],
		[
			'title' => 'New line block',
			'text' => 'The new line block supports and automatically imports <code>hr</code> blocks from the old Editor plugin and <code>hr</code> elements from pasted HTML.'
		],
		[
			'title' => 'Privacy friendly video block',
			'text' => 'The video block is now more privacy friendly as it creates embeds with the "do not track" option. No tracking in the Panel please!'
		],
	]
]);
