<footer class="footer text-sm">
	<div class="container mb-24">
		<?php if ($separator ?? true): ?>
		<hr class="hr mb-6">
		<?php endif ?>

		<div class="flex">
			<div class="footer-info mb-6">
				<p class="font-bold mb-1">Kirby</p>
				<p class="mb-3">The CMS that adapts to any project. Made for developers, designers, creators and clients.</p>
				<nav aria-label="Kirby on the web" class="mb-3">
					<ul class="social">
						<li>
							<a rel="me" href="<?= option('github.url') ?>" aria-label="GitHub">
								<?= icon('github') ?>
							</a>
						</li>
						<li>
							<a rel="me" href="https://mastodon.social/@getkirby" aria-label="Mastodon">
								<?= icon('mastodon') ?>
							</a>
						</li>
						<li>
							<a rel="me" href="https://bsky.app/profile/getkirby.com" aria-label="Bluesky">
								<?= icon('bluesky') ?>
							</a>
						</li>
						<li>
							<a rel="me" href="https://linkedin.com/company/getkirby" aria-label="LinkedIn">
								<?= icon('linkedin') ?>
							</a>
						</li>
						<li>
							<a rel="me" href="https://videos.getkirby.com" aria-label="YouTube">
								<?= icon('youtube') ?>
							</a>
						</li>
						<li>
							<a rel="me" href="https://chat.getkirby.com" aria-label="Discord">
								<?= icon('discord') ?>
							</a>
						</li>
					</ul>
				</nav>
				<p class="mb-3 color-gray-700 flex items-center">
					🇪🇺 Made in Europe
				</p>
			</div>
			<?php if ($kirby->option('archived') === true): ?>
			<div class="max-w-xs">
				<p class="font-bold mb-1">Archived Docs</p>
				<p class="mb-6">
					These docs are no longer maintained. Please check out <a class="underline" href="https://getkirby.com">getkirby.com</a> for more information and the latest version of Kirby.
				</p>
				<p class="font-bold mb-1">About</p>
				<ul class="footer-menu-2">
					<?php snippet('layouts/menu-items', [
						'items' => [
							'Security' => '/security',
							'Privacy'  => '/privacy',
							'License'  => '/license',
							'Presskit' => '/press',
							'Team'     => '/team',
							'Contact'  => '/contact',
						]
					]) ?>
				</ul>
			</div>
			<?php else: ?>
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
									'For artists'            => page('for/artists'),
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
									'Pixels'      => 'https://pixels.getkirby.com',
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
						<p class="font-bold mb-3">With support of</p>
						<ul class="footer-menu-2 footer-menu-partners">
							<li class="mb-3">
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
			<?php endif ?>
		</div>
	</div>
</footer>
