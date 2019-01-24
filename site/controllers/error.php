<?php

return function () {
    $path = $this->request()->url()->path()->slice(1);

    if (empty($path) === false && $page = page('docs/guide/' . $path)) {
        go($page->url(), 307);
    }
};
