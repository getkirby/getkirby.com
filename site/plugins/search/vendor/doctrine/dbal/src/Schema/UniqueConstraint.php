<?php

declare(strict_types=1);

namespace Doctrine\DBAL\Schema;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Schema\Exception\InvalidState;
use Doctrine\DBAL\Schema\Name\Parser\UnqualifiedNameParser;
use Doctrine\DBAL\Schema\Name\Parsers;
use Doctrine\DBAL\Schema\Name\UnqualifiedName;
use Doctrine\Deprecations\Deprecation;
use Throwable;

use function array_keys;
use function array_map;
use function count;
use function strtolower;

/**
 * Represents unique constraint definition.
 *
 * @extends AbstractOptionallyNamedObject<UnqualifiedName>
 * @final This class will be made final in DBAL 5.0.
 */
class UniqueConstraint extends AbstractOptionallyNamedObject
{
    /**
     * Asset identifier instances of the column names the unique constraint is associated with.
     *
     * @deprecated
     *
     * @var array<string, Identifier>
     */
    protected array $columns = [];

    /**
     * Platform specific flags
     *
     * @deprecated
     *
     * @var array<string, true>
     */
    protected array $flags = [];

    /**
     * Names of the columns covered by the unique constraint.
     *
     * @var list<UnqualifiedName>
     */
    private array $columnNames = [];

    private bool $failedToParseColumnNames = false;

    /**
     * @internal Use {@link UniqueConstraint::editor()} to instantiate an editor and
     *           {@link UniqueConstraintEditor::create()} to create a unique constraint.
     *
     * @param non-empty-list<string> $columns
     * @param array<string>          $flags
     * @param array<string, mixed>   $options
     */
    public function __construct(
        string $name,
        array $columns,
        array $flags = [],
        private readonly array $options = [],
    ) {
        if (count($columns) < 1) {
            Deprecation::trigger(
                'doctrine/dbal',
                'https://github.com/doctrine/dbal/pull/6685',
                'Instantiation of a unique constraint without columns is deprecated.',
            );
        }

        if (count($options) > 0) {
            Deprecation::trigger(
                'doctrine/dbal',
                'https://github.com/doctrine/dbal/pull/6685',
                'Using %s options is deprecated.',
                self::class,
            );
        }

        parent::__construct($name);

        foreach ($columns as $column) {
            $this->addColumn($column);
        }

        foreach ($flags as $flag) {
            $this->addFlag($flag);
        }
    }

    protected function getNameParser(): UnqualifiedNameParser
    {
        return Parsers::getUnqualifiedNameParser();
    }

    /**
     * Returns the names of the columns the constraint is associated with.
     *
     * @return non-empty-list<UnqualifiedName>
     */
    public function getColumnNames(): array
    {
        if ($this->failedToParseColumnNames) {
            throw InvalidState::uniqueConstraintHasInvalidColumnNames($this->getName());
        }

        if (count($this->columnNames) < 1) {
            throw InvalidState::uniqueConstraintHasEmptyColumnNames($this->getName());
        }

        return $this->columnNames;
    }

    /**
     * @deprecated Use {@see getColumnNames()} instead.
     *
     * @return non-empty-list<string>
     */
    public function getColumns(): array
    {
        Deprecation::triggerIfCalledFromOutside(
            'doctrine/dbal',
            'https://github.com/doctrine/dbal/pull/6685',
            '%s is deprecated. Use getColumnNames() instead.',
            __METHOD__,
        );

        /** @phpstan-ignore return.type */
        return array_keys($this->columns);
    }

    /**
     * @deprecated Use {@see getColumnNames()} and {@see UnqualifiedName::toSQL()} instead.
     *
     * But only if they were defined with one or a column name
     * is a keyword reserved by the platform.
     * Otherwise, the plain unquoted value as inserted is returned.
     *
     * @param AbstractPlatform $platform The platform to use for quotation.
     *
     * @return list<string>
     *
     * Returns the quoted representation of the column names the constraint is associated with.
     */
    public function getQuotedColumns(AbstractPlatform $platform): array
    {
        Deprecation::triggerIfCalledFromOutside(
            'doctrine/dbal',
            'https://github.com/doctrine/dbal/pull/6685',
            '%s is deprecated. Use getColumnNames() and UnqualifiedName::toSQL() instead.',
            __METHOD__,
        );

        $columns = [];

        foreach ($this->columns as $column) {
            $columns[] = $column->getQuotedName($platform);
        }

        return $columns;
    }

    /**
     * @deprecated Use {@see getColumnNames()} instead.
     *
     * @return non-empty-list<string>
     */
    public function getUnquotedColumns(): array
    {
        Deprecation::trigger(
            'doctrine/dbal',
            'https://github.com/doctrine/dbal/pull/6685',
            '%s is deprecated. Use getColumnNames() instead.',
            __METHOD__,
        );

        return array_map($this->trimQuotes(...), $this->getColumns());
    }

    /**
     * @deprecated Use {@see isClustered()} instead.
     *
     * Returns platform specific flags for unique constraint.
     *
     * @return array<int, string>
     */
    public function getFlags(): array
    {
        Deprecation::triggerIfCalledFromOutside(
            'doctrine/dbal',
            'https://github.com/doctrine/dbal/pull/6685',
            '%s is deprecated. Use isClustered() instead.',
            __METHOD__,
        );

        return array_keys($this->flags);
    }

    /**
     * Adds flag for a unique constraint that translates to platform specific handling.
     *
     * @deprecated Use {@see UniqueConstraintEditor::setIsClustered()} instead.
     *
     * @return $this
     *
     * @example $uniqueConstraint->addFlag('CLUSTERED')
     */
    public function addFlag(string $flag): self
    {
        Deprecation::triggerIfCalledFromOutside(
            'doctrine/dbal',
            'https://github.com/doctrine/dbal/pull/6685',
            '%s is deprecated.',
            __METHOD__,
        );

        $this->flags[strtolower($flag)] = true;

        return $this;
    }

    /**
     * Does this unique constraint have a specific flag?
     *
     * @deprecated Use {@see isClustered()} instead.
     */
    public function hasFlag(string $flag): bool
    {
        Deprecation::triggerIfCalledFromOutside(
            'doctrine/dbal',
            'https://github.com/doctrine/dbal/pull/6685',
            '%s is deprecated. Use isClustered() instead.',
            __METHOD__,
        );

        return isset($this->flags[strtolower($flag)]);
    }

    /**
     * Returns whether the unique constraint is clustered.
     */
    public function isClustered(): bool
    {
        return $this->hasFlag('clustered');
    }

    /**
     * Removes a flag.
     *
     * @deprecated Use {@see UniqueConstraintEditor::setIsClustered()} instead.
     */
    public function removeFlag(string $flag): void
    {
        Deprecation::trigger(
            'doctrine/dbal',
            'https://github.com/doctrine/dbal/pull/6685',
            '%s is deprecated.',
            __METHOD__,
        );

        unset($this->flags[strtolower($flag)]);
    }

    /** @deprecated */
    public function hasOption(string $name): bool
    {
        Deprecation::trigger(
            'doctrine/dbal',
            'https://github.com/doctrine/dbal/pull/6685',
            '%s is deprecated.',
            __METHOD__,
        );

        return isset($this->options[strtolower($name)]);
    }

    /** @deprecated */
    public function getOption(string $name): mixed
    {
        Deprecation::trigger(
            'doctrine/dbal',
            'https://github.com/doctrine/dbal/pull/6685',
            '%s is deprecated.',
            __METHOD__,
        );

        return $this->options[strtolower($name)];
    }

    /**
     * @deprecated
     *
     * @return array<string, mixed>
     */
    public function getOptions(): array
    {
        Deprecation::triggerIfCalledFromOutside(
            'doctrine/dbal',
            'https://github.com/doctrine/dbal/pull/6685',
            '%s is deprecated.',
            __METHOD__,
        );

        return $this->options;
    }

    /** @deprecated */
    protected function addColumn(string $column): void
    {
        Deprecation::triggerIfCalledFromOutside(
            'doctrine/dbal',
            'https://github.com/doctrine/dbal/pull/6685',
            '%s is deprecated.',
            __METHOD__,
        );

        $this->columns[$column] = new Identifier($column);

        $parser = Parsers::getUnqualifiedNameParser();

        try {
            $this->columnNames[] = $parser->parse($column);
        } catch (Throwable $e) {
            $this->failedToParseColumnNames = true;

            Deprecation::trigger(
                'doctrine/dbal',
                'https://github.com/doctrine/dbal/pull/6685',
                'Unable to parse column name: %s.',
                $e->getMessage(),
            );
        }
    }

    /**
     * Instantiates a new unique constraint editor.
     */
    public static function editor(): UniqueConstraintEditor
    {
        return new UniqueConstraintEditor();
    }

    /**
     * Instantiates a new unique constraint editor and initializes it with the constraint's properties.
     */
    public function edit(): UniqueConstraintEditor
    {
        return self::editor()
            ->setName($this->getObjectName())
            ->setColumnNames(...$this->getColumnNames())
            ->setIsClustered($this->isClustered());
    }
}
