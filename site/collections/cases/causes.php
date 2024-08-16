<?php

return function ($kirby) {
	return $kirby->collection('cases')->filterBy('tag', 'cause', ',');
};
