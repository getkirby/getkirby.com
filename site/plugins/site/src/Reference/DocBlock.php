<?php

namespace Kirby\Reference;

use Exception;
use phpDocumentor\Reflection\DocBlock as BaseDocBlock;
use phpDocumentor\Reflection\DocBlockFactory;
use phpDocumentor\Reflection\DocBlock\Tag;

class DocBlock
{
    protected BaseDocBlock $instance;

    public function __construct(string $comment)
    {
        if (empty($comment) === true) {
            $comment = '/**/';
        }

        $this->instance = DocBlockFactory::createInstance()->create($comment);
    }

    public function __call(string $method, array $args = [])
    {
        if (method_exists($this->instance, $method) === true) {
            return $this->instance->$method(...$args);
        }

        throw new Exception('Invalid doc block method: ' . $method);
    }

    public function getTag(string $name): Tag|null
    {
        foreach ($this->getTags() as $tag) {
            if (strtolower($tag->getName()) === strtolower($name)) {
                return $tag;
            }
        }

        return null;
    }

    public function getParameters(): array
    {
        return array_filter(
            $this->getTags(),
            fn ($tag) => $tag->getName() === 'param'
        );
    }

    public function getParameter(string $name): Tag|null
    {
        foreach ($this->getParameters() as $param) {
            if (strtolower($param->getVariableName()) === strtolower($name)) {
                return $param;
            }
        }

        return null;
    }

    public function getReturnType(): Tag|null
    {
        return $this->getTag('return');
    }
}
