<section id="snippets" class="mb-42">

	<?php snippet('hgroup', [
		'title'    => 'Snippets with slots',
		'subtitle' => 'Templating on another level',
		'mb'       => 12
	]) ?>

	<figure class="video mb-6 rounded-xl overflow-hidden" style="--aspect-ratio: 16/9">
		<?= video('https://www.youtube-nocookie.com/watch?v=ASmy8mcBWqg', [
			'youtube' => [
				'controls'       => 0,
				'modestbranding' => 1,
				'showinfo'       => 0,
				'rel'            => 0,
			]
		], [
			'loading' => 'lazy',
			'title' => 'YouTube video demonstrating snippets with slots'
		]) ?>
	</figure>

	<div class="columns mb-6" style="--columns: 2">
		<div class="release-code-box">
			<?= $page->snippetsA()->kt() ?>
		</div>

		<div class="release-code-box">
			<?= $page->snippetsB()->kt() ?>
		</div>
	</div>

	<div class="columns" style="--columns: 3">
		<div class="release-text-box">
			<div class="prose">
				<a href="<?= url('docs/guide/templates/snippets#passing-slots-to-snippets') ?>">Snippets with slots</a> turn your PHP snippets into rich components. Pass full code blocks into a snippet and output them right in the middle of the snippet where you need them.
			</div>
		</div>
		<div class="release-text-box">
			<div class="prose">
				The contents of each slot are captured and passed to the snippet in the <code>$slots</code> variable. Snippets can have multiple slots and you can even combine slots with data variables.
			</div>
		</div>
		<div class="release-text-box">
			<div class="prose">
				Use snippets with slots for simple components like buttons or even for full page layouts. You can nest snippets within slots of other snippets for full flexibility.
			</div>
		</div>
	</div>

</section>
