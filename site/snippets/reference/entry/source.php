<?php
extract([
  'link' => $link ?? $page->onGithub()
]);
?>

<?php if ($link->isNotEmpty()): ?>
<h2 id="source"><a href="#source">Source code</a></h2>
<p class="follow">
  <?= Html::a(
    $link,
    "kirby/" . Str::after($link, 'tree/' . Kirby::version() .'/')
  ) ?>
</p>
<?php endif ?>
