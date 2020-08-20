<?php

use Kirby\Cms\Field;
use Kirby\Text\KirbyTag;
use Kirby\Reference\ReflectionPage;

class ReferenceKirbytagPage extends ReflectionPage
{

    protected function _reflection()
    {
        return new ReflectionFunction(KirbyTag::$types[$this->name()]['html']);
    }

    public function attributes(): array
    {
        return KirbyTag::$types[$this->name()]['attr'];
    }

    public function exists(): bool
    {
        return isset(KirbyTag::$types[$this->name()]) === true;
    }


    public function line(): int
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

    public function metadata(): array
    {
        return array_merge(parent::metadata(), [
            'ogtitle' => '(' . $this->name() . ': …) KirbyTag',
        ]);
    }

    /**
     * Returns the URL to the source code on GitHub
     *
     * @return \Kirby\Cms\Field
     */
    public function onGithub(string $path = ''): Field
    {
        return parent::onGithub('config/tags.php');
    }

    public function template()
    {
        return $this->kirby()->template('reference.method');
    }

    public function title(): Field
    {
        return new Field($this, 'title', '&#40;' . $this->name() . ': …&#41;');
    }
}
