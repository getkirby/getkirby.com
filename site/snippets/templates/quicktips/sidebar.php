<?php use Kirby\Http\Uri; ?>
<nav aria-label="Cookbook menu">
	<div class="sidebar cookbook-sidebar sticky" style="--top: var(--spacing-6)">
		<header class="sidebar-header mb-12">
			<p class="h1 color-gray-400">
				<a href="/docs/quicktips">Quicktips</a>
			</p>

			<div class="sidebar-mobile-select">
				<label for="mobile-menu">
					Select a tag …
					<?= icon('angle-down') ?>
				</label>

				<select
					id="mobile-menu"
					onchange="window.location.href = this.value"
				>
					<option disabled selected>Select a tag …</option>
						<?php foreach ($tags as $tag): ?>
						<option value="<?= page('docs/quicktips')->url(). '/tags/' . Str::slug($tag) ?>">
							<?= Str::ucFirst($tag) ?>
						</option>
						<?php endforeach ?>
				</select>
			</div>
		</header>


		<ul class="filters">
			<li>
				<a href="/docs/quicktips"<?= ariaCurrent(Uri::current()->path()->last() === 'quicktips') ?>>
					<?= icon('list-bullet') ?> All quicktips
				</a>
			</li>
			<li>
				<button class="search-button" type="button" data-area="cookbook">
					<?= icon('search') ?> Search
				</button>
			</li>
			<li><hr class="hr"></li>
			<?php foreach ($tags as $tag): ?>
			<li>
				<a aria-label="<?= $tag ?> recipes" href="<?= page('docs/quicktips')->url(). '/tags/' . Str::slug($tag) ?>"<?= ariaCurrent($tag === Uri::current()->path()->last()) ?>>
					 <?= Str::ucFirst($tag) ?>
				</a>
			</li>
			<?php endforeach ?>
		</ul>
	</div>
</nav>
