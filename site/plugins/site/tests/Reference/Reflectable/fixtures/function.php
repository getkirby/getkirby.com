<?php

function foo(string $bar = 'baz', int|null $optional = null): string {
	return $bar;
}

function fooWithoutReturnType() {
	return 'foo';
}

function fooWithVoidReturnType(): void {
}

/**
 * This is a function with a doc block
 *
 * ```php
 * fooWithDocBlock();
 * ```
 *
 * @see foo
 * @since 5.0.0
 * @deprecated 6.0.0 Use foo() instead
 * @internal
 * @throws Exception when foo is not found
 */
function fooWithDocBlock(): string {
	return 'foo';
}
