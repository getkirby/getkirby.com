<details open id="<?= Str::slug($title) ?>" class="bg-light rounded release-changelog">
	<summary><?= $title ?></summary>
	<div class="prose"><?= $changes->kt(['markdown' => ['idPrefix' => Str::slug($title)]]) ?></div>
</details>
