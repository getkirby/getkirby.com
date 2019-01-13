<?php

$class = $class ?? '';
$icon  = $icon ? icon($icon, true) : '';

echo Html::a($link, [$icon, "<span class=\"cta-text\">{$text}</span>"], ['class' => trim("cta {$class}")]);
