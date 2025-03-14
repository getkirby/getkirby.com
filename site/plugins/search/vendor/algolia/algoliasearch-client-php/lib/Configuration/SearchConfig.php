<?php

// Code generated by OpenAPI Generator (https://openapi-generator.tech), manual changes will be lost - read more on https://github.com/algolia/api-clients-automation. DO NOT EDIT.

namespace Algolia\AlgoliaSearch\Configuration;

class SearchConfig extends Configuration
{
    protected $clientName = 'Search';

    private $defaultWaitTaskTimeBeforeRetry = 5000; // 5 sec in milliseconds
    private $defaultMaxRetries = 50;

    public static function create($appId, $apiKey)
    {
        $config = [
            'appId' => $appId,
            'apiKey' => $apiKey,
        ];

        return new static($config);
    }

    public function getWaitTaskTimeBeforeRetry()
    {
        return $this->config['waitTaskTimeBeforeRetry'];
    }

    public function getDefaultMaxRetries()
    {
        return $this->config['defaultMaxRetries'];
    }

    public function getDefaultConfiguration()
    {
        return [
            'appId' => '',
            'apiKey' => '',
            'hosts' => null,
            'hasFullHosts' => false,
            'readTimeout' => 5,
            'writeTimeout' => 30,
            'connectTimeout' => 2,
            'defaultHeaders' => [],
            'waitTaskTimeBeforeRetry' => $this->defaultWaitTaskTimeBeforeRetry,
            'defaultMaxRetries' => $this->defaultMaxRetries,
            'defaultForwardToReplicas' => null,
            'batchSize' => 1000,
        ];
    }
}
