<?php

return function () {
    if ($page = page($path = 'docs/guide/' . $this->request()->url()->path()->slice(1))) {
        go($page->url(), 307);
    }
};
