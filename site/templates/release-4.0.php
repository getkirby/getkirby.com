<?php layout() ?>
<?= css('assets/css/layouts/features.css') ?>
<?= css('assets/css/layouts/releases.css') ?>

<style>
  .release-box,
  .release-code-box,
  .release-padded-box,
  .release-text-box {
    border-radius: .5rem;
    overflow: hidden;
    z-index: 1;
  }

  .release-code-box {
    display: grid;
    align-items: stretch;
    background: var(--color-black);
  }

  .release-code-box .code-toolbar {
    display: grid;
  }

  .release-padded-box,
  .release-text-box {
    padding: var(--spacing-6);
  }

  .release-text-box {
    background: var(--color-light);
  }

  .release-padded-box h3,
  .release-text-box h3 {
    font-weight: var(--font-bold);
    font-size: var(--text-lg);
  }

  .release-text-box .prose {
    font-size: var(--text-lg);
  }

  @media screen and (min-width: 60rem) {

    .release-text-box,
    .release-padded-box {
      padding: var(--spacing-12);
    }
  }


.btn {
	border-radius: var(--rounded);
}
</style>

<header class="mb-12 flex items-end justify-between release-header">
  <div>
    <h1 class="h1"><?= $page->title() ?></h1>
    <p class="h1 color-gray-600"><?= $page->subtitle() ?></p>
  </div>

  <?php snippet('templates/releases/cta', [
    'options' => ['center' => false, 'mb' => 0]
  ]) ?>
</header>

<article class="release-wrapper">
	<figure class="release-box mb-6 p-12 bg-black">
		<?= $page->image('chameleon.png') ?>
	</figure>

	<?php snippet('templates/release-40/gist') ?>
	<?php snippet('templates/release-40/roadmap') ?>

	<?php foreach ($sections as $section): ?>
  <?php snippet([
		'templates/release-40/' . $section->slug(),
		'templates/release-40/section'
	], ['section' => $section]) ?>
	<?php endforeach ?>

	<?php snippet('templates/release-40/versioning') ?>

  <section id="faq" class="mb-42">
    <?php snippet('templates/features/intro', [
      'title' => 'Frequently asked questions',
      'text'  => 'We are getting a lot of questions after our announcement and already tried to answer most of them here. We will keep collecting questions from the community here and try to answer them as transparently as possible. Let us know on Discord or in the Forum if you have additional questions.'
    ]) ?>
    <?php snippet('faq') ?>
  </section>

	<?php snippet('templates/release-40/changes') ?>

	<?php snippet('templates/releases/get-started') ?>
  <?php snippet('templates/release-40/release-menu') ?>

</article>

<?= js('assets/js/templates/release.js') ?>
