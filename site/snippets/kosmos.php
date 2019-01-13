<?php if ($kosmos = page('kosmos')): ?>
<section class="kosmos">

  <?php snippet('hero', ['align' => 'left', 'theme' => 'dark', 'page' => $kosmos]) ?>
  <?php snippet('kosmos-form') ?>

  <div class="kosmos-issues-heading">
    <h3 class="-color:purple-on-dark">Latest issues</h3>
    </a><?php snippet('arrow-link', ['link' => $kosmos->url(), 'text' => 'View all']) ?>
  </div>

  <?php snippet('kosmos-issues', ['issues' => page('kosmos')->children()->listed()->flip()->limit(4)]) ?>

</section>
<?php endif ?>
