<?php

namespace Kirby\Site\Models;

use Kirby\Cms\Field;
use Kirby\Cms\Page;
use Kirby\Site\DocBlock;
use ReflectionFunction;
use Throwable;

class HelperPage extends Page
{

    protected $docBlock;
    protected $methodExists;
    protected $parameters;
    protected $reflection;

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

    public function excerpt(): Field
    {

        $excerpt = null;

        if ($docBlock = $this->docBlock()) {
            $excerpt = trim($this->docBlock()->getSummary());
            $excerpt = str_replace(PHP_EOL, ' ', $excerpt);

            if ($excerpt === '/') {
                $excerpt = null;
            }
        }

        if (empty($excerpt) === false) {
            return new Field($this, 'excerpt', $excerpt);
        }

        return $this->content()->get('excerpt');
    }

    public function githubSource()
    {
        return option('github') . '/kirby/tree/master/config/helpers.php#L' . $this->line();
    }

    public function line()
    {
        if ($reflection = $this->reflection()) {
            return $reflection->getStartLine();
        }

        return null;
    }

    public function methodExists(): bool
    {
        return function_exists($this->slug());

    }

    public function methodName(): string
    {
        return preg_replace_callback('!-([a-z])!', function ($matches) {
            return strtoupper($matches[1]);
        }, $this->slug());
    }

    public function methodCall(): string
    {
        if ($reflection = $this->reflection()) {
            $parameters = array_column($this->parameters(), 'export');
            $parameters = empty($parameters) ? '' : implode(', ', $parameters);
            return $this->methodName() . '(' . $parameters . '): ' . $this->returnType();
        }

        return $this->slug();
    }

    public function parameters()
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

            $type     = $parameter->getType() ?? ($doc ? (string)$doc->getType(): null);
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
                'type'        => $type ?? 'mixed',
            ];
        }

        return $this->parameters = $parameters;
    }

    public function reflection()
    {
        if ($this->reflection !== null) {
            return $this->reflection;
        }

        if ($this->methodExists() === true) {
            return $this->reflection = new ReflectionFunction($this->slug());
        }

        return $this->reflection = false;
    }

    public function returnType()
    {
        if ($reflection = $this->reflection()) {
            if ($reflection->hasReturnType() === true) {
                $type = $reflection->getReturnType();

                if ($type->allowsNull() === true) {
                    $type = $type . '|null';
                }

                return $type;
            }

            if ($docBlock = $this->docBlock()) {
                if ($type = $docBlock->getReturnType()) {
                    $type = trim((string)$type->getType());
                    $type = substr($type, 0, 1) === '\\' ? substr($type, 1) : $type;
                    return $type;
                }
            }
        }

        return null;
    }

    public function title(): Field
    {
        return parent::title()->value($this->methodName() . '()');
    }

}
