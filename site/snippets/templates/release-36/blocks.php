<?php snippet('templates/features/section', [
  'id'       => 'blocks',
  'title'    => 'Blocks',
  'intro'    => 'Now even more awesome',
  'text'     => 'Our blocks field has lifted Kirby’s editing experience on another level since 3.5. Now we are taking it even a step further.',
  'figure'   => 'templates/release-36/blocks-figure',
  'features' => [
    [
      'title' => 'Copy & Paste',
      'text' => 'It’s finally here! You can now copy and paste blocks between block and layout fields. Even HTML from websites, word documents or other sources can be pasted and creates beautiful, clean blocks.'
    ],
    [
      'title' => 'Improved multi-select',
      'text'  => 'To copy multiple blocks, you can cmd+click or alt+click on all blocks you want to include in your selection. Delete them all at once or copy them with cmd+c or via the copy button.'
    ],
    [
      'title' => 'New line block',
      'text' => 'The new line block automatically supports and imports hr blocks from the old Editor plugin and hr elements in pasted HTML'
    ],
    [
      'title' => 'Privacy friendly video block',
      'text' => 'The video block is now more privacy friendly by automatically creating embeds with the "do not track" option. No tracking in the Panel please!'
    ],
  ]
]);
