<?php

if ($page->link()->isNotEmpty() === true) {
	go($page->link());
}

if ($page->video()->isNotEmpty() === true) {
	go($page->video());
}

go($page->parent()->url());
