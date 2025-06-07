<?php

namespace TestTypes;

/**
 * @template TValue
 */
class A {
	/**
	 * @param TValue $a
	 * @return TValue
	 */
	public function foo(int $a)
	{
		return $a;
	}
}

/**
 * @template TValue of string
 * @extends \TestTypes\A<TValue>
 *
 */
class B extends A {
}

/**
 * @extends \TestTypes\B<string>
 * @use \TestTypes\Z<string>
 */
class C extends B {
	use Z;
}

/**
 * @template TTraitValue
 */
trait Z {
	/**
	 * @return TTraitValue
	 */
	public function bar()
	{
		return 'bar';
	}
}