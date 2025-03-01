<?php

namespace Kirby\Reference\Reflectable;

use Kirby\Toolkit\A;
use PHPStan\PhpDocParser\Ast\Node;
use PHPStan\PhpDocParser\Ast\PhpDoc\ParamTagValueNode;
use PHPStan\PhpDocParser\Ast\PhpDoc\PhpDocNode;
use PHPStan\PhpDocParser\Ast\PhpDoc\PhpDocTagNode;
use PHPStan\PhpDocParser\Ast\PhpDoc\PhpDocTextNode;
use PHPStan\PhpDocParser\Ast\PhpDoc\ReturnTagValueNode;
use PHPStan\PhpDocParser\Ast\Type\GenericTypeNode;
use PHPStan\PhpDocParser\Lexer\Lexer;
use PHPStan\PhpDocParser\Parser\ConstExprParser;
use PHPStan\PhpDocParser\Parser\PhpDocParser;
use PHPStan\PhpDocParser\Parser\TokenIterator;
use PHPStan\PhpDocParser\Parser\TypeParser;
use PHPStan\PhpDocParser\ParserConfig;
use Reflector;
use Throwable;

/**
 * Extended PHPStan PhpDocNode class
 * with some helper methods
 */
class Doc extends PhpDocNode
{
	public function getExtends(): GenericTypeNode|null
	{
		$tags = $this->getExtendsTagValues();

		if (count($tags) === 0) {
			return null;
		}

		return $tags[array_key_first($tags)]->type;
	}

	public function getParamNode(string $name): ParamTagValueNode|null
	{
		// PHPStan uses names with a $ prefix
		// while reflection gives us the name without it
		$name   = '$' . strtolower($name);
		$params = $this->getParamTagValues();

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

	public function getUses(): GenericTypeNode|null
	{
		$tags = $this->getUsesTagValues();

		if (count($tags) === 0) {
			return null;
		}

		return $tags[array_key_first($tags)]->type;
	}

	public static function factory(Reflector $reflection): PhpDocNode
	{
		try {
			$docblock  = $reflection->getDocComment();
			$config    = new ParserConfig(usedAttributes: []);
			$lexer     = new Lexer($config);
			$constExpr = new ConstExprParser($config);
			$type      = new TypeParser($config, $constExpr);
			$phpDoc    = new PhpDocParser($config, $type, $constExpr);
			$tokens    = new TokenIterator($lexer->tokenize($docblock));
			$node      = $phpDoc->parse($tokens);
			return new static($node->children);

		} catch (Throwable) {
			return new static([]);
		}
	}
}
