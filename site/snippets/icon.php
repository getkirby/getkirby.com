<?php
extract([
    'type' => $type ?? null
]);
?>

<svg class="icon icon-<?= $type ?>" width="20" height="20">
    <use class="fill-current" xlink:href="<?= url('assets/images/icons.svg#icon-' . $type) ?>">
</svg>