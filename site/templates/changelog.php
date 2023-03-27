<?php layout('changelog') ?>

<?php slot('h1') ?>
  Make 'n' break: <br>The unavoidable breaking changes
<?php endslot() ?>
<?php slot() ?>

  <section>
    <?php foreach ($releases as $release): ?>
      <article class="mb-12" style="--span: 12">
        <header class="mb-6">
          <h2 class="h2" id="<?= 'version-' . $release->version()->slug() ?>"
              class="h2">Kirby <?= $release->version() ?></h2>
        </header>
        <div class="mb-12">
          <h3 class="h3 mb-6">Breaking</h3>
          <div class="prose text-sm">
            <?= (new Kirby\Cms\Field(
              $release,
              'breaking',
              str_replace(
                '(docs: releases/breaking-changes vars: version=' . substr($release->version()->value(), 2, 1) . ')',
                '',
                $release->breaking()
              )))->kt() ?>
          </div>
        </div>
        <?php if ($release->deprecated()->isNotEmpty()): ?>
          <div class="mb-12">
            <h3 class="h3 mb-6">Deprecated</h3>
            <div class="prose text-sm">
              <?= $release->deprecated()->kt() ?>
            </div>
          </div>
        <?php endif ?>
      </article>
    <?php endforeach ?>
  </section>
  <footer class="h2 max-w-xl">
    Full list of features of <a href="/releases"><span class="link">all releases</span> &rarr;</a>
  </footer>
<?php endslot() ?>