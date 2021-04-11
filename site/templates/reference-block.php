<?php snippet('cheatsheet.article.header') ?>

<div class="text">
  <h2 id="preview"><a href="#preview">Preview</a></h2>
  <?= kirbytag('screenshot', $page->image()->filename()) ?>

  <?= $page->text()->kt() ?>

  <h2 id="default-files"><a href="#default-files">Default files</a></h2>

  <h3 id="default-files__snippet"><a href="#default-files__snippet">Snippet</a></h3>
  <?= kt('
```php "/site/snippets/blocks/' . $page->slug() . '.php"
' . file_get_contents(kirby()->root('kirby') . '/config/blocks/' . $page->slug() . '/' . $page->slug() . '.php') .'
```    
  ') ?>

  <h3 id="default-files__blueprint"><a href="#default-files__blueprint">Blueprint</a></h3>
  <?= kt('
```yaml "/site/blueprints/blocks/' . $page->slug() . '.yml"
' . file_get_contents(kirby()->root('kirby') . '/config/blocks/' . $page->slug() . '/' . $page->slug() . '.yml') .'
```    
  ') ?>

  <h3 id="default-files__vue-component"><a href="#default-files__vue-component">Vue component</a></h3>
  <p><a href="https://github.com/getkirby/kirby/blob/master/panel/src/components/Blocks/Types/<?= ucfirst($page->title()) ?>.vue">kirby/blob/master/panel/src/components/Blocks/Types/<?= ucfirst($page->title()) ?>.vue</a></p>
</div>

<?php snippet('github.edit') ?>

<?php snippet('cheatsheet.article.footer') ?>
