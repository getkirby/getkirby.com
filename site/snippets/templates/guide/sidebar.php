<?php
function toItem($page) {
  return [
    'id'     => $page->id(),
    'title'  => $page->title(),
    'link'   => $page->url(),
    'open'   => $page->isOpen(),
    'active' => $page->isActive()
  ];
}

$items = $menu->values(function ($page) {
  $item = toItem($page);

  if ($page->hasListedChildren() === true) {
    $item['children'] = $page->children()->listed()->values(
      fn ($subpage) => toItem($subpage)
    );
  }

  return $item;
});
?>

<?php snippet('sidebar/sidebar' , compact('title', 'link', 'items', 'sticky')) ?>