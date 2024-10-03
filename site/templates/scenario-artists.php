<?php layout('scenarios') ?>

<?php
snippet('templates/features/section', [
	'id'    => 'art-1',
	'title' => 'Showcase your creativity like never before',
	'text'  => 'Kirby CMS makes it easy to create visually stunning and engaging websites for all types of creatives, including artists, musicians and filmmakers. Whether you\'re a gallery showcasing artwork, a musician launching an album, or a videographer sharing your portfolio, Kirby gives you the flexibility to showcase your work beautifully.',
	'figure' => [
		'image' => 'museum.png',
		'alt'   => 'A photo showing a crowded museum room',
	],
	'features' => [
		[
			'title' => 'Tailored to your medium',
			'text' => 'Kirby lets you create online spaces that showcase your unique style. Whether it\'s music, video or visual art, Kirby makes it easy to dynamically display your work.'
		],
		[
			'title' => 'Scale your platform',
			'text' => 'From small studios to large cultural institutions, Kirby\'s flexible system can handle any scale, whether it\'s a solo music portfolio or a museum-wide digital archive.',
		],
		[
			'title' => 'Simplified content management',
			'text' => 'Organize your portfolio, update schedules, and share new projects with ease. Kirby\'s intuitive interface lets you focus on your art, not the technology.',
		],
		[
			'title' => 'Smooth collaboration',
			'text' => 'Kirby streamlines workflows for creative teams, from curators to musicians. Work seamlessly with video editors, designers, and artists.',
		],
		[
			'title' => 'Control access and permissions',
			'text' => 'Give your team the access they need while keeping sensitive content secure. Manage who can update your digital exhibits, music tracks, or recent projects.',
		],
		[
			'title' => 'Immersive experiences',
			'text' => 'Add high-quality music, video, 3D models and interactive media. Kirby supports a wide range of formats, perfect for creating a multi-sensory experience.',
		],
	]
]);
?>

<?php
snippet('templates/features/section', [
	'reverse' => true,
	'id'    => 'art-2',
	'title' => 'Fast, flexible & cost-effective',
	'text'  => 'Kirby delivers powerful features without subscription fees. Build your digital art space at a one-time cost, providing flexibility and value for creative professionals.',
	'figure' => [
		'image' => 'band.png',
		'alt'   => 'A photo of a band practicing',
		],
	'features' => [
		[
			'title' => 'Multilingual ready',
			'text' => 'Display your art, music, or video in multiple languages and share your work with a global audience.'
		],
		[
			'title' => 'Tell your creative story',
			'text' => 'Whether you\'re a gallery, musician, or filmmaker, Kirby helps you create a digital space that reflects your artistic vision and connects with your audience.',
		],
		[
			'title' => 'Seamless integration',
			'text' => 'Integrate Kirby with audio/video platforms, DAMs, CRMs, and other tools to streamline your creative workflow.',
		],
		[
			'title' => 'Host your art anywhere',
			'text' => 'With Kirby, you can host your website on any server, giving you total freedom over your hosting environment.',
		],
		[
			'title' => 'Clear and transparent pricing',
			'text' => 'No monthly fees, no hidden costs. Kirby offers all of its powerful features with a single license, so you can focus on your art without worrying about your budget.',
			'link'  => '/buy'
		],
		[
			'title' => 'Free for a good cause',
			'text'  => 'We offer free licenses for students, and creators working on educational or community-based art projects.',
			'link'  => '/buy'
		],
	]
]);
?>

<?php snippet('templates/scenarios/cases', [
	'title' => 'Trusted by artists of all traits',
	'cases' => $kirby->collection('cases/art'),
	'limit' => 8
]) ?>

<?php snippet('templates/scenarios/brands', [
	'title' => '… and institutions world&#8209;wide',
	'tag'   => 'art',
	'limit' => 10
]) ?>
