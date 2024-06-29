<style>
.partner-listing {
	display: grid;
	--ratio: 1/1;
	background: var(--color-white);
	border-radius: var(--rounded-sm);
	padding: var(--spacing-3);
}
.partner-listing-header {
	grid-area: header;
	line-height: var(--leading-normal);
}
.partner-listing-label {
	display: flex;
	align-items: center;
	gap: var(--spacing-1);
	font-size: var(--text-xs);
}
.partner-listing-image {
	grid-area: image;
	aspect-ratio: var(--ratio);
	background: var(--color-green-200);
	display: grid;
	place-items: center;
	height: 100%;
}
.partner-listing-image svg {
	color: var(--color-green-400);
	width: 2rem;
	height: 2rem;
}

.partner-listing-footer {
	font-family: var(--font-mono);
	font-size: var(--text-sm);
	line-height: var(--leading-normal);
}
.partner-listing-location {
	color: var(--color-text-dimmed);
}

.partner-listing-description {
	font-size: var(--text-base);
	line-height: var(--leading-normal);
	color: var(--color-text-dimmed);
}

.partner-listing label {
	position: relative;
	display: block;
	width: 100%;
}

.partner-listing input,
.partner-listing textarea {
	position: absolute;
	top: 0;
	left: 0;
	font: inherit;
	color: inherit;
	background: transparent;
	width: 100%;
}

.partner-listing textarea {
	resize: none;
}

.partner-listing[data-tier="regular"] {
	align-items: center;
	grid-template-columns: 4.5rem 1fr;
	grid-template-areas:
		"image header"
		"image footer";
	grid-column-gap: var(--spacing-6);
}
.partner-listing[data-tier="regular"] .partner-listing-header {
	align-self: end;
	margin-bottom: 2px;
}
.partner-listing[data-tier="regular"] .partner-listing-footer {
	align-self: start;
}

.partner-listing[data-tier="certified"] {
	--ratio: 3/2;
	grid-template-areas:
		"header"
		"image"
		"footer";
	grid-row-gap: var(--spacing-3);
}
</style>

<article class="partner-listing" data-tier="certified" :data-tier="personalInfo.tier">
	<header class="partner-listing-header">
		<p class="partner-listing-label" v-if="personalInfo.tier === 'certified'">
			Certified Kirby Partner <?= icon('verified') ?>
		</p>
		<p v-cloak v-else>
			<label>
				<span :style="labelStyle(personalInfo.businessType)">Type of company</span>
				<input name="businessType" type="text" v-model="personalInfo.businessType">
			</label>
		</p>
		<h4 class="h3">
			<label>
				<span :style="labelStyle(personalInfo.businessName)">Your business name</span>
				<input name="businessName" type="text" v-model="personalInfo.businessName">
			</label>
		</h4>
	</header>
	<figure class="partner-listing-image">
		<?= icon('image') ?>
	</figure>
	<aside class="partner-listing-footer">
		<p v-if="personalInfo.tier === 'certified'">
			<label>
				<span :style="labelStyle(personalInfo.businessType)">Type of business</span>
				<input name="businessType" type="text" v-model="personalInfo.businessType">
			</label>
		</p>
		<p class="partner-listing-location">
			<label>
				<span :style="labelStyle(personalInfo.location)">City, Country</span>
				<input name="location" type="text" v-model="personalInfo.location">
			</label>
		</p>
	</aside>
	<p class="partner-listing-description" v-if="personalInfo.tier === 'certified'">
		<label>
			<span :style="labelStyle(personalInfo.description)">Tell the audience about yourself in 140 characters or less. Describe your strengths as company and let them know why they should choose you.</span>
			<textarea name="description" rows="2" maxlength="140" v-model="personalInfo.description"></textarea>
		</label>
	</p>
</article>
