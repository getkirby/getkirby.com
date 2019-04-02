<?php

use Kirby\Meta\Meta;

require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/helpers.php';

Kirby::plugin('getkirby/meta', [
    'routes' => [
        [
            'pattern' => 'meta-debug',
            'action' => function () {

                echo '<table border="1">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Template</th>
                            <th>Description</th>
                            <th>Image</th>
                            <th>Twitter card type</th>
                        </tr>
                    </thead>
                    <tbody>
                ';

                $blacklist = [
                    'link',
                ];
                
                foreach (site()->index() as $item) {
                    
                    if (in_array($item->template()->name(), $blacklist)) {
                        continue;
                    }


                    $meta = $item->meta();

                    echo '<tr>';
                    
                    
                    echo '<td>' . $item->id() . '</td>';
                    echo '<td>' . $item->template()->name() . '</td>';
                    
                    
                    echo '<td>' . ($meta->hasOwnDescription() ? $meta->description() : '❌') . '</td>';
                    echo '</tr>';
                }

                echo '</tbody></table>';
                exit;
            },
        ],
    ],

    'pageMethods' => [
        'meta' => function() {
            return new Meta($this);
        }
    ]
]);

// class opengraph {

//   static::$image = null;
//   static

//   public static function image(string $image = null) {
//     if ($image !== null) {

//     }
//   }
// }

// function opengraph() {
  
// }
