<?php

namespace Kirby\Reference;

use Kirby\Cms\App;
use Kirby\Cms\Field;
use Kirby\Cms\Page;

class ReflectionPage extends Page
{
    protected $docBlock;
    protected $parameters;
    protected $reflection;
    protected $throws;

    /**
     * Returns how this would be called in code
     *
     * @return string
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
     *
     * @return \Kirby\Cms\Field
     */
    public function deprecated(): Field
    {
        if ($docBlock = $this->docBlock()) {
            if ($tag = $docBlock->getTag('deprecated')) {
                $value = $tag->getVersion() . '|' . $tag->getDescription();
                return new Field($this, 'deprecated', $value);
            }
        }

        return parent::deprecated();
    }

    /**
     * Gets the DocBlock information
     *
     * @return \Kirby\Reference\DocBlock|bool
     */
    public function docBlock()
    {
        if ($this->docBlock !== null) {
            return $this->docBlock;
        }

        if ($reflection = $this->reflection()) {
            try {
                return $this->docBlock = new DocBlock($reflection->getDocComment());
            } catch (Throwable $e) {
                return $this->docBlock = false;
            }
        }

        return $this->docBlock = false;
    }

    /**
     * Returns a description excerpt
     *
     * @return \Kirby\Cms\Field
     */
    public function excerpt(): Field
    {
        $excerpt = null;

        // prefer excerpt defined in content file
        if ($this->content()->has('excerpt')) {
            return $this->content()->get('excerpt');
        }

        // otherwise try to get summary from DocBlock in code
        if ($docBlock = $this->docBlock()) {
            $excerpt = trim($docBlock->getSummary());
            $excerpt = str_replace(PHP_EOL, ' ', $excerpt);

            if ($excerpt !== '/' && $excerpt !== null) {
                return new Field($this, 'excerpt', $excerpt);
            }
        }

        return new Field($this, 'excerpt', null);
    }

    /**
     * Whether to show 2nd sidebar in Reference to select items
     * and navigate easily between siblings
     *
     * @return bool
     */
    public function hasSelector(): bool
    {
        return true;
    }

    /**
     * Check if this has been deprecated
     *
     * @return boolean
     */
    public function isDeprecated(): bool
    {
        return $this->deprecated()->isNotEmpty() === true;
    }

    /**
     * Check if this is marked as internal
     *
     * @return boolean
     */
    public function isInternal(): bool
    {
        if ($docBlock = $this->docBlock()) {
            return is_null($docBlock->getTag('internal')) === false;
        }

        return false;
    }

    /**
     * Checks if this is a magic method
     *
     * @return boolean
     */
    public function isMagic(): bool
    {
        return substr($this->slug(), 0, 2) === '__';
    }

    /**
     * Checks if this is static
     *
     * @return boolean
     */
    public function isStatic(): bool
    {
        if ($reflection = $this->reflection()) {
            return $reflection->isStatic() === true;
        }

        return false;
    }

    /**
     * Gets the line number where this starts in the code
     *
     * @return int|null
     */
    public function line(): ?int
    {
        if ($reflection = $this->reflection()) {
            return $reflection->getStartLine();
        }

        return null;
    }

    public function metadata(): array
    {
        return [
            'description' => strip_tags($this->excerpt()->kirbytags()),
            'twittercard' => 'summary',
        ];
    }

    /**
     * Get the name of this
     *
     * @return string
     */
    public function name(): string
    {
        return preg_replace_callback('!-([a-z])!', function ($matches) {
            return strtoupper($matches[1]);
        }, $this->slug());
    }

    /**
     * Returns URL to the code on GitHub
     *
     * @return \Kirby\Cms\Field
     */
    public function onGithub(string $path = ''): Field
    {
        $url  = option('github.org') . '/kirby/tree/' . App::version();
        $url .= '/' . $path;
        $url .= '#L' . $this->line();
        return $this->customField()->value($url);
    }

    /**
     * Returns an array with all parameter info
     *
     * @return array
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

            if ($docBlock = $this->docBlock()) {
                $doc = $docBlock->getParameter($parameter->getName());
            } else {
                $doc = null;
            }

            if ($type = $parameter->getType()) {
                $type = $type->getName();
            } elseif ($doc) {
                $type = (string)$doc->getType();
            }

            $name     = $parameter->getName();
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
                'docBlock'    => $doc,
                'default'     => $default,
                'description' => $doc ? $doc->getDescription() : null,
                'export'      => $param,
                'name'        => $name,
                'optional'    => $optional,
                'type'        => types($type ?? 'mixed', $this),
            ];
        }

        return $this->parameters = $parameters;
    }

    /**
     * Creates the reflection object
     */
    public function reflection()
    {
        if ($this->reflection !== null) {
            return $this->reflection;
        }

        if ($this->exists() === true) {
            return $this->reflection = $this->_reflection();
        }
    }

    /**
     * Returns a string of all return types
     *
     * @return string|null
     */
    public function returnType(): ?string
    {
        if ($reflection = $this->reflection()) {
            // First, try to get return type from reflection
            if ($reflection->hasReturnType() === true) {
                $type = $reflection->getReturnType();

                if ($type->allowsNull() === true) {
                    $type = $type . '|null';
                }

                return types($type->getName(), $this);
            }

            // Otherwise, check DocBlock for return type
            if ($docBlock = $this->docBlock()) {
                if ($type = $docBlock->getReturnType()) {
                    $type = trim((string)$type->getType());
                    return types($type, $this);
                }
            }
        }

        return null;
    }

    /**
     * Returns in which version this was introduced
     *
     * @return \Kirby\Cms\Field
     */
    public function since(): Field
    {
        if ($docBlock = $this->docBlock()) {
            if ($tag = $docBlock->getTag('since')) {
                $since = $tag->getVersion();
                return new Field($this, 'since', $since ?? null);
            }
        }

        return parent::since();
    }

    public function template()
    {
        // If template exists, use it
        if ($this->intendedTemplate() === parent::template()) {
            return parent::template();
        }

        return $this->kirby()->template('reference.article');
    }

    /**
     * Returns what exceptions can be thrown by this
     *
     * @return array
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
