<section id="views" class="mb-42">
  <?php snippet('templates/features/intro', [
    'title' => 'System & Languages',
    'intro' => 'Two completely new views',
    'text'  => 'The settings view has been replaced by a new system view with all kinds of additional information about your Kirby installation and a brand new languages view.'
  ]) ?>

  <div class="columns mb-6" style="--columns: 2; --gap: var(--spacing-1)">
    <article class="p-6 bg-dark color-white">
      <h3 class="h3 mb-6">System View</h3>
      <figure class="mb-6">
        <?= img('system-view.png', [
          'alt' => 'A screenshot of the new system view',
          'lightbox' => true,
          'class' => 'bg-black rounded shadow-xl',
          'src' => [
            'width' => 1000,
          ],
          'srcset' => [
            '1x' => [
              'width' => 1000
            ],
            '2x' => [
              'width' => 2000
            ],
          ]
        ]) ?>
      </figure>
      <p class="font-mono text-sm color-gray-400">The system view contains the version and license information from the previous settings view. But now it also features additional health information about your setup, which will be extended step by step in later releases. It also contains a list of your installed plugins.</p>
    </article>
    <article class="p-6 bg-dark color-white">
      <h3 class="h3 mb-6">Languages View</h3>
      <figure class="mb-6">
        <?= img('languages-view.png', [
          'alt' => 'A screenshot of the new languages view',
          'lightbox' => true,
          'class' => 'bg-black rounded shadow-xl',
          'src' => [
            'width' => 1000,
          ],
          'srcset' => [
            '1x' => [
              'width' => 1000
            ],
            '2x' => [
              'width' => 2000
            ],
          ]
        ]) ?>
      </figure>
      <p class="font-mono text-sm color-gray-400">Manage languages through the new languages view. Add new languages, update existing ones and protect language management via the brand new access permissions.</p>
    </article>
  </div>

</section>
