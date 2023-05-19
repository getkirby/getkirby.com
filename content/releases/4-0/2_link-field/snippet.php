<div class="columns" style="--columns: 3">
	<figure class="release-padded-box bg-light" style="--span: 2">
		<?= $section->image('file-link.png') ?>
	</figure>
	<div class="flex flex-column">
		<div class="release-padded-box flex-grow bg-light mb-6">
			<?= $section->intro()->kt() ?>
		</div>
		<figure class="release-code-box p-6">
			<div>
				<?= $section->example()->kt() ?>
			</div>
		</figure>
	</div>
</div>
