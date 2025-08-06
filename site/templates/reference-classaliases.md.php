<?php

layout('article.md');

snippet('kirbytext/reference.md', ['entries' => $page->children()]);
