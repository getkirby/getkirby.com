<?php layout('scenarios') ?>

<?php
snippet('templates/features/section', [
	'id'    => 'education-1',
	'title' => 'Transform your university’s digital presence',
	'text'  => 'Kirby delivers a powerful and user-friendly content management system tailored for higher education. Streamlined content updates and multi-language support simplify managing your website and let your team focus on providing exceptional educational experiences.',
	'figure' => [
		'image' => 'campus.png',
		'alt'   => 'A photo of three students entering a university campus',
	],
	'features' => [
		[
			'title' => 'Tailored to your needs',
			'text' => 'Kirby\'s allows for extensive customization, enabling universities to create digital environments that perfectly meet their unique requirements.'
		],
		[
			'title' => 'Scales with ease',
			'text' => 'From microsites to comprehensive university websites: Kirby\'s flexible architecture allows you to tackle projects of any size without compromising performance or usability.',
		],
		[
			'title' => 'Effortless content updates',
			'text' => 'Our intuitive and fully customizable Panel allows staff to easily update and manage content, reducing maintenance time and ensuring accurate, up-to-date information across all pages.',
		],
		[
			'title' => 'Integrated in your workflows',
			'text' => 'Kirby makes it really easy for your staff to collaborate, with customizable automation that ensures a smooth and efficient publishing process.',
		],
		[
			'title' => 'Flexible user management',
			'text' => 'Set specific user roles and permissions to control access, ensuring secure and reliable content management tailored to each team member\'s role.',
		],
		[
			'title' => 'Rich searchable content',
			'text' => 'Optimize your content for search engines, accessibility, and visibility with modern media formats to enhance your institution\'s online presence.',
		],
	]
]);
?>

<?php
snippet('templates/features/section', [
	'reverse' => true,
	'id'    => 'education-2',
	'title' => 'Fast, fair & mighty',
	'text'  => 'Kirby provides universities with a flexible and reliable platform. Its robust features allow you to improve the overall digital experience for students and staff alike. All for a comparatively small fee.',
	'figure' => [
		'image' => 'graduates.png',
		'alt'   => 'A photo of university graduates',
		],
	'features' => [
		[
			'title' => 'Global reach',
			'text' => 'Kirby\'s multilingual support ensures that your content is accessible to an international audience, improving engagement with students and faculty from around the world.'
		],
		[
			'title' => 'Elevate your brand',
			'text' => 'Strengthen your university\'s brand presence to stand out in the crowded education landscape and ensure a memorable and impactful digital experience.',
		],
		[
			'title' => 'Connect your systems',
			'text' => 'Kirby integrates effortlessly with CRM systems, campus management tools, analytics platforms, and admissions portals to streamline data flow and increase overall efficiency across your digital ecosystem.',
		],
		[
			'title' => 'Host anywhere, no dependencies',
			'text' => 'Kirby can be hosted on almost every server, offering universities complete flexibility and control over their hosting environment without being tied to specific providers.',
		],
		[
			'title' => 'Transparent pricing',
			'text' => 'With a one-time license fee, Kirby eliminates recurring costs and hidden fees, providing a budget-friendly solution without compromising features or functionality.',
			'link'  => '/buy'
		],
		[
			'title' => 'Free for a good cause',
			'text'  => 'We offer free licenses for students and projects used in the classroom.',
			'link'  => '/buy'
		],
	]
]);
?>

<?php snippet('templates/scenarios/brands', [
	'title' => 'Trusted by universities world&#8209;wide',
	'tag'   => 'education'
]) ?>
