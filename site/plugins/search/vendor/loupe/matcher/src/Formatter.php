<?php

declare(strict_types=1);

namespace Loupe\Matcher;

use Loupe\Matcher\Formatting\Cropper;
use Loupe\Matcher\Formatting\Highlighter;
use Loupe\Matcher\Formatting\Unhighlighter;
use Loupe\Matcher\Tokenizer\TokenCollection;

class Formatter
{
    public function __construct(
        private Matcher $matcher
    ) {
    }

    public function format(string $text, TokenCollection|string $query, FormatterOptions $options, TokenCollection|null $matches = null): FormatterResult
    {
        $matches = $matches ?? $this->matcher->calculateMatches($text, $query);

        $transformers = [];
        if ($options->shouldHighlight() || $options->shouldCrop()) {
            $transformers[] = new Highlighter($this->matcher, $options->getHighlightStartTag(), $options->getHighlightEndTag());
        }
        if ($options->shouldCrop()) {
            $transformers[] = new Cropper($options->getCropLength(), $options->getCropMarker(), $options->getHighlightStartTag(), $options->getHighlightEndTag());
        }
        if (!$options->shouldHighlight()) {
            $transformers[] = new Unhighlighter($options->getHighlightStartTag(), $options->getHighlightEndTag());
        }

        $formattedText = $text;
        foreach ($transformers as $transformer) {
            $formattedText = $transformer->transform($formattedText, $matches);
        }

        return new FormatterResult($formattedText, $matches);
    }
}
