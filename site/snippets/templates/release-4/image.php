<?php
/**
 * @var string $alt
 * @var string|null $class
 * @var Kirby\Cms\File|Kirby\Cms\FileVersion|null $img
 */
?>
<img src="<?= $img->url() ?>" style="aspect-ratio: <?= $img->width() . '/' . $img->height() ?>" loading="lazy" alt="<?= $alt ?? null ?>" class="<?= $class ?? null ?>">
