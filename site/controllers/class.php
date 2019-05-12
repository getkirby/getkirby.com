<?php

return function ($kirby) {

  if ($advanced = get('advanced')) {
    $kirby->session()->set('advanced', $advanced);
  }

};
