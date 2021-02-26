<?php

namespace Kirby\Site\Models;

use Kirby\Cms\App;
use Kirby\Cms\Field;
use Kirby\Text\KirbyTag;
use ReflectionFunction;

class ReferenceKirbyTagPage extends ReferenceHelperPage
{
    public function attributes(): array
    {
        if ($reflection = $this->reflection()) {
            return KirbyTag::$types[$this->methodName()]['attr'];
        }

        return [];
    }

    public function excerpt(): Field
    {
        return $this->content()->get('excerpt');
    }

    public function githubSource()
    {
        return option('github') . '/kirby/tree/' . App::version() . '/config/tags.php#L' . $this->line();
    }

    public function metadata(): array
    {
        return array_merge(parent::metadata(), [
            'ogtitle' => $this->title() . ' KirbyTag',
        ]);
    }

    public function line()
    {
        if ($reflection = $this->reflection()) {
            $line = $reflection->getStartLine();
            $line -= 2;

            $attributes = $this->attributes();
            if (count($attributes) > 0) {
                $line -= count($attributes) + 1;
            }

            return $line;
        }

        return null;
    }

    public function methodExists(): bool
    {
        return isset(KirbyTag::$types[$this->methodName()]) === true;
    }

    public function reflection()
    {
        if ($this->reflection !== null) {
            return $this->reflection;
        }

        if ($this->methodExists() === true) {
            return $this->reflection = new ReflectionFunction(KirbyTag::$types[$this->methodName()]['html']);
        }

        return $this->reflection = false;
    }

    public function title(): Field
    {
        return new Field($this, 'title', '(' . $this->methodName() . ': …)');
    }

}
