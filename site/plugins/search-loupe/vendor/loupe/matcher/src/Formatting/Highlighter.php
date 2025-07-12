<?php

declare(strict_types=1);

namespace Loupe\Matcher\Formatting;

use Loupe\Matcher\Matcher;
use Loupe\Matcher\Tokenizer\TokenCollection;

class Highlighter implements Transformer
{
    public function __construct(
        private Matcher $matcher,
        private string $startTag,
        private string $endTag
    ) {
    }

    public function transform(string $text, TokenCollection $matches): string
    {
        $spans = $this->matcher->calculateMatchSpans($matches);

        if (empty($spans)) {
            return $text;
        }

        $result = '';
        $end = 0;

        foreach ($spans as $span) {
            // Insert start tag before span
            $result .= mb_substr($text, $end, $span->getStartPosition() - $end, 'UTF-8');
            $result .= $this->startTag;

            // Insert span text
            $result .= mb_substr($text, $span->getStartPosition(), $span->getLength(), 'UTF-8');

            // Insert end tag after span
            $result .= $this->endTag;
            $end = $span->getEndPosition();
        }

        // Add remaining text after last span
        $result .= mb_substr($text, $end, null, 'UTF-8');

        return $result;
    }
}
