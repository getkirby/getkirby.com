<?php

namespace Kirby\SubmitPlugin;

use Kirby\Cms\App;
use Kirby\Exception\Exception;
use Kirby\Http\Remote;
use Kirby\Http\Request;
use Kirby\Http\Url;
use Kirby\Toolkit\A;
use Kirby\Toolkit\Str;

/**
 * Submitting plugin to getkirby.com website via form
 *
 * @package   Kirby SubmitPlugin
 * @author    Ahmet Bora <ahmet@getkirby.com>
 * @link      https://getkirby.com
 * @copyright Bastian Allgeier GmbH
 * @license   https://opensource.org/licenses/MIT
 */
class SubmitPlugin
{
    /**
     * @var
     */
    protected $data;

    /**
     * @var
     */
    protected $contents;

    /**
     * SubmitPlugin constructor.
     * Set and extract some data to be need
     *
     * @param array $data
     * @throws \Kirby\Exception\Exception
     */
    public function __construct(array $data)
    {
        // Only supports GitHub repositories
        if (Url::toObject($data['url'])->host() !== 'github.com') {
            throw new Exception('You can only add GitHub repositories. If it is not a GitHub repository, please contact us.');
        }

        $data['repository'] = Url::path($data['url']);

        $repositorySegments = Str::split($data['repository'], '/');
        $data['owner'] = $repositorySegments[0] ?? null;
        $data['repo'] = $repositorySegments[1] ?? null;

        if (empty($data['owner']) === true || empty($data['repo']) === true) {
            throw new Exception('Your plugin URL is invalid. Please check your repository url.');
        }

        $data['ref'] = 'plugin/' . $data['repo'];

        $this->data = $data;
    }

    /**
     * @param string|null $key
     * @return array|mixed|null
     */
    public function data(string $key = null)
    {
        if ($key !== null) {
            return $this->data[$key] ?? null;
        }

        return $this->data;
    }

    /**
     * Manages the end-to-end process for submitting the plugin
     *
     * @return bool
     * @throws \Kirby\Exception\Exception
     */
    public function submit(): bool
    {
        try {
            $this->checkInfo();
            $this->generateContents();

            $this->createRef();
            $this->createCommit();
            $this->createPullRequest();
        } catch (Exception $e) {
            $this->rollback();
            throw $e;
        }

        return true;
    }

    /**
     * Runs basic validations before API request
     *
     * @throws \Kirby\Exception\Exception
     */
    private function checkInfo()
    {
        try {
            // checks plugin exists
            $this->checkPluginExists();

            // checks repository exists
            $this->checkRepoExists();

            // checks composer.json file
            $this->checkValidComposer();
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * @return void
     * @throws \Kirby\Exception\Exception
     */
    public function checkPluginExists(): void
    {
        if (page('plugins/' . $this->data('repository'))) {
            throw new Exception('The plugin already exists in plugins directory.');
        }
    }

    /**
     * @return void
     * @throws \Kirby\Exception\Exception
     */
    public function checkRepoExists()
    {
        // if plugin exists, response header will be 200
        // otherwise catches the exception
        try {
            $this->request($this->api('', $this->data('repository')), [], 'GET');
        } catch (Exception $e) {
            throw new Exception('The repository not found.');
        }
    }

    /**
     * @return void
     * @throws \Kirby\Exception\Exception
     */
    public function checkValidComposer(): void
    {
        try {
            $response = $this->request($this->api('/contents/composer.json', $this->data('repository')), [], 'GET');

            if (empty($response) === false) {
                // checks `kirby-plugin` composer.json file
                $content = empty($response['content']) === false ? base64_decode($response['content']) : null;
                $composer = json_decode($content, true);
                $type = $composer['type'] ?? null;

                if ($type !== 'kirby-plugin') {
                    throw new Exception('The composer.json file must be of type "kirby-plugin".');
                }
            } else {
                throw new Exception('No valid composer.json file found.');
            }
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * Rollbacks changes made to the GitHub repository in case of any error.
     *
     * @return void
     */
    private function rollback(): void
    {
        // if the pull request is created,
        // the process is completed even if an error appears on the UI side.
        // so in case of error it is sufficient to delete the branch.
        $this->deleteRef();
    }

    /**
     * Generate commit contents
     */
    private function generateContents(): void
    {
        // plugin.txt
        // plugin details
        $plugin = [
            'Title: ' . $this->data('title'),
            'Repository: ' . $this->data('url'),
            'Category: ' . $this->data('category'),
            'Description: ' . $this->data('description')
        ];

        $this->contents['content/plugins/' . $this->data('repo') . '/plugin.txt'] = A::join($plugin, "\n\n----\n\n");

        // plugin-developer.txt
        // plugin developer
        if (page('plugins/' . $this->data('owner'))) {
            $this->contents['content/plugins/' . $this->data('owner') . '/plugin-developer.txt'] = 'Title: ' . $this->data('developer');
        }

        // screenshot.png
        // plugin screenshot
        if ($featuredImage = $this->data('featured_image')) {
            $this->contents['content/plugins/' . $this->data('repo') . '/screenshot.png'] = $featuredImage;
        }
    }

    /**
     * Create GitHub ref/branch based on `sha`
     * that created branch hash
     * use `git rev-parse origin/main` to get hash
     */
    private function createRef()
    {
        return $this->request($this->api('/git/refs'), [
            'ref' => 'refs/heads/' . $this->data('ref'),
            'sha' => $this->getRefSha()
        ]);
    }

    /**
     * Delete created ref/branch
     *
     * @return void
     */
    private function deleteRef(): void
    {
        try {
            $this->request($this->api('/git/refs/heads/' . $this->data('ref')), [], 'DELETE');
        } catch (Exception $e) {
            // do not throw exception
            // silently continue
        }
    }

    /**
     * Pushed content changes to created new ref/branch
     *
     * @return bool
     * @throws \Kirby\Exception\Exception
     *
     * @todo: can be use git trees to batch operation
     */
    private function createCommit(): bool
    {
        try {
            foreach ($this->contents as $path => $content) {
                $this->request($this->api('/contents/' . $path), [
                    'branch' => $this->data('ref'),
                    'content' => base64_encode($content),
                    'message' => 'Add ' . $this->data('title') . ' plugin',
                ], 'PUT');
            }
        } catch (Exception $e) {
            throw $e;
        }

        return true;
    }

    /**
     * Creates pull request based on created new ref/branch
     */
    private function createPullRequest()
    {
        return $this->request($this->api('/pulls'), [
            'base' => 'main',
            'head' => $this->data('ref'),
            'title' => 'Add ' . $this->data('title') . ' plugin',
            'body' => 'This pull request created with automated via GitHub API for ' . $this->data('title') . ' plugin'
        ]);
    }

    /**
     * @param string $endpoint
     * @return string
     */
    private function api(string $endpoint = '', string $repository = null): string
    {
        return 'https://api.github.com/repos/' . ($repository ?? option('github.repository.website')) . $endpoint;
    }

    /**
     * Get main branch SHA of getkirby.com repository via API
     *
     * @return string
     * @throws \Kirby\Exception\Exception
     */
    private function getRefSha()
    {
        $response = $this->request($this->api('/git/refs/heads/main'), [], 'GET');

        if (isset($response['object']['sha']) === false) {
            throw new Exception('Targeted main branch SHA not found!');
        }

        return $response['object']['sha'];
    }

    /**
     * @param string $url
     * @param array $params
     * @param string $type
     * @return array
     * @throws \Kirby\Exception\Exception
     */
    private function request(string $url, array $params = [], string $type = 'POST'): array
    {
        try {
            $response = Remote::request($url, [
                'method' => $type,
                'data' => json_encode($params),
                'agent' => $_SERVER['HTTP_USER_AGENT'] ?? 'Kirby',
                'headers' => [
                    'Authorization: token ' . option('github.key'),
                    'Accept: application/vnd.github.v3+json'
                ]
            ]);

            $json = $response->json();

            // 200: OK, 201: Created, 202: Accepted, 204: No Content
            if (in_array($response->code(), [200, 201, 202, 204]) === false) {
                throw new Exception($json['message'] ?? 'GitHub API failed!');
            }

            return $json;
        } catch (Exception $e) {
            throw $e;
        }
    }
}
