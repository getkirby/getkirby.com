<?php if (empty($link) === false): ?>
<h2 id="source"><a href="#source">Source Code</a></h2>
<p><?= Html::a(
  $link,
  "kirby/" . Str::after($link, 'tree/develop/')
) ?></p>
<?php endif ?>
