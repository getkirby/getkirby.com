<?php

namespace Kirby\Reference\Reflectable;

use Kirby\Toolkit\A;
use PHPStan\PhpDocParser\Ast\Node;
use PHPStan\PhpDocParser\Ast\PhpDoc\ParamTagValueNode;
use PHPStan\PhpDocParser\Ast\PhpDoc\PhpDocNode;
use PHPStan\PhpDocParser\Ast\PhpDoc\PhpDocTagNode;
use PHPStan\PhpDocParser\Ast\PhpDoc\PhpDocTextNode;
use PHPStan\PhpDocParser\Ast\PhpDoc\ReturnTagValueNode;
use PHPStan\PhpDocParser\Ast\PhpDoc\TypelessParamTagValueNode;
use PHPStan\PhpDocParser\Ast\Type\IdentifierTypeNode;
use PHPStan\PhpDocParser\Ast\Type\TypeNode;
use PHPStan\PhpDocParser\Lexer\Lexer;
use PHPStan\PhpDocParser\Parser\ConstExprParser;
use PHPStan\PhpDocParser\Parser\PhpDocParser;
use PHPStan\PhpDocParser\Parser\TokenIterator;
use PHPStan\PhpDocParser\Parser\TypeParser;
use PHPStan\PhpDocParser\ParserConfig;
use Reflector;
use Throwable;

/**
 * Extended PHPStan `PhpDocNode` class with some helper methods
 */
class Doc extends PhpDocNode
{
	/**
	 * Parsed doc blocks, keyed by their source
	 */
	protected static array $cache = [];

	public static function factory(Reflector $reflection): static
	{
		$docblock = $reflection->getDocComment() ?: '';
		return static::$cache[$docblock] ??= static::parse($docblock);
	}

	public function getParamNode(
		string $name
	): ParamTagValueNode|TypelessParamTagValueNode|null {
		// PHPStan uses names with a $ prefix
		// while reflection gives us the name without it
		$name   = '$' . strtolower($name);
		$params = [
			...$this->getParamTagValues(),
			...$this->getTypelessParamTagValues()
		];

		return A::find(
			$params,
			fn ($param) => strtolower($param->parameterName) === $name
		);
	}

	public function getReturnNode(): ReturnTagValueNode|null
	{
		$tags = $this->getReturnTagValues();

		if (count($tags) === 0) {
			return null;
		}

		return $tags[array_key_first($tags)];
	}

	public function getTagByName(string $name): PhpDocTagNode|null
	{
		$tags = $this->getTagsByName($name);

		if (count($tags) === 0) {
			return null;
		}

		return $tags[array_key_first($tags)];
	}

	public function getTemplates(): array
	{
		return $this->getTemplateTagValues();
	}

	public function getTextNodes(): array
	{
		return array_filter(
			$this->children,
			fn (Node $node) => $node instanceof PhpDocTextNode
		);
	}

	protected static function parse(string $docblock): static
	{
		try {
			[$lexer, $parser] = static::parsers();
			$tokens = new TokenIterator($lexer->tokenize($docblock));
			return new static($parser->parse($tokens)->children);
		} catch (Throwable) {
			return new static([]);
		}
	}

	/**
	 * Returns the lexer, doc block parser and type parser,
	 * created once as they are stateless
	 *
	 * @return array{Lexer, PhpDocParser, TypeParser}
	 */
	protected static function parsers(): array
	{
		static $parsers;

		if ($parsers === null) {
			$config    = new ParserConfig(usedAttributes: []);
			$constExpr = new ConstExprParser($config);
			$type      = new TypeParser($config, $constExpr);
			$parsers   = [
				new Lexer($config),
				new PhpDocParser($config, $type, $constExpr),
				$type
			];
		}

		return $parsers;
	}

	/**
	 * Parses a type string, e.g. `array<string, Page>`;
	 * falls back to an identifier if it isn't a valid type
	 */
	public static function parseType(string $type): TypeNode
	{
		try {
			[$lexer, , $parser] = static::parsers();
			$tokens = new TokenIterator($lexer->tokenize($type));
			$node   = $parser->parse($tokens);

			if ($tokens->currentTokenType() === Lexer::TOKEN_END) {
				return $node;
			}
		} catch (Throwable) {
		}

		return new IdentifierTypeNode($type);
	}
}
