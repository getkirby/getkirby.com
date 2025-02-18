<?php layout('scenarios') ?>

<?php
snippet('templates/features/section', [
	'id'    => 'events-1',
	'title' => 'Make your event stand out',
	'text'  => 'Kirby CMS makes it easy to create unique and engaging event websites, whether for intimate gatherings or large-scale conferences. Kirby provides a platform to showcase your event\'s unique features and attract attendees.',
	'figure' => [
		'image' => 'makerspace.jpg',
		'alt'   => 'Crowded hallway during an art conference',
	],
	'features' => [
		[
			'title' => 'It\'s what your events need',
			'text' => 'With Kirby, you can create a digital space that reflects the unique atmosphere of your event. Create engaging registration portals, highlight keynote speakers, and seamlessly integrate with ticketing systems.'
		],
		[
			'title' => 'From small to the large stage',
			'text' => 'Whether you\'re hosting a local workshop or an international conference, Kirby\'s scalable architecture easily handles sites of all sizes, ensuring smooth and reliable performance.',
		],
		[
			'title' => 'Effortless content management',
			'text' => 'Kirby\'s easy-to-use Panel makes managing event schedules, speaker bios, and attendee updates a breeze. Keep your attendees informed and engaged.',
		],
		[
			'title' => 'Streamlined operations',
			'text' => 'Kirby integrates neatly into your existing event management workflow. Customize automation features to simplify logistics and increase operational efficiency.',
		],
		[
			'title' => 'All area access',
			'text' => 'Assign specific roles and permissions to your team to ensure only authorized people can update and keep your event information secure and consistent.',
		],
		[
			'title' => 'Rich visual content',
			'text' => 'Add high-quality images and video to boost your site. Kirby supports a wide range of media formats, perfect for displaying stunning images and engaging promotional videos.',
		],
	]
]);
?>

<?php
snippet('templates/features/section', [
	'reverse' => true,
	'id'    => 'events-2',
	'title' => 'Fast, fair & robust',
	'text'  => 'Kirby is the ideal choice for the event space, providing a robust and reliable platform that enhances the online experience for attendees and organizers alike. Enjoy powerful features without the hassle of ongoing costs.',
	'figure' => [
		'image' => 'concert.jpg',
		'alt'   => 'Man walking into a concert arena',
		],
	'features' => [
		[
			'title' => 'Inherently multilingual',
			'text' => 'Reach an international audience with built-in multilingual support. Kirby makes it easy to cater to international participants by offering content in multiple languages for a seamless experience.'
		],
		[
			'title' => 'Tell your story',
			'text' => 'Set yourself apart in the competitive event landscape with a compelling and memorable online presence. Kirby can help you create a digital experience that reflects your event\'s unique style and values.',
		],
		[
			'title' => 'Seamless integration',
			'text' => 'Kirby easily connects to CRM systems, ticketing platforms, analytics tools, and more, streamlining data collection and improving efficiency.',
		],
		[
			'title' => 'Host anywhere, no strings attached',
			'text' => 'Enjoy the freedom to host your website on any server, giving you complete control over your hosting environment. Kirby\'s flexibility means you\'re never tied to a specific provider.',
		],
		[
			'title' => 'Transparent pricing',
			'text' => 'Kirby offers a one-time license fee, so there are no hidden costs. You get all the features you need at a price that fits your budget without compromising quality.',
			'link'  => '/buy'
		],
		[
			'title' => 'Free for community events',
			'text'  => 'We offer free licenses for small non-profit events that support local communities or charitable organizations.',
			'link'  => '/buy'
		],
	]
]);
?>

<?php snippet('templates/scenarios/cases', [
	'title' => 'Trusted by events of all sizes',
	'cases' => $kirby->collection('cases/events'),
	'limit' => 8
]) ?>

<?php snippet('templates/scenarios/brands', [
	'tag' => 'event'
]) ?>
