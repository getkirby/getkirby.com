# getkirby.com site plugin

The `site` plugin bundles various functionality created for the getkirby.com site.

## Field methods

- `$field->shortUrl()`
- `$field->stripGlossary()`
- `$field->toToc()`

## KirbyTags

## Helper functions

- `ariaCurrent()`
- `csv()`
- `field()`
- `icon()`
- `img()`
- `json()`
- `required()`
- `type()`
- `version()`
- `video()`
- `xml()`

## `Kirby\Icons`

## `Kirby\Marsdown`

Implements a superset to `ParsedownExtra` that adds support for

- Groupings (e.g. columns and tabs)
- Blocks (e.g. info or since)
- Fenced codeblocks incl. for Kirby content files and filesystem figures
- Inline type highlighting (and linking, where available)

## `Kirby\Reference`

Adds classes that take care of our reflection-based automatic Reference docs.

### `Kirby\Reference\Reflectable`

Provides various `Reflectable` classes that are used by their counterpart page models to more easily reflect on different parts of the Kirby core:

- For a field method: `ReflectableFieldMethod`
- For a KirbyTag: `ReflectableKirbytag`
- For a class: `ReflectableClass`
- for a method: `ReflectableClassMethod`
- For a helper function: `ReflectableHelperFunction`
- For a core component: `ReflectableCoreComponent`
- For a validator: `ReflectableValidator`

These all expose various methods to use inside our Reference to provide information about the respective part, e.g. these methods shared by all `Reflectable` classes:

- `$reflectable->summary()`: The short description from a DocBlock
- `$reflectable->examples()`: Code example from a DocBlock
- `$reflectable->isDeprecated()`: Whether the part has been deprecated
- `$reflectable->isInternal()`: Whether the part has been deprecated
- `$reflectable->since()`: The `@since` tag information
- `$reflectable->source()`: URL to the source on GitHub
- `$reflectable->throws()`: The `@throws` tag information

### `Kirby\Reference\Reflectable\Tags`

These classes help to offer some of the information used by the `Reflectable` classes in a more object-oriented manner. Some relate to DocBlock tags (e.g. `Deprecated`, `Throws`, `Since`).

#### `Parameters`

Represents the collection of a function's parameters and their typing. The `::factory()` method does the heavy lifting, merging parameter information from the PHP reflection of the function as well as an optional DocBlock.

The `::toString()` method returns a string representation of all the parameters incl. type hints and default values.

#### `Parameter`

Represents a single parameter of a function incl. its type and optional default value. The `::factory()` method can be called either with a `ReflectionParameter` or a `ParamTagValueNode` object - allowing to create a parameter either from native PHP reflection or a DocBlock tag.

### `Kirby\Reference\Types`

#### `Type`

Represents a simple type. The main methods here are

- `$type->toString()`: Simple string representation of the type
- `$type->toHtml()`: Wrapped in a code tag with the correct CSS type selector
- `Type::factory()`: Takes care of returning a simple `Type` object or an `Identifier` object for classes etc.

#### `Identifier`

An extended version of `Type` that takes care of classes etc. as type.

The `::toHtml()` method in this case can optionally try to add a link to the Reference page for this type. This is also used for the inline code type parsing of our Marsdown component to add links to inline code elements e.g. referencing a class method (linking to the class method's Reference page).

#### `Chain`

An extended version of `Type` that represents a chain call, usually a base class and one or more chained method calls on the base object. 

It takes care of resolving the chained call, providing the link and color etc. for the last item in the chain as well as ensuring the correct notation of the chained call (taking short handles for special classes like `$page` into account.)

#### `Types`

Represent a collection of `Type` objects. This takes care of some heavy-lifting to normalize the reflection information to the way we want to display it in the Reference. Among others to

- Display the full class names instead of `self` or `static`
- Display only unique times, avoiding listing a type multiple times
- Include `|null` as type for nullable types

The most significant methods for usage in templates etc. are `$types->toString()` and `$types->toHtml()`.

The `Types` class also takes care of trying to resolve type templates from DocBlocks to their actual type in the context of the current object (e.g. class, class method) via the `Context` class.

#### `Context`

This class helps to resolve type templates by collecting type template information from the current reflectable object (class or function), its parents and traits as well as native PHP type hints that imply what type a type template could be.

```php
/**
 * @template TValue
 */
abstract class A {
	/**
	 * @return TValue
	 */
	abstract public function foo();
}

/**
 * @extends \A<string>
 */
class B extends A {
}

$reflection = new ReflectionClass(B::class);
$context    = new Context(class: $reflection);

// Investigating `B::foo()` will provide `TValue` as return type.
// We can use the Context class to resolve this to the actual annotated type:

$type = 'TValue';
$type = $context->resolve($type);
```
