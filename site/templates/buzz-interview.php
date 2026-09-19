<?php
/**
 * @var BuzzInterviewPage $page
 */
?>
<?php layout() ?>

<style>
:root {
	--name-col: 2em;
	--gap: 0.7em;
	--bubble-pad-x: 0.9em;
	--bubble-pad-y: 0.6em;
}

.prose > :first-child {
	padding-top: var(--bubble-pad-y);
}

.prose :where(p, ul, .image a) {
	position: relative;
	padding-block: var(--bubble-pad-y);
	min-height: 3.5em;
}
.prose :where(p, ul) {
	padding-left: calc(var(--name-col) + var(--gap) + var(--bubble-pad-x));
}

.prose strong{
	text-decoration: underline;
	text-decoration-style: solid;
	text-decoration-skip-ink: none;
	text-decoration-thickness: 3px;
	text-decoration-color: #E1E1E1;
	font-weight: 400;
}

/* bubble background — starts only after the name column, so it never
		bleeds under the name */
.prose p::before {
	content: '';
	position: absolute;
	top: 0;
	bottom: 0;
	left: calc(var(--name-col) + var(--gap));
	right: 0;
	background: #ffffff00;
	border-radius: 0.55rem;
	z-index: -1;
	border: #008c8b00 solid 2px;
}

.answer {
	position: relative;
}
.prose * + .answer {
	margin-top: 1em;
}

.avatar {
	position: absolute;
	left: 0;
	top: var(--bubble-pad-y);
	height: 2.5em;
	width: 2.5em;
	transform: translateY(-0.5em);
}
.avatar :where(img, svg) {
	width: 100%;
	height: 100%;
	object-fit: contain;
}

.prose .image a {
	display:block;
}

.prose img {
	width: 100%;
}

.max-w-xl, article {
	max-width: 45rem;
	margin: auto;
}
</style>


<?php if ($image = $page->image('header.jpg')): ?>
	<?= img($image, [
		// decorative
		'alt'   => $image->alt()->or(''),
		'class' => 'rounded mb-12 shadow-lg w-auto',
		'src'   => [
			'width' => 1248
		],
		// above the fold, so it must not be lazy-loaded
		'lazy'          => false,
		'fetchpriority' => 'high',
		'sizes' => '(min-width: 90rem) 1248px, (min-width: 72rem) calc(100vw - 192px), (min-width: 30rem) calc(100vw - 96px), (min-width: 22rem) calc(100vw - 48px), calc(100vw - 32px)',
		'srcset' => [
			640,
			960,
			1248,
			1600,
			2496
		]
	]) ?>
<?php endif ?>

<header class="mb-12 max-w-xl">
	<div class="text-base mb-1 color-gray-600">
		<?= $page->category()->widont() ?>
	</div>

	<h1 class="h1 mb-12"><?= $page->title() ?></h1>

	<p class="text-xl leading-snug mb-6">
		<?= $page->intro()->widont() ?>
	</p>

	<?php if ($page->cta()->isNotEmpty()): ?>
		<?php snippet('cta', [
			'buttons' => $page->cta()->yaml(),
			'center'  => false
		]) ?>
	<?php endif ?>
</header>

<?php if ($page->video()->isNotEmpty()): ?>
	<figure
		class="rounded overflow-hidden mb-12 shadow-lg"
		style="--aspect-ratio: 800/400"
	>
		<?= video($page->video(), $page->image('youtube.jpg')) ?>
	</figure>
<?php endif ?>

<article>
	<div class="prose mb-24">
		<?php $avatar = $page->avatar() ?>

		<?php foreach ($page->qa() as $qa): ?>
			<p class="question">
				<span class="avatar" aria-hidden="true"><?= icon('kirby') ?></span>
				<strong><?= $qa->question()->kti() ?></strong>
			</p>

			<div class="answer">
				<?php if ($avatar): ?>
					<span class="avatar">
						<?= img($avatar, [
							'alt' => '',
							'src' => [
								'crop'  => true,
								'width' => 40
							],
							'srcset' => [
								'40w' => [
									'crop'  => true,
									'width' => 40
								],
								'80w' => [
									'crop'  => true,
									'width' => 80
								]
							]
						]) ?>
					</span>
				<?php endif ?>

				<?= $qa->answer()->kt() ?>
			</div>
		<?php endforeach ?>

		<?php if ($page->outro()->isNotEmpty()): ?>
			<?= $page->outro()->kt() ?>
		<?php endif ?>
	</div>
</article>
