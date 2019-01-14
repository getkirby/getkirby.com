<ul class="clients">
  <?php foreach (page('clients')->children()->shuffle() as $client): ?>
  <?php if ($image = $client->image()): ?>
  <li>
    <img src="<?= $image->url() ?>" alt="<?= $client->title() ?>">
  </li>
  <?php endif ?>
  <?php endforeach ?>
</ul>
