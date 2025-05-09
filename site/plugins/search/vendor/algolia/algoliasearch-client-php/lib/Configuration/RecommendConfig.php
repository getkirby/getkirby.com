<?php

// Code generated by OpenAPI Generator (https://openapi-generator.tech), manual changes will be lost - read more on https://github.com/algolia/api-clients-automation. DO NOT EDIT.

namespace Algolia\AlgoliaSearch\Configuration;

class RecommendConfig extends Configuration
{
    protected $clientName = 'Recommend';

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
        ];
    }
}
