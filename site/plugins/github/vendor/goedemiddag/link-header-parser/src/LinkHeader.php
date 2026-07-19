<?php

namespace Goedemiddag\LinkHeaderParser;

readonly class LinkHeader
{
    /**
     * @param  array<string, Link>  $links
     */
    public function __construct(
        public array $links = [],
    ) {
    }

    public function getLink(string $rel): ?Link
    {
        return $this->links[$rel] ?? null;
    }
}
