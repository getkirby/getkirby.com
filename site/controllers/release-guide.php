<?php

return function ($page) {
	if ($page->link()->isNotEmpty() === true) {
		go($page->link());
	}
};
