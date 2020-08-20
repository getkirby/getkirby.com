<?php
extract([
  'call'     => $call ?? (string)$page->call(),
  'language' => 'php'
]);
?>

<?php if (empty($call) == false): ?>
<figure>
  <pre class="code"><code class="language-<?= $language ?>"><?= $call ?></code></pre>
</figure>
<?php endif ?>
