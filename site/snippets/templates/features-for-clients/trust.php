<style>
.trust-in-brands svg {
  width: 100%;
	height: auto;
  max-height: 3.5rem;
  max-width: 9rem;
}
</style>

<section class="mb-42 columns features-xl">
	<div>
		<?php snippet('templates/features/intro', [
			'title' => 'Trusted by brands world-wide',
			'text'  => 'Tech, art, <a href="/for/events">events</a>, <a href="/for/education">education</a>, <a href="/for/hospitality">hospitality</a>,  food, fashion, health: Leading brands use Kirby for their digital solutions. Editorial systems, intranet solutions, factory terminals, mobile apps, or just great websites – they are in good hands with Kirby.'
		]) ?>

		<ul class="columns" style="--columns-sm: 3; --columns: 3">
			<li>
				<span class="block text-2xl">40k+</span>
				<span class="font-mono text-xs"> sites</span>
			</li>
			<li>
				<span class="block text-2xl">6500+</span>
				<span class="font-mono text-xs"> forum users</span>
			</li>
			<li>
				<span class="block text-2xl">2500+</span>
				<span class="font-mono text-xs"> discord users</span>
			</li>
		</ul>

	</div>

	<ul class="trust-in-brands columns auto-rows-fr rounded overflow-hidden" style="--columns-sm: 2; --columns-md: 3; --columns: 3; --gap: var(--spacing-1)">
		<?php foreach(collection('brands/featured')->limit(9) as $brand): ?>
		<?php snippet('brand', [
			'brand' => $brand,
			'class' => 'bg-light p-6 flex items-center justify-center'
		]) ?>
		<?php endforeach ?>
	</ul>

</section>
