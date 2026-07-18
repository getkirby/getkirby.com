<?php

namespace Goedemiddag\LinkHeaderParser;

readonly class Link
{
    /**
     * @param array<string, string> $attributes
     */
    public function __construct(
        public string $uri,
        public string $rel,
        public array $attributes = [],
    ) {
    }

    public function getAttribute(string $name): ?string
    {
        return $this->attributes[$name] ?? null;
    }

    public function hasAttribute(string $name): bool
    {
        return array_key_exists($name, $this->attributes);
    }
}
