<?php

/**
 * Shortcuts that we use in the core to redirect to specific
 * license terms. MUST NOT BE REMOVED!
 */
return [
	[
		'pattern' => 'license/free-licenses',
		'action'  => fn () => go('license/#free-licenses__usage-for-a-development-installation')
	],
];
