<?php
$sticky ??= true;

$items = $menu->values(function ($page) {
  $item = [
    'id'     => $page->id(),
    'title'  => $page->title(),
    'link'   => $page->url(),
    'open'   => $page->isOpen(),
    'active' => $page->isActive()
  ];

  if ($page->hasListedChildren() === true) {
    $item['children'] = $page->children()->listed()->values(function ($subpage) {
        return [
        'id'     => $subpage->id(),
        'title'  => $subpage->title(),
        'link'   => $subpage->url(),
        'open'   => $subpage->isOpen(),
        'active' => $subpage->isActive()
        ];
    });
  }

  return $item;
});
?>

<?php snippet('sidebar/sidebar' , compact('title', 'items', 'sticky')) ?>