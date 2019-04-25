<?php

$padding = rtrim(number_format($image->height() / $image->width() * 100, 5, '.', ''), '0');
$tagName = !empty($link)? 'a' : 'span';

?>
<<?= $tagName . (!empty($link) ? ' href="' . html($link) . '"' : '') ?> class="intrinsic" style="padding-bottom: <?= $padding ?>%;">
  <img
    src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw=="
    <?php if (isset($srcset)): ?>
    data-src="<?= $image->resize($srcset[0])->url() ?>"
    data-srcset="<?= $image->srcset($srcset) ?>"
    data-sizes="auto"
    sizes="100vw"
    <?php else: ?>
    data-src="<?= $image->url() ?>"
    <?php endif ?>
    class="lazyload"
    alt="<?= $image->alt()->html() ?>"
  >
  <noscript>
  <?php if (isset($srcset)): ?>
  <img src="<?= $image->resize($srcset[0])->url() ?>"
       srcset="<?= $image->srcset($srcset) ?>"
       sizes="100vw"
       alt="<?= $image->alt()->html() ?>"
  >
  <?php else: ?>
  <img src="<?= $image->url() ?>"
       alt="<?= $image->alt()->html() ?>"
  >
  <?php endif ?>
  </noscript>
</<?= $tagName ?>>
