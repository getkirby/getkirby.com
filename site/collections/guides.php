<?php

return function () {
	return site()->find('docs/guide')->children()->listed();
};
