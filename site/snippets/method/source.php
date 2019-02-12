<?php if (empty($link) === false): ?>
<h2 id="source"><a href="#source">Source code</a></h2>
<p><?= Html::a(
  $link,
  "kirby/" . Str::after($link, 'tree/master/')
) ?></p>
<?php endif ?>
