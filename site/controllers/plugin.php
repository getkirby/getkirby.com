<?php

return function ($page) {
  $categories = option('plugins.categories');

  $related = page('plugins')
    ->grandChildren()
    ->filterBy('category', $page->category()->value())
    ->not($page);

  $getFromGitHub = function(Array $paths) {

    $request = Remote::request(implode('/',$paths));
    
    if ($request->code() == 200) {
      return [
        'url' => $request->url(),
        'content' => $request->content(),
        'root' => implode('/',array_slice($paths, 0, -1))
      ];
    };

  };

  $readme = function () use ($getFromGitHub){

    if (page()->repository()->isNotEmpty()) {

      $repo_path = 'https://raw.githubusercontent.com/'.Url::path(page()->repository());
      $result = array();
      $variations = [
        ['master', 'README.md'],
        ['master', 'readme.md'],
        ['master/.github', 'README.md'],
        ['master/.github', 'readme.md'],
        ['main', 'README.md'],
        ['main', 'readme.md'],
        ['main/.github', 'README.md'],
        ['main/.github', 'readme.md'],
        ['stable', 'README.md'],
        ['stable', 'readme.md'],
        ['stable/.github', 'README.md'],
        ['stable/.github', 'readme.md'],
      ];
      
      //Walk throug Variations
      foreach($variations as $variation) {
          if ($result = $getFromGitHub(array_merge([$repo_path], $variation))) {
            break;
          };
      }

      //Debug:
      //dump($result['url'] ?? "No Url");
      //dump($result['root'] ?? "No Root");

      //No content
      if (empty($result)) return;

      //Replace relative paths
      $result['content'] = preg_replace('/\]\((?!https?:\/\/)/', ']('.$result['root'] . '/', $result['content']);
      
      //Parse Mardown and off the post
      return kirbytext($result['content']);

    }
  };

  if ($page->subcategory()->isNotEmpty()) {
    $related = $related->filterBy('subcategory', $page->subcategory()->value());
  }
  
  return [
    'categories'      => $categories,
    'currentCategory' => $page->category(),
    'download'        => $page->download(),
    'author'          => $page->parent(),
    'authorPlugins'   => $page->siblings(false),
    'relatedPlugins'  => $related,
    'documentation'   => $page->text()->kt()->or($readme())
  ];
};