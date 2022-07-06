<?= kirbytag('properties', '$props', [
	'class' => 'Kirby\Cms\File' ,
	'additional' => [
		[
			'name'		=> 'source',
			'type'		=> 'string',
			'required'	=> true,
			'default'	 => null,
			'description' => 'source thingy'
		]
	]		 
])?>