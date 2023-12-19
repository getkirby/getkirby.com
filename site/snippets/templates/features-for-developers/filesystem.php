<?php

snippet('templates/features/section', [
	'id' => 'files-and-folders',
	'title' => 'At the core: Files & Folders',
	'intro' => 'A rock-solid, yet simple foundation',
	'text'  => 'Stay in control of your data. Kirby stores your data in files and folders. Universally accessible on all operating systems and editable with any text editor.',
	'figure' => 'templates/features-for-developers/filesystem-figure',
	'voice' => 'andy-bell',
	'features' => [
		[
			'title' => 'Fast',
			'text' => 'The file system is much faster than you might think. Most often even way faster than a database. With SSD drives on your server you get a system that can fly.'
		],
		[
			'title' => 'Resilient',
			'text' => 'Files and folders are probably the most future-proof way of storing your data. Think version control via Git, simple backup options and syncing via tools like rsync.'
		],
		[
			'title' => 'Extensible',
			'text' => 'Combine our flat-file system with databases, APIs or even data from a simple Excel spreadsheet. Kirby handles it all.'
		],
	]
]);
