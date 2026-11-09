<?php

/**
 * Checks if the site is served as archived docs
 * for a previous major version
 */
function isArchived(): bool
{
	return option('archived', false) === true;
}
