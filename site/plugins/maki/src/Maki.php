<?php

namespace Kirby\Maki;

use ParsedownExtra;

class Maki extends ParsedownExtra
{

    public function __construct()
    {
        parent::__construct();
        $this->setBreaksEnabled(true);
    }

    /**
     * An extended version of Parsedown’s codeblock handler,
     * offering the possibility of adding a caption (e.g. filename)
     * to codeblocks.
     */
    protected function blockFencedCode($Line)
    {
        $marker = $Line['text'][0];

        // Match opener

        $openerLength = strspn($Line['text'], $marker);

        if ($openerLength < 3)
        {
            return;
        }

        $infostring = trim(str_replace("\t", ' ', substr($Line['text'], $openerLength)), ' ');

        if (strpos($infostring, ' ') === false && strpos($infostring, '`') !== false)
        {
            // abort parsing of block, if code block does not
            // have a caption, but language string contains
            // a backtick to match the behavior of vanilla
            // Parsedown.
            return;
        }

        $infostring = explode(' ', $infostring, 2);
        $language   = $infostring[0];

        if(sizeof($infostring) === 2) {
            // Block with caption
            $caption = $infostring[1];

            $openChar = $caption[0];

            if($openChar === '"' || $openChar === '"') {
                $captionLength = strlen($caption);
                $lastChar      = $caption[$captionLenght - 1];

                if($lastChar === $openChar) {
                    // Remove quotes surrounding caption
                    $caption = substr($caption, 1, $captionLength - 2);
                }
            } else {
                // If caption was not wrapped in quotes,
                // just drop it.
                $caption = '';
            }
        } else {
            // Block without caption
            $caption = '';
        }

        // Compose the code block

        $Element = [
            'name' => 'code',
            'text' => '',
        ];

        if ($language !== '') {
            $Element['attributes'] = [
                'class' => "language-{$language}"
            ];
        }


        $Block = [
            'char'         => $marker,
            'caption'      => $caption,
            'openerLength' => $openerLength,
            'language'     => $language,
            'element' => [
                'name'       => 'pre',
                'element'    => $Element,
                'attributes' => [
                    'class' => 'code',
                ],
                // 'handler' => 'element',
            ],
        ];

        return $Block;
    }

    /**
     * Extended version of the final block handler, which
     * adds support for filysystem code blocks, which
     */
    protected function blockFencedCodeComplete($Block)
    {
        switch ($Block['language']) {
            case 'filesystem':
                $Block['element'] = [
                    'name'       => !empty($Block['caption']) ? 'div' : 'figure',
                    'attributes' => ['class' => 'filesystem'],
                    'rawHtml'    => FileSystem::parse($Block['element']['element']['text']),
                ];
                break;
            case 'kirbycontent':
                $Block['element']['element']['text'] = KirbyContent::parse($Block['element']['element']['text']);
                break;
            default:
                $text = $Block['element']['element']['text'];
                $text = str_replace(['&lpar;', '&rpar;', '(\\'], ['(', ')', '('], $text);
                $Block['element']['element']['text'] = trim($text);
        }

        if($Block['language'] !== 'filesystem' && !empty($Block['caption'])) {

            $Block['element'] = [
                'name' => 'figure',
                'attributes' => [
                    'class' => 'codeblock-figure',
                ],
                'element' => [
                    'elements' => [
                        [
                            'name' => 'figcaption',
                            'text' => htmlspecialchars($Block['caption']),
                        ],
                        $Block['element'],
                    ],
                ],
            ];
        }

        return $Block;
    }

    protected function blockTable($Line, array $Block = null)
    {
        $Block = parent::blockTable($Line, $Block);

        return $Block;
    }
    
    protected function blockTableComplete($Block)
    {
        $Block = [
            'element' => [
                'name'       => 'div',
                'attributes' => [
                    'class' => 'table-wrap',
                ],
                'elements'   => [$Block['element']],
            ],
        ];

        return $Block;
    }

    // Highlight data types in inline code
    protected function inlineCode($Excerpt)
    {
        $Excerpt = parent::inlineCode($Excerpt);
        
        if ($Excerpt !== null) {
            return array_merge($Excerpt, [
                'element' => [
                    'rawHtml' => formatDatatype(htmlspecialchars($Excerpt['element']['text'])),
                ],
            ]);
        }
    }
}
