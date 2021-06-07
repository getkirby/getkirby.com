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
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->setData($data);
    }

    /**
     * @param array $data
     * @return array
     */
    public function setData(array $data): self
    {
        // extract some data to be need
        $data['repository'] = Url::path($data['url']);
        $data['owner'] = Str::split($data['repository'], '/')[0];
        $data['repo'] = basename($data['url']);
        $data['ref'] = 'plugin/' . $data['repo'];

        $this->data = $data;

        return $this;
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
     * @todo: complete the method
     */
    private function checkInfo()
    {
        // checks repository exists
        if (false) {
            throw new Exception('The repository not found.');
        }

        // checks composer.json file
        if (false) {
            throw new Exception('No valid composer.json file found.');
        }

        // checks `kirby-plugin` composer.json file
        if (false) {
            throw new Exception('The composer.json file must be of type "kirby-plugin".');
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
            // sha of main branch
            'sha' => '96ac0994434eefb5b1214279c496fed50424bc82',
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
            $this->request($this->api('/git/refs'), [
                'ref' => 'refs/heads/' . $this->data('ref')
            ], 'DELETE');
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
            'base' => 'master',
            'head' => $this->data('ref'),
            'title' => 'Add ' . $this->data('title') . ' plugin',
            'body' => 'This pull request created with automated via GitHub API for ' . $this->data('title') . ' plugin'
        ]);
    }

    /**
     * @param string $endpoint
     * @return string
     */
    private function api(string $endpoint): string
    {
        return 'https://api.github.com/repos/' . option('github.repository.website') . $endpoint;
    }

    /**
     * @param string $url
     * @param array $params
     * @param string $type
     * @throws \Kirby\Exception\Exception
     */
    private function request(string $url, array $params = [], string $type = 'POST')
    {
        try {
            $response = Remote::request($url, [
                'method' => $type,
                'data' => json_encode($params),
                'agent' => $_SERVER['HTTP_USER_AGENT'],
                'headers' => [
                    'Authorization: token ' . option('github.key'),
                    'Accept: application/vnd.github.v3+json'
                ]
            ]);

            if ($response->code() !== 200) {
                throw new Exception($response->json()->message ?? 'GitHub API failed!');
            }

            return $response;
        } catch (Exception $e) {
            throw $e;
        }
    }
}
