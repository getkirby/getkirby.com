<?php

return function ($kirby) {
    return $kirby->collection('cases')->find([
        'fridays-for-future-at',
        'berlin-in-bewegung',
        'fairclimatefund',
        'strassenfeger',
        'natucate',
        'teteenlair'
    ]);
};
