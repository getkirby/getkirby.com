<?php

echo json([
    'query'      => $query,
    'area'       => $area,
    'results'    => $results ?? [],
    'pagination' => $pagination?->toArray(),
]);