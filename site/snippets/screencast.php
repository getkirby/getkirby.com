<?php
/**
 * @var Kirby\Cms\Page $page
 */
?>
<?php if ($page->screencast()->isNotEmpty()): ?>
	<?= $page->screencast()->kt() ?>
<?php endif ?>
