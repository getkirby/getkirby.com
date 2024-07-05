<section class="mb-6">
	<h3 class="font-bold mb-1">What you get</h3>

	<ul class="benefits mb-3">
		<li>
			<span class="icon"><?= icon('star') ?></span>
			Your own customizable profile page
		</li>
		<li>
			<span class="icon"><?= icon('star') ?></span>
			Exposure and traffic from getkirby.com
		</li>
		<li v-if="form.plan === 'certified'">
			<span class="icon"><?= icon('star') ?></span>
			<span>Project gallery with up to <span class="extra">6 projects</span></span>
		</li>
		<li v-else v-cloak>
			<span class="icon"><?= icon('star') ?></span>
			Project gallery with up to 3 projects
		</li>
		<li>
			<span class="icon"><?= icon('star') ?></span>
			Access to the Discord #partners channel
		</li>
		<li>
			<span class="icon"><?= icon('star') ?></span>
			Directly matched client leads
		</li>
		<li>
			<span class="icon"><?= icon('star') ?></span>
			More visibility within the Kirby community
		</li>
	</ul>

	<p v-if="form.plan !== 'certified'" v-cloak class="text-xs color-gray-700">
		More <?= $renew ? '<mark>new benefits</mark>' : 'benefits' ?> as <button class="underline" @click="form.plan = 'certified'">Certified partner</button>…
	</p>
</section>

<section class="mb-6" v-if="form.plan === 'certified'">
	<h3 class="font-bold mb-1">Certified partner benefits</h3>

	<ul class="benefits">
		<li class="extra">
			<span class="icon"><?= icon('star') ?></span>
			Certification, including official badges
		</li>
		<li class="extra">
			<span class="icon"><?= icon('star') ?></span>
			10% discount on all licenses
		</li>
		<li class="extra">
			<span class="icon"><?= icon('star') ?></span>
			Regular office hour calls with the Kirby core team
		</li>
		<li class="extra">
			<span class="icon"><?= icon('star') ?></span>
			Detailed results of our project review
		</li>
		<li class="extra">
			<span class="icon"><?= icon('star') ?></span>
			Priority listing in the directory
		</li>
		<li class="extra">
			<span class="icon"><?= icon('star') ?></span>
			Promotion on social media and in the Kosmos newsletter
		</li>
	</ul>
</section>

<section class="mb-6">
	<h3 class="font-bold mb-1">Requirements</h3>

	<ul v-if="form.plan === 'certified'" class="requirements">
		<li>
			<span class="icon"><?= icon('check') ?></span>
			4 completed Kirby projects
		</li>
		<li>
			<span class="icon"><?= icon('check') ?></span>
			1 reviewed project
		</li>
	</ul>
	<ul v-else v-cloak class="requirements">
		<li>
			<span class="icon"><?= icon('check') ?></span>
			2 completed Kirby projects
		</li>
	</ul>
</section>

<section class="mb-12">
	<h3 class="font-bold">Price per year</h3>
	<p class="price text-xl mb-3">
		<span v-text="locale.currency.trim()" class="currency-sign">€</span>
		<span v-text="price">
			<?= number_format($certified->price()->regular((int)($people ?? 1)), 0, '.', ',') ?>
		</span>
	</p>
	<ul class="text-xs color-gray-700">
		<li>Price + VAT if applicable.</li>
		<?php if (!$renew): ?>
		<li>You will be charged once your application has been accepted.</li>
		<?php endif ?>
		<li>Your partnership will <em>not</em> automatically renew.</li>
	</ul>
</section>
