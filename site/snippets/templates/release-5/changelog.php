<details open id="<?= Str::slug($title) ?>" class="bg-light rounded release-changelog">
	<summary><?= $title ?></summary>
	<div class="prose"><?= $changes->kt() ?></div>
</details>
