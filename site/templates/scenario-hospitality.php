<?php layout('scenarios') ?>

<?php
snippet('templates/features/section', [
	'id'    => 'hospitality-1',
	'title' => 'Elevate your guest experience online',
	'text'  => 'Kirby transforms the digital presence of hotels, restaurants, travel agencies and tour operators. Whether you\'re showcasing luxurious rooms, home-style cuisine, or exotic destinations, Kirby provides a platform to tell your story with elegance and ease.',
	'figure' => [
		'image' => 'host.png',
		'alt'   => 'A photograph of a boutique restaurant. Guest interacting with a smiling host at the cash register.',
	],
	'features' => [
		[
			'title' => 'Tailored for unique hospitality needs',
			'text' => 'Kirby offers limitless customization, allowing you to create a digital space that reflects your brand\'s personality. Create unique booking experiences, highlight special offers, and seamlessly integrate with reservation systems.'
		],
		[
			'title' => 'From small to large scale',
			'text' => 'Whether you\'re a cozy inn or a sprawling resort, Kirby\'s scalable architecture effortlessly handles sites of all sizes, ensuring flawless performance and intuitive navigation.',
		],
		[
			'title' => 'Effortless content management',
			'text' => 'Kirby\'s easy-to-use Panel makes managing room availability, daily specials, and event calendars is a breeze. Keep your guests informed and engaged with fresh, up-to-date content.',
		],
		[
			'title' => 'Streamlined operations',
			'text' => 'Kirby integrates smoothly with your existing workflows, from handling guest requests to managing event bookings. Customize automation features to simplify complex processes and increase efficiency.',
		],
		[
			'title' => 'Secure access control',
			'text' => 'Assign specific roles and permissions to staff, ensuring that only authorized personnel can make changes, keeping your content safe and consistent.',
		],
		[
			'title' => 'Rich visual content',
			'text' => 'Enhance your site\'s appeal with high-quality images and videos. Kirby supports a wide range of media formats, perfect for showcasing your stunning visuals and immersive virtual tours.',
		],
	]
]);
?>

<?php
snippet('templates/features/section', [
	'reverse' => true,
	'id'    => 'hospitality-2',
	'title' => 'Fast, fair & robust',
	'text'  => 'Kirby is the ideal choice for the hospitality industry, providing a robust and reliable platform that enhances the online experience for guests and customers. Enjoy powerful features without the hassle of ongoing costs.',
	'figure' => [
		'image' => 'view.png',
		'alt'   => 'A photo of a traveler relaxing in a hammock surrounded by lights overlooking the forest',
		],
	'features' => [
		[
			'title' => 'Global reach',
			'text' => 'Reach a global audience with built-in multilingual support. Kirby makes it easy to cater to international guests by offering content in multiple languages for a seamless experience.'
		],
		[
			'title' => 'Strengthen your brand identity',
			'text' => 'Stand out in the competitive hospitality market with a distinctive and memorable online presence. Kirby can help you create a digital experience that reflects your brand\'s unique style and values.',
		],
		[
			'title' => 'Seamless integration',
			'text' => 'Kirby easily connects to booking engines, CRM systems, analytics tools, and more, streamlining data management and improving operational efficiency.',
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
			'title' => 'Support for community initiatives',
			'text'  => 'We offer free licenses for non-profit projects in the hospitality and tourism industries that support local communities and charitable organizations.',
			'link'  => '/buy'
		],
	]
]);
?>

<?php snippet('templates/scenarios/brands', [
	'title' => 'Trusted by hosts world&#8209;wide',
	'tag'   => 'hospitality'
]) ?>
