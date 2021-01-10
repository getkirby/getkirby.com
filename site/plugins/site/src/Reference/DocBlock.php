<?php

namespace Kirby\Reference;

use Exception;
use phpDocumentor\Reflection\DocBlockFactory;

class DocBlock
{

    protected $instance;

    public function __construct(string $comment)
    {
        if (empty($comment)) {
            $comment = '/**/';
        }

        $this->instance = DocBlockFactory::createInstance()->create($comment);
    }

    public function getTag(string $name)
    {
        foreach ($this->getTags() as $tag) {
            if (strtolower($tag->getName()) === strtolower($name)) {
                return $tag;
            }
        }
    }

    public function getParameters(): array
    {
        return array_filter($this->getTags(), function ($tag) {
            return $tag->getName() === 'param';
        });
    }

    public function getParameter(string $name)
    {
        foreach ($this->getParameters() as $param) {
            if (strtolower($param->getVariableName()) === strtolower($name)) {
                return $param;
            }
        }
    }

    public function getReturnType()
    {
        return $this->getTag('return');
    }

    public function __call(string $method, array $args = [])
    {
        if (method_exists($this->instance, $method)) {
            return call_user_func_array([$this->instance, $method], $args);
        }

        throw new Exception('Invalid doc block method');
    }

}
