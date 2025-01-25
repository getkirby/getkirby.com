<div class="menu ml-auto">
	<input id="menu-check" type="checkbox">
	<label tabindex="0" class="menu-toggle" for="menu-check" aria-label="Show / hide menu">
		<?= icon('menu') ?>
	</label>
	<nav aria-label="Main menu">
		<ul class="menu-1">
			<li class="has-submenu">
				<a href="<?= page('for/developers')->menuUrl() ?>">The CMS</a>
				<ul class="menu-2">
					<?php snippet('layouts/menu-items', [
						'items' => [
							'For developers'         => page('for/developers'),
							'For designers'          => page('for/designers'),
							'For content creators'   => page('for/creators'),
							'For clients & agencies' => page('for/clients'),
							'-',
							'Showcase' => page('love'),
							'Releases' => page('releases'),
							'Feedback' => 'https://feedback.getkirby.com',
						]
					]) ?>
				</ul>
			</li>
			<li class="has-submenu">
				<a href="<?= page('docs/guide')->menuUrl() ?>">Docs</a>
				<ul class="menu-2">
					<?php snippet('layouts/menu-items', [
						'items' => [
							'Guide'       => page('docs/guide'),
							'Reference'   => page('docs/reference'),
							'Cookbook'    => page('docs/cookbook'),
							'Quicktips'   => page('docs/quicktips'),
							'Screencasts' => 'https://www.youtube.com/kirbycasts',
							'Glossary'    => page('docs/glossary'),
						]
					]) ?>
				</ul>
			</li>
			<li class="has-submenu">
				<a href="<?= page('kosmos')->menuUrl() ?>">Resources</a>
				<ul class="menu-2">
					<?php snippet('layouts/menu-items', [
						'items' => [
							'Plugins' => 'https://plugins.getkirby.com',
							'Themes'  => page('themes'),
							'-',
							'Newsletter' => page('kosmos'),
							'Buzz'       => page('buzz'),
							'-',
							'License Hub' => 'https://hub.getkirby.com',
						]
					]) ?>
				</ul>
			</li>
			<li class="has-submenu">
				<a href="<?= page('meet')->menuUrl() ?>">Community</a>
				<ul class="menu-2">
					<?php snippet('layouts/menu-items', [
						'items' => [
							'Get together' => page('meet'),
							'-',
							'Support forum' => 'https://forum.getkirby.com',
							'Discord chat' => 'https://chat.getkirby.com',
							'Community map' => 'https://community.getkirby.com',
							'-',
							'Mastodon' => 'https://mastodon.social/@getkirby',
							'LinkedIn' => 'https://www.linkedin.com/company/getkirby',
						]
					]) ?>
				</ul>
			</li>
			<li><a class="partners" href="<?= page('partners')->menuUrl() ?>">Partners</a></li>
		</ul>
		<ul class="menu-1 menu-steps">
			<li><a href="<?= page('try')->menuUrl() ?>">Try</a></li>
			<li>
				<a href="<?= page('love')->menuUrl() ?>" aria-label="Love">
					<?= icon('heart') ?>
				</a>
			</li>
			<li>
				<a href="<?= page('buy')->menuUrl() ?>">Buy</a>
			</li>
		</ul>
	</nav>
</div>
