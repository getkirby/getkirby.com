<?php

namespace LexZander\KirbyKarbon;

use Kirby\Http\Response;
use Kirby\Http\Uri;
use Kirby\Toolkit\A;
use Kirby\Toolkit\Str;
use Kirby\Toolkit\V;

class CarbonTxt
{
    // set as const inside class since syntax version of carbon.txt should not be a users option
    public const VERSION = '0.5';

    // template for carbon.txt to populate later with dynamic values through Str::template()
    public const TEMPLATE = <<<'TOML'
        version = "{{ version }}"
        {{ lastUpdated }}

        [org]
        disclosures = {{ disclosures }}

        [upstream]
        services = {{ services }}
        TOML;

    protected function lastUpdated(): string
    {
        $date = site()->karbon_last_updated();

        // TOML date, therefore unquoted; empty until the carbon data is saved once
        return $date->isNotEmpty() ? 'last_updated = ' . $date->toDate('Y-m-d') : '';
    }

    // wraps a value in TOML basic-string quotes and escapes what TOML requires
    protected function tomlString(string $value): string
    {
        return Str::wrap(strtr($value, [
            '\\' => '\\\\',
            '"'  => '\\"',
            "\n" => '\\n',
            "\r" => '\\r',
            "\t" => '\\t',
        ]), '"');
    }

    // reduces "https://cdn.example.com/path" or "cdn.example.com/path" to "cdn.example.com"
    protected function domain(string|null $value): string|null
    {
        $value = trim($value ?? '');

        if ($value === '') {
            return null;
        }

        if (Str::contains($value, '://') === false) {
            $value = 'https://' . $value;
        }

        return (new Uri($value))->host();
    }

    // one entry per line, each already wrapped in {}
    protected function tomlArray(array $lines): string
    {
        if ($lines === []) {
            return '[]';
        }

        return Str::wrap(A::join($lines, ",\n\t"), "[\n\t", "\n]");
    }

    protected function disclosures(): string
    {
        $lines = [];

        foreach (site()->karbon_disclosures()->toStructure() as $item) {
            $url = $item->url()->toUrl();

            // doc_type and an absolute http(s) url are required by the spec, skip incomplete entries
            if ($item->doc_type()->isEmpty() || $url === null || V::url($url) === false || Str::startsWith($url, 'http') === false) {
                continue;
            }

            $pairs = [
                'doc_type = ' . $this->tomlString($item->doc_type()->value()),
                'url = ' . $this->tomlString($url),
            ];

            if ($domain = $this->domain($item->domain()->value())) {
                $pairs[] = 'domain = ' . $this->tomlString($domain);
            }
            if (V::date($item->valid_until()->value())) {
                // TOML date, therefore unquoted
                $pairs[] = 'valid_until = ' . $item->valid_until()->toDate('Y-m-d');
            }
            if ($item->title()->isNotEmpty()) {
                $pairs[] = 'title = ' . $this->tomlString($item->title()->value());
            }

            $lines[] = Str::wrap(A::join($pairs), '{ ', ' }');
        }

        return $this->tomlArray($lines);
    }

    protected function services(): string
    {
        $lines = [];

        foreach (site()->karbon_services()->toStructure() as $item) {
            // an entry without a domain says nothing, skip it
            if (!$domain = $this->domain($item->domain()->value())) {
                continue;
            }

            $pairs = ['domain = ' . $this->tomlString($domain)];

            // tags field: carbon.txt allows a string or an array of strings, the key itself is optional
            $types = A::map($item->service_type()->split(), fn (string $type) => $this->tomlString($type));

            if ($types !== []) {
                $pairs[] = 'service_type = ' . (count($types) === 1 ? $types[0] : Str::wrap(A::join($types), '[', ']'));
            }

            $lines[] = Str::wrap(A::join($pairs), '{ ', ' }');
        }

        return $this->tomlArray($lines);
    }

    public function render(): string
    {
        return Str::template(self::TEMPLATE, [
            'version'     => self::VERSION,
            'lastUpdated' => $this->lastUpdated(),
            'disclosures' => $this->disclosures(),
            'services'    => $this->services(),
        ]);
    }

    public static function response(): Response
    {
        return new Response((new static())->render(), 'text/plain', 200, [], 'utf-8');
    }
}
