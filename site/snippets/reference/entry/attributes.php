<?php
extract([
  'attributes' => $attributes ?? $page->attributes()
]);
?>
<?php if (count($attributes) > 0): ?>
<h2 id="attributes"><a href="#attributes">Attributes</a></h2>
<table>
  <?php foreach ($attributes as $attribute): ?>
  <tr>
    <td><?= $attribute ?></td>
  </tr>
  <?php endforeach ?>
</table>
<?php endif ?>
