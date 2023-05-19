<?php

return function ($page) {

	return [
		'questions' => $page->find('answers')->children(),
	];

};
