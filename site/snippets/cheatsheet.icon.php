<?php if ($entry->icon()->isNotEmpty()): ?>
  <figure class="cheatsheet-entry-icon">
    <svg>
      <use xlink:href="#<?= $entry->icon() ?>" />
    </svg>
  </figure>
<?php endif ?>
