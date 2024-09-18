<?php

return function () {
	return page('meet/events')->children()->sortBy('date', 'desc');
};
