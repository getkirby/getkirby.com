<?php

return function ($page) {
  return [
	'templates' => json_encode([
	  'gitattributes' => $page->file('gitattributes.md')->read(),
	  'gitignore'	 => $page->file('gitignore.md')->read(),
	  'editorconfig'  => $page->file('editorconfig.md')->read(),
	  'indexjs'	   => $page->file('index.js.md')->read(),
	  'indexphp'	  => $page->file('index.php.md')->read(),
	  'license'	   => $page->file('license.md')->read(),
	  'readme'		=> $page->file('readme.md')->read(),
	  'security'	  => $page->file('security.md')->read(),
	]),
  ];
};
