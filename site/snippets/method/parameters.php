<?php if (count($parameters) > 0): ?>
<h2 id="parameters"><a href="#parameters">Parameters</a></h2>
<table class="properties">
  <thead>
    <tr>
      <th>Name</th>
      <th>Type</th>
      <th>Default</th>
      <th>Description</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($parameters as $param): ?>
    <tr>
      <td><code>$<?= $param['name'] ?></code></td>
      <td><?= formatDatatype($param['type']) ?></td>
      <td data-property-label="Default:"><?= formatDefault($param['default']) ?></td>
      <td class="text"><?= kti($param['description']) ?></td>
    </tr>
    <?php endforeach ?>
  </tbody>
</table>
<?php endif ?>
