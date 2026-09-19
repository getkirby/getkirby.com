<?php
/**
 * @var BuzzInterviewPage $page
 */
?>
<?php layout() ?>

<style>
.prose {
	--avatar-size: 2.25rem;
	--avatar-gap: 1rem;
}

.interview {
	margin-bottom: 1.5rem;
}
.interview > li + li {
	margin-top: 2.75rem;
}
.answer {
	margin-top: 1rem;
}


.prose :where(.question, .answer, .outro) {
	display: grid;
	grid-template-columns: var(--avatar-size) minmax(0, 1fr);
	column-gap: var(--avatar-gap);
}
.prose :where(.question, .answer, .outro) > :not(.avatar) {
	grid-column: 2;
}
.prose :where(.question, .answer, .outro) > .image {
	grid-column: 1 / -1;
}
/* the text sharing row 1 with the avatar: no inherited `* + p` spacing,
   and centred against the avatar while it is the shorter of the two */
.prose :where(.question, .answer, .outro) > :is(:first-child, .avatar + *) {
	margin-top: 0;
	align-self: center;
}

.prose .image a {
	display: block;
}

.prose strong {
	text-decoration: underline;
	text-decoration-style: solid;
	text-decoration-skip-ink: none;
	text-decoration-thickness: 3px;
	text-decoration-color: #E1E1E1;
	font-weight: 400;
}

.prose .avatar {
	grid-area: 1 / 1;
	align-self: start;
	width: var(--avatar-size);
	height: var(--avatar-size);
	color: var(--color-black);
}
.prose .avatar :where(img, svg) {
	width: 100%;
	height: 100%;
	object-fit: contain;
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

<article class="mb-24">
	<?php $avatar = $page->avatar() ?>

	<ol class="interview">
		<?php foreach ($page->qa() as $qa): ?>
			<li class="prose">
				<div class="question">
					<span class="avatar" aria-hidden="true">
						<?= icon('kirby') ?>
					</span>
					<p><strong><?= $qa->question()->kti() ?></strong></p>
				</div>

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
			</li>
		<?php endforeach ?>
	</ol>

	<?php if ($page->outro()->isNotEmpty()): ?>
		<div class="prose">
			<div class="outro">
				<?= $page->outro()->kt() ?>
			</div>
		</div>
	<?php endif ?>
</article>
