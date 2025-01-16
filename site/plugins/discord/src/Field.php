<?php

namespace Kirby\Discord;

/**
 * Field information for a Discord webhook request
 *
 * @author Kirby Team <mail@getkirby.com>
 * @license MIT
 * @link https://getkirby.com
 */
class Field
{
    public function __construct(
        public string $name,
        public mixed $value,
		public bool $inline = false
    ) {
    }

	public static function from(self|array $field): static|null
	{
		return match (true) {
			is_array($field)
				=> new static(...$field),
			default
				=> $field
		};
	}

    public function toArray(): array
    {
        return [
			'name'   => $this->name,
			'value'  => $this->value,
			'inline' => $this->inline
        ];
    }
}
