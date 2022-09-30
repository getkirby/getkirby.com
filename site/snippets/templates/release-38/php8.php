<section id="php8" class="mb-42">

  <?php snippet('hgroup', [
    'title'    => 'PHP 8+',
    'subtitle' => 'Use the potential of a modern PHP environment',
    'mb'       => 12
  ]) ?>

  <div class="columns" style="--columns: 3">

    <figure class="release-box bg-dark p-24 color-white grid place-items-center" style="--span: 2">
      <div style="width: 15rem; --aspect-ratio: 2/1;">
        <?= image('home/php.svg')->read() ?>
      </div>
    </figure>

    <div class="release-text-box" style="background: var(--color-light)">
      <h3>There’s no time to dwell in the past</h3>
      <div class="prose">
        <p>Kirby has already supported PHP 8.0 and 8.1 right after their release. PHP 8 not only brings an incredible performance boost but also language features that really move Kirby forward.</p>
        <p>Kirby 3.8 builds exclusively on PHP 8+. With the end-of-life of PHP 7.4 in November and wide-spread hosting support for PHP 8, we don't see any reason to stay with an outdated version if the future is so bright.</p>
      </div>
    </div>
  </div>

</section>
