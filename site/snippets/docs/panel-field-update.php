<?php
/**
 * Renders the "Update programmatically" section for a field type
 *
 * @example
 * (docs: panel-field-update field: tags)
 *
 * @var string      $field Field type
 * @var string|null $level Heading level (default: 2)
 */

$update   = '(method: $page->update)';
$callback = '(link: docs/reference/objects/cms/page/update#updating-a-field-by-callback text: pass a callback)';

$picker = fn (string $type, string $name, string $example, string $ids, string $item) => [
	'name'   => $name,
	'pass'   => 'an array of ' . rtrim($type, 's') . ' IDs or UUIDs',
	'value'  => '[' . $ids . ']',
	'notes'  => [
		'You can also pass a ' . rtrim($type, 's') . ' object or a ' . $type . ' collection, e.g. `' . $example . '`.',
		'Kirby stores the ' . $type . ' as UUIDs (or as IDs, if you set the `store` option to `id`). ' . ucfirst($type) . ' that cannot be found are skipped.'
	],
	'append' => ['To add a ' . rtrim($type, 's') . ' to the existing selection', $item],
];

$options = fn (string $name, string $value) => [
	'name'  => $name,
	'pass'  => 'the value of the option',
	'value' => $value,
	'notes' => ['Use the value of the option, not its text.'],
];

$multipleOptions = [
	'name'  => 'categories',
	'pass'  => 'an array with the values of the selected options',
	'value' => "['design', 'architecture']",
];

$fields = [
	'blocks' => [
		'name'  => 'text',
		'pass'  => 'an array of blocks',
		'explain' => 'Each block needs a `type` and its `content`:',
		'value' => <<<'PHP'
			[
			    [
			      'type'    => 'heading',
			      'content' => [
			        'level' => 'h2',
			        'text'  => 'A new heading'
			      ]
			    ],
			    [
			      'type'    => 'text',
			      'content' => [
			        'text' => '<p>Some text</p>'
			      ]
			    ]
			  ]
			PHP,
		'notes'  => [
			'Kirby adds an ID to each block automatically. You can also pass the blocks of another field, e.g. `$otherPage->text()->toBlocks()`.'
		],
		'append' => ['To add a block to the existing ones', <<<'PHP'
			[
			      'type'    => 'text',
			      'content' => [
			        'text' => '<p>Another paragraph</p>'
			      ]
			    ]
			PHP],
		'after' => 'Also see our quicktip on how to (link: docs/quicktips/update-blocks-programmatically text: add blocks programmatically).',
	],
	'checkboxes' => $multipleOptions,
	'color' => [
		'name'  => 'color',
		'pass'  => 'a string',
		'value' => "'#ff0000'",
		'notes' => ['Use the same color format you have set up for the field.'],
	],
	'date' => [
		'name'  => 'published',
		'pass'  => 'a date string, a `DateTime` object or a UNIX timestamp',
		'value' => "'2026-10-01'",
		'notes' => [
			'Kirby stores the date in the `format` of the field. If the field includes a time, add it to the string (e.g. `\'2026-10-01 14:30\'`). The time is rounded to the field\'s `step`.'
		],
	],
	'email' => [
		'name'  => 'email',
		'pass'  => 'a string',
		'value' => "'jane@example.com'",
		'notes' => ['By default, the value is not validated when you update it programmatically. Make sure it is a valid email address.'],
	],
	'entries' => [
		'name'  => 'entries',
		'pass'  => 'an array of values',
		'value' => "['design', 'architecture']",
	],
	'files' => $picker('files', 'downloads', '$page->files()->filterBy(\'extension\', \'pdf\')', "'file://Kp0Vb2lm9Qe7Xs4R', 'blog/my-article/report.pdf'", "'file://Kp0Vb2lm9Qe7Xs4R'"),
	'hidden' => [
		'name'  => 'title',
		'pass'  => 'the value',
		'value' => "'Some value'",
	],
	'layout' => [
		'name'  => 'layout',
		'pass'  => 'an array of layout rows',
		'explain' => 'Each row contains its columns, and each column has a `width` and its `blocks`:',
		'value' => <<<'PHP'
			[
			    [
			      'columns' => [
			        [
			          'width'  => '1/2',
			          'blocks' => [
			            ['type' => 'text', 'content' => ['text' => '<p>Left</p>']]
			          ]
			        ],
			        [
			          'width'  => '1/2',
			          'blocks' => [
			            ['type' => 'text', 'content' => ['text' => '<p>Right</p>']]
			          ]
			        ]
			      ]
			    ]
			  ]
			PHP,
		'notes' => [
			'Kirby adds IDs to rows, columns and blocks automatically. You can also pass the layouts of another field, e.g. `$otherPage->layout()->toLayouts()`.'
		],
	],
	'link' => [
		'name'  => 'link',
		'pass'  => 'a string',
		'value' => "'https://getkirby.com'",
		'notes' => [
			'Depending on the type of link, this can be a URL, an email address with `mailto:`, a phone number with `tel:` or the UUID of a page or file, e.g. `page://8RxIAFzmw1Ae3rnK`.'
		],
	],
	'list' => [
		'name'  => 'list',
		'pass'  => 'an HTML list',
		'value' => "'<ul><li>First item</li><li>Second item</li></ul>'",
	],
	'multiselect' => $multipleOptions,
	'number' => [
		'name'  => 'number',
		'pass'  => 'a number',
		'value' => '42',
	],
	'object' => [
		'name'  => 'contact',
		'pass'  => 'an array with the names of the object fields as keys',
		'value' => <<<'PHP'
			[
			    'name'  => 'Jane Doe',
			    'email' => 'jane@example.com',
			    'phone' => '+49 123 456789'
			  ]
			PHP,
	],
	'pages' => $picker('pages', 'related', '$page->siblings()->listed()', "'page://8RxIAFzmw1Ae3rnK', 'blog/my-article'", "'page://8RxIAFzmw1Ae3rnK'"),
	'radio' => $options('category', "'design'"),
	'range' => [
		'name'  => 'budget',
		'pass'  => 'a number',
		'value' => '500',
	],
	'select' => $options('category', "'design'"),
	'slug' => [
		'name'  => 'className',
		'pass'  => 'a string',
		'value' => "Str::slug('My Class Name')",
		'notes' => ['The value is stored as is. Use (method: Kirby\Toolkit\Str::slug text: Str::slug()) to make sure it is a valid slug.'],
	],
	'structure' => [
		'name'  => 'addresses',
		'pass'  => 'an array of entries',
		'explain' => 'Each entry is an array with the names of the structure fields as keys:',
		'value' => <<<'PHP'
			[
			    [
			      'street' => 'Main Street 1',
			      'zip'    => '12345',
			      'city'   => 'Springfield'
			    ],
			    [
			      'street' => 'Second Street 2',
			      'zip'    => '67890',
			      'city'   => 'Shelbyville'
			    ]
			  ]
			PHP,
		'notes'  => [
			'You can also pass the entries of another structure field, e.g. `$otherPage->addresses()->toStructure()`.'
		],
		'append' => ['To add an entry to the existing ones', <<<'PHP'
			[
			      'street' => 'Third Street 3',
			      'zip'    => '13579',
			      'city'   => 'Capital City'
			    ]
			PHP],
	],
	'tags' => [
		'name'   => 'tags',
		'pass'   => 'an array of tags',
		'value'  => "['design', 'architecture']",
		'append' => ['To add a tag to the existing ones', "'photography'"],
	],
	'tel' => [
		'name'  => 'phone',
		'pass'  => 'a string',
		'value' => "'+49 123 456789'",
	],
	'text' => [
		'name'  => 'name',
		'pass'  => 'a string',
		'value' => "'Jane Doe'",
	],
	'textarea' => [
		'name'  => 'text',
		'pass'  => 'a string',
		'value' => "'Some **Markdown** text'",
	],
	'time' => [
		'name'  => 'time',
		'pass'  => 'a time string',
		'value' => "'14:30'",
		'notes' => ['Kirby stores the time in the `format` of the field and rounds it to the field\'s `step`.'],
	],
	'toggle' => [
		'name'  => 'toggle',
		'pass'  => '`true` or `false`',
		'value' => 'true',
	],
	'toggles' => $options('alignment', "'center'"),
	'url' => [
		'name'  => 'url',
		'pass'  => 'a string',
		'value' => "'https://getkirby.com'",
		'notes' => ['By default, the value is not validated when you update it programmatically. Make sure it is a valid URL.'],
	],
	'users' => [
		...$picker('users', 'authors', '$kirby->users()->role(\'editor\')', "'user://abcd1234', 'jane@example.com'", "'user://abcd1234'"),
		'pass' => 'an array of user IDs, UUIDs or email addresses',
	],
	'writer' => [
		'name'  => 'text',
		'pass'  => 'an HTML string',
		'value' => "'<p>Some <strong>bold</strong> text</p>'",
		'notes' => ['Kirby sanitizes the HTML before storing it, e.g. `<script>` tags are removed.'],
	],
];

if (!$def = $fields[$field] ?? null) {
	return;
}

$name = $def['name'];
?>
<?= str_repeat('#', (int)($level ?? 2)) ?> Update programmatically

To change the field value from PHP, pass <?= $def['pass'] ?> to <?= $update ?><?= isset($def['explain']) ? '. ' . $def['explain'] : ':' ?>


```php
$page->update([
  '<?= $name ?>' => <?= $def['value'] . PHP_EOL ?>
]);
```

<?php foreach ($def['notes'] ?? [] as $note): ?>
<?= $note ?>


<?php endforeach ?>
<?php if ($append = $def['append'] ?? null): ?>
<?= $append[0] ?>, <?= $callback ?>:

```php
$page->update([
<?php if (str_contains($append[1], "\n")): ?>
  '<?= $name ?>' => fn ($<?= $name ?>) => [
    ...$<?= $name ?>,
    <?= $append[1] . PHP_EOL ?>
  ]
<?php else: ?>
  '<?= $name ?>' => fn ($<?= $name ?>) => [...$<?= $name ?>, <?= $append[1] ?>]
<?php endif ?>
]);
```

<?php endif ?>
<?= $def['after'] ?? '' ?>
