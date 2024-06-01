<footer class="footer text-sm">
	<div class="container mb-24">
		<?php if ($separator ?? true): ?>
		<hr class="hr mb-6">
		<?php endif ?>

		<div class="columns" style="--columns-sm: 1; --columns-md: 1; --columns: 2; --gap: var(--spacing-12)">
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
				<ul class="footer-menu-1 columns" style="--columns-sm: 2; --columns-md: 3; --columns: 3; --gap: var(--spacing-6)">
					<li>
						<p class="font-bold mb-1">The CMS</p>
						<ul class="footer-menu-2">
							<li><a href="<?= page('features/developers')->menuUrl() ?>">For developers</a></li>
							<li><a href="<?= page('features/designers')->menuUrl() ?>">For designers</a></li>
							<li><a href="<?= page('features/creators')->menuUrl() ?>">For content creators</a></li>
							<li><a href="<?= page('features/clients')->menuUrl() ?>">For clients & agencies</a></li>
							<li><a href="<?= page('love')->menuUrl() ?>">Showcase</a></li>
							<li><a href="<?= page('releases')->menuUrl() ?>">Releases</a></li>
							<li><a href="https://feedback.getkirby.com">Feedback</a></li>
						</ul>
					</li>
					<li>
						<p class="font-bold mb-1">Docs</p>
						<ul class="footer-menu-2">
							<li><a href="<?= page('docs/guide')->menuUrl() ?>">Guide</a></li>
							<li><a href="<?= page('docs/reference')->menuUrl() ?>">Reference</a></li>
							<li><a href="<?= page('docs/cookbook')->menuUrl() ?>">Cookbook</a></li>
							<li><a href="<?= page('docs/quicktips')->menuUrl() ?>">Quicktips</a></li>
							<li><a href="https://videos.getkirby.com">Screencasts</a></li>
							<li><a href="<?= page('docs/glossary')->menuUrl() ?>">Glossary</a></li>
							<li><a href="<?= page('docs/archive')->menuUrl() ?>">Archive</a></li>
						</ul>
					</li>
					<li>
						<p class="font-bold mb-1">Resources</p>
						<ul class="footer-menu-2">
							<li><a href="https://plugins.getkirby.com">Plugins</a></li>
							<li><a href="<?= page('themes')->menuUrl() ?>">Themes</a></li>
							<li><a href="<?= page('kosmos')->menuUrl() ?>">Newsletter</a></li>
							<li><a href="<?= page('buzz')->menuUrl() ?>">Buzz</a></li>
							<li><a href="https://hub.getkirby.com">License Hub</a></li>
						</ul>
					</li>
					<li>
						<p class="font-bold mb-1">Community</p>
						<ul class="footer-menu-2">
							<li><a href="<?= page('meet')->menuUrl() ?>">Get together</a></li>
							<li><a href="https://forum.getkirby.com">Support forum</a></li>
							<li><a href="https://chat.getkirby.com">Discord chat</a></li>
							<li><a href="https://community.getkirby.com">Community map</a></li>
							<li><a href="https://mastodon.social/@getkirby">Mastodon</a></li>
							<li><a href="https://www.linkedin.com/company/getkirby">LinkedIn</a></li>
							<li><a href="https://instagram.com/getkirby">Instagram</a></li>
						</ul>
					</li>
					<li>
						<p class="font-bold mb-1">Kirby</p>
						<ul class="footer-menu-2">
							<li><a href="<?= page('security')->menuUrl() ?>">Security</a></li>
							<li><a href="<?= page('privacy')->menuUrl() ?>">Privacy</a></li>
							<li><a href="<?= page('license')->menuUrl() ?>">License</a></li>
							<li><a href="<?= page('press')->menuUrl() ?>">Presskit</a></li>
							<li><a href="<?= page('contact')->menuUrl() ?>">Contact</a></li>
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
