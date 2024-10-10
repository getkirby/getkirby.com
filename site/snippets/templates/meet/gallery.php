<section class="mb-24">
	<h2 class="h2 mb-6">Shake it like a polaroid picture</h2>
	<ul class="album-gallery">
		<?php foreach ($gallery as $image): ?>
		<li>
			<figure class="img rounded-xl overflow-hidden" style="--w:<?= $image->width() ?>;--h:<?= $image->height() ?>">
				<img src="<?= $image->resize(800)->url() ?>" alt="Meetup <?= $image->page()->city()->esc() ?> - <?= $image->page()->date()->toDate('M Y') ?>" loading="lazy">
			</figure>
		</li>
		<?php endforeach ?>
	</ul>
</section>

<style>
.album-gallery {
  line-height: 0;
  columns: 1;
  column-gap: 1.5rem;
}
.album-gallery li {
  display: block;
  break-inside: avoid;
}
.album-gallery li:not(:last-child) {
  margin-bottom: 1.5rem;
}
@media screen and (min-width: 40rem) {
  .album-gallery {
    columns: 2;
  }
}
@media screen and (min-width: 60rem) {
  .album-gallery {
    columns: 3;
  }
}
</style>
