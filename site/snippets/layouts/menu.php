<div class="menu ml-auto">
	<input id="menu-check" type="checkbox">
	<label tabindex="0" class="menu-toggle" for="menu-check" aria-label="Show / hide menu">
		<?= icon('menu') ?>
	</label>
	<nav aria-label="Main menu">
		<ul class="menu-1">
			<li class="has-submenu">
				<a href="<?= page('features/developers')->menuUrl() ?>">The CMS</a>
				<ul class="menu-2">
					<li><a href="<?= page('features/developers')->menuUrl() ?>">For developers</a></li>
					<li><a href="<?= page('features/designers')->menuUrl() ?>">For designers</a></li>
					<li><a href="<?= page('features/creators')->menuUrl() ?>">For content creators</a></li>
					<li><a href="<?= page('features/clients')->menuUrl() ?>">For clients & agencies</a></li>
					<li><hr /></li>
					<li><a href="<?= page('love')->menuUrl() ?>">Showcase</a></li>
					<li><a href="<?= page('releases')->menuUrl() ?>">Releases</a></li>
					<li><a class="is-external" href="https://feedback.getkirby.com">Feedback</a></li>
				</ul>
			</li>
			<li class="has-submenu">
				<a href="<?= page('docs/guide')->menuUrl() ?>">Docs</a>
				<ul class="menu-2">
					<li><a href="<?= page('docs/guide')->menuUrl() ?>">Guide</a></li>
					<li><a href="<?= page('docs/reference')->menuUrl() ?>">Reference</a></li>

					<li><a href="<?= page('docs/cookbook')->menuUrl() ?>">Cookbook</a></li>
					<li><a href="<?= page('docs/quicktips')->menuUrl() ?>">Quicktips</a></li>
					<li><a class="is-external" href="https://youtube.com/kirbycasts">Screencasts</a></li>
					<li><a href="<?= page('docs/glossary')->menuUrl() ?>">Glossary</a></li>
				</ul>
			</li>
			<li class="has-submenu">
				<a href="<?= page('kosmos')->menuUrl() ?>">Resources</a>
				<ul class="menu-2">
					<li><a class="is-external" href="https://plugins.getkirby.com">Plugins</a></li>
					<li><a href="<?= page('themes')->menuUrl() ?>">Themes</a></li>
					<li><hr /></li>
					<li><a href="<?= page('kosmos')->menuUrl() ?>">Newsletter</a></li>
					<li><a href="<?= page('buzz')->menuUrl() ?>">Buzz</a></li>
					<li><hr /></li>
					<li><a class="is-external" href="https://hub.getkirby.com">License Hub</a></li>
				</ul>
			</li>
			<li class="has-submenu">
				<a href="<?= page('meet')->menuUrl() ?>">Community</a>
				<ul class="menu-2">
					<li><a href="<?= page('meet')->menuUrl() ?>">Get together</a></li>
					<li><hr /></li>
					<li><a class="is-external" href="https://forum.getkirby.com">Support forum</a></li>
					<li><a class="is-external" href="https://chat.getkirby.com">Discord chat</a></li>
					<li><a class="is-external" href="https://community.getkirby.com">Community map</a></li>
					<li><hr /></li>
					<li><a class="is-external" href="https://mastodon.social/@getkirby">Mastodon</a></li>
					<li><a class="is-external" href="https://www.linkedin.com/company/getkirby">LinkedIn</a></li>
					<li><a class="is-external" href="https://instagram.com/getkirby">Instagram</a></li>
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
