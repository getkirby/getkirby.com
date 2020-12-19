<?php

return function($kirby, $page) {

  $statusMessage = $statusType = null;
  if ($error = param('error')) {
    $statusType = 'error';

    switch ($error) {
      case 'not-found':
        $statusMessage = 'The requested demo instance does not exist or has expired. ' .
                         'Feel free to create a new instance.';
        break;
      case 'rate-limit':
        $statusMessage = 'Your IP address has reached the maximum number of concurrent demo ' .
                         'instances. Please try again later or continue with one of your ' .
                         'existing instances. Maybe your colleague has one you can play around ' .
                         'with together? :)';
        break;
      case 'overload':
        $statusMessage = 'Our demo server is currently being used by a lot of users, please ' .
                         'try again later. Sorry for the inconvenience!';
        break;
      default:
        $statusMessage = 'An unexpected error occured in the demo manager. Please let us know ' .
                         'if this keeps happening. Thanks!';
    }
  } elseif ($status = param('status')) {
    $statusType = 'status';

    switch ($status) {
      case 'deleted':
        $statusMessage = 'Your demo instance was deleted successfully. Thanks for trying out ' .
                         'Kirby! You can create a new demo at any time.';
        break;
      default:
        $statusType    = 'error';
        $statusMessage = 'Something unexpected happened in the demo manager. Please let us know ' .
                         'if this keeps happening. Thanks!';
    }
  }

  return [
    'demoServer'    => 'https://' . r(param('demo') === 'staging', 'staging.') . 'trykirby.com',
    'statusMessage' => $statusMessage,
    'statusType'    => $statusType
  ];

};
