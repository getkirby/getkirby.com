## The `$props` parameter

<table class="properies">
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
      <td><?= formatDatatype('array') ?></td>
      <td>Blueprint definition</td>
    </tr>

    <tr>
      <td>content</td>
      <td><?= formatDatatype('array') ?></td>
      <td>Field values</td>
    </tr>

    <tr>
      <td>dirname</td>
      <td><?= formatDatatype('string') ?></td>
      <td></td>
    </tr>

    <tr>
      <td>draft</td>
      <td><?= formatDatatype('bool') ?></td>
      <td>If <code>true</code>, the page will be created as draft</td>
    </tr>

    <tr>
      <td>model</td>
      <td><?= formatDatatype('string') ?></td>
      <td>Page model</td>
    </tr>

    <tr>
      <td>num</td>
      <td><?= formatDatatype('mixed') ?></td>
      <td>Sorting number, use <code>null</code> for unlisted pages</td>
    </tr>

    <tr>
      <td>parent</td>
      <td><?= formatDatatype('Kirby\Cms\Page') ?></td>
      <td>Parent page</td>
    </tr>

    <tr>
      <td>root</td>
      <td><?= formatDatatype('string') ?></td>
      <td></td>
    </tr>

    <tr>
      <td>slug<?= formatRequired(true) ?></td>
      <td><?= formatDatatype('string') ?></td>
      <td></td>
    </tr>

    <tr>
      <td>template</td>
      <td><?= formatDatatype('string') ?></td>
      <td></td>
    </tr>

    <tr>
      <td>translations</td>
      <td><?= formatDatatype('array') ?></td>
      <td>Language codes with subarrays of field values</td>
    </tr>

    <tr>
      <td>url</td>
      <td><?= formatDatatype('string') ?></td>
      <td></td>
    </tr>

  </tbody>
</table>
