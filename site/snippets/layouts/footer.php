<footer class="footer text-sm">
	<div class="container mb-24">
		<?php if ($separator ?? true): ?>
		<hr class="hr mb-6">
		<?php endif ?>

		<div class="flex">
			<div class="footer-info mb-6">
				<p class="font-bold mb-1">Kirby</p>
				<p class="mb-1">The CMS that adapts to any project. Made for developers, designers, creators and clients.</p>
				<nav aria-label="Kirby on the web" class="social">
					<a title="Mastodon" rel="me" href="https://mastodon.social/@getkirby">
						<?= icon('mastodon') ?>
					</a>
					<a title="GitHub" rel="me" href="https://github.com/getkirby">
						<?= icon('github') ?>
					</a>
					<a title="Instagram" rel="me" href="https://instagram.com/getkirby">
						<?= icon('instagram') ?>
					</a>
					<a title="Youtube" rel="me" href="https://videos.getkirby.com">
						<?= icon('youtube') ?>
					</a>
					<a title="Discord" rel="me" href="https://chat.getkirby.com">
						<?= icon('discord') ?>
					</a>
					<a title="LinkedIn" rel="me" href="https://linkedin.com/company/getkirby">
						<?= icon('linkedin') ?>
					</a>
				</nav>
			</div>
			<nav aria-label="Footer menu" class="footer-menu">
				<ul class="footer-menu-1 columns" style="--columns-sm: 2; --columns-md: 3; --columns: 3; --column-gap: var(--spacing-8); --row-gap: var(--spacing-6)">
					<li>
						<p class="font-bold mb-1">The CMS</p>
						<ul class="footer-menu-2">
							<?php snippet('layouts/menu-items', [
								'items' => [
									'For developers'         => page('for/developers'),
									'For designers'          => page('for/designers'),
									'For content creators'   => page('for/creators'),
									'For clients & agencies' => page('for/clients'),
									'For events'             => page('for/events'),
									'For education'          => page('for/education'),
									'For hospitality'        => page('for/hospitality'),
									'Showcase'               => page('love'),
									'Releases'               => page('releases'),
									'Feedback'               => 'https://feedback.getkirby.com',
								]
							]) ?>
						</ul>
					</li>
					<li>
						<p class="font-bold mb-1">Docs</p>
						<ul class="footer-menu-2">
							<?php snippet('layouts/menu-items', [
								'items' => [
									'Guide'       => page('docs/guide'),
									'Reference'   => page('docs/reference'),
									'Cookbook'    => page('docs/cookbook'),
									'Quicktips'   => page('docs/quicktips'),
									'Screencasts' => 'https://www.youtube.com/kirbycasts',
									'Glossary'    => page('docs/glossary'),
									'Archive'     => page('docs/archive'),
								]
							]) ?>
						</ul>
					</li>
					<li>
						<p class="font-bold mb-1">Resources</p>
						<ul class="footer-menu-2">
							<?php snippet('layouts/menu-items', [
								'items' => [
									'Plugins'     => 'https://plugins.getkirby.com',
									'Themes'      => page('themes'),
									'Newsletter'  => page('kosmos'),
									'Buzz'        => page('buzz'),
									'License Hub' => 'https://hub.getkirby.com',
								]
							]) ?>
						</ul>
					</li>
					<li>
						<p class="font-bold mb-1">Community</p>
						<ul class="footer-menu-2">
							<?php snippet('layouts/menu-items', [
								'items' => [
									'Get together'  => page('meet'),
									'Support forum' => 'https://forum.getkirby.com',
									'Discord chat'  => 'https://chat.getkirby.com',
									'Community map' => 'https://community.getkirby.com',
									'Mastodon'      => 'https://mastodon.social/@getkirby',
									'LinkedIn'      => 'https://www.linkedin.com/company/getkirby',
									'Instagram'     => 'https://instagram.com/getkirby',
								]
							]) ?>
						</ul>
					</li>
					<li>
						<p class="font-bold mb-1">Kirby</p>
						<ul class="footer-menu-2">
							<?php snippet('layouts/menu-items', [
								'items' => [
									'Security' => page('security'),
									'Privacy'  => page('privacy'),
									'License'  => page('license'),
									'Presskit' => page('press'),
									'Team'     => page('team'),
									'Contact'  => page('contact'),
								]
							]) ?>
						</ul>
					</li>
					<li>
						<p class="font-bold mb-1">With support of</p>
						<ul class="footer-menu-2 footer-menu-partners">
							<li class="mb-1">
								<a href="https://keycdn.com">
									<?= icon('keycdn') ?>
								</a>
							</li>
							<li>
								<a href="https://algolia.com">
									<?= icon('algolia') ?>
								</a>
							</li>
						</ul>
					</li>
				</ul>
			</nav>
		</div>
	</div>
</footer>
