<footer class="docs-footer">
  <a href="<?= option('github') ?>/getkirby.com/edit/master/content/<?= $page->diruri() ?>/<?= $page->intendedTemplate() ?>.txt" target="_blank">
    <?php icon('github') ?> Edit on GitHub
  </a>
  <?php if($item = page('styleguide')): ?>
    <a href="<?= $item->url() ?>">Our content styleguide</a>
  <?php endif ?>
</footer>
