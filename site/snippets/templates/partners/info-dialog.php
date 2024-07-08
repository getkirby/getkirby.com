<style>
.info-dialog[open] {
	overflow: visible;
}
.info-dialog:modal {
	max-height: calc(100% - 2rem);
	max-width: calc(100% - 2rem);
}
.info-dialog-form {
	display: flex;
	flex-direction: column;
	overflow-y: auto;
	max-height: calc(100vh - 2rem);
}
.info-dialog-body {
	overflow-y: auto;
}
.info-dialog-cancel-button {
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

<dialog class="dialog info-dialog" id="infoDialog" style="width: 35rem" onclick="event.target === this && this.close()">
	<form id="infoDialogForm" class="info-dialog-form relative" method="dialog">
		<figure class="badge-banner">
			<?= svg('assets/images/certified-partner-landscape.svg') ?>
		</figure>

		<div class="p-6 info-dialog-body">
			<div class="prose text-base mb-6">
				<h3>Our certification process</h3>
				<p>For each partner application, we perform a manual review with the help of testing tools. Our review includes checks for crucial web vitals and best practices in development, design and content structure.</p>
				<p>The review of our Certified Kirby Partners goes beyond that. With access to the source code of a full project, we perform a detailed manual code review that allows us to look behind the scenes of the partner's work. Our certification includes the following aspects:</p>
			</div>

			<ul class="certified-checklist text-base">
				<li><?= icon('verified') ?> Code quality</li>
				<li><?= icon('verified') ?> Performance</li>
				<li><?= icon('verified') ?> Privacy & Security</li>
				<li><?= icon('verified') ?> Semantics & Accessibility</li>
				<li><?= icon('verified') ?> Panel layout & Usability</li>
				<li><?= icon('verified') ?> Responsiveness & Modularity</li>
				<li><?= icon('verified') ?> Code documentation</li>
			</ul>
		</div>
	</form>
	<button form="infoDialogForm" class="info-dialog-cancel-button"><?= icon('cancel-small') ?></button>
</dialog>
