<?php snippet('rss/header', [
  'description' => 'This is the archive of our monthly newsletter – Kirby Kosmos',
  'modified'	=> $issues->last()->date()->toDate('r'),
  'url'		 => $page->url() . '.rss'
]) ?>

<?php foreach ($issues as $issue): ?>
<item>
  <title><?= $issue->title()->xml() ?></title>
  <link><?= $issue->url() ?></link>
  <pubDate><?= $issue->date()->toDate('r') ?></pubDate>
  <guid><?= $issue->url() ?></guid>
  <description>
	<![CDATA[
	  <?php if ($cover = $issue->image()): ?>
	  <figure><?= $cover ?></figure>
	  <?php endif ?>
	  <h1><?= $issue->title() ?></h1>
	  <p><?= $issue->text()->excerpt(140) ?></p>
	]]>
  </description>
</item>
<?php endforeach ?>

<?php snippet('rss/footer') ?>
