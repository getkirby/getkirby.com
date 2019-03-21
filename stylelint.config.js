/* eslint-disable */

module.exports = {
  'extends': 'stylelint-config-standard',

  'plugins': [
    'stylelint-scss',
    'stylelint-order'
  ],

  'rules': {
    'number-leading-zero': 'never',
    'at-rule-no-unknown': null,
    'selector-list-comma-newline-after': null,
    'no-descending-specificity': null,
    'selector-descendant-combinator-no-non-space': null, // needs to disabled in order to allow colons (`.-theme\:dark`) in selectors,
    'selector-attribute-quotes': 'always',
    'string-quotes': 'double',
    'function-url-quotes': 'always',
    'at-rule-empty-line-before': [
      'always', {
        'ignore': ['after-comment'],
        'ignoreAtRules': [ 'else', 'import', 'include' ],
      }
    ],
    'block-opening-brace-space-before': 'always',
    'block-closing-brace-newline-after': [
      'always', {
        'ignoreAtRules': [ 'if', 'else' ]
      }
    ],
    'at-rule-name-space-after': 'always',

    'order/order': [
			'custom-properties',
			'declarations'
		],
		'order/properties-alphabetical-order': true
  },
};
