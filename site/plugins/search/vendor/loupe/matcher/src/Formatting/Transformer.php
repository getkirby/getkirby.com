<?php

declare(strict_types=1);

namespace Loupe\Matcher\Formatting;

use Loupe\Matcher\Tokenizer\TokenCollection;

interface Transformer
{
    /**
     * Transform the text according to the transformer's rules.
     */
    public function transform(string $text, TokenCollection|string $query, TokenCollection $matches): string;
}
