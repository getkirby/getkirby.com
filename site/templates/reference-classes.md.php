<?php

layout('reference.md');

snippet('templates/reference/sections/objects.md', ['sections' => $page->children()->unlisted()]);
