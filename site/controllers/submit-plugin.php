<?php

use Kirby\Toolkit\F;
use Kirby\SubmitPlugin\SubmitPlugin;

return function ($kirby, $page) {
    $errors = [];
    $categories = option('plugins.categories');

    if ($kirby->request()->is('POST')) {
        try {
            if (csrf(get('csrf')) === false) {
                throw new Exception('CSRF token mismatch!');
            }

            $data = [
                'title' => get('title'),
                'url' => get('url'),
                'category' => get('category'),
                'description' => get('description'),
                'developer' => get('developer'),
            ];

            $rules = [
                'title' => ['required', 'minLength' => 3, 'maxLength' => 100],
                'url' => ['required', 'url'],
                'category' => ['required', 'in' => [array_keys($categories)]],
                'description' => ['required', 'minLength' => 20, 'maxLength' => 255],
                'developer' => ['required', 'minLength' => 3, 'maxLength' => 32],
            ];

            $messages = [
                'title' => 'Please enter a valid plugin title',
                'url' => 'Please enter a valid GitHub or GitLab repository url',
                'category' => 'Please select a category',
                'description' => 'Please enter a plugin description that between 20 and 255 characters',
                'developer' => 'Please enter a plugin author name'
            ];

            // some of the data is invalid
            if ($invalid = invalid($data, $rules, $messages)) {
                $errors = $invalid;
            }

            // @todo: test uploading screenshot
            // check plugin screenshot file
            if ($upload = $kirby->request()->files()->get('file')) {
                if ($upload['error'] === 4) {
                    $errors[] = 'You have to add at least one file';
                } elseif ($upload['error'] !== 0) {
                    $errors[] = 'The file could not be uploaded';
                } elseif ($upload['size'] > 1000000) {
                    $errors[] = $upload['name'] . ' is larger than 1 MB';
                } elseif (in_array($upload['type'], ['image/png']) === false) {
                    $errors[] = $upload['name'] . ' is not a PNG';
                } else {
                    list($width, $height) = getimagesize($upload['tmp_name']);

                    // finally, check the width and height.
                    if ($width > 800 || $height > 600) {
                        $errors[] = 'Screenshot max resolution must be 800x600 px';
                    } else {
                        $data['featured_image'] = F::read($upload['tmp_name']);
                    }
                }
            }

            // submit plugin if no errors
            if (empty($errors) === true) {
                try {
                    $plugin = new SubmitPlugin($data);

                    if ($plugin->submit() === true) {
                        return $page->go(['params' => [
                            'status' => 'success'
                        ]]);
                    }
                } catch (Exception $e) {
                    $errors[] = $e->getMessage() ?? 'The plugin could not be submit';
                }
            }
        } catch (Exception $e) {
            $errors[] = $e->getMessage();
        }
    }

    return [
        'errors' => $errors,
        'categories' => $categories,
        'currentCategory' => null
    ];
};
