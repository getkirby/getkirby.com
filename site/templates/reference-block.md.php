<?php

layout('reference.md');

if ($image = $page->image()) {
	echo markdownHeading('Preview', 2);
	echo markdownImage($image->url());
	echo markdownBreak();
}

if ($page->slug() !== 'table') {

	$root      = kirby()->root('kirby') . '/config/blocks/' . $page->name() . '/' . $page->name();
	$snippet   = file_get_contents($root . '.php');
	$blueprint = file_get_contents($root . '.yml');

	echo markdownHeading('Default files', 2);

	echo markdownHeading('Snippet', 3);
	echo 'By default, Kirby uses the following snippet to render the ' . $page->title() . ' block:';
	echo markdownBreak();
	echo markdownCodeBlock($snippet);
	echo 'To overwrite ' . markdownLink('this default snippet', $page->source() . $page->name() . '.php') . ', place your custom file in `/site/snippets/blocks/' . $page->name() . '.php`.';
	echo markdownBreak();

	echo markdownHeading('Blueprint', 3);
	echo 'By default, Kirby uses the following blueprint for the ' . $page->title() . ' block:';
	echo markdownBreak();
	echo markdownCodeBlock($blueprint, 'yaml');
	echo 'To overwrite ' . markdownLink('this default blueprint', $page->source() . $page->name() . '.yml') . ', place your custom file in `/site/blueprints/blocks/' . $page->name() . '.yml`.';
	echo markdownBreak();

} else {
	echo $page->text()->convertToMarkdown();
}

echo markdownHeading('Vue component', 3);

echo markdownLink(
	'`kirby/src/components/Forms/Blocks/Types/' . ucfirst($page->title()) . '.vue`',
	option('github.url') . '/kirby/blob/main/panel/src/components/Forms/Blocks/Types/' . ucfirst($page->title()) . '.vue'
);
