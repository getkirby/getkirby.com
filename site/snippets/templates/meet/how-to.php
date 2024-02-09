<section class="howto mb-24">
	<h2 class="h2 mb-6">Want to host a meetup?</h2>
	<div class="howto-instructions prose text-lg">
		<?= $page->howto()->kt() ?>
	</div>
</section>

<style>
.howto-instructions {
  columns: 1;
  column-gap: var(--spacing-24);
}
.howto-instructions li {
  margin-bottom: 1.5rem;
  break-inside: avoid;
}
@media screen and (min-width: 60rem) {
  .howto-instructions {
    columns: 2;
  }
}
</style>
