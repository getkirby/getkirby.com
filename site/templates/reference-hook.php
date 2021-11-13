<?php layout('reference') ?>

<div class="prose">
  <?= $page->example()->kt() ?>

  <?php $arguments = $page->arguments()->split() ?>
  <?php if (count($arguments) > 0): ?>
  <h2 id="parameters"><a href="#parameters">Parameters</a></h2>
  <div class="table">
    <table>
      <thead>
        <th>Parameter</th>
        <th>Type</th>
      </thead>
      <?php foreach ($arguments as $argument): ?>
      <?php $argument = explode(' ', $argument) ?>
      <tr>
        <td><?= $argument[count($argument) - 1] ?></td>
        <td><?= Types::format($argument[count($argument) - 2] ?? '-') ?></td>
      </tr>
      <?php endforeach ?>
    </table>
  </div>
  <?php endif ?>

  <?= $page->details()->kt() ?>
</div>
