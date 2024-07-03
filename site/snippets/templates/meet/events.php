<?php if ($events->count() > 0): ?>
<section class="events mb-24">
	<header class="flex justify-between items-center mb-6">
		<h2 class="h2">Upcoming events</h2>
		<a
			class="btn btn--filled"
			href="mailto:mail@getkirby.com"
		>
			<?= icon('calendar') ?>
			Submit an event
		</a>
	</header>

	<ul class="text-sm flex flex-column" style="gap: 2px">
		<?php foreach($events as $event): ?>
		<li>
			<a href="<?= $event->link() ?>" class="flex items-center justify-between bg-white p-3 rounded shadow">
				<h3 class="font-bold"><?= $event->title() ?></h3>
				<p class="color-gray-700">
					<localized-datetime date="<?= $event->date() ?>"><?= $event->date()->toDate('D j M, H:i T') ?></localized-datetime>
				</p>
			</a>
		</li>
		<?php endforeach ?>
	</ul>
	<?php endif ?>
</section>

<script>
class LocalizedDatetimeElement extends HTMLElement {
	connectedCallback() {
		this.utc = new Date(this.getAttribute("date"));
		this.innerText = this.format(this.utc);
	}

	format(datetime) {
		return datetime.toLocaleString("en-US", {
			weekday: "short",
			day: "numeric",
			month: "long",
			year: "numeric",
			hour12: false,
			hour: "2-digit",
			minute: "2-digit",
			timeZoneName: "short"
		})
	}
}

customElements.define("localized-datetime", LocalizedDatetimeElement);
</script>

<style>
@media (max-width: 40rem) {
	.events header {
		flex-direction: column;
		gap: 1rem;
		align-items: flex-start;
	}
	.events ul a {
		flex-direction: column;
		gap: var(--spaccing-1);
		align-items: flex-start;
	}
}
</style>
