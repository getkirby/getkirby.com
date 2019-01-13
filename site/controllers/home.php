<?php

return function ($kirby) {

  if ($kirby->option('beta') && get('half-assed') !== 'protection') {
    go('docs');
  }

};
