<?php if ($causes->count() > 0): ?>
<h4 class="h4 mb-3"><?= $headline ?></h4>
<ul class="mb-6">
	<?php foreach ($causes as $cause): ?>
	<li>
		<details class="details" id="<?= $cause->slug() ?>">
			<summary class="py-3 border-top"><?= $cause->title()->kti()->widont() ?></summary>
			<div>
				<div class="py-3 mb-3 prose text-base">
					<?= $cause->text()->kt() ?>
				</div>

				<a href="mailto:licensing@getkirby.com?subject=<?= $cause->subject() ?>" class="btn btn--outlined mb-6">
					Contact us
				</a>
			</div>
		</details>
	</li>
	<?php endforeach ?>
</ul>
<?php endif ?>
