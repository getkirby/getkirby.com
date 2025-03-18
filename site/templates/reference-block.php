<?php layout('reference') ?>

<div class="prose">
	<h2 id="preview"><a href="#preview">Preview</a></h2>
	<?php if($image = $page->image()): ?>
		<?= kirbytag('image', $image->filename()) ?>
	<?php endif ?>

	<?php if($page->slug() !== 'table'): ?>

	<?= $page->text()->kt() ?>

	<h2 id="default-files"><a href="#default-files">Default files</a></h2>

	<h3 id="default-files__snippet"><a href="#default-files__snippet">Snippet</a></h3>
	<p>By default, Kirby uses the following snippet to render the <?= $page->title() ?> block:</p>
	<?= kt('
```php
' . file_get_contents(kirby()->root('kirby') . '/config/blocks/' . $page->name() . '/' . $page->name() . '.php') . '
```
	') ?>
	<p>To overwrite <a href="<?= $page->source() ?>/<?= $page->name() ?>.php">this default snippet</a>, place your custom file in <code>/site/snippets/blocks/<?= $page->name() ?>.php</code>.</p>


	<h3 id="default-files__blueprint"><a href="#default-files__blueprint">Blueprint</a></h3>
	<p>By default, Kirby uses the following blueprint for the <?= $page->title() ?> block:</p>

	<?= kt('
```yaml
' . file_get_contents(kirby()->root('kirby') . '/config/blocks/' . $page->name() . '/' . $page->name() . '.yml') . '
```
	') ?>
	<p>To overwrite <a href="<?= $page->source() ?>/<?= $page->name() ?>.yml">this default blueprint</a>, place your custom file in <code>/site/blueprints/blocks/<?= $page->name() ?>.yml</code>.</p>

	<?php else: ?>
		<?= $page->text()->kt() ?>
	<?php endif ?>

	<h3 id="default-files__vue-component"><a href="#default-files__vue-component">Vue component</a></h3>
	<p><a href="<?= option('github.url') ?>/kirby/blob/main/panel/src/components/Forms/Blocks/Types/<?= ucfirst($page->title()) ?>.vue"><code>kirby/src/components/Forms/Blocks/Types/<?= ucfirst($page->title()) ?>.vue</code></a></p>
</div>
