<?php layout('reference') ?>

<div class="prose">
  <?php if (count($page->attributes()) > 0): ?>
  <h2 id="attributes"><a href="#attributes">Attributes</a></h2>
  <div class="table">
    <table>
      <?php foreach ($page->attributes() as $attribute): ?>
      <tr>
        <td><?= $attribute ?></td>
      </tr>
      <?php endforeach ?>
    </table>
  </div>
  <?php endif ?>

  <?= $page->text()->kt() ?>
</div>
