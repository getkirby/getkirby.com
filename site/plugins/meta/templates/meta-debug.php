<?php snippet('header') ?>

<main class="main" id="maincontent">
    <article class="wrap">
      <?php snippet('hero', ['align' => 'center']) ?>
      <div class="text">
        <table>
            <thead>
                <tr>
                    <th style="vertical-align: bottom;" width="100">Template</th>
                    <th style="vertical-align: bottom;">Opengraph title</th>
                    <th style="vertical-align: bottom;">Description</th>
                    <th style="vertical-align: bottom;" width="120">Thumbnail</th>
                    <th style="writing-mode: vertical-lr;" width="40">Has own description</th>
                    <th style="writing-mode: vertical-lr;" width="40">Has own thumbnail</th>
                    <th style="writing-mode: vertical-lr;" width="40">Thumbnail alt text</th>
                </tr>
            </thead>
            <tbody>
                <?php
                
                foreach (site()->index() as $item) {

                    if ($item->template()->name() === 'link') {
                        continue;
                    }

                    $meta = $item->meta();

                    echo '<tr>';
                        echo '<th colspan="7" style="background: #efefef">' . $item->title()->link() . ' <code>' . $item->id() . '</code></th>';
                    echo '</tr>';

                    echo '<tr>';
                    
                    echo '<td>' . $item->template()->name() . '</td>';
                    
                    echo '<td>' . $meta->ogtitle()->html() . '</td>';
                    
                    
                    echo '<td>' . $meta->description()->html() . '</td>';
                    
                    
                    echo '<td>' . $meta->thumbnail() . '</td>';
                    
                    echo '<td>' . ($meta->hasOwnDescription() ? '✅' : '❌') . '</td>';
                    echo '<td>' . ($meta->hasOwnThumbnail() ? '✅' : '❌') . '</td>';

                    $thumbnail = $meta->thumbnail();
                    echo '<td>' . ($thumbnail !== null && $thumbnail->alt()->isNotEmpty() ? '✅' : '❌') . '</td>';

                    echo '</tr>';
                }

                ?>
            </tbody>
        </table>
      </div>
    </article>
  </main>
<?php snippet('footer') ?>