<?php

$og   = [];
$meta = [];

$template           = $page->template();
$og['og:site_name'] = $site->title();
$og['og:url']       = $page->url();
$og['og:title']     = $page->title();
$og['og:type']      = 'website';

/* -----  Description  ------------------------------------------------------ */

$meta['twitter:card'] = 'summary';

$description = null;

if ($page->description()->isNotEmpty()) {
  $description = $page->description()->value();
} else {
  $description = $site->description()->value();
}

$og['og:description'] = $meta['description'] = $description;

/* -----  Image  ------------------------------------------------------------ */

$image = null;

if (($image = $page->ogimage()->toFile()) || ($image = $site->ogimage()->toFile())) {
  $og['og:image'] = $image->url();
}


// Image
// $image = null;
// if($page->cover()->isNotEmpty()):
//   if ($file = $page->cover()->toFile()):
//     $image = $file->resize(1000)->url();
//   endif;
// endif;

// if ($image):
//   $og['og:image'] = $image;
// else:
//   $content = $page->meta() . "\n" .
//              $page->description() . "\n" .
//              $page->text();

//   if (preg_match('/\(image:\s*([^)\s]+)\s*\)/siU', $content, $matches)):
//     $image = $page->image($matches[1]);
//     if ($image->exists()):
//       $og['og:image'] = $image->resize(1000)->url();
//     endif;
//   endif;
// endif;

// Twitter Username
if($site->twittersite()->isNotEmpty()) {
  $meta['twitter:site'] = $site->twittersite()->value();
}

if($site->twittercreator()->isNotEmpty()) {
  $meta['twitter:creator'] = $site->twittercreator()->value();
}

// Generate Meta Tags
foreach($meta as $name => $content):
  echo html::tag('meta', null, [
    'name'    => $name,
    'content' => $content,
  ]), "\n";
endforeach;

// Generate Opengraph Tags
foreach($og as $prop => $content):
  echo html::tag('meta', null, [
    'property' => $prop,
    'content'  => $content,
  ]), "\n";
endforeach;
?>
