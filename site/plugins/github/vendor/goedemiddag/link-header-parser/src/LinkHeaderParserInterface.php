<?php

namespace Goedemiddag\LinkHeaderParser;

interface LinkHeaderParserInterface
{
    public function parse(string $header): LinkHeader;
}
