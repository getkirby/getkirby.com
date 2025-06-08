<?php

namespace Bar;

class Foo {
	public function __construct()
	{
	}

	public function bar()
	{
	}

	public function baz()
	{
	}
}

trait FooTrait {
}

/**
 * This is a class with a doc block
 *
 * ```php
 * new FooWithDocBlock();
 * ```
 *
 * @see Bar\Foo
 * @since 5.0.0
 * @deprecated 6.0.0 Use Bar\Foo instead
 * @internal
 * @throws Exception when foo is not found
 */
class FooWithDocBlock {
}