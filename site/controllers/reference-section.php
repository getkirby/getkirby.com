<?php

return function () {

  if ($advanced = get('advanced')) {
    Cookie::set('getkirby_advanced', $advanced, [
      'lifetime' => 60*24*365*2
    ]);
  }

};
