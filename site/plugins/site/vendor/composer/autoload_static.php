<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit7735eedf59144eaf4d78690a66d8bbdf
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'PHPStan\\PhpDocParser\\' => 21,
        ),
        'K' => 
        array (
            'Kirby\\' => 6,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'PHPStan\\PhpDocParser\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpstan/phpdoc-parser/src',
        ),
        'Kirby\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $prefixesPsr0 = array (
        'C' => 
        array (
            'Caxy\\HtmlDiff' => 
            array (
                0 => __DIR__ . '/..' . '/caxy/php-htmldiff/lib',
            ),
        ),
    );

    public static $classMap = array (
        'Caxy\\HtmlDiff\\AbstractDiff' => __DIR__ . '/..' . '/caxy/php-htmldiff/lib/Caxy/HtmlDiff/AbstractDiff.php',
        'Caxy\\HtmlDiff\\DiffCache' => __DIR__ . '/..' . '/caxy/php-htmldiff/lib/Caxy/HtmlDiff/DiffCache.php',
        'Caxy\\HtmlDiff\\HtmlDiff' => __DIR__ . '/..' . '/caxy/php-htmldiff/lib/Caxy/HtmlDiff/HtmlDiff.php',
        'Caxy\\HtmlDiff\\HtmlDiffConfig' => __DIR__ . '/..' . '/caxy/php-htmldiff/lib/Caxy/HtmlDiff/HtmlDiffConfig.php',
        'Caxy\\HtmlDiff\\LcsService' => __DIR__ . '/..' . '/caxy/php-htmldiff/lib/Caxy/HtmlDiff/LcsService.php',
        'Caxy\\HtmlDiff\\ListDiffLines' => __DIR__ . '/..' . '/caxy/php-htmldiff/lib/Caxy/HtmlDiff/ListDiffLines.php',
        'Caxy\\HtmlDiff\\MatchingBlock' => __DIR__ . '/..' . '/caxy/php-htmldiff/lib/Caxy/HtmlDiff/MatchingBlock.php',
        'Caxy\\HtmlDiff\\Operation' => __DIR__ . '/..' . '/caxy/php-htmldiff/lib/Caxy/HtmlDiff/Operation.php',
        'Caxy\\HtmlDiff\\Preprocessor' => __DIR__ . '/..' . '/caxy/php-htmldiff/lib/Caxy/HtmlDiff/Preprocessor.php',
        'Caxy\\HtmlDiff\\Strategy\\EqualMatchStrategy' => __DIR__ . '/..' . '/caxy/php-htmldiff/lib/Caxy/HtmlDiff/Strategy/EqualMatchStrategy.php',
        'Caxy\\HtmlDiff\\Strategy\\ListItemMatchStrategy' => __DIR__ . '/..' . '/caxy/php-htmldiff/lib/Caxy/HtmlDiff/Strategy/ListItemMatchStrategy.php',
        'Caxy\\HtmlDiff\\Strategy\\MatchStrategyInterface' => __DIR__ . '/..' . '/caxy/php-htmldiff/lib/Caxy/HtmlDiff/Strategy/MatchStrategyInterface.php',
        'Caxy\\HtmlDiff\\Table\\AbstractTableElement' => __DIR__ . '/..' . '/caxy/php-htmldiff/lib/Caxy/HtmlDiff/Table/AbstractTableElement.php',
        'Caxy\\HtmlDiff\\Table\\DiffRowPosition' => __DIR__ . '/..' . '/caxy/php-htmldiff/lib/Caxy/HtmlDiff/Table/DiffRowPosition.php',
        'Caxy\\HtmlDiff\\Table\\RowMatch' => __DIR__ . '/..' . '/caxy/php-htmldiff/lib/Caxy/HtmlDiff/Table/RowMatch.php',
        'Caxy\\HtmlDiff\\Table\\Table' => __DIR__ . '/..' . '/caxy/php-htmldiff/lib/Caxy/HtmlDiff/Table/Table.php',
        'Caxy\\HtmlDiff\\Table\\TableCell' => __DIR__ . '/..' . '/caxy/php-htmldiff/lib/Caxy/HtmlDiff/Table/TableCell.php',
        'Caxy\\HtmlDiff\\Table\\TableDiff' => __DIR__ . '/..' . '/caxy/php-htmldiff/lib/Caxy/HtmlDiff/Table/TableDiff.php',
        'Caxy\\HtmlDiff\\Table\\TableMatch' => __DIR__ . '/..' . '/caxy/php-htmldiff/lib/Caxy/HtmlDiff/Table/TableMatch.php',
        'Caxy\\HtmlDiff\\Table\\TablePosition' => __DIR__ . '/..' . '/caxy/php-htmldiff/lib/Caxy/HtmlDiff/Table/TablePosition.php',
        'Caxy\\HtmlDiff\\Table\\TableRow' => __DIR__ . '/..' . '/caxy/php-htmldiff/lib/Caxy/HtmlDiff/Table/TableRow.php',
        'Caxy\\HtmlDiff\\Util\\MbStringUtil' => __DIR__ . '/..' . '/caxy/php-htmldiff/lib/Caxy/HtmlDiff/Util/MbStringUtil.php',
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
        'Kirby\\Icons\\Icon' => __DIR__ . '/../..' . '/src/Icons/Icon.php',
        'Kirby\\Icons\\SimpleXmlElement' => __DIR__ . '/../..' . '/src/Icons/SimpleXmlElement.php',
        'Kirby\\Marsdown\\FileSystem' => __DIR__ . '/../..' . '/src/Marsdown/FileSystem.php',
        'Kirby\\Marsdown\\Marsdown' => __DIR__ . '/../..' . '/src/Marsdown/Marsdown.php',
        'Kirby\\Reference\\Reflectable\\Doc' => __DIR__ . '/../..' . '/src/Reference/Reflectable/Doc.php',
        'Kirby\\Reference\\Reflectable\\Reflectable' => __DIR__ . '/../..' . '/src/Reference/Reflectable/Reflectable.php',
        'Kirby\\Reference\\Reflectable\\ReflectableClass' => __DIR__ . '/../..' . '/src/Reference/Reflectable/ReflectableClass.php',
        'Kirby\\Reference\\Reflectable\\ReflectableClassMethod' => __DIR__ . '/../..' . '/src/Reference/Reflectable/ReflectableClassMethod.php',
        'Kirby\\Reference\\Reflectable\\ReflectableCoreComponent' => __DIR__ . '/../..' . '/src/Reference/Reflectable/ReflectableCoreComponent.php',
        'Kirby\\Reference\\Reflectable\\ReflectableFieldMethod' => __DIR__ . '/../..' . '/src/Reference/Reflectable/ReflectableFieldMethod.php',
        'Kirby\\Reference\\Reflectable\\ReflectableFunction' => __DIR__ . '/../..' . '/src/Reference/Reflectable/ReflectableFunction.php',
        'Kirby\\Reference\\Reflectable\\ReflectableHelperFunction' => __DIR__ . '/../..' . '/src/Reference/Reflectable/ReflectableHelperFunction.php',
        'Kirby\\Reference\\Reflectable\\ReflectableKirbytag' => __DIR__ . '/../..' . '/src/Reference/Reflectable/ReflectableKirbytag.php',
        'Kirby\\Reference\\Reflectable\\ReflectableOptions' => __DIR__ . '/../..' . '/src/Reference/Reflectable/ReflectableOptions.php',
        'Kirby\\Reference\\Reflectable\\ReflectableValidator' => __DIR__ . '/../..' . '/src/Reference/Reflectable/ReflectableValidator.php',
        'Kirby\\Reference\\Reflectable\\Tags\\Deprecated' => __DIR__ . '/../..' . '/src/Reference/Reflectable/Tags/Deprecated.php',
        'Kirby\\Reference\\Reflectable\\Tags\\Exception' => __DIR__ . '/../..' . '/src/Reference/Reflectable/Tags/Exception.php',
        'Kirby\\Reference\\Reflectable\\Tags\\Parameter' => __DIR__ . '/../..' . '/src/Reference/Reflectable/Tags/Parameter.php',
        'Kirby\\Reference\\Reflectable\\Tags\\Parameters' => __DIR__ . '/../..' . '/src/Reference/Reflectable/Tags/Parameters.php',
        'Kirby\\Reference\\Reflectable\\Tags\\Returns' => __DIR__ . '/../..' . '/src/Reference/Reflectable/Tags/Returns.php',
        'Kirby\\Reference\\Reflectable\\Tags\\Since' => __DIR__ . '/../..' . '/src/Reference/Reflectable/Tags/Since.php',
        'Kirby\\Reference\\Reflectable\\Tags\\Throws' => __DIR__ . '/../..' . '/src/Reference/Reflectable/Tags/Throws.php',
        'Kirby\\Reference\\Types\\Context' => __DIR__ . '/../..' . '/src/Reference/Types/Context.php',
        'Kirby\\Reference\\Types\\Identifier' => __DIR__ . '/../..' . '/src/Reference/Types/Identifier.php',
        'Kirby\\Reference\\Types\\Type' => __DIR__ . '/../..' . '/src/Reference/Types/Type.php',
        'Kirby\\Reference\\Types\\Types' => __DIR__ . '/../..' . '/src/Reference/Types/Types.php',
        'PHPStan\\PhpDocParser\\Ast\\AbstractNodeVisitor' => __DIR__ . '/..' . '/phpstan/phpdoc-parser/src/Ast/AbstractNodeVisitor.php',
        'PHPStan\\PhpDocParser\\Ast\\Attribute' => __DIR__ . '/..' . '/phpstan/phpdoc-parser/src/Ast/Attribute.php',
        'PHPStan\\PhpDocParser\\Ast\\Comment' => __DIR__ . '/..' . '/phpstan/phpdoc-parser/src/Ast/Comment.php',
        'PHPStan\\PhpDocParser\\Ast\\ConstExpr\\ConstExprArrayItemNode' => __DIR__ . '/..' . '/phpstan/phpdoc-parser/src/Ast/ConstExpr/ConstExprArrayItemNode.php',
        'PHPStan\\PhpDocParser\\Ast\\ConstExpr\\ConstExprArrayNode' => __DIR__ . '/..' . '/phpstan/phpdoc-parser/src/Ast/ConstExpr/ConstExprArrayNode.php',
        'PHPStan\\PhpDocParser\\Ast\\ConstExpr\\ConstExprFalseNode' => __DIR__ . '/..' . '/phpstan/phpdoc-parser/src/Ast/ConstExpr/ConstExprFalseNode.php',
        'PHPStan\\PhpDocParser\\Ast\\ConstExpr\\ConstExprFloatNode' => __DIR__ . '/..' . '/phpstan/phpdoc-parser/src/Ast/ConstExpr/ConstExprFloatNode.php',
        'PHPStan\\PhpDocParser\\Ast\\ConstExpr\\ConstExprIntegerNode' => __DIR__ . '/..' . '/phpstan/phpdoc-parser/src/Ast/ConstExpr/ConstExprIntegerNode.php',
        'PHPStan\\PhpDocParser\\Ast\\ConstExpr\\ConstExprNode' => __DIR__ . '/..' . '/phpstan/phpdoc-parser/src/Ast/ConstExpr/ConstExprNode.php',
        'PHPStan\\PhpDocParser\\Ast\\ConstExpr\\ConstExprNullNode' => __DIR__ . '/..' . '/phpstan/phpdoc-parser/src/Ast/ConstExpr/ConstExprNullNode.php',
        'PHPStan\\PhpDocParser\\Ast\\ConstExpr\\ConstExprStringNode' => __DIR__ . '/..' . '/phpstan/phpdoc-parser/src/Ast/ConstExpr/ConstExprStringNode.php',
        'PHPStan\\PhpDocParser\\Ast\\ConstExpr\\ConstExprTrueNode' => __DIR__ . '/..' . '/phpstan/phpdoc-parser/src/Ast/ConstExpr/ConstExprTrueNode.php',
        'PHPStan\\PhpDocParser\\Ast\\ConstExpr\\ConstFetchNode' => __DIR__ . '/..' . '/phpstan/phpdoc-parser/src/Ast/ConstExpr/ConstFetchNode.php',
        'PHPStan\\PhpDocParser\\Ast\\ConstExpr\\DoctrineConstExprStringNode' => __DIR__ . '/..' . '/phpstan/phpdoc-parser/src/Ast/ConstExpr/DoctrineConstExprStringNode.php',
        'PHPStan\\PhpDocParser\\Ast\\Node' => __DIR__ . '/..' . '/phpstan/phpdoc-parser/src/Ast/Node.php',
        'PHPStan\\PhpDocParser\\Ast\\NodeAttributes' => __DIR__ . '/..' . '/phpstan/phpdoc-parser/src/Ast/NodeAttributes.php',
        'PHPStan\\PhpDocParser\\Ast\\NodeTraverser' => __DIR__ . '/..' . '/phpstan/phpdoc-parser/src/Ast/NodeTraverser.php',
        'PHPStan\\PhpDocParser\\Ast\\NodeVisitor' => __DIR__ . '/..' . '/phpstan/phpdoc-parser/src/Ast/NodeVisitor.php',
        'PHPStan\\PhpDocParser\\Ast\\NodeVisitor\\CloningVisitor' => __DIR__ . '/..' . '/phpstan/phpdoc-parser/src/Ast/NodeVisitor/CloningVisitor.php',
        'PHPStan\\PhpDocParser\\Ast\\PhpDoc\\AssertTagMethodValueNode' => __DIR__ . '/..' . '/phpstan/phpdoc-parser/src/Ast/PhpDoc/AssertTagMethodValueNode.php',
        'PHPStan\\PhpDocParser\\Ast\\PhpDoc\\AssertTagPropertyValueNode' => __DIR__ . '/..' . '/phpstan/phpdoc-parser/src/Ast/PhpDoc/AssertTagPropertyValueNode.php',
        'PHPStan\\PhpDocParser\\Ast\\PhpDoc\\AssertTagValueNode' => __DIR__ . '/..' . '/phpstan/phpdoc-parser/src/Ast/PhpDoc/AssertTagValueNode.php',
        'PHPStan\\PhpDocParser\\Ast\\PhpDoc\\DeprecatedTagValueNode' => __DIR__ . '/..' . '/phpstan/phpdoc-parser/src/Ast/PhpDoc/DeprecatedTagValueNode.php',
        'PHPStan\\PhpDocParser\\Ast\\PhpDoc\\Doctrine\\DoctrineAnnotation' => __DIR__ . '/..' . '/phpstan/phpdoc-parser/src/Ast/PhpDoc/Doctrine/DoctrineAnnotation.php',
        'PHPStan\\PhpDocParser\\Ast\\PhpDoc\\Doctrine\\DoctrineArgument' => __DIR__ . '/..' . '/phpstan/phpdoc-parser/src/Ast/PhpDoc/Doctrine/DoctrineArgument.php',
        'PHPStan\\PhpDocParser\\Ast\\PhpDoc\\Doctrine\\DoctrineArray' => __DIR__ . '/..' . '/phpstan/phpdoc-parser/src/Ast/PhpDoc/Doctrine/DoctrineArray.php',
        'PHPStan\\PhpDocParser\\Ast\\PhpDoc\\Doctrine\\DoctrineArrayItem' => __DIR__ . '/..' . '/phpstan/phpdoc-parser/src/Ast/PhpDoc/Doctrine/DoctrineArrayItem.php',
        'PHPStan\\PhpDocParser\\Ast\\PhpDoc\\Doctrine\\DoctrineTagValueNode' => __DIR__ . '/..' . '/phpstan/phpdoc-parser/src/Ast/PhpDoc/Doctrine/DoctrineTagValueNode.php',
        'PHPStan\\PhpDocParser\\Ast\\PhpDoc\\ExtendsTagValueNode' => __DIR__ . '/..' . '/phpstan/phpdoc-parser/src/Ast/PhpDoc/ExtendsTagValueNode.php',
        'PHPStan\\PhpDocParser\\Ast\\PhpDoc\\GenericTagValueNode' => __DIR__ . '/..' . '/phpstan/phpdoc-parser/src/Ast/PhpDoc/GenericTagValueNode.php',
        'PHPStan\\PhpDocParser\\Ast\\PhpDoc\\ImplementsTagValueNode' => __DIR__ . '/..' . '/phpstan/phpdoc-parser/src/Ast/PhpDoc/ImplementsTagValueNode.php',
        'PHPStan\\PhpDocParser\\Ast\\PhpDoc\\InvalidTagValueNode' => __DIR__ . '/..' . '/phpstan/phpdoc-parser/src/Ast/PhpDoc/InvalidTagValueNode.php',
        'PHPStan\\PhpDocParser\\Ast\\PhpDoc\\MethodTagValueNode' => __DIR__ . '/..' . '/phpstan/phpdoc-parser/src/Ast/PhpDoc/MethodTagValueNode.php',
        'PHPStan\\PhpDocParser\\Ast\\PhpDoc\\MethodTagValueParameterNode' => __DIR__ . '/..' . '/phpstan/phpdoc-parser/src/Ast/PhpDoc/MethodTagValueParameterNode.php',
        'PHPStan\\PhpDocParser\\Ast\\PhpDoc\\MixinTagValueNode' => __DIR__ . '/..' . '/phpstan/phpdoc-parser/src/Ast/PhpDoc/MixinTagValueNode.php',
        'PHPStan\\PhpDocParser\\Ast\\PhpDoc\\ParamClosureThisTagValueNode' => __DIR__ . '/..' . '/phpstan/phpdoc-parser/src/Ast/PhpDoc/ParamClosureThisTagValueNode.php',
        'PHPStan\\PhpDocParser\\Ast\\PhpDoc\\ParamImmediatelyInvokedCallableTagValueNode' => __DIR__ . '/..' . '/phpstan/phpdoc-parser/src/Ast/PhpDoc/ParamImmediatelyInvokedCallableTagValueNode.php',
        'PHPStan\\PhpDocParser\\Ast\\PhpDoc\\ParamLaterInvokedCallableTagValueNode' => __DIR__ . '/..' . '/phpstan/phpdoc-parser/src/Ast/PhpDoc/ParamLaterInvokedCallableTagValueNode.php',
        'PHPStan\\PhpDocParser\\Ast\\PhpDoc\\ParamOutTagValueNode' => __DIR__ . '/..' . '/phpstan/phpdoc-parser/src/Ast/PhpDoc/ParamOutTagValueNode.php',
        'PHPStan\\PhpDocParser\\Ast\\PhpDoc\\ParamTagValueNode' => __DIR__ . '/..' . '/phpstan/phpdoc-parser/src/Ast/PhpDoc/ParamTagValueNode.php',
        'PHPStan\\PhpDocParser\\Ast\\PhpDoc\\PhpDocChildNode' => __DIR__ . '/..' . '/phpstan/phpdoc-parser/src/Ast/PhpDoc/PhpDocChildNode.php',
        'PHPStan\\PhpDocParser\\Ast\\PhpDoc\\PhpDocNode' => __DIR__ . '/..' . '/phpstan/phpdoc-parser/src/Ast/PhpDoc/PhpDocNode.php',
        'PHPStan\\PhpDocParser\\Ast\\PhpDoc\\PhpDocTagNode' => __DIR__ . '/..' . '/phpstan/phpdoc-parser/src/Ast/PhpDoc/PhpDocTagNode.php',
        'PHPStan\\PhpDocParser\\Ast\\PhpDoc\\PhpDocTagValueNode' => __DIR__ . '/..' . '/phpstan/phpdoc-parser/src/Ast/PhpDoc/PhpDocTagValueNode.php',
        'PHPStan\\PhpDocParser\\Ast\\PhpDoc\\PhpDocTextNode' => __DIR__ . '/..' . '/phpstan/phpdoc-parser/src/Ast/PhpDoc/PhpDocTextNode.php',
        'PHPStan\\PhpDocParser\\Ast\\PhpDoc\\PropertyTagValueNode' => __DIR__ . '/..' . '/phpstan/phpdoc-parser/src/Ast/PhpDoc/PropertyTagValueNode.php',
        'PHPStan\\PhpDocParser\\Ast\\PhpDoc\\PureUnlessCallableIsImpureTagValueNode' => __DIR__ . '/..' . '/phpstan/phpdoc-parser/src/Ast/PhpDoc/PureUnlessCallableIsImpureTagValueNode.php',
        'PHPStan\\PhpDocParser\\Ast\\PhpDoc\\RequireExtendsTagValueNode' => __DIR__ . '/..' . '/phpstan/phpdoc-parser/src/Ast/PhpDoc/RequireExtendsTagValueNode.php',
        'PHPStan\\PhpDocParser\\Ast\\PhpDoc\\RequireImplementsTagValueNode' => __DIR__ . '/..' . '/phpstan/phpdoc-parser/src/Ast/PhpDoc/RequireImplementsTagValueNode.php',
        'PHPStan\\PhpDocParser\\Ast\\PhpDoc\\ReturnTagValueNode' => __DIR__ . '/..' . '/phpstan/phpdoc-parser/src/Ast/PhpDoc/ReturnTagValueNode.php',
        'PHPStan\\PhpDocParser\\Ast\\PhpDoc\\SelfOutTagValueNode' => __DIR__ . '/..' . '/phpstan/phpdoc-parser/src/Ast/PhpDoc/SelfOutTagValueNode.php',
        'PHPStan\\PhpDocParser\\Ast\\PhpDoc\\TemplateTagValueNode' => __DIR__ . '/..' . '/phpstan/phpdoc-parser/src/Ast/PhpDoc/TemplateTagValueNode.php',
        'PHPStan\\PhpDocParser\\Ast\\PhpDoc\\ThrowsTagValueNode' => __DIR__ . '/..' . '/phpstan/phpdoc-parser/src/Ast/PhpDoc/ThrowsTagValueNode.php',
        'PHPStan\\PhpDocParser\\Ast\\PhpDoc\\TypeAliasImportTagValueNode' => __DIR__ . '/..' . '/phpstan/phpdoc-parser/src/Ast/PhpDoc/TypeAliasImportTagValueNode.php',
        'PHPStan\\PhpDocParser\\Ast\\PhpDoc\\TypeAliasTagValueNode' => __DIR__ . '/..' . '/phpstan/phpdoc-parser/src/Ast/PhpDoc/TypeAliasTagValueNode.php',
        'PHPStan\\PhpDocParser\\Ast\\PhpDoc\\TypelessParamTagValueNode' => __DIR__ . '/..' . '/phpstan/phpdoc-parser/src/Ast/PhpDoc/TypelessParamTagValueNode.php',
        'PHPStan\\PhpDocParser\\Ast\\PhpDoc\\UsesTagValueNode' => __DIR__ . '/..' . '/phpstan/phpdoc-parser/src/Ast/PhpDoc/UsesTagValueNode.php',
        'PHPStan\\PhpDocParser\\Ast\\PhpDoc\\VarTagValueNode' => __DIR__ . '/..' . '/phpstan/phpdoc-parser/src/Ast/PhpDoc/VarTagValueNode.php',
        'PHPStan\\PhpDocParser\\Ast\\Type\\ArrayShapeItemNode' => __DIR__ . '/..' . '/phpstan/phpdoc-parser/src/Ast/Type/ArrayShapeItemNode.php',
        'PHPStan\\PhpDocParser\\Ast\\Type\\ArrayShapeNode' => __DIR__ . '/..' . '/phpstan/phpdoc-parser/src/Ast/Type/ArrayShapeNode.php',
        'PHPStan\\PhpDocParser\\Ast\\Type\\ArrayShapeUnsealedTypeNode' => __DIR__ . '/..' . '/phpstan/phpdoc-parser/src/Ast/Type/ArrayShapeUnsealedTypeNode.php',
        'PHPStan\\PhpDocParser\\Ast\\Type\\ArrayTypeNode' => __DIR__ . '/..' . '/phpstan/phpdoc-parser/src/Ast/Type/ArrayTypeNode.php',
        'PHPStan\\PhpDocParser\\Ast\\Type\\CallableTypeNode' => __DIR__ . '/..' . '/phpstan/phpdoc-parser/src/Ast/Type/CallableTypeNode.php',
        'PHPStan\\PhpDocParser\\Ast\\Type\\CallableTypeParameterNode' => __DIR__ . '/..' . '/phpstan/phpdoc-parser/src/Ast/Type/CallableTypeParameterNode.php',
        'PHPStan\\PhpDocParser\\Ast\\Type\\ConditionalTypeForParameterNode' => __DIR__ . '/..' . '/phpstan/phpdoc-parser/src/Ast/Type/ConditionalTypeForParameterNode.php',
        'PHPStan\\PhpDocParser\\Ast\\Type\\ConditionalTypeNode' => __DIR__ . '/..' . '/phpstan/phpdoc-parser/src/Ast/Type/ConditionalTypeNode.php',
        'PHPStan\\PhpDocParser\\Ast\\Type\\ConstTypeNode' => __DIR__ . '/..' . '/phpstan/phpdoc-parser/src/Ast/Type/ConstTypeNode.php',
        'PHPStan\\PhpDocParser\\Ast\\Type\\GenericTypeNode' => __DIR__ . '/..' . '/phpstan/phpdoc-parser/src/Ast/Type/GenericTypeNode.php',
        'PHPStan\\PhpDocParser\\Ast\\Type\\IdentifierTypeNode' => __DIR__ . '/..' . '/phpstan/phpdoc-parser/src/Ast/Type/IdentifierTypeNode.php',
        'PHPStan\\PhpDocParser\\Ast\\Type\\IntersectionTypeNode' => __DIR__ . '/..' . '/phpstan/phpdoc-parser/src/Ast/Type/IntersectionTypeNode.php',
        'PHPStan\\PhpDocParser\\Ast\\Type\\InvalidTypeNode' => __DIR__ . '/..' . '/phpstan/phpdoc-parser/src/Ast/Type/InvalidTypeNode.php',
        'PHPStan\\PhpDocParser\\Ast\\Type\\NullableTypeNode' => __DIR__ . '/..' . '/phpstan/phpdoc-parser/src/Ast/Type/NullableTypeNode.php',
        'PHPStan\\PhpDocParser\\Ast\\Type\\ObjectShapeItemNode' => __DIR__ . '/..' . '/phpstan/phpdoc-parser/src/Ast/Type/ObjectShapeItemNode.php',
        'PHPStan\\PhpDocParser\\Ast\\Type\\ObjectShapeNode' => __DIR__ . '/..' . '/phpstan/phpdoc-parser/src/Ast/Type/ObjectShapeNode.php',
        'PHPStan\\PhpDocParser\\Ast\\Type\\OffsetAccessTypeNode' => __DIR__ . '/..' . '/phpstan/phpdoc-parser/src/Ast/Type/OffsetAccessTypeNode.php',
        'PHPStan\\PhpDocParser\\Ast\\Type\\ThisTypeNode' => __DIR__ . '/..' . '/phpstan/phpdoc-parser/src/Ast/Type/ThisTypeNode.php',
        'PHPStan\\PhpDocParser\\Ast\\Type\\TypeNode' => __DIR__ . '/..' . '/phpstan/phpdoc-parser/src/Ast/Type/TypeNode.php',
        'PHPStan\\PhpDocParser\\Ast\\Type\\UnionTypeNode' => __DIR__ . '/..' . '/phpstan/phpdoc-parser/src/Ast/Type/UnionTypeNode.php',
        'PHPStan\\PhpDocParser\\Lexer\\Lexer' => __DIR__ . '/..' . '/phpstan/phpdoc-parser/src/Lexer/Lexer.php',
        'PHPStan\\PhpDocParser\\ParserConfig' => __DIR__ . '/..' . '/phpstan/phpdoc-parser/src/ParserConfig.php',
        'PHPStan\\PhpDocParser\\Parser\\ConstExprParser' => __DIR__ . '/..' . '/phpstan/phpdoc-parser/src/Parser/ConstExprParser.php',
        'PHPStan\\PhpDocParser\\Parser\\ParserException' => __DIR__ . '/..' . '/phpstan/phpdoc-parser/src/Parser/ParserException.php',
        'PHPStan\\PhpDocParser\\Parser\\PhpDocParser' => __DIR__ . '/..' . '/phpstan/phpdoc-parser/src/Parser/PhpDocParser.php',
        'PHPStan\\PhpDocParser\\Parser\\StringUnescaper' => __DIR__ . '/..' . '/phpstan/phpdoc-parser/src/Parser/StringUnescaper.php',
        'PHPStan\\PhpDocParser\\Parser\\TokenIterator' => __DIR__ . '/..' . '/phpstan/phpdoc-parser/src/Parser/TokenIterator.php',
        'PHPStan\\PhpDocParser\\Parser\\TypeParser' => __DIR__ . '/..' . '/phpstan/phpdoc-parser/src/Parser/TypeParser.php',
        'PHPStan\\PhpDocParser\\Printer\\DiffElem' => __DIR__ . '/..' . '/phpstan/phpdoc-parser/src/Printer/DiffElem.php',
        'PHPStan\\PhpDocParser\\Printer\\Differ' => __DIR__ . '/..' . '/phpstan/phpdoc-parser/src/Printer/Differ.php',
        'PHPStan\\PhpDocParser\\Printer\\Printer' => __DIR__ . '/..' . '/phpstan/phpdoc-parser/src/Printer/Printer.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit7735eedf59144eaf4d78690a66d8bbdf::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit7735eedf59144eaf4d78690a66d8bbdf::$prefixDirsPsr4;
            $loader->prefixesPsr0 = ComposerStaticInit7735eedf59144eaf4d78690a66d8bbdf::$prefixesPsr0;
            $loader->classMap = ComposerStaticInit7735eedf59144eaf4d78690a66d8bbdf::$classMap;

        }, null, ClassLoader::class);
    }
}
