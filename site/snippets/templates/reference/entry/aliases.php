<?php
$aliases = $page->reflection()->aliases();
?>
<?php if (count($aliases) > 0): ?>
<h2 id="aliases"><a href="#aliases">Aliases</a></h2>
<p>You can use the following aliases for this field method in your template:</p>
<ul>
	<?php foreach ($aliases as $alias): ?>
	<li><code>$field-><?= $alias ?>(…)</code></li>
	<?php endforeach ?>
</ul>
<?php endif ?>
