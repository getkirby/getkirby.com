<?php

// expire the Kirby and CDN caches daily at midnight to refresh the "today" marker in the security calendar
$expiryTime = strtotime('tomorrow 0:00Z');
$kirby->response()->expires($expiryTime);
$kirby->response()->header('Cache-Control', 's-maxage=' . ($expiryTime - time()));

include __DIR__ . '/text.php';
