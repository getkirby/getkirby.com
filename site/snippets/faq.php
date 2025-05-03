<div class="faq">
	<?php foreach ($questions as $question): ?>
	<details class="details" id="<?= $question->slug() ?>">
		<summary class="py-3 border-top"><?= $question->title()->kti()->widont() ?></summary>
		<div class="py-3 prose text-base">
			<?= $question->text()->kt() ?>
		</div>
	</details>
	<?php endforeach ?>
</div>

<script>
function openFaqById(hash) {
	const element = document.querySelector(hash);

	if (element instanceof HTMLDetailsElement) {
		element.open = true;
	}
}

// open the FAQ entry onload
if (window.location.hash) {
	openFaqById(window.location.hash);
}

// open the FAQ entry when the hash in the URL changes (e.g. by clicking a relevant link)
window.addEventListener('hashchange', () => openFaqById(window.location.hash));
</script>
