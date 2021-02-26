<?php

return function ($site) {
    return $site->find('docs/reference')->children()->listed();
};
