<section id="object-field" class="mb-42">

  <?php snippet('hgroup', [
    'title'    => 'New object field',
    'subtitle' => 'More power for your data',
    'mb'       => 12
  ]) ?>

  <div class="columns" style="--columns: 6">

    <figure class="release-box bg-light" style="--aspect-ratio: 2751/1402; --span: 6">
      <img src="<?= $page->image('object-field-1.png')?->url() ?>" loading="lazy" alt="The new object field opens in a new drawer to edit fields comfortably">
    </figure>

    <div class="release-text-box" style="background: var(--color-white); --span: 2">
      <h3>Objectively awesome</h3>
      <div class="prose">
        <?= $page->objectFieldInfo()->kt() ?>
      </div>
    </div>

    <figure class="release-box bg-light" style="--aspect-ratio: 1794/497; --span: 4">
      <img src="<?= $page->image('object-field-2.png')?->url() ?>" loading="lazy" alt="The new object field shows data in a very compact way">
    </figure>

    <div class="release-text-box" style="background: var(--color-light); --span: 3">
      <h3>In your blueprints</h3>
      <div class="prose">
        <p>The object field definition is very similar to a structure field. You can define any set of fields for the object with the <code>fields</code> option.</p>
      </div>
    </div>

    <div class="release-code-box" style="--span: 3; aspect-ratio: 5/3">
      <?= $page->objectFieldConfig()->kt() ?>
    </div>

    <div class="release-text-box" style="background: var(--color-light); --span: 3">
      <h3>In your templates</h3>
      <div class="prose">
        <p>The result is stored as YAML in the content file and can be used in your templates with the new <code>$field->toObject()</code> method.</p>
      </div>
    </div>

    <div class="release-code-box" style="--span: 3; aspect-ratio: 5/3">
      <?= $page->objectFieldTemplate()->kt() ?>
    </div>

  </div>
</section>
