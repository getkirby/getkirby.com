<?php

// expire the cache daily at midnight to refresh the "today" marker in the security calendar
$expiryTime = strtotime('tomorrow 0:00Z');
$kirby->response()->expires($expiryTime);
$kirby->response()->header('Expires', gmdate('D, d M Y H:i:s T', $expiryTime));

include __DIR__ . '/text.php';
