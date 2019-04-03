<?php snippet('header') ?>

<main class="main" id="maincontent">
    <article class="wrap">
      <?php snippet('hero', ['align' => 'center']) ?>
      <div class="text">
        <table>
            <thead>
                <tr>
                    <th width="30%">ID/Template</th>
                    <th>Description</th>
                    <th>Thumbnail</th>
                </tr>
            </thead>
            <tbody>
                <?php
                
                $blacklist = [
                    'link',
                ];
                
                foreach (site()->index() as $item) {

                    
                    
                    if (in_array($item->template()->name(), $blacklist)) {
                        continue;
                    }

                    if (preg_match('/(?:^|\/)(reference)(\/|$)/', $item->id())) {
                        continue;
                    }


                    $meta = $item->meta();

                    echo '<tr>';
                    
                    
                    echo '<td><code>' . $item->id() . '</code><br>' . $item->template()->name() . '</td>';
                    
                    echo '<td>' . ($meta->hasOwnDescription() ? $meta->description() : '❌') . '</td>';

                    echo '<td>' . ($meta->hasOwnThumbnail() ? '✅' : '❌') . '</td>';

                    echo '</tr>';
                }

                ?>
            </tbody>
        </table>
      </div>
    </article>
  </main>
<?php snippet('footer') ?>