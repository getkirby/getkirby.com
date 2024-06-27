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

.partner-listing input,
.partner-listing textarea {
	font: inherit;
	color: inherit;
	width: 100%;
}

.partner-listing input::placeholder,
.partner-listing textarea::placeholder {
	color: inherit;
	opacity: 1;
}

.partner-listing input:focus,
.partner-listing textarea:focus {
	position: relative;
	z-index: 1;
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

<article class="partner-listing" :data-tier="personalInfo.tier">
	<header class="partner-listing-header">
		<p class="partner-listing-label" v-if="personalInfo.tier === 'certified'">
			Certified Kirby Partner <?= icon('verified') ?>
		</p>
		<p class="partner-listing-label" v-else>
			<input name="subtitle" type="text" v-model="personalInfo.subtitle" placeholder="Type of company">
		</p>
		<h4 class="partner-listing-title h3">
			<input name="title" type="text" v-model="personalInfo.title" placeholder="Your company name">
		</h4>
	</header>
	<figure class="partner-listing-image">
		<?= icon('image') ?>
	</figure>
	<aside class="partner-listing-footer">
		<p class="partner-listing-subtitle" v-if="personalInfo.tier === 'certified'">
			<input name="subtitle" type="text" v-model="personalInfo.subtitle" placeholder="Type of company">
		</p>
		<p class="partner-listing-location">
			<input type="text" name="location" v-model="personalInfo.location" placeholder="City, Country">
		</p>
	</aside>
	<p class="partner-listing-description" v-if="personalInfo.tier === 'certified'">
		<textarea name="description" rows="2" maxlength="140" v-model="personalInfo.description" placeholder="Tell the audience about yourself in 140 characters or less. Describe your strengths as company and let them know why they should choose you."></textarea>
	</p>
</article>
