<?php
$reflection = $page->reflection();
?>

<?php if ($call = $reflection->call()): ?>
<figure class="code">
	<pre><code class="language-php"><?= $call ?></code></pre>
</figure>
<?php endif ?>

<?php snippet('templates/reference/entry/parameters') ?>
<?php snippet('templates/reference/entry/returns') ?>
<?php snippet('templates/reference/entry/throws') ?>
