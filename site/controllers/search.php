<?php

return function () {

    $hitsPerPage = 50;
    $options     = $this->option('algolia');

    if (!$options) {
        go();
    }

    $pageNum = param('page');
    $query   = trim(get('q'));

    if (!empty($query)) {
        $results = algolia()->search($query, $pageNum, [
            'hitsPerPage'           => $hitsPerPage,
            'attributesToHighlight' => false,
            'attributesToSnippet'   => '*'
        ]);
    } else {
        $results = new Collection;
        $results = $results->paginate(10);
    }

    return [
        'results'     => $results,
        'query'       => html(strip_tags($query), false),
        'hitsPerPage' => $hitsPerPage,
        'startNumber' => ($hitsPerPage * ($results->pagination()->page() -1) + 1),
    ];

};
