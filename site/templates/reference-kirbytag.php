<?php snippet('cheatsheet.article.header') ?>

  <div class="text">
    <?php if (count($attributes)): ?>
    <h2 id="attributes"><a href="#attributes">Attributes</a></h2>
    <table>
      <?php foreach ($attributes as $attribute): ?>
      <tr>
        <td><?= $attribute ?></td>
      </tr>
      <?php endforeach ?>
    </table>
    <?php endif ?>

    <?= $page->text()->kt()->anchorHeadlines() ?>

    <?php snippet('method/source', ['link' => $page->githubSource()]) ?>
  </div>

  <?php snippet('github.edit') ?>

<?php snippet('cheatsheet.article.footer') ?>
