<?php

return function ($kirby) {
	return $kirby->collection('cases')->filterBy('cause', true);
};
