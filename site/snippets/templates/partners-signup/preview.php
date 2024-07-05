<?php if ($renew): ?>
<article
	v-if="form.tier === 'certified'"
	class="partner-listing-static"
>
	<?php snippet('templates/partners/partner.certified', [
		'partner'     => $renew,
		'placeholder' => true,
		'lazy'        => false
	]) ?>
</article>
<article
	v-else
	v-cloak
	class="partner-listing-static"
>
	<?php snippet('templates/partners/partner', [
		'partner'     => $renew,
		'placeholder' => true
	]) ?>
</article>


<?php else: ?>
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
	position: relative;
	grid-area: image;
	aspect-ratio: var(--ratio);
	background: var(--color-green-200);
	display: grid;
	place-items: center;
}
.partner-listing-image svg {
	color: var(--color-green-400);
	width: 2rem;
	height: 100%; /* Layout centering bug in Safari */
}
.partner-listing-image span {
	position: absolute;
	bottom: 0;
	color: var(--color-green-700);
	padding: 1rem;
}
.partner-listing-image-info {
	padding: var(--spacing-3);
	font-size: var(--text-sm);
}

.partner-listing-footer {
	font-family: var(--font-mono);
	font-size: var(--text-sm);
	line-height: var(--leading-normal);
}
.partner-listing-location {
	color: var(--color-text-dimmed);
}

.partner-listing-summary {
	font-size: var(--text-sm);
	line-height: var(--leading-normal);
	color: var(--color-text-dimmed);
}

.partner-listing .field + .field {
	margin: 0;
}

.partner-listing label {
	position: relative;
	display: block;
	width: 100%;
}

.partner-listing :where(input, textarea) {
	position: absolute;
	top: 0;
	left: 0;
	font: inherit;
	color: inherit;
	background: transparent;
	width: 100%;
	height: 100%;
	border-radius: var(--rounded-sm);
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
	--ratio: 2/1;
	grid-template-areas:
		"header"
		"image"
		"footer";
	grid-row-gap: var(--spacing-3);
}
</style>

<article
	:data-tier="form.tier"
	data-tier="certified"
	class="partner-listing"
>
	<header class="partner-listing-header">
		<button type="button" onclick="infoDialog.showModal()" v-if="form.tier === 'certified'">
			<p class="flex items-center text-xs" style="gap: var(--spacing-1)">
				Certified Kirby Partner
				<?= icon('verified') ?>
			</p>
		</button>
		<p class="field" v-cloak v-else>
			<label>
				<span :style="labelStyle(form.businessType)">
					Type of business <abbr title="Required" aria-hidden>*</abbr>
				</span>
				<input
					name="businessType"
					:required="view === 'details'"
					type="text"
					v-model="form.businessType"
				>
			</label>
		</p>
		<h4 class="field h3">
			<label>
				<span :style="labelStyle(form.businessName)">
					Your business name <abbr title="Required" aria-hidden>*</abbr>
				</span>
				<input
					name="businessName"
					:required="view === 'details'"
					type="text"
					v-model="form.businessName"
				>
			</label>
		</h4>
	</header>
	<figure class="partner-listing-image">
		<?= icon('image') ?>
		<span
			v-if="form.tier === 'certified' && view === 'details'"
			v-cloak
		>
			We will ask you for an image once your application has been accepted.
		</span>
	</figure>
	<aside class="partner-listing-footer">
		<p class="field" v-if="form.tier === 'certified'">
			<label>
				<span :style="labelStyle(form.businessType)">
					Type of business <abbr title="Required" aria-hidden>*</abbr>
				</span>
				<input
					name="businessType"
					:required="view === 'details'"
					type="text"
					v-model="form.businessType"
				>
			</label>
		</p>
		<p class="field partner-listing-location">
			<label>
				<span :style="labelStyle(form.location)">
					City, Country <abbr title="Required" aria-hidden>*</abbr>
				</span>
				<input
					name="location"
					:required="view === 'details'"
					type="text"
					v-model="form.location"
				>
			</label>
		</p>
	</aside>
	<p
		v-if="form.tier === 'certified'"
		class="field partner-listing-summary"
	>
		<label>
			<span :style="labelStyle(form.summary)">
				Tell the audience about yourself in 140 characters or less. Describe your strengths as company and let them know why they should choose you.
			</span>
			<textarea
				name="summary"
				rows="2"
				maxlength="140"
				v-model="form.summary"
			></textarea>
		</label>
	</p>
</article>

<p
	v-if="form.tier === 'regular' && view === 'details'"
	v-cloak
	class="partner-listing-image-info"
>
	We will ask you for an image once your application has been accepted.
</p>
<?php endif ?>
