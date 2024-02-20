<?php

return function () {
	return page('home/clients')->children()->listed()->shuffle();
};
