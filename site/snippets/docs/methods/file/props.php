## The `$props` parameter

<table class="properties">
  <thead>
    <tr>
      <th>Property</th>
      <th>Type</th>
      <th>Description</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>blueprint</td>
      <td><?= formatType('array') ?></td>
      <td>Blueprint definition</td>
    </tr>

    <tr>
      <td>content</td>
      <td><?= formatType('array') ?></td>
      <td>Field values</td>
    </tr>

    <tr>
      <td>filename</td>
      <td><?= formatType('string') ?></td>
      <td>Field values</td>
    </tr>

    <tr>
      <td>parent<?= formatRequired(true) ?></td>
      <td><?= formatType('Kirby\Cms\Model') ?></td>
      <td><code>$site</code>, <code>$page</code> or <code>$user</code></td>
    </tr>

    <tr>
      <td>root</td>
      <td><?= formatType('string') ?></td>
      <td></td>
    </tr>

    <tr>
      <td>source<?= formatRequired(true) ?></td>
      <td><?= formatType('string') ?></td>
      <td></td>
    </tr>

    <tr>
      <td>template</td>
      <td><?= formatType('string') ?></td>
      <td></td>
    </tr>

    <tr>
      <td>translations</td>
      <td><?= formatType('array') ?></td>
      <td>Language codes with subarrays of field values</td>
    </tr>

    <tr>
      <td>url</td>
      <td><?= formatType('string') ?></td>
      <td></td>
    </tr>
  </tbody>
</table>
