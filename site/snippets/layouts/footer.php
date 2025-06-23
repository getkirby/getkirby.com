<footer class="footer text-sm">
	<div class="container mb-24">
		<?php if ($separator ?? true): ?>
		<hr class="hr mb-6">
		<?php endif ?>

		<div class="flex">
			<div class="footer-info mb-6">
				<p class="font-bold mb-1">Kirby</p>
				<p class="mb-3">The CMS that adapts to any project. Made for developers, designers, creators and clients.</p>
				<nav aria-label="Kirby on the web" class="social mb-3">
					<a rel="me" href="<?= option('github.url') ?>">
						<?= icon('github', 'GitHub') ?>
					</a>
					<a rel="me" href="https://mastodon.social/@getkirby">
						<?= icon('mastodon', 'Mastodon') ?>
					</a>
					<a rel="me" href="https://bsky.app/profile/getkirby.com">
						<?= icon('bluesky', 'Bluesky') ?>
					</a>
					<a rel="me" href="https://linkedin.com/company/getkirby">
						<?= icon('linkedin', 'LinkedIn') ?>
					</a>
					<a rel="me" href="https://videos.getkirby.com">
						<?= icon('youtube', 'YouTube') ?>
					</a>
					<a rel="me" href="https://chat.getkirby.com">
						<?= icon('discord', 'Discord') ?>
					</a>
				</nav>
				<p class="mb-3 color-gray-700 flex items-center">
					🇪🇺 Made in Europe
				</p>
			</div>
			<nav aria-label="Footer menu" class="footer-menu">
				<ul class="footer-menu-1 columns" style="--columns-sm: 2; --columns-md: 3; --columns: 3; --column-gap: var(--spacing-8); --row-gap: var(--spacing-6)">
					<li>
						<p class="font-bold mb-1">The CMS</p>
						<ul class="footer-menu-2">
							<?php snippet('layouts/menu-items', [
								'items' => [
									'For developers'         => '/for/developers',
									'For designers'          => '/for/designers',
									'For content creators'   => '/for/creators',
									'For clients & agencies' => '/for/clients',
									'For artists'            => '/for/artists',
									'For events'             => '/for/events',
									'For education'          => '/for/education',
									'For hospitality'        => '/for/hospitality',
									'Showcase'               => '/love',
									'Releases'               => '/releases',
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
									'Themes'      => '/themes',
									'Newsletter'  => '/kosmos',
									'Buzz'        => '/buzz',
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
									'Get together'  => '/meet',
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
									'Security' => '/security',
									'Privacy'  => '/privacy',
									'License'  => '/license',
									'Presskit' => '/press',
									'Team'     => '/team',
									'Contact'  => '/contact',
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
		</div>
	</div>
</footer>
