<?php

namespace Kirby\Reference;

use Kirby\Cms\App;
use Kirby\Cms\Field;
use Kirby\Cms\Page;
use Kirby\Reference\Types;
use Kirby\Template\Template;
use ReflectionUnionType;
use Throwable;

abstract class ReflectionPage extends Page
{

    protected DocBlock|false|null $docBlock = null;
    protected array|null $parameters = null;
    protected $reflection;
    protected string|false|null $returns = false;
    protected array|null $throws = null;

    /**
     * Returns how this entry would be called in code
     */
    public function call(): string
    {
        if ($reflection = $this->reflection()) {
            $parameters = array_column($this->parameters(), 'export');
            $parameters = empty($parameters) ? '' : implode(', ', $parameters);

            $call = $this->name() . '(' . $parameters . ')';

            if ($return = $this->returnType()) {
                $call .= ': ' . $return;
            }

            return $call;
        }

        return $this->slug();
    }

    /**
     * Returns deprecation information
     */
    public function deprecated(): Field
    {
        if ($tag = $this->docBlock()?->getTag('deprecated')) {
            $value = $tag->getVersion() . '|' . $tag->getDescription();
            return new Field($this, 'deprecated', $value);
        }

        return parent::deprecated();
    }

    /**
     * Gets the DocBlock information
     */
    public function docBlock(): DocBlock|false
    {
        if ($this->docBlock !== null) {
            return $this->docBlock;
        }

        if ($reflection = $this->reflection()) {
            try {
                return $this->docBlock = new DocBlock($reflection->getDocComment());
            } catch (Throwable) {
                return $this->docBlock = false;
            }
        }

        return $this->docBlock = false;
    }

    /**
     * Returns an intro description
     */
    public function intro(): Field
    {
        // prefer intro defined in content file
        if ($this->content()->has('intro')) {
            return $this->content()->get('intro');
        }

        // otherwise try to get summary from DocBlock in code
        if ($docBlock = $this->docBlock()) {
            $intro = trim($docBlock->getSummary());
            $intro = str_replace(PHP_EOL, ' ', $intro);

            if ($intro === '/') {
                $intro = null;
            }
        }

        return new Field($this, 'intro', $intro ?? null);
    }

    /**
     * Check if this has been deprecated
     */
    public function isDeprecated(): bool
    {
        return $this->deprecated()->isNotEmpty() === true;
    }

    /**
     * Check if this is marked as internal
     */
    public function isInternal(): bool
    {
        return is_null($this->docBlock()?->getTag('internal')) === false;
    }

    public function isMutable(): bool
    {
        return strpos($this->returns(), '$this') !== false;
    }

    public function isImmutable(): bool
    {
        return strpos($this->returns(), 'static') !== false ||
               strpos($this->returns(), 'self') !== false;
    }

    /**
     * Gets the line number where this starts in the code
     */
    public function line(): int|null
    {
        return $this->reflection()?->getStartLine();
    }

    public function metadata(): array
    {
        return [
            'description' => strip_tags($this->intro()->kirbytags()),
            'thumbnail' => [
                'lead'  => $this->metaLead(page('docs/reference'), 'Reference')
            ]
        ];
    }

    /**
     * Get the name of this entry
     */
    public function name(): string
    {
        return preg_replace_callback(
            '!-([a-z])!',
            fn ($matches) => strtoupper($matches[1]),
            $this->slug()
        );
    }

    /**
     * Returns URL to the code on GitHub
     */
    public function onGitHub(string $path = ''): Field
    {

        if (empty($path) === false) {
            $url  = option('github.url') . '/kirby/tree/' . App::version();
            $url .= '/' . $path;

            if ($line = $this->line()) {
                $url .= '#L' . $line;
            }
        }

        return field($url ?? null);
    }

    /**
     * Returns an array with all parameter info
     */
    public function parameters(): array
    {
        if ($this->parameters !== null) {
            return $this->parameters;
        }

        $reflection = $this->reflection();
        $parameters = [];

        if (!$reflection) {
            return $this->parameters = $parameters;
        }

        foreach ($reflection->getParameters() as $parameter) {
            $name = $parameter->getName();

            if ($docBlock = $this->docBlock()) {
                $doc = $docBlock->getParameter($name);
            } else {
                $doc = null;
            }

            if ($type = $parameter->getType()) {
                $type = $this->typeName($type);
            } elseif ($doc) {
                $type = (string)$doc->getType();
            }

            $param    = trim($type . ' $' . $name);
            $default  = null;
            $optional = false;

            if ($parameter->isOptional() === true) {

                if ($parameter->isDefaultValueAvailable()) {
                    $default = $parameter->getDefaultValue();
                    $default = var_export($default, true);
                    $default = str_replace('NULL', 'null', $default);
                    $default = str_replace('array (' . PHP_EOL . ')', '[ ]', $default);
                } else {
                    $default = 'null';
                }

                $optional  = true;
                $param    .= ' = ' . $default;
            }

            $parameters[] = [
                'name'        => '$' . $name,
                'required'    => $optional === false,
                'type'        => Types::factory($type ?? 'mixed', $this),
                'default'     => $default,
                'description' => $doc ? (string)$doc->getDescription() : null,
                'export'      => $param
            ];
        }

        return $this->parameters = $parameters;
    }

    /**
     * Creates the reflection object
     */
    protected function reflection()
    {
        return $this->reflection ??= $this->_reflection();
    }

    protected function _reflection()
    {
        return false;
    }

    public function typeName($type): string
    {
        if ($type instanceof ReflectionUnionType) {
            $types = [];

            foreach ($type->getTypes() as $reflectionType) {
                $types[] = $reflectionType->getName();
            }

            return implode('|', $types);
        }

        return $type->getName();
    }

    public function returns(): ?string
    {
        if ($this->returns !== false) {
            return $this->returns;
        }

        if ($reflection = $this->reflection()) {
            // First, try to get return type from reflection
            if ($reflection->hasReturnType() === true) {

                $type = $reflection->getReturnType();
                $name = $this->typeName($type);

                if ($type->allowsNull() === true) {
                    $name =  $name . '|null';
                }

                return $this->returns = $name;
            }

            // Otherwise, check DocBlock for return type
            if ($docBlock = $this->docBlock()) {
                if ($type = $docBlock->getReturnType()) {
                    $type = trim((string)$type->getType());
                    return $this->returns = $type;
                }
            }
        }

        return $this->returns = null;
    }


    /**
     * Returns a string of all return types
     */
    public function returnType(): string|null
    {
        if ($return = $this->returns()) {
            return Types::factory($return, $this);
        }

        return null;
    }

    /**
     * Returns in which version this entry was introduced
     */
    public function since(): Field
    {
        if ($tag = $this->docBlock()?->getTag('since')) {
            $since = $tag->getVersion();
            return new Field($this, 'since', $since ?? null);
        }

        return parent::since();
    }

    /**
     * If a dedicated template exist, use it.
     * Otherwise fall back to `reference-article` template.
     */
    public function template(): Template
    {
        // If template exists, use it
        if ($this->intendedTemplate() === parent::template()) {
            return parent::template();
        }

        return $this->kirby()->template('reference-article');
    }

     /**
     * Returns what exceptions can be thrown by this
     */
    public function throws(): array
    {
        if ($this->throws !== null) {
            return $this->throws;
        }

        $throws     = [];
        $reflection = $this->reflection();
        $docBlock   = $this->docBlock();

        if (!$reflection || !$docBlock) {
            return $this->throws = $throws;
        }

        foreach ($docBlock->getTagsByName('throws') as $doc) {
            $throws[] = [
                'description' => $doc->getDescription(),
                'type'        => ltrim($doc->getType(), '\\'),
            ];
        }

        return $this->throws = $throws;
    }
}
