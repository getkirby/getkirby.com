<?php

class SecurityPage extends Page
{

    public function incidents()
    {
        return parent::incidents()->toStructure()->flip();
    }

    public function incidentsTable()
    {
        return snippet('templates/security/incidents', ['incidents' => $this->incidents()], true);
    }

    public function replace()
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

        return [
            'latest'             => $this->kirby()->version(),
            'no-vulnerabilities' => $noVulns
        ];
    }

    public function versions()
    {
        return parent::versions()->replace($this->replace())->toStructure();
    }

    public function versionsTable()
    {
        return snippet('templates/security/versions', ['versions' => $this->versions()], true);
    }

    public function text()
    {
        return parent::text()->replace(array_merge($this->replace(), [
            'incidents' => $this->incidentsTable(),
            'versions'  => $this->versionsTable()
        ]));
    }

}
