<div class="sidebar-mobile-select">
	<label for="mobile-menu">
		<?= $placeholder ?? 'Select a page …' ?>
		<?= icon('angle-down') ?>
	</label>

	<select
		id="mobile-menu"
		onchange="window.location.href = this.value"
	>
		<option disabled selected><?= $placeholder ?? 'Select a page …' ?></option>
		<?php if ($hasCategories ?? false): ?>
			<?php foreach ($menu as $category => $items): ?>
				<optgroup
					label="<?= option('categories')[$category] ?? ucfirst($category) ?>"
				>
					<?php snippet('sidebar/mobile-options', [
						'items'    => $items,
						'children' => $children ?? true
					]) ?>
				</optgroup>
			<?php endforeach ?>

		<?php else: ?>
			<?php snippet('sidebar/mobile-options', [
				'items'    => $menu,
				'children' => $children ?? true
			]) ?>
		<?php endif ?>
	</select>
</div>
