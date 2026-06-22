<?php

use Kirby\Cms\Page;
use Kirby\Toolkit\Str;
use Kirby\Toolkit\V;

class PartnersSignupPage extends Page
{
	public function validate(array $data): array
	{
		$errors = [
			'plan'       => $this->validatePlan($data['plan']),
			'references' => $this->validateReferences($data['plan'], $data['references']),
			'website'    => $this->validateWebsite($data['website']),
			'email'      => $this->validateEmail($data['email']),
			'business'   => $this->validateBusinessType($data['business']),
			'projects'   => $this->validateProjects($data['projects'], $data['plan']),
			'reviewRef'  => $this->validateDownloadLink($data['reviewRef']),
		];

		return array_filter($errors, fn($error) => $error !== true);
	}
	/**
	 * @throws Exception
	 */
	public function validateReferences(string $plan, string $references): string|bool
	{
		$links        = array_unique(preg_split('/[\s,]+/', $references, -1, PREG_SPLIT_NO_EMPTY));
		$projectCount = $plan === 'regular' ? 2 : 4;

		$links = array_unique($links);

		if (count($links) < $projectCount) {
			return 'A minimum number of ' . $projectCount . ' unique references is required';
		}

		foreach ($links as $referenceLink) {
			if (V::url($referenceLink) === false || Str::contains($referenceLink, 'example')) {
				return 'At least one of the URLs provided is not valid';
			}
		}

		return true;
	}

	/**
	 * @throws Exception
	 */
	public function validateWebsite(string $website): string|bool
	{
		if (empty($website)) {
			return 'The website field may not be empty';
		}

		if (V::url($website) === false) {
			return 'Please make sure to provide a valid website URL';
		}

		if (Str::contains($website, 'example')) {
			return 'Please provide a valid website name';
		}

		return true;
	}

	public function validateEmail(string $email): string|bool
	{
		if (V::email($email) === false || Str::contains($email, 'example')) {
			return 'Please provide a valid email';
		}

		return true;
	}

	public function validateBusinessType(string $businessType): string|bool
	{
		if (is_numeric($businessType) || preg_match('/^[0-9_\-@#$]/', $businessType)) {
			return 'Please provide a valid business name';
		}

		return true;
	}

	public function validatePlan(string $plan): string|bool
	{
		if (in_array($plan, ['regular', 'certified']) === false) {
			return 'Please provide a valid plan';
		}

		return true;
	}

	public function validateDownloadLink(?string $link): string|bool
	{
		if ($link && $link !== '' && V::url($link) === false) {
			return 'Please provide a valid download URL or leave the field empty';
		}

		return true;
	}

	public function validateProjects(int $projects, $plan): string|bool
	{
		$rules = [
			'regular'   => 2,
			'certified' => 4,
		];

		if ($projects < $rules[$plan]) {
			return 'The number of projects does not match the minimum number of required projects for the selected plan';
		}

		return true;
	}

	public function getMessages(): array
	{
		return $this->messages;
	}

	private function resetMessages(): void
	{
		$this->messages = [];
	}

}
