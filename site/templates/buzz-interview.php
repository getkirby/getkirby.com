<?php
/**
 * @var BuzzEntryPage $page
 * @var Kirby\Cms\Pages $authors
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

  .prose p, .prose ul, .prose .image a{
    position: relative;
    padding: var(--bubble-pad-y) 0px;
    padding-left: calc(var(--name-col) + var(--gap) + var(--bubble-pad-x));
	min-height: 3.5em;
  }

  .prose .image a{
	padding-left: 0px;
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

  /* name — pulled into the empty left margin, plain, no box */
  .prose p > strong:first-child {
    position: absolute;
    left: 0;
    top: var(--bubble-pad-y);
    text-align: right;
    height: 2.5em;
    width: 2.5em;
    background-size: 100% 100%;
	transform: translateY(-0.5em);
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


<div class="w-auto header-img">
<?php if ($image = $page->image('z-interview-header.jpg')): ?>
	<img src="<?= $image->url() ?>" alt="<?= $page->title() ?>" class="rounded mb-12 shadow-lg w-auto" />
<?php endif ?>
</div>
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

	<?php snippet('toc') ?>
</header>

<?php if ($page->video()->isNotEmpty()): ?>
	<figure class="rounded overflow-hidden mb-12 shadow-lg" style="--aspect-ratio: 800/400">
		<?= video($page->video(), $page->image('youtube.jpg')) ?>
	</figure>
<?php endif ?>

<article>
	<div class="prose mb-24">
		<?= $page->text()->kt() ?>
	</div>

</article>
