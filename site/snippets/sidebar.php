<?php

$levels = $levels ?? 3;
$items  = $items ?? $site->find('docs')->children()->listed();

$doNotSkipTemplates = [
  'reference',
  'reference.fields',
  'reference.fieldmethods',
  'reference.packages',
  'reference.helpers',
  'reference.kirbytags',
  'reference.roots',
  'reference.urls',
  'reference.validators',
];

?>

<!-- ## Sidebar Navigation -->

<nav class="sidebar / js-sidebar" aria-labelledby="sidebar-nav-heading">

  <h2 id="sidebar-nav-heading" class="screen-reader-text">Guide Index</h2>

  <ul class="sidebar-items">

    <?php foreach($items as $item): ?>
      <?php $hasSubmenu = $item->hasListedChildren(); ?>

      <li class="sidebar-item">

        <?php if($hasSubmenu): ?>
          <button class="sidebar-toggle / js-sidebar-toggle | button-reset" aria-expanded="<?= r($item->isOpen(), 'true', 'false') ?>" tabindex="-1"><i></i></button>
        <?php endif ?>

        <?php if($hasSubmenu && $item->text()->isEmpty() && !in_array($item->template(), $doNotSkipTemplates)): ?>
          <a href="<?= $item->children()->listed()->first()->url() ?>" class="sidebar-item-link | link-reset medium"><?= $item->title()->html() ?></a>
        <?php else: ?>
          <?= $item->title()->link([ 'class' => 'sidebar-item-link | link-reset medium' ]) ?>
        <?php endif ?>

        <?php if($hasSubmenu): ?>

          <div class="sidebar-submenu / js-sidebar-submenu"<?= r(!$item->isOpen(), ' hidden') ?>>

            <?php if($item->hasListedChildren()): ?>
              <ul class="sidebar-subpages">
                <?php foreach($item->children()->listed() as $subpage): ?>
                  <li class="sidebar-subpage">

                    <?= $subpage->title()->link(['class' => 'sidebar-subpage-link | link-reset', 'tabindex' => r($item->isOpen(), '0', '-1')]) ?>

                    <?php if($levels >= 3 && $subpage->isOpen() && $subpage->hasListedChildren()): ?>
                      <ul class="sidebar-subpagechildren">
                        <?php foreach($subpage->children() as $subpageChild): ?>
                          <li class="mt-tiny">
                            <a href="<?= $subpageChild->url() ?>"
                               <?= r($subpageChild->isOpen(), ' aria-current="' . ($subpageChild->isActive() ? 'page' : 'true') . '"') ?>
                               tabindex="<?= r($item->isOpen(), '0', '-1') ?>"><?= htmlspecialchars(str_replace($subpage->title()->html() . '\\', '', $subpageChild->title())) ?></a>
                          </li>
                        <?php endforeach ?>
                      </ul>
                    <?php endif ?>

                  </li>
                <?php endforeach ?>
              </ul>
            <?php endif ?>

          </div>
        <?php endif ?>

      </li>
    <?php endforeach ?>

  </ul>

</nav>
