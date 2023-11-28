<?php

use Kirby\Content\Field;
use Kirby\Cms\Page;
use Kirby\Toolkit\Str;

class SecurityPage extends Page
{
	public function incidents(): array
	{
		return array_reverse(parent::incidents()->yaml());
	}

	public function incidentsTable()
	{
		return snippet('templates/security/incidents', [
			'incidents' => $this->incidents()
		], true);
	}

	public function messages(): array
	{
		return array_reverse(parent::messages()->yaml());
	}

	public function messagesTable()
	{
		return snippet('templates/security/messages', [
			'messages' => $this->messages()
		], true);
	}

	public function php(): array
	{
		return parent::php()->yaml();
	}

	protected function replace(Field $field, array $data = []): Field
	{
		$noVulns = null;

		// latest `fixed` version in the incident list =
		// no newer known vulnerabilities
		foreach ($this->incidents() as $incident) {
			foreach (Str::split($incident['fixed']) as $fixed) {
				if (
					$noVulns === null ||
					version_compare($fixed, $noVulns, '>')
				) {
					$noVulns = $fixed;
				}
			}
		}

		$latest = $this->kirby()->version();

		// extract the part before the second dot
		preg_match('/^(\w+\.\w+)\./', $latest, $matches);

		$data = array_merge([
			'latest'            => $latest,
			'latestMajor'       => $matches[1],
			'noVulnerabilities' => $noVulns
		], $data);

		$field->value = Str::template($field->value, $data);

		return $field;
	}

	public function urls(): array
	{
		return $this->replace(parent::urls())->yaml();
	}

	public function versions(): array
	{
		return $this->replace(parent::versions())->yaml();
	}

	public function versionsTable()
	{
		return snippet('templates/security/versions', [
			'versions' => $this->versions()
		], true);
	}

	public function text(): Field
	{
		return $this->replace(parent::text(), [
			'incidents' => $this->incidentsTable(),
			'messages'  => $this->messagesTable(),
			'versions'  => $this->versionsTable()
		]);
	}
}
