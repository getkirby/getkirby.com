<?php

declare(strict_types=1);

namespace Loupe\Matcher\Formatting;

use Loupe\Matcher\Tokenizer\TokenCollection;

class Unhighlighter implements Transformer
{
    public function __construct(
        private string $startTag,
        private string $endTag
    ) {
    }

    public function transform(string $text, TokenCollection|string $query, TokenCollection $matches): string
    {
        return str_replace([$this->startTag, $this->endTag], ['', ''], $text);
    }
}
