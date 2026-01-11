<?php

use Kirby\Cms\Page;
use Kirby\Toolkit\Str;
use Kirby\Toolkit\V;

class PartnersSignupPage extends Page
{
	/**
	 * @throws Exception
	 */
	public function validateReferences(string $plan, string $references): void
	{
		$links = preg_split('/[\s,]+/', $references, -1, PREG_SPLIT_NO_EMPTY);
		$projectCount = $plan === 'regular' ? 2 : 4;

		if (count($links) < $projectCount) {
			throw new Exception('A minimum number of ' . $projectCount . ' references is required');
		}

		foreach ($links as $referenceLink) {
			if (V::url($referenceLink) === false) {
				throw new Exception('At least one of the URLs provided is not valid');
			}
		}

	}

	/**
	 * @throws Exception
	 */
	public function validateWebsite(string $website): void
	{
		if (empty($website)) {
			throw new Exception('The website field may not be empty');
		}

		if (V::url($website) === false) {
			throw new Exception('Please make sure to provide a valid website URL');
		}

		if (Str::contains($website, 'example')) {
			throw new Exception('Please provide a valid website name');
		}
	}

	public function validateEmail(string $email): void
	{
		if (V::email($email) === false || Str::contains($email, 'example')) {
			throw new Exception('Please provide a valid email');
		}
	}

	public function validateBusinessType(string $businessType): void
	{
		if (is_numeric($businessType) || preg_match('/^[0-9_\-@#$]/', $businessType)) {
			throw new Exception('Please provide a valid business name');
		}

	}
}
