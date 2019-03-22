<?php if (count($parameters) > 0): ?>
<h2 id="parameters"><a href="#parameters">Parameters</a></h2>
<table>
  <tr>
    <th>Name</th>
    <th>Type</th>
    <th>Default</th>
    <th>Description</th>
  </tr>
  <?php foreach ($parameters as $param): ?>
  <tr>
    <td><code>$<?= $param['name'] ?></code></td>
    <td><code><?= $param['type'] ?></code></td>
    <td><code><?= $param['default'] ?></code></td>
    <td class="text"><?= kti($param['description']) ?></td>
  </tr>
  <?php endforeach ?>
</table>
<?php endif ?>
