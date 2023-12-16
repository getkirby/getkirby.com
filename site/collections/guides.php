<?php

return function ($site) {
	return $site->find('docs/guide')->children()->listed();
};
