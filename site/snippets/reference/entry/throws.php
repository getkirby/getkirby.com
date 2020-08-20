<?php
extract([
  'throws' => $throws ?? $page->throws()
]);
?>
<?php if (count($throws) > 0): ?>
<h2 id="exceptions"><a href="#exceptions">Exceptions</a></h2>
<table>
  <tr>
    <th>Type</th>
    <th>Description</th>
  </tr>
  <?php foreach ($throws as $throw): ?>
  <tr>
    <td><code><?= $throw['type'] ?></code></td>
    <td class="text"><?= kti($throw['description']) ?></td>
  </tr>
  <?php endforeach ?>
</table>
<?php endif ?>
