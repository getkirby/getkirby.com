<?php

declare(strict_types=1);

namespace Doctrine\DBAL\Schema;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Schema\Exception\InvalidState;
use Doctrine\DBAL\Schema\ForeignKeyConstraint\Deferrability;
use Doctrine\DBAL\Schema\ForeignKeyConstraint\MatchType;
use Doctrine\DBAL\Schema\ForeignKeyConstraint\ReferentialAction;
use Doctrine\DBAL\Schema\Name\OptionallyQualifiedName;
use Doctrine\DBAL\Schema\Name\Parser\UnqualifiedNameParser;
use Doctrine\DBAL\Schema\Name\Parsers;
use Doctrine\DBAL\Schema\Name\UnqualifiedName;
use Doctrine\Deprecations\Deprecation;
use Throwable;
use ValueError;

use function array_keys;
use function array_map;
use function count;
use function strrpos;
use function strtolower;
use function strtoupper;
use function substr;

/**
 * An abstraction class for a foreign key constraint.
 *
 * @extends AbstractOptionallyNamedObject<UnqualifiedName>
 * @final This class will be made final in DBAL 5.0.
 */
class ForeignKeyConstraint extends AbstractOptionallyNamedObject
{
    /**
     * Asset identifier instances of the referencing table column names the foreign key constraint is associated with.
     *
     * @deprecated
     *
     * @var non-empty-array<string, Identifier>
     */
    protected array $_localColumnNames;

    /**
     * Table or asset identifier instance of the referenced table name the foreign key constraint is associated with.
     *
     * @deprecated
     */
    protected Identifier $_foreignTableName;

    /**
     * Asset identifier instances of the referenced table column names the foreign key constraint is associated with.
     *
     * @deprecated
     *
     * @var non-empty-array<string, Identifier>
     */
    protected array $_foreignColumnNames;

    /**
     * Options associated with the foreign key constraint.
     *
     * @deprecated
     *
     * @var array<string, mixed>
     */
    protected array $options;

    /**
     * Referencing table column names the foreign key constraint is associated with.
     *
     * An empty list indicates that an attempt to parse column names failed.
     *
     * @var list<UnqualifiedName>
     */
    private readonly array $referencingColumnNames;

    /**
     * Referenced table name the foreign key constraint is associated with.
     *
     * A null value indicates that an attempt to parse the table name failed.
     */
    private readonly ?OptionallyQualifiedName $referencedTableName;

    /**
     * Referenced table column names the foreign key constraint is associated with.
     *
     * An empty list indicates that an attempt to parse column names failed.
     *
     * @var list<UnqualifiedName>
     */
    private readonly array $referencedColumnNames;

    /**
     * The match type of the foreign key constraint.
     *
     * A null value indicates that an attempt to parse the match type failed.
     */
    private readonly ?MatchType $matchType;

    /**
     * The referential action for <code>UPDATE</code> operations.
     *
     * A null value indicates that an attempt to parse the referential action failed.
     */
    private readonly ?ReferentialAction $onUpdateAction;

    /**
     * The referential action for <code>DELETE</code> operations.
     *
     * A null value indicates that an attempt to parse the referential action failed.
     */
    private readonly ?ReferentialAction $onDeleteAction;

    /**
     * Indicates whether the constraint is or can be deferred.
     *
     * A null value indicates that the combination of the options that defined deferrability was invalid.
     */
    private readonly ?Deferrability $deferrability;

    /**
     * @internal Use {@link ForeignKeyConstraint::editor()} to instantiate an editor and
     *           {@link ForeignKeyConstraintEditor::create()} to create a foreign key constraint.
     *
     * @param non-empty-list<string> $localColumnNames   Names of the referencing table columns.
     * @param string                 $foreignTableName   Referenced table.
     * @param non-empty-list<string> $foreignColumnNames Names of the referenced table columns.
     * @param string                 $name               Name of the foreign key constraint.
     * @param array<string, mixed>   $options            Options associated with the foreign key constraint.
     */
    public function __construct(
        array $localColumnNames,
        string $foreignTableName,
        array $foreignColumnNames,
        string $name = '',
        array $options = [],
    ) {
        $this->options = $options;

        if (count($localColumnNames) < 1) {
            Deprecation::trigger(
                'doctrine/dbal',
                'https://github.com/doctrine/dbal/pull/6728',
                'Instantiation of a foreign key constraint without local column names is deprecated.',
            );
        }

        if (count($foreignColumnNames) < 1) {
            Deprecation::trigger(
                'doctrine/dbal',
                'https://github.com/doctrine/dbal/pull/6728',
                'Instantiation of a foreign key constraint without foreign column names is deprecated.',
            );
        }

        if (count($foreignColumnNames) !== count($localColumnNames)) {
            Deprecation::trigger(
                'doctrine/dbal',
                'https://github.com/doctrine/dbal/pull/6728',
                'Instantiation of a foreign key constraint with a different number of local and foreign'
                    . ' column names is deprecated.',
            );
        }

        parent::__construct($name);

        $this->_localColumnNames = $this->createIdentifierMap($localColumnNames);
        $this->_foreignTableName = new Identifier($foreignTableName);

        $this->_foreignColumnNames = $this->createIdentifierMap($foreignColumnNames);

        $this->referencingColumnNames = $this->parseColumnNames($localColumnNames);
        $this->referencedTableName    = $this->parseReferencedTableName($foreignTableName);
        $this->referencedColumnNames  = $this->parseColumnNames($foreignColumnNames);

        $this->matchType      = $this->parseMatchType($options);
        $this->onUpdateAction = $this->parseReferentialAction($options, 'onUpdate');
        $this->onDeleteAction = $this->parseReferentialAction($options, 'onDelete');

        $this->deferrability = $this->parseDeferrability($options);
    }

    protected function getNameParser(): UnqualifiedNameParser
    {
        return Parsers::getUnqualifiedNameParser();
    }

    /**
     * Returns the names of the referencing table columns the foreign key constraint is associated with.
     *
     * @return non-empty-list<UnqualifiedName>
     */
    public function getReferencingColumnNames(): array
    {
        if (count($this->referencingColumnNames) < 1) {
            throw InvalidState::foreignKeyConstraintHasInvalidReferencingColumnNames($this->getName());
        }

        return $this->referencingColumnNames;
    }

    /**
     * Returns the names of the referenced table columns the foreign key constraint is associated with.
     */
    public function getReferencedTableName(): OptionallyQualifiedName
    {
        if ($this->referencedTableName === null) {
            throw InvalidState::foreignKeyConstraintHasInvalidReferencedTableName($this->getName());
        }

        return $this->referencedTableName;
    }

    /**
     * Returns the names of the referenced table columns the foreign key constraint is associated with.
     *
     * @return non-empty-list<UnqualifiedName>
     */
    public function getReferencedColumnNames(): array
    {
        if (count($this->referencedColumnNames) < 1) {
            throw InvalidState::foreignKeyConstraintHasInvalidReferencedColumnNames($this->getName());
        }

        return $this->referencedColumnNames;
    }

    /**
     * Returns the match type of the foreign key constraint.
     */
    public function getMatchType(): MatchType
    {
        if ($this->matchType === null) {
            throw InvalidState::foreignKeyConstraintHasInvalidMatchType($this->getName());
        }

        return $this->matchType;
    }

    /**
     * Returns the referential action for <code>UPDATE</code> operations.
     */
    public function getOnUpdateAction(): ReferentialAction
    {
        if ($this->onUpdateAction === null) {
            throw InvalidState::foreignKeyConstraintHasInvalidOnUpdateAction($this->getName());
        }

        return $this->onUpdateAction;
    }

    /**
     * Returns the referential action for <code>DELETE</code> operations.
     */
    public function getOnDeleteAction(): ReferentialAction
    {
        if ($this->onDeleteAction === null) {
            throw InvalidState::foreignKeyConstraintHasInvalidOnDeleteAction($this->getName());
        }

        return $this->onDeleteAction;
    }

    /**
     * Returns whether the constraint is or can be deferred.
     */
    public function getDeferrability(): Deferrability
    {
        if ($this->deferrability === null) {
            throw InvalidState::foreignKeyConstraintHasInvalidDeferrability($this->getName());
        }

        return $this->deferrability;
    }

    /**
     * @param non-empty-array<int, string> $names
     *
     * @return non-empty-array<string, Identifier>
     */
    private function createIdentifierMap(array $names): array
    {
        $identifiers = [];

        foreach ($names as $name) {
            $identifiers[$name] = new Identifier($name);
        }

        return $identifiers;
    }

    /**
     * Returns the names of the referencing table columns
     * the foreign key constraint is associated with.
     *
     * @deprecated Use {@see getReferencingColumnNames()} instead.
     *
     * @return non-empty-list<string>
     */
    public function getLocalColumns(): array
    {
        Deprecation::triggerIfCalledFromOutside(
            'doctrine/dbal',
            'https://github.com/doctrine/dbal/pull/6728',
            '%s is deprecated. Use getReferencingColumnNames() instead.',
            __METHOD__,
        );

        return array_keys($this->_localColumnNames);
    }

    /**
     * @deprecated Use {@see getReferencingColumnNames()} and {@see UnqualifiedName::toSQL()} instead.
     *
     * Returns the quoted representation of the referencing table column names
     * the foreign key constraint is associated with.
     *
     * But only if they were defined with one or the referencing table column name
     * is a keyword reserved by the platform.
     * Otherwise the plain unquoted value as inserted is returned.
     *
     * @param AbstractPlatform $platform The platform to use for quotation.
     *
     * @return non-empty-array<int, string>
     */
    public function getQuotedLocalColumns(AbstractPlatform $platform): array
    {
        Deprecation::triggerIfCalledFromOutside(
            'doctrine/dbal',
            'https://github.com/doctrine/dbal/pull/6728',
            '%s is deprecated. Use getReferencingColumnNames() and UnqualifiedName::toSQL() instead.',
            __METHOD__,
        );

        $columns = [];

        foreach ($this->_localColumnNames as $column) {
            $columns[] = $column->getQuotedName($platform);
        }

        return $columns;
    }

    /**
     * @deprecated Use {@see getReferencingColumnNames()} instead.
     *
     * Returns unquoted representation of local table column names for comparison with other FK
     *
     * @return non-empty-array<int, string>
     */
    public function getUnquotedLocalColumns(): array
    {
        Deprecation::triggerIfCalledFromOutside(
            'doctrine/dbal',
            'https://github.com/doctrine/dbal/pull/6728',
            '%s is deprecated. Use getReferencingColumnNames() instead.',
            __METHOD__,
        );

        return array_map($this->trimQuotes(...), $this->getLocalColumns());
    }

    /**
     * @deprecated Use {@see getReferencedColumnNames()} instead.
     *
     * Returns unquoted representation of foreign table column names for comparison with other FK
     *
     * @return non-empty-array<int, string>
     */
    public function getUnquotedForeignColumns(): array
    {
        Deprecation::triggerIfCalledFromOutside(
            'doctrine/dbal',
            'https://github.com/doctrine/dbal/pull/6728',
            '%s is deprecated. Use getReferencedColumnNames() instead.',
            __METHOD__,
        );

        return array_map($this->trimQuotes(...), $this->getForeignColumns());
    }

    /**
     * @deprecated Use {@see getReferencedTableName()} instead.
     *
     * Returns the name of the referenced table
     * the foreign key constraint is associated with.
     */
    public function getForeignTableName(): string
    {
        Deprecation::triggerIfCalledFromOutside(
            'doctrine/dbal',
            'https://github.com/doctrine/dbal/pull/6728',
            '%s is deprecated. Use getReferencedTableName() instead.',
            __METHOD__,
        );

        return $this->_foreignTableName->getName();
    }

    /**
     * @deprecated Use {@see getReferencedTableName()} instead.
     *
     * Returns the non-schema qualified foreign table name.
     */
    public function getUnqualifiedForeignTableName(): string
    {
        Deprecation::triggerIfCalledFromOutside(
            'doctrine/dbal',
            'https://github.com/doctrine/dbal/pull/6728',
            '%s is deprecated. Use getReferencedTableName() instead.',
            __METHOD__,
        );

        $name     = $this->_foreignTableName->getName();
        $position = strrpos($name, '.');

        if ($position !== false) {
            $name = substr($name, $position + 1);
        }

        if ($this->isIdentifierQuoted($name)) {
            $name = $this->trimQuotes($name);
        }

        return strtolower($name);
    }

    /**
     * @deprecated Use {@see getReferencedTableName()} and {@see OptionallyQualifiedName::toSQL()} instead.
     *
     * Returns the quoted representation of the referenced table name
     * the foreign key constraint is associated with.
     *
     * But only if it was defined with one or the referenced table name
     * is a keyword reserved by the platform.
     * Otherwise the plain unquoted value as inserted is returned.
     *
     * @param AbstractPlatform $platform The platform to use for quotation.
     */
    public function getQuotedForeignTableName(AbstractPlatform $platform): string
    {
        Deprecation::triggerIfCalledFromOutside(
            'doctrine/dbal',
            'https://github.com/doctrine/dbal/pull/6728',
            '%s is deprecated. Use getReferencedTableName() and OptionallyQualifiedName::toSQL() instead.',
            __METHOD__,
        );

        return $this->_foreignTableName->getQuotedName($platform);
    }

    /**
     * @deprecated Use {@see getReferencedColumnNames()} instead.
     *
     * Returns the names of the referenced table columns
     * the foreign key constraint is associated with.
     *
     * @return non-empty-array<int, string>
     */
    public function getForeignColumns(): array
    {
        Deprecation::triggerIfCalledFromOutside(
            'doctrine/dbal',
            'https://github.com/doctrine/dbal/pull/6728',
            '%s is deprecated. Use getReferencedColumnNames() instead.',
            __METHOD__,
        );

        return array_keys($this->_foreignColumnNames);
    }

    /**
     * @deprecated Use {@see getReferencedColumnNames()} and {@see UnqualifiedName::toSQL()} instead.
     *
     * Returns the quoted representation of the referenced table column names
     * the foreign key constraint is associated with.
     *
     * But only if they were defined with one or the referenced table column name
     * is a keyword reserved by the platform.
     * Otherwise the plain unquoted value as inserted is returned.
     *
     * @param AbstractPlatform $platform The platform to use for quotation.
     *
     * @return non-empty-array<int, string>
     */
    public function getQuotedForeignColumns(AbstractPlatform $platform): array
    {
        Deprecation::triggerIfCalledFromOutside(
            'doctrine/dbal',
            'https://github.com/doctrine/dbal/pull/6728',
            '%s is deprecated. Use getReferencedColumnNames() and UnqualifiedName::toSQL() instead.',
            __METHOD__,
        );

        $columns = [];

        foreach ($this->_foreignColumnNames as $column) {
            $columns[] = $column->getQuotedName($platform);
        }

        return $columns;
    }

    /**
     * @deprecated Use {@see getMatchType()}, {@see getOnDeleteAction()}, {@see getOnUpdateAction()} or
     *             {@see getDeferrability()} instead.
     *
     * Returns whether or not a given option
     * is associated with the foreign key constraint.
     */
    public function hasOption(string $name): bool
    {
        Deprecation::triggerIfCalledFromOutside(
            'doctrine/dbal',
            'https://github.com/doctrine/dbal/pull/6728',
            '%s is deprecated. Use getMatchType(), getOnDeleteAction(), getOnUpdateAction() or'
                . ' getDeferrability() instead.',
            __METHOD__,
        );

        return isset($this->options[$name]);
    }

    /**
     * @deprecated Use {@see getMatchType()}, {@see getOnDeleteAction()}, {@see getOnUpdateAction()} or
     *             {@see getDeferrability()} instead.
     *
     * Returns an option associated with the foreign key constraint.
     */
    public function getOption(string $name): mixed
    {
        Deprecation::triggerIfCalledFromOutside(
            'doctrine/dbal',
            'https://github.com/doctrine/dbal/pull/6728',
            '%s is deprecated. Use getMatchType(), getOnDeleteAction(), getOnUpdateAction() or'
                . ' getDeferrability() instead.',
            __METHOD__,
        );

        return $this->options[$name];
    }

    /**
     * @deprecated Use {@see getMatchType()}, {@see getOnDeleteAction()}, {@see getOnUpdateAction()} or
     *             {@see getDeferrability()} instead.
     *
     * Returns the options associated with the foreign key constraint.
     *
     * @return array<string, mixed>
     */
    public function getOptions(): array
    {
        Deprecation::triggerIfCalledFromOutside(
            'doctrine/dbal',
            'https://github.com/doctrine/dbal/pull/6728',
            '%s is deprecated. Use getMatchType(), getOnDeleteAction(), getOnUpdateAction() or'
                . ' getDeferrability() instead.',
            __METHOD__,
        );

        return $this->options;
    }

    /**
     * @deprecated Use {@see getOnUpdateAction()} instead.
     *
     * Returns the referential action for UPDATE operations
     * on the referenced table the foreign key constraint is associated with.
     */
    public function onUpdate(): ?string
    {
        Deprecation::triggerIfCalledFromOutside(
            'doctrine/dbal',
            'https://github.com/doctrine/dbal/pull/6728',
            '%s is deprecated. Use getOnUpdateAction() instead.',
            __METHOD__,
        );

        return $this->onEvent('onUpdate');
    }

    /**
     * @deprecated Use {@see getOnDeleteAction()} instead.
     *
     * Returns the referential action for DELETE operations
     * on the referenced table the foreign key constraint is associated with.
     */
    public function onDelete(): ?string
    {
        Deprecation::triggerIfCalledFromOutside(
            'doctrine/dbal',
            'https://github.com/doctrine/dbal/pull/6728',
            '%s is deprecated. Use getOnDeleteAction() instead.',
            __METHOD__,
        );

        return $this->onEvent('onDelete');
    }

    private function parseReferencedTableName(string $referencedTableName): ?OptionallyQualifiedName
    {
        $parser = Parsers::getOptionallyQualifiedNameParser();

        try {
            return $parser->parse($referencedTableName);
        } catch (Throwable $e) {
            Deprecation::trigger(
                'doctrine/dbal',
                'https://github.com/doctrine/dbal/pull/6728',
                'Unable to parse referenced table name: %s.',
                $e->getMessage(),
            );

            return null;
        }
    }

    /**
     * @param list<string> $columnNames
     *
     * @return list<UnqualifiedName>
     */
    private function parseColumnNames(array $columnNames): array
    {
        $parser = Parsers::getUnqualifiedNameParser();

        try {
            return array_map(
                static fn (string $columnName) => $parser->parse($columnName),
                $columnNames,
            );
        } catch (Throwable $e) {
            Deprecation::trigger(
                'doctrine/dbal',
                'https://github.com/doctrine/dbal/pull/6728',
                'Unable to parse column name: %s.',
                $e->getMessage(),
            );

            return [];
        }
    }

    /** @param array<string, mixed> $options */
    private function parseMatchType(array $options): ?MatchType
    {
        if (isset($options['match'])) {
            try {
                /**
                 * This looks like a PHPStan bug.
                 *
                 * @phpstan-ignore missingType.checkedException
                 */
                return MatchType::from(strtoupper($options['match']));
            } catch (ValueError $e) {
                Deprecation::trigger(
                    'doctrine/dbal',
                    'https://github.com/doctrine/dbal/pull/6728',
                    'Unable to parse match type: %s.',
                    $e->getMessage(),
                );

                return null;
            }
        }

        return MatchType::SIMPLE;
    }

    /** @param array<string, mixed> $options */
    private function parseReferentialAction(array $options, string $option): ?ReferentialAction
    {
        if (isset($options[$option])) {
            try {
                /**
                 * This looks like a PHPStan bug.
                 *
                 * @phpstan-ignore missingType.checkedException
                 */
                return ReferentialAction::from(strtoupper($options[$option]));
            } catch (ValueError $e) {
                Deprecation::trigger(
                    'doctrine/dbal',
                    'https://github.com/doctrine/dbal/pull/6728',
                    'Unable to parse referential action: %s.',
                    $e->getMessage(),
                );

                return null;
            }
        }

        return ReferentialAction::NO_ACTION;
    }

    /** @param array<string, mixed> $options */
    private function parseDeferrability(array $options): ?Deferrability
    {
        // a constraint is INITIALLY IMMEDIATE unless explicitly declared as INITIALLY DEFERRED
        $isDeferred = isset($options['deferred']) && $options['deferred'] !== false;

        // a constraint is NOT DEFERRABLE unless explicitly declared as DEFERRABLE or is explicitly or implicitly
        // INITIALLY DEFERRED
        $isDeferrable = isset($options['deferrable'])
            ? $options['deferrable'] !== false
            : $isDeferred;

        if ($isDeferred) {
            if (! $isDeferrable) {
                Deprecation::trigger(
                    'doctrine/dbal',
                    'https://github.com/doctrine/dbal/pull/6728',
                    'Declaring a constraint as NOT DEFERRABLE INITIALLY DEFERRED is deprecated',
                );

                return null;
            }

            return Deferrability::DEFERRED;
        }

        return $isDeferrable ? Deferrability::DEFERRABLE : Deferrability::NOT_DEFERRABLE;
    }

    /**
     * Returns the referential action for a given database operation
     * on the referenced table the foreign key constraint is associated with.
     *
     * @param string $event Name of the database operation/event to return the referential action for.
     */
    private function onEvent(string $event): ?string
    {
        if (isset($this->options[$event])) {
            $onEvent = strtoupper($this->options[$event]);

            if ($onEvent !== 'NO ACTION' && $onEvent !== 'RESTRICT') {
                return $onEvent;
            }
        }

        return null;
    }

    /**
     * @deprecated
     *
     * Checks whether this foreign key constraint intersects the given index columns.
     *
     * Returns `true` if at least one of this foreign key's local columns
     * matches one of the given index's columns, `false` otherwise.
     *
     * @param Index $index The index to be checked against.
     */
    public function intersectsIndexColumns(Index $index): bool
    {
        Deprecation::triggerIfCalledFromOutside(
            'doctrine/dbal',
            'https://github.com/doctrine/dbal/pull/6728',
            '%s is deprecated.',
            __METHOD__,
        );

        foreach ($index->getColumns() as $indexColumn) {
            foreach ($this->_localColumnNames as $localColumn) {
                if (strtolower($indexColumn) === strtolower($localColumn->getName())) {
                    return true;
                }
            }
        }

        return false;
    }

    /**
     * Instantiates a new foreign key constraint editor.
     */
    public static function editor(): ForeignKeyConstraintEditor
    {
        return new ForeignKeyConstraintEditor();
    }

    /**
     * Instantiates a new foreign key constraint editor and initializes it with the constraint's properties.
     */
    public function edit(): ForeignKeyConstraintEditor
    {
        return self::editor()
            ->setName($this->getObjectName())
            ->setReferencedTableName($this->getReferencedTableName())
            ->setReferencingColumnNames(...$this->getReferencingColumnNames())
            ->setReferencedColumnNames(...$this->getReferencedColumnNames())
            ->setMatchType($this->getMatchType())
            ->setOnDeleteAction($this->getOnDeleteAction())
            ->setOnUpdateAction($this->getOnUpdateAction())
            ->setDeferrability($this->getDeferrability());
    }
}
