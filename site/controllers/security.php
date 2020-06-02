<?php

return function ($kirby, $page) {
    $incidents      = $page->incidents()->toStructure();
    $incidentsTable = snippet('security-incidents', compact('incidents'), true);

    $supported = null;
    foreach ($incidents as $incident) {
        if ($supported === null || version_compare($incident->fixed(), $supported, '>')) {
            $supported = $incident->fixed();
        }
    }

    $text = new Field($page, 'text', Str::template($page->text(), [
        'latest'    => $kirby->version(),
        'supported' => $supported,
        'incidents' => $incidentsTable
    ]));

    return compact('text', 'supported', 'incidents');
};
