<?php

$link   = $link ?? '#';
$class  = $class ?? '';
$icon   = $icon ? icon($icon, true) : '';
$button = $button ?? false;

if ($button) {
  echo Html::button([$icon, "<span class=\"cta-text\">{$text}</span>"], ['class' => trim("cta {$class}")]);
} else {
  echo Html::a($link, [$icon, "<span class=\"cta-text\">{$text}</span>"], ['class' => trim("cta {$class}")]);
}

