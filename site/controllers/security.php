<?php

return function ($kirby, $page) {
    $incidents      = $page->incidents();
    $incidentsTable = snippet('security-incidents', compact('incidents'), true);

    $noVulns = null;
    foreach ($incidents as $incident) {
        if ($noVulns === null || version_compare($incident->fixed(), $noVulns, '>')) {
            $noVulns = $incident->fixed();
        }
    }

    $data = [
        'latest'             => $kirby->version(),
        'no-vulnerabilities' => $noVulns
    ];

    $supported      = $page->supported();
    $supportedTable = snippet('security-supported', compact('supported'), true);

    $text = new Field($page, 'text', Str::template($page->text(), array_merge($data, [
        'incidents' => $incidentsTable,
        'supported' => $supportedTable
    ])));

    return compact('text', 'supported', 'incidents');
};
