<?php

return function () {
    return page('voices')->children()->find([
        'jon-hicks',
        'grand-public',
        'colly',
        'diesdas-digital',
    ]);
};
