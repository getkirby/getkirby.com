<?php

namespace Goedemiddag\LinkHeaderParser;

final class LinkHeaderFactory implements LinkHeaderParserInterface
{
    public static function fromHeader(string $header): LinkHeader
    {
        return (new self())->parse($header);
    }

    public function parse(string $header): LinkHeader
    {
        $header = preg_replace('/^\s*Link:\s*/i', '', trim($header));

        $links = [];
        foreach ($this->split($header, ',') as $linkValue) {
            $link = $this->parseLink($linkValue);
            if ($link === null) {
                continue;
            }

            $links[$link->rel] = $link;
        }

        return new LinkHeader($links);
    }

    private function parseLink(string $linkValue): ?Link
    {
        $segments = array_map('trim', $this->split($linkValue, ';'));
        if (count($segments) < 2) {
            return null;
        }

        $rawUri = $segments[0];
        if ($rawUri === '' || ! str_starts_with($rawUri, '<') || ! str_ends_with($rawUri, '>')) {
            return null;
        }

        $uri = trim($rawUri, '<>');
        $rel = null;
        $params = [];
        foreach (array_slice($segments, 1) as $segment) {
            if ($segment === '' || ! str_contains($segment, '=')) {
                continue;
            }

            [$name, $rawValue] = explode('=', $segment, 2);
            $name = strtolower(trim($name));
            if ($name === '') {
                continue;
            }

            $value = $this->unquote($rawValue);
            if ($name === 'rel') {
                $rel = strtolower($value);
                continue;
            }

            $params[$name] = $value;
        }

        if ($rel === null) {
            return null;
        }

        return new Link(
            uri: $uri,
            rel: $rel,
            attributes: $params,
        );
    }

    private function unquote(string $value): string
    {
        $value = trim($value);
        if (strlen($value) >= 2 && $value[0] === '"' && $value[-1] === '"') {
            $value = substr($value, 1, -1);
        }

        return str_replace('\\"', '"', $value);
    }

    /**
     * @return list<string>
     */
    private function split(string $value, string $delimiter): array
    {
        $parts = [];
        $buffer = '';
        $quoted = false;
        $escaped = false;
        $length = strlen($value);

        for ($i = 0; $i < $length; $i++) {
            $char = $value[$i];

            if ($escaped) {
                $buffer .= $char;
                $escaped = false;
                continue;
            }

            if ($quoted && $char === '\\') {
                $buffer .= $char;
                $escaped = true;
                continue;
            }

            if ($char === '"') {
                $quoted = ! $quoted;
                $buffer .= $char;
                continue;
            }

            if (! $quoted && $char === $delimiter) {
                $parts[] = trim($buffer);
                $buffer = '';
                continue;
            }

            $buffer .= $char;
        }

        if ($buffer !== '') {
            $parts[] = trim($buffer);
        }

        return $parts;
    }
}
