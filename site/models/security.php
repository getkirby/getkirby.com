<?php

use Kirby\Cms\Field;
use Kirby\Cms\Page;
use Kirby\Toolkit\Str;

class SecurityPage extends Page
{
    public function incidents()
    {
        return parent::incidents()->toStructure()->flip();
    }

    public function incidentsTable()
    {
        return snippet('templates/security/incidents', [
            'incidents' => $this->incidents()
        ], true);
    }

    public function messages()
    {
        return parent::messages()->toStructure()->flip();
    }

    public function messagesTable()
    {
        return snippet('templates/security/messages', [
            'messages' => $this->messages()
        ], true);
    }

    protected function replace(Field $field, array $data = [])
    {
        $noVulns = null;

        // latest `fixed` version in the incident list = no newer known vulnerabilities
        foreach ($this->incidents() as $incident) {
            foreach ($incident->fixed()->split(',') as $fixed) {
                if ($noVulns === null || version_compare($fixed, $noVulns, '>')) {
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

    public function urls()
    {
        return $this->replace(parent::urls())->toStructure();
    }

    public function versions()
    {
        return $this->replace(parent::versions())->toStructure();
    }

    public function versionsTable()
    {
        return snippet('templates/security/versions', [
            'versions' => $this->versions()
        ], true);
    }

    public function text()
    {
        return $this->replace(parent::text(), [
            'incidents' => $this->incidentsTable(),
            'messages'  => $this->messagesTable(),
            'versions'  => $this->versionsTable()
        ]);
    }
}
