<section class="mb-6">
	<h3 class="font-bold mb-1">What you get</h3>
	<ul class="benefits">
		<li>
			<span class="icon"><?= icon('star') ?></span>
			Your own customizable profile page
		</li>
		<li>
			<span class="icon"><?= icon('star') ?></span>
			Exposure and traffic from getkirby.com
		</li>
		<li v-if="personalInfo.tier === 'certified'">
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
</section>

<section class="mb-6" v-if="personalInfo.tier === 'certified'">
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
	<ul class="requirements" v-if="personalInfo.tier === 'certified'">
		<li>
			<span class="icon"><?= icon('check') ?></span>
			4 completed Kirby projects
		</li>
		<li>
			<span class="icon"><?= icon('check') ?></span>
			1 reviewed project
		</li>
	</ul>
	<ul class="requirements" v-else v-cloak>
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
		<span v-text="price"><?= number_format($certified->price()->regular((int)($people ?? 1)), 0, '.', ',') ?></span>
	</p>
	<ul class="text-xs color-gray-700">
		<li>Price + VAT if applicable.</li>
		<li>You will be charged once your application has been accepted.</li>
		<li>Your partnership will <em>not</em> automatically renew.</li>
	</ul>
</section>
