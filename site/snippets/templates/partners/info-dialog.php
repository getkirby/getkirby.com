<style>
.dialog[open] {
	overflow: visible;
}
.dialog-form {
	display: flex;
	flex-direction: column;
	overflow: scroll;
	max-height: calc(100vh - 1.5rem);
}
.dialog-body {
	overflow: scroll;
}
.dialog-cancel-button {
	position: absolute;
	top: 0;
	right: 0;
	transform: translate(50%, -50%);
	width: 1.375rem;
	height: 1.375rem;
	background: var(--color-light);
	border-radius: 50%;
	display: grid;
	place-items: center;
	color: black;
}
.badge-banner {
	flex-shrink: 0;
	border-top-left-radius: var(--rounded);
	border-top-right-radius: var(--rounded);
	overflow: hidden;
}
.certified-checklist li {
	display: flex;
	align-items: center;
	gap: .5rem;
}
</style>

<dialog class="dialog" id="infoDialog" style="width: 35rem" onclick="event.target === this && this.close()">
	<form id="infoDialogForm" class="dialog-form relative" method="dialog">
		<figure class="badge-banner">
			<?= svg('assets/images/' . (($certified ?? true) ? 'certified-' : '') . 'partner-landscape.svg') ?>
		</figure>

		<div class="p-6 dialog-body">
			<div class="prose text-base mb-6">
				<h3>Our review process</h3>
				<p>For each partner application, we perform a manual review with the help of testing tools. Our review includes checks for crucial web vitals and best practices in development, design and content structure.</p>
				<p>The review of our Certified Kirby Partners goes beyond that. With access to the source code of a full project, we perform a detailed manual code review that allows us to look behind the scenes of the partner's work. Our certification includes the following aspects:</p>
			</div>

			<ul class="certified-checklist text-base">
				<li><?= icon(($certified ?? true) ? 'verified' : 'icon-blank') ?> Code quality</li>
				<li><?= icon(($certified ?? true) ? 'verified' : 'icon-blank') ?> Performance</li>
				<li><?= icon(($certified ?? true) ? 'verified' : 'icon-blank') ?> Privacy & Security</li>
				<li><?= icon(($certified ?? true) ? 'verified' : 'icon-blank') ?> Semantics & Accessibility</li>
				<li><?= icon(($certified ?? true) ? 'verified' : 'icon-blank') ?> Panel layout & Usability</li>
				<li><?= icon(($certified ?? true) ? 'verified' : 'icon-blank') ?> Responsiveness & Modularity</li>
				<li><?= icon(($certified ?? true) ? 'verified' : 'icon-blank') ?> Code documentation</li>
			</ul>
		</div>
	</form>
	<button form="infoDialogForm" class="dialog-cancel-button"><?= icon('cancel-small') ?></button>
</dialog>
