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
      <td>dirname</td>
      <td><?= formatType('string') ?></td>
      <td></td>
    </tr>

    <tr>
      <td>draft</td>
      <td><?= formatType('bool') ?></td>
      <td>If <code>true</code>, the page will be created as draft</td>
    </tr>

    <tr>
      <td>model</td>
      <td><?= formatType('string') ?></td>
      <td>Page model</td>
    </tr>

    <tr>
      <td>num</td>
      <td><?= formatType('mixed') ?></td>
      <td>Sorting number, use <code>null</code> for unlisted pages</td>
    </tr>

    <tr>
      <td>parent</td>
      <td><?= formatType('Kirby\Cms\Page') ?></td>
      <td>Parent page</td>
    </tr>

    <tr>
      <td>root</td>
      <td><?= formatType('string') ?></td>
      <td></td>
    </tr>

    <tr>
      <td>slug<?= formatRequired(true) ?></td>
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
