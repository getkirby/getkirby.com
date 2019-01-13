<?php snippet('header', [ 'floating' => true ]) ?>

  <main class="main" id="maincontent">

    <article class="wrap">

      <?php snippet('hero') ?>

      <?php

      $headlines = $page->text()->headlines('h2');

      $headlines->add(new Obj([
        'id' => '#icons',
        'url' => '#icons',
        'text' => 'Available icons',
      ]));

      snippet('toc', $headlines);

      ?>

      <div class="text">
        <?= $page->text()->kt()->anchorHeadlines('h2') ?>

        <h2 id="icons"><a href="#icons">Available Icons</a></h2>

        <p>The table below gives an overview of all icons available on the site. This section is mostly aimed at template developers and/or contributors who want to make suggestions to style updates.</p>

        <table>
          <tr>
            <th>Preview</th>
            <th>Name</th>
            <th style="text-align: center">Size</th>
          </tr>
          <?php foreach(availableIcons() as $icon): ?>
            <tr>
              <td><?php icon($icon) ?></td>
              <td><code><?= $icon ?></code></td>
              <?php $dimensions = (new \Kirby\Image\Image(iconRoot($icon)))->dimensions() ?>
              <td style="text-align: center"><code><?= $dimensions->width() ?>&thinsp;&times;&thinsp;<?= $dimensions->height() ?></code></td>
            </tr>
          <?php endforeach; ?>
        </table>

      </div>

    </article>
  </main>

<?php snippet('footer') ?>
