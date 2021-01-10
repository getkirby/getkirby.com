<?php
extract([
  'type' => $type ?? null,
  'text' => $text ?? null,
]);
?>

<aside class="<?= $type ?>">
  <?= icon($type) ?>
  <?= kirbytext($text) ?>
</aside>