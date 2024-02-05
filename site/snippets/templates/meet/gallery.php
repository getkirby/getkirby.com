<section>
	<h2 class="h2 mb-6">Shake it like a polaroid picture</h2>
	<ul class="album-gallery">
		<?php foreach ($gallery as $image): ?>
		<li>
			<figure class="img" style="--w:<?= $image->width() ?>;--h:<?= $image->height() ?>">
				<img src="<?= $image->resize(800)->url() ?>" alt="<?= $image->alt()->esc() ?>">
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
  margin-bottom: 1.5rem;
  break-inside: avoid;
}
@media screen and (min-width: 60rem) {
  .album-gallery {
    columns: 2;
  }
}
</style>
