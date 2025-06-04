<?php

use Kirby\Cms\License;
use Kirby\Content\Field;
use Kirby\Github\Github;
use Kirby\Toolkit\A;
use Kirby\Toolkit\Collection;
use Kirby\Toolkit\Str;

class SecurityPage extends DefaultPage
{
	/**
	 * Returns all security advisories in the `getkirby/kirby` GitHub repo
	 */
	public function incidents(): array
	{
		$kirby = $this->kirby();
		$cache = $kirby->cache('github');

		$entry = $cache->get('incidents');
		if (
			$entry !== null &&
			$entry['currentVersion'] === $kirby->version()
		) {
			return $entry['incidents'];
		}

		try {
			$incidents = [];
			foreach (Github::request('getkirby/kirby', 'security-advisories')->json() as $advisory) {
				$cvss = match (true) {
					$advisory['cvss_severities']['cvss_v4']['score'] !== null => $advisory['cvss_severities']['cvss_v4'],
					$advisory['cvss_severities']['cvss_v3']['score'] !== null => $advisory['cvss_severities']['cvss_v3'],
					default => $advisory['cvss']
				};

				$incidents[] = [
					'affected'    => Str::replace($advisory['vulnerabilities'][0]['vulnerable_version_range'], [', ', '-'], [' || ', ' - ']),
					'fixed'       => $advisory['vulnerabilities'][0]['patched_versions'],
					'description' => $advisory['summary'],
					'link'        => $advisory['html_url'],
					'severity'    => $advisory['severity'],
					'score'       => $cvss['score'],
					'cve'         => $advisory['cve_id'],
					'cvss'        => $cvss['vector_string']
				];
			}
		} catch (Throwable) {
			// no GitHub API key is available
			return [];
		}

		$incidents = A::sort($incidents, 'cve', 'desc');

		$cache->set('incidents', ['currentVersion' => $kirby->version(), 'incidents' => $incidents], 10080);

		return $incidents;
	}

	public function incidentsTable()
	{
		return snippet('templates/security/incidents', [
			'incidents' => $this->incidents()
		], true);
	}

	protected function kirbyVersionNoVulnerabilities(): string
	{
		$noVulnerabilities = null;

		// latest `fixed` version in the incident list =
		// no newer known vulnerabilities
		foreach ($this->incidents() as $incident) {
			foreach (Str::split($incident['fixed']) as $fixed) {
				if (
					$noVulnerabilities === null ||
					version_compare($fixed, $noVulnerabilities, '>')
				) {
					$noVulnerabilities = $fixed;
				}
			}
		}

		return $noVulnerabilities;
	}

	public function kirbyVersions(): array
	{
		$versions = $this->content()->versions()->yaml();

		// dynamically add v4+
		foreach (License::HISTORY as $major => $initialRelease) {
			// v3 and older are configured manually in `security.txt`
			if ((int)$major < 4) {
				continue;
			}

			$nextRelease = License::HISTORY[(string)($major + 1)] ?? null;

			$versions[$major . '.*'] = [
				'shortName'          => 'v' . $major,
				'initialRelease'     => $initialRelease,
				'endOfActiveSupport' => $nextRelease,
				'endOfLife'          => date('Y-m-d', strtotime($initialRelease . ' + 3 years')),
				'latest'             => page('releases/' . $major)->latestRelease()
			];
		}

		// determine current status for each version
		foreach ($versions as $constraint => $version) {
			$versions[$constraint]['status'] = match (true) {
				time() > strtotime($version['endOfLife']) => 'end-of-life',
				$version['endOfActiveSupport'] !== null   => 'security-support',
				default                                   => 'active-support'
			};
		}

		return array_reverse($versions, true);
	}

	public function kirbyVersionsForUpdateCheck(): array
	{
		$versions = [
			$this->kirby()->version() => [
				'status'      => 'latest',
				'description' => 'Latest Kirby release',
			],
			'>=' . $this->kirbyVersionNoVulnerabilities() => [
				'status'      => 'no-vulnerabilities',
				'description' => 'No known vulnerabilities',
			]
		];

		foreach ($this->kirbyVersions() as $constraint => $version) {
			$description = match ($version['status']) {
				'end-of-life'      => 'Not supported (end of life) since ' . date('F j, Y', strtotime($version['endOfLife'])),
				'security-support' => 'Security support until ' . date('F j, Y', strtotime($version['endOfLife'])),
				'active-support'   => 'Actively supported'
			};

			$versions[$constraint] = [
				'status'         => $version['status'],
				'description'    => $description,
				'latest'         => $version['latest'],
				'initialRelease' => $version['initialRelease']
			];
		}

		return $versions;
	}

	public function kirbyVersionsTable()
	{
		return snippet('templates/security/versions', [
			'versions' => new Collection($this->kirbyVersions())
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
		$latest = $this->kirby()->version();

		// extract the part before the first dot
		preg_match('/^(\w+)\./', $latest, $matches);

		$versions = page('releases')->children()->filterBy('template', '!=', 'link')->pluck('versionField');
		$releasePages = implode(' || ', array_map(fn ($version) => $version . str_repeat('.0', 2 - substr_count($version, '.')), $versions));

		$data = [
			'latest'            => $latest,
			'latestMajor'       => $matches[1],
			'noVulnerabilities' => $this->kirbyVersionNoVulnerabilities(),
			'releasePages'      => $releasePages,
			...$data
		];

		$field->value = Str::template($field->value, $data);

		return $field;
	}

	public function urls(): array
	{
		return $this->replace(parent::urls())->yaml();
	}

	public function text(): Field
	{
		return $this->replace(parent::text(), [
			'incidents' => $this->incidentsTable(),
			'messages'  => $this->messagesTable(),
			'versions'  => $this->kirbyVersionsTable()
		]);
	}
}
