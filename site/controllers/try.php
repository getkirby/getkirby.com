<?php

return function($kirby, $page) {

  $statusMessage  = $statusType = $statusIcon = null;
  $statusMessages = [
	'not-found'  => 'The requested demo instance does not exist or has expired. Feel free to create a new instance.',
	'rate-limit' => 'Your IP address has reached the maximum number of concurrent demo instances. Please try again later or continue with one of your existing instances. Maybe your colleague has one you can play around with together? :)',
	'overload'   => 'Our demo server is currently being used by a lot of users, please try again later. Sorry for the inconvenience!',
	'deleted'	=> 'Your demo instance was deleted successfully. Thanks for trying out Kirby! You can create a new demo at any time.',
	'default'	=> 'An unexpected error occured in the demo manager. Please let us know if this keeps happening. Thanks!',
  ];

  if ($status = (param('error') ?? param('status'))) {
	$statusMessage = $statusMessages[$status] ?? $statusMessages['default'];
	$statusType	= $status === 'deleted' ? 'info' : 'warning';
  }

  return [
	'questions'	 => $page->find('answers')->children(),
	'statusIcon'	=> $statusType === 'warning' ? 'warning' : 'check',
	'statusMessage' => $statusMessage,
	'statusType'	=> $statusType,
  ];

};
