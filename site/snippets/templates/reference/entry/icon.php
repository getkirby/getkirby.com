<?php
$icon = null;

if ($entry->intendedTemplate()->name() === 'reference-icon') {
  $icon = $entry->slug();
}
?>

<?php if ($icon): ?>
<figure class="p-3 mr-3 bg-light rounded">
  <svg style="width: 1rem; height: 1rem;">
    <use xlink:href="#icon-<?= $icon ?>" />
  </svg>
</figure>
<?php endif ?>