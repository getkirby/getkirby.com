<?php layout() ?>

<style>
:root {
	--box-info: var(--color-blue-400);
	--box-warning: var(--color-yellow-400);
}
</style>

<header class="mb-42 flex items-center justify-between">
	<div>
		<h1 class="h1"><?= $page->title() ?></h1>
		<p class="h1 color-gray-600">Calumma</p>
	</div>

	<?php snippet('cta', [
		'buttons' => [
			[
				'text' => 'Try now',
				'link' => '/try',
				'icon' => 'download',
				'style' => 'outlined'
			],
		],
		'center' => false,
		'mb' => 0
	]) ?>

</header>

<section class="columns mb-36" style="--columns: 2; --gap: var(--spacing-24)">
	<article>
		<?php snippet('hgroup', [
			'title'    => 'Builder + Editor = Blocks',
			'subtitle' => 'A match made in heaven'
		]) ?>
		<div class="prose text-lg mb-12">
			<p>Our brand-new Blocks field is the perfect solution for complex single-column layouts and long-form text.</p>
			<p>It brings the best of the <a href="<?= option('github.url') ?>/editor">Editor</a> and the <a href="https://github.com/TimOetting/kirby-builder">Builder</a> plugins into the core. Combining a great WYSIWYG editing experience with fully customizable blocks. <a href="<?= url('docs/reference/panel/fields/blocks') ?>">Learn more &rarr;</a></p>
		</div>
		<aside class="mb-12">
			<h3 class="h3 mb-3">Highlights</h3>
			<?php snippet('templates/release-35/gallery', [
				'images' => ['blocks-selector', 'blocks-settings', 'blocks-plugins']
			]) ?>
		</aside>
	</article>
	<figure>
		<a class="block bg-light p-6" href="<?= url('docs/reference/panel/fields/blocks') ?>">
			<?php if ($image = $page->image('blocks.jpg')): ?>
			<img
				loading="lazy"
				src="<?= $image->resize(700)->url() ?>"
				srcset="<?= $image->srcset([
					700,
					1400,
				]) ?>"
				alt="The new blocks field"
			>
			<?php endif ?>
		</a>
	</figure>
</section>

<section class="columns mb-36" style="--columns: 2; --gap: var(--spacing-24)">
	<figure>
		<a href="<?= url('docs/reference/panel/fields/layout') ?>">
			<?php if ($image = $page->image('layouts.jpg')): ?>
			<img
				loading="lazy"
				class="shadow-xl rounded"
				src="<?= $image->resize(700)->url() ?>"
				srcset="<?= $image->srcset([
					700,
					1400,
				]) ?>"
				alt="The new layouts field"
			>
			<?php endif ?>
		</a>
	</figure>
	<article>
		<?php snippet('hgroup', [
			'title'    => 'Layout',
			'subtitle' => 'Yes you can'
		]) ?>
		<div class="prose text-lg mb-12">
			<p>Together with the new Blocks field we are also introducing a powerful new Layout field. Arrange blocks in multiple columns and build complex page layouts. Assign custom layout settings and fine-tune the generated HTML in your templates. <a href="<?= url('docs/reference/panel/fields/layout') ?>">Learn more &rarr;</a></p>
		</div>
		<aside class="mb-12">
			<h3 class="h3 mb-3">Highlights</h3>
			<?php snippet('templates/release-35/gallery', [
				'images' => ['layout-blocks', 'layout-selector', 'layout-settings']
			]) ?>
		</aside>
	</article>
</section>

<section class="mb-36">
	<h2 class="h2 mb-6">Authentication</h2>

	<div class="highlight columns color-white bg-dark" style="--columns: 3; --gap: var(--spacing-24)">
		<article>
			<header>
				<h3 class="h3 mb-1" style="color: var(--color-green-400)">Passwordless login</h3>
			</header>
			<div class="prose text-base color-gray-400 mb-12">
				<p>3.5 comes with major enhancements for your login flow. Enable password-less login for secure, one-time code authentication.</p>
			</div>

			<div class="mb-12">
				<?php snippet('templates/release-35/image', [
					'image' => $page->image('login-passwordless.jpg')
				]) ?>
			</div>

			<div class="mb-12">
				<?php snippet('templates/release-35/image', [
					'image' => $page->image('login-code.jpg')
				]) ?>
			</div>
			<div>
				<a class="underline" href="<?= url('docs/guide/authentication/login-methods') ?>">Learn more &rarr;</a>
			</div>
		</article>

		<article>
			<header>
				<h3 class="h3 mb-1" style="color: var(--color-purple-400)">Password reset</h3>
			</header>
			<div class="prose text-base color-gray-400 mb-12">
				<p>The new authentication enhancements now offer a secure way for your users to reset their passwords.</p>
			</div>
			<div class="mb-12">
				<?php snippet('templates/release-35/image', [
					'image' => $page->image('password-reset-email.jpg'),
				]) ?>
			</div>
			<div class="mb-12">
				<?php snippet('templates/release-35/image', [
					'image' => $page->image('password-reset-code.jpg')
				]) ?>
			</div>
			<div class="mb-12">
				<?php snippet('templates/release-35/image', [
					'image' => $page->image('password-reset.jpg')
				]) ?>
			</div>
			<div>
				<a class="underline" href="<?= url('docs/guide/authentication/password-reset-form') ?>">Learn more &rarr;</a>
			</div>
		</article>

		<article>
			<header>
				<h3 class="h3 mb-1" style="color: var(--color-aqua-400)">2FA</h3>
			</header>
			<div class="prose text-base color-gray-400 mb-12">
				<p>Secure standard password-based authentication with an additional one-time code verification layer for increased security.</p>
			</div>
			<div class="mb-12">
				<?php snippet('templates/release-35/image', [
					'image' => $page->image('login.jpg')
				]) ?>
			</div>
			<div class="mb-12">
				<?php snippet('templates/release-35/image', [
					'image' => $page->image('login-code.jpg')
				]) ?>
			</div>
			<div>
				<a class="underline" href="<?= url('docs/guide/authentication/frontend-login') ?>">Learn more &rarr;</a>
			</div>
		</article>

	</div>
</section>

<section>
	<h2 class="h2 mb-12">There’s more …</h2>
	<div class="mb-36 masonry" style="--columns-sm: 1; --columns-md: 2; --columns-lg: 4; --gap: var(--spacing-12)">
		<?php snippet('templates/release-35/feature', [
			'headline' => 'Date & Time',
			'image' => $page->image('date.jpg'),
			'text' => 'The new date and time fields are a joy to work with and open completely new ways to enter dates with custom date formats and intervals.',
			'link' => 'docs/reference/panel/fields/date'
		]) ?>

		<?php snippet('templates/release-35/feature', [
			'headline' => 'Writer field',
			'image' => $page->image('writer.jpg'),
			'text' => 'You don’t need the full power of the Blocks? Maybe just some inline HTML? Then the new Writer field is here for you. Create single-line HTML with formats like bold, italic, underline or links.',
			'link' => 'docs/reference/panel/fields/writer'
		]) ?>

		<?php snippet('templates/release-35/feature', [
			'headline' => 'List field',
			'image' => $page->image('list.jpg'),
			'text' => 'The new list field can be used if you want to create simple ordered or unordered lists in a more visual way than with Markdown.',
			'link' => 'docs/reference/panel/fields/list'
		]) ?>

		<?php snippet('templates/release-35/feature', [
			'headline' => 'Quicksearch',
			'image' => $page->image('search.jpg'),
			'text' => 'The Panel search has been redesigned and now shows nice previews for pages, files and users.'
		]) ?>

		<?php snippet('templates/release-35/feature', [
			'headline' => 'Title & URL',
			'image' => $page->image('unified-dialog.jpg'),
			'text' => 'Changing the page title or the page URL is now done in the same dialog. With this simplified workflow you can instantly see when your page title and slug no longer match and should be updated.'
		]) ?>

		<?php snippet('templates/release-35/feature', [
			'headline' => 'Status icons',
			'image' => $page->image('status-icons.jpg'),
			'text' => 'Kirby\'s page status icons now have distinctive forms to make them accessible for people with color blindness.'
		]) ?>

		<?php snippet('templates/release-35/feature', [
			'headline' => 'New starterkit',
			'image' => $page->image('starterkit.jpg'),
			'class' => 'shadow',
			'text' => 'We completely overhauled Kirby’s Starterkit to feature a new design together with the new blocks and layout fields.',
			'link' => option('github.url') . '/starterkit'
		]) ?>
	</div>
</section>

<section class="bg-light p-12">
	<div class="columns" style="--gap: var(--spacing-12)">
		<article style="--span: 4">
			<h3 class="h3 mb-3">More new features</h3>
			<div class="prose color-gray-800 text-sm">
				<?= $page->features()->kt() ?>
			</div>
		</article>
		<article style="--span: 4">
			<h3 class="h3 mb-3">Enhancements</h3>
			<div class="prose color-gray-800 text-sm">
				<?= $page->enhancements()->kt() ?>
			</div>
		</article>
		<article style="--span: 4">
			<h3 class="h3 mb-3">Bug fixes</h3>
			<div class="prose color-gray-800 text-sm">
				<?= $page->bugs()->kt() ?>
			</div>
		</article>
		<article style="--span: 12">
			<h3 class="h3 mb-6">Breaking changes</h3>
			<div class="columns" style="--columns: 2; --gap: var(--spacing-12)">
				<div class="prose color-gray-800 text-sm">
					<?= $page->breaking()->kt() ?>
				</div>
				<div class="prose color-gray-800 text-sm">
					<?= $page->deprecated()->kt() ?>
				</div>
			</div>
		</article>
		<article style="--span: 6">
			<h3 class="h3 mb-3">Stats</h3>
			<div class="prose color-gray-800 text-sm">
				<?= $page->stats()->kt() ?>
			</div>
		</article>
		<article style="--span: 6">
			<h3 class="h3 mb-3">Thank you</h3>
			<div class="prose color-gray-800 text-sm">
				<?= $page->thanks()->kt() ?>
			</div>
		</article>
	</div>
</section>
