<?php

use Kirby\Cms\Field;
use Kirby\Text\KirbyTag;
use Kirby\Reference\ReflectionPage;

class ReferenceKirbytagPage extends ReflectionPage
{

    public function attributes(): array
    {
        return $this->tag()['attr'];
    }

    public function exists(): bool
    {
        return $this->tag() !== null;
    }


    public function line(): int|null
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
        return array_replace_recursive(parent::metadata(), [
            'ogtitle' => $this->title() . ' KirbyTag',
            'thumbnail' => [
                'lead'  => 'Reference / KirbyTag'
            ]
        ]);
    }

    public function onGitHub(string $path = ''): Field
    {
        return parent::onGitHub('config/tags.php');
    }

    protected function tag(): array|null
    {
        return static::tags()[$this->name()] ?? null;
    }

    protected static function tags(): array
    {
        return static::$kirby->core()->kirbyTags();
    }

    public function title(): Field
    {
        return new Field($this, 'title', '&#40;' . $this->name() . ': …&#41;');
    }

    protected function reflection(): ReflectionFunction
    {
        return $this->reflection ??= new ReflectionFunction($this->tag()['html']);
    }
}
