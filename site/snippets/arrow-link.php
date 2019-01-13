<?php

$direction = @$direction ?? 'right';

$iconBefore = ($direction === 'left')  ? icon('chevron-left', true) : '';
$prefix     = ($direction === 'left')  ? '<span class="hide-if-css" aria-hidden="true">« </span>' : '';

$iconAfter  = ($direction === 'right') ? icon('chevron-right', true) : '';
$suffix     = ($direction === 'right') ? '<span class="hide-if-css" aria-hidden="true"> »</span>' : '';

$content    = "{$iconBefore}<span>{$prefix}{$text}{$suffix}</span>{$iconAfter}";

if (@$disabled) {
  echo Html::tag('span', [$content], [
    'class'       => "arrow-link -direction:{$direction} -disabled",
    'aria-hidden' => 'true',
  ]);
} else {
  echo Html::a($link, [$content], [
    'class' => "arrow-link -direction:{$direction}",
    'rel'   => @$rel ?? null,
  ]);
}
