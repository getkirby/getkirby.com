<?php

return function () {
	return page('brands')->children()->listed()->shuffle();
};
