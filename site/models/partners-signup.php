<?php

use Kirby\Cms\Page;
use Kirby\Toolkit\Str;
use Kirby\Toolkit\V;

class PartnersSignupPage extends Page
{
	private array $messages = [];

	public function validate(array $data): array
	{
		$this->resetMessages();

		$errors = [
			'plan'         => $this->validatePlan($data['plan']),
			'references'   => $this->validateReferences($data['plan'], $data['references']),
			'website'      => $this->validateWebsite($data['website']),
			'email'        => $this->validateEmail($data['email']),
			'businessType' => $this->validateBusinessType($data['business']),
			'projects'     => $this->validateProjects($data['projects'], $data['plan']),
			'downloadLink' => $this->validateDownloadLink($data['reviewRef']),
		];

		return array_filter($errors, fn($error) => $error === false);
	}
	/**
	 * @throws Exception
	 */
	public function validateReferences(string $plan, string $references): bool
	{
		$links        = array_unique(preg_split('/[\s,]+/', $references, -1, PREG_SPLIT_NO_EMPTY));
		$projectCount = $plan === 'regular' ? 2 : 4;

		$links = array_unique($links);

		if (count($links) < $projectCount) {
			$this->messages[] = 'A minimum number of ' . $projectCount . ' unique references is required';
			return false;
		}

		foreach ($links as $referenceLink) {
			if (V::url($referenceLink) === false || Str::contains($referenceLink, 'example')) {
				$this->messages[] = 'At least one of the URLs provided is not valid';
				return false;
			}
		}

		return true;
	}

	/**
	 * @throws Exception
	 */
	public function validateWebsite(string $website): bool
	{
		if (empty($website)) {
			$this->messages[] = 'The website field may not be empty';
			return false;
		}

		if (V::url($website) === false) {
			$this->messages[] = 'Please make sure to provide a valid website URL';
			return false;
		}

		if (Str::contains($website, 'example')) {
			$this->messages[] = 'Please provide a valid website name';
			return false;
		}

		return true;
	}

	public function validateEmail(string $email): bool
	{
		if (V::email($email) === false || Str::contains($email, 'example')) {
			$this->messages[] = 'Please provide a valid email';
			return false;
		}

		return true;
	}

	public function validateBusinessType(string $businessType): bool
	{
		if (is_numeric($businessType) || preg_match('/^[0-9_\-@#$]/', $businessType)) {
			$this->messages[] = 'Please provide a valid business name';
			return false;
		}

		return true;
	}

	public function validatePlan(string $plan): bool
	{
		if (in_array($plan, ['regular', 'certified']) === false) {
			$this->messages[] = 'Please provide a valid plan';
			return false;
		}

		return true;
	}

	public function validateDownloadLink(?string $link): bool
	{
		if ($link && $link !== '' && V::url($link) === false) {
			$this->messages[] = 'Please provide a valid download URL or leave the field empty';
			return false;
		}

		return true;
	}

	public function validateProjects(int $projects, $plan): bool
	{
		$rules = [
			'regular'   => 2,
			'certified' => 4,
		];

		if ($projects < $rules[$plan]) {
			$this->messages[] = 'The number of projects does not match the minimum number of required projects for the selected plan';
			return false;
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
