<div class="faq columns" style="--columns: 2; --row-gap: var(--spacing-6); --column-gap: var(--spacing-12);">
  <?php foreach ($questions as $question): ?>
  <details class="details">
    <summary class="py-1 border-top" id="<?= $question->slug() ?>"><?= $question->title()->widont() ?></summary>
    <div class="py-3 prose text-base">
      <?= $question->text()->kt() ?>
    </div>
  </details>
  <?php endforeach ?>
</div>
