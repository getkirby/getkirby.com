<section id="filesystem" class="playground-filesystem">
  <div class="playground-filesystem-layout">
	<header class="playground-filesystem-header h2 max-w-xs">
	  <h2>Just files and folders</h2>
	  <p class="color-gray-600">Kirby stores your content in simple text files. Folders are pages. Add images, documents and videos and you are ready to go. It’s that simple.</p>
	</header>

	<div class="playground-filesystem-files">
	  <div role="img" aria-label="An example setup of folders and files to store content for Kirby" class="playground-filesystem-folders">
		<?= $story->filesystem()->kt() ?>
	  </div>

	  <span class="hr-v hr-indent" style="height: var(--spacing-12);"></span>

	  <figure role="img" aria-label="A text editor with content for Kirby" class="playground-filesystem-editor bg-white max-w-xs shadow-2xl rounded-xl">
		<header class="flex items-center py-1 px-3 text-center text-sm font-bold">
		  <div class="dots absolute">
			<i></i>
			<i></i>
			<i></i>
		  </div>
		  <div class="flex-grow">
			<?= $story->filename() ?>
		  </div>
		</header>
		<div class="font-mono text-sm p-3 no-highlight">
		  <?= $story->filecontent()->kt() ?>
		</div>
	  </figure>

	  <span class="hr-v hr-indent" style="height: var(--spacing-42); grid-column: 1"></span>
	</div>
  </div>

  <div class="columns">
	<span class="hr-h hr-indent hr-end"></span>
  </div>
</section>
