<?php layout() ?>

<article>
	<header class="max-w-xl mb-24">
		<h1 class="h1 mb-6">Get together</h1>
		<p class="text-xl leading-snug color-gray-700">
			<?= $page->description() ?>
		</p>
	</header>

	<?php if ($message): ?>
	<aside class="block box box--<?= $message['type'] ?> mb-12">
		<?php snippet('kirbytext/box', [
			'type' => $message['type'],
			'text' => $message['text']
		]) ?>
	</aside>
	<?php endif ?>

	<?php snippet('templates/meet/events', ['events' => $events]) ?>
	<?php snippet('templates/meet/map', ['people' => $people]) ?>
	<?php snippet('templates/meet/form') ?>

	<footer>
		<h2 class="h2 mb-3">Want to host a meetup?</h2>
		<div class="relative prose mb-24">
			<ol>
				<li><b>It doesn't need to be big:</b> whether a small get-together at the local pub or hosting in the office of an agency. What counts is to get together with likeminded people. Start small.</li>
				<li><b>Use the community map to find people nearby.</b> Maybe get in touch with one or two. Hosting a meetup together can take off some stress from yourself.</li>
				<li><b>Think about how to spend the time.</b> What do you prefer? Just chatting with other developers about Kirby, work and life? Sharing lessons learned from projects in short presentations?</li>
				<li><b>Spread the word.</b> Let the community know about your event. Share it on <a href="/docs/archive"><span class="link">Discord</span></a> and the Kirby team will help promote it.</li>
				<li><b>Take photos.</b> Not a must and nobody who doesn't like it should be forced to. We really love to see some snaps when people from the community get together. If everyone feels comfortable with it, let us see your happy faces.</li>
			</ol>
		</div>

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
	</footer>
</article>

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
