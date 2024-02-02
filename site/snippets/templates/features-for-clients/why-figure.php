<style>
.why svg {
	width: 64px;
	height: 64px;
}
</style>

<ul class="why columns color-gray-400" style="--columns-sm: 2; --columns-md: 4; --columns-lg: 3; --gap: var(--spacing-12)">
  <?php foreach ($page->images()->filterBy('extension', 'svg')->sortBy('sort') as $medium): ?>
  <li>
    <figure>
      <figcaption class="h6 color-black mb-1" ><?= $medium->title() ?></figcaption>
      <p class="border-top pt-3"><?= $medium->read() ?></p>
    </figure>
  </li>
  <?php endforeach ?>
</ul>
