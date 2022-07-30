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

    public function messages()
    {
        return parent::messages()->toStructure()->flip();
    }

    public function messagesTable()
    {
        return snippet('templates/security/messages', ['messages' => $this->messages()], true);
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

        $latest = $this->kirby()->version();

        // extract the part before the second dot
        preg_match('/^(\w+\.\w+)\./', $latest, $matches);

        return [
            'latest'             => $latest,
            'latestMajor'        => $matches[1],
            'no-vulnerabilities' => $noVulns
        ];
    }

    public function urls()
    {
        return parent::urls()->replace($this->replace())->toStructure();
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
            'messages'  => $this->messagesTable(),
            'versions'  => $this->versionsTable()
        ]));
    }

}
