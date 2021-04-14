<?php

return function ($site) {
    return $site->find('love')->children()->listed();
};
