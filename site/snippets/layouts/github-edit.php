<hr class="hr mb-6">

<p class="prose text-sm mb-6 max-w-xs">
  Did you find an error? Help us improve our docs and edit this page on Github. Make sure to check out
  <a href="/styleguide">our styleguide &rarr;</a>
</p>
<a href="<?= option('github.url') ?>/getkirby.com/<?= F::exists($page->contentFile()) ? 'edit/main/content/' . $page->diruri() . '/' . $page->intendedTemplate() . '.txt' : 'issues/new?template=reference.md' ?>" class="btn btn--outlined mb-3">
  <?= icon('github') ?> Edit this page
</a>
