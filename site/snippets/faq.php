<div class="faq">
	<?php foreach ($questions as $question): ?>
	<details class="details">
		<summary class="py-3 border-top" id="<?= $question->slug() ?>"><?= $question->title()->kti()->widont() ?></summary>
		<div class="py-3 prose text-base">
			<?= $question->text()->kt() ?>
		</div>
	</details>
	<?php endforeach ?>
</div>
