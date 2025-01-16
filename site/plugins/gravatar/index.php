<?php

function gravatar(string $email, string|null $default = null): string {
	$address = strtolower(trim($email));
	$hash    = hash('sha256',$address);

	return 'https://www.gravatar.com/avatar/' . $hash . '?d=' . $default;
}
