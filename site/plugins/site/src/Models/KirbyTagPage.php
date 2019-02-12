<?php

namespace Kirby\Site\Models;

use Kirby\Cms\Field;
use Kirby\Text\KirbyTag;
use ReflectionFunction;

class KirbyTagPage extends HelperPage
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
        return option('github') . '/kirby/tree/master/config/tags.php#L' . $this->line();
    }

    public function line()
    {
        if ($reflection = $this->reflection()) {
            return $reflection->getStartLine();
        }

        return null;
    }

    public function methodCall(): string
    {
        return parent::methodCall();
    }

    public function methodExists(): bool
    {
        return isset(KirbyTag::$types[$this->methodName()]);
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
