<?php

return function($kirby, $page) {

  $errorMessage = null;
  if ($error = param('error')) {
    switch ($error) {
      case 'not-found':
        $errorMessage = 'The requested demo instance does not exist or has expired. ' .
                        'Feel free to create a new instance.';
        break;
      case 'rate-limit':
        $errorMessage = 'Your IP address has reached the maximum number of concurrent demo ' .
                        'instances. Please try again later or continue with one of your ' .
                        'existing instances.';
        break;
      default:
        $errorMessage = 'An unexpected error occured in the demo manager.';
    }
  }

  return [
    'errorMessage' => $errorMessage
  ];

};
