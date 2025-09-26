<?php

declare(strict_types=1);

namespace Doctrine\DBAL\Schema;

use Doctrine\DBAL\Exception;
use Doctrine\DBAL\Platforms\SQLServer;
use Doctrine\DBAL\Platforms\SQLServerPlatform;
use Doctrine\DBAL\Result;
use Doctrine\DBAL\Types\Type;

use function array_change_key_case;
use function assert;
use function explode;
use function func_get_arg;
use function func_num_args;
use function implode;
use function is_string;
use function preg_match;
use function sprintf;
use function str_contains;
use function str_replace;

use const CASE_LOWER;

/**
 * SQL Server Schema Manager.
 *
 * @extends AbstractSchemaManager<SQLServerPlatform>
 */
class SQLServerSchemaManager extends AbstractSchemaManager
{
    private ?string $databaseCollation = null;

    /**
     * {@inheritDoc}
     */
    public function listSchemaNames(): array
    {
        return $this->connection->fetchFirstColumn(
            <<<'SQL'
SELECT name
FROM   sys.schemas
WHERE  name NOT IN('guest', 'INFORMATION_SCHEMA', 'sys')
SQL,
        );
    }

    /**
     * {@inheritDoc}
     */
    protected function _getPortableSequenceDefinition(array $sequence): Sequence
    {
        return new Sequence($sequence['name'], (int) $sequence['increment'], (int) $sequence['start_value']);
    }

    /**
     * {@inheritDoc}
     */
    protected function _getPortableTableColumnDefinition(array $tableColumn): Column
    {
        $dbType = $tableColumn['type'];

        $length = (int) $tableColumn['length'];

        $precision = null;

        $scale = 0;
        $fixed = false;

        if ($tableColumn['scale'] !== null) {
            $scale = (int) $tableColumn['scale'];
        }

        if ($tableColumn['precision'] !== null) {
            $precision = (int) $tableColumn['precision'];
        }

        switch ($dbType) {
            case 'nchar':
            case 'ntext':
                // Unicode data requires 2 bytes per character
                $length /= 2;
                break;

            case 'nvarchar':
                if ($length === -1) {
                    break;
                }

                // Unicode data requires 2 bytes per character
                $length /= 2;
                break;

            case 'varchar':
                // TEXT type is returned as VARCHAR(MAX) with a length of -1
                if ($length === -1) {
                    $dbType = 'text';
                }

                break;

            case 'varbinary':
                if ($length === -1) {
                    $dbType = 'blob';
                }

                break;
        }

        if ($dbType === 'char' || $dbType === 'nchar' || $dbType === 'binary') {
            $fixed = true;
        }

        $type = $this->platform->getDoctrineTypeMapping($dbType);

        $options = [
            'fixed'         => $fixed,
            'notnull'       => (bool) $tableColumn['notnull'],
            'scale'         => $scale,
            'precision'     => $precision,
            'autoincrement' => (bool) $tableColumn['autoincrement'],
        ];

        if ($tableColumn['comment'] !== null) {
            $options['comment'] = $tableColumn['comment'];
        }

        if ($length !== 0 && ($type === 'text' || $type === 'string' || $type === 'binary')) {
            $options['length'] = $length;
        }

        $column = new Column($tableColumn['name'], Type::getType($type), $options);

        if ($tableColumn['default'] !== null) {
            $default = $this->parseDefaultExpression($tableColumn['default']);

            $column->setDefault($default);
            $column->setPlatformOption(
                SQLServerPlatform::OPTION_DEFAULT_CONSTRAINT_NAME,
                $tableColumn['df_name'],
            );
        }

        $column->setPlatformOption('collation', $tableColumn['collation']);

        return $column;
    }

    private function parseDefaultExpression(string $value): ?string
    {
        while (preg_match('/^\((.*)\)$/s', $value, $matches) === 1) {
            $value = $matches[1];
        }

        if ($value === 'NULL') {
            return null;
        }

        if (preg_match('/^\'(.*)\'$/s', $value, $matches) === 1) {
            $value = str_replace("''", "'", $matches[1]);
        }

        if ($value === 'getdate()') {
            return $this->platform->getCurrentTimestampSQL();
        }

        return $value;
    }

    /**
     * {@inheritDoc}
     */
    protected function _getPortableTableForeignKeysList(array $rows): array
    {
        $foreignKeys = [];

        foreach ($rows as $row) {
            $name = $row['ForeignKey'];

            if (! isset($foreignKeys[$name])) {
                $referencedTableName = $row['ReferenceTableName'];

                // @phpstan-ignore missingType.checkedException
                if ($row['ReferenceSchemaName'] !== $this->getCurrentSchemaName()) {
                    $referencedTableName = $row['ReferenceSchemaName'] . '.' . $referencedTableName;
                }

                $foreignKeys[$name] = [
                    'local_columns' => [$row['ColumnName']],
                    'foreign_table' => $referencedTableName,
                    'foreign_columns' => [$row['ReferenceColumnName']],
                    'name' => $name,
                    'options' => [
                        'onUpdate' => str_replace('_', ' ', $row['update_referential_action_desc']),
                        'onDelete' => str_replace('_', ' ', $row['delete_referential_action_desc']),
                    ],
                ];
            } else {
                $foreignKeys[$name]['local_columns'][]   = $row['ColumnName'];
                $foreignKeys[$name]['foreign_columns'][] = $row['ReferenceColumnName'];
            }
        }

        return parent::_getPortableTableForeignKeysList($foreignKeys);
    }

    /**
     * {@inheritDoc}
     */
    protected function _getPortableTableIndexesList(array $rows, string $tableName): array
    {
        foreach ($rows as &$row) {
            $row['non_unique'] = (bool) $row['non_unique'];
            $row['primary']    = (bool) $row['primary'];
            $row['flags']      = $row['flags'] ? [$row['flags']] : null;
        }

        return parent::_getPortableTableIndexesList($rows, $tableName);
    }

    /**
     * {@inheritDoc}
     */
    protected function _getPortableTableForeignKeyDefinition(array $tableForeignKey): ForeignKeyConstraint
    {
        return new ForeignKeyConstraint(
            $tableForeignKey['local_columns'],
            $tableForeignKey['foreign_table'],
            $tableForeignKey['foreign_columns'],
            $tableForeignKey['name'],
            $tableForeignKey['options'],
        );
    }

    /**
     * @deprecated Use the schema name and the unqualified table name separately instead.
     *
     * {@inheritDoc}
     */
    protected function _getPortableTableDefinition(array $table): string
    {
        // @phpstan-ignore missingType.checkedException
        if ($table['schema_name'] !== $this->getCurrentSchemaName()) {
            return $table['schema_name'] . '.' . $table['table_name'];
        }

        return $table['table_name'];
    }

    /**
     * {@inheritDoc}
     */
    protected function _getPortableDatabaseDefinition(array $database): string
    {
        return $database['name'];
    }

    /**
     * {@inheritDoc}
     */
    protected function _getPortableViewDefinition(array $view): View
    {
        return new View($view['name'], $view['definition']);
    }

    /** @throws Exception */
    public function createComparator(/* ComparatorConfig $config = new ComparatorConfig() */): Comparator
    {
        return new SQLServer\Comparator(
            $this->platform,
            $this->getDatabaseCollation(),
            func_num_args() > 0 ? func_get_arg(0) : new ComparatorConfig(),
        );
    }

    /** @throws Exception */
    private function getDatabaseCollation(): string
    {
        if ($this->databaseCollation === null) {
            $databaseCollation = $this->connection->fetchOne(
                'SELECT collation_name FROM sys.databases WHERE name = '
                . $this->platform->getCurrentDatabaseExpression(),
            );

            // a database is always selected, even if omitted in the connection parameters
            assert(is_string($databaseCollation));

            $this->databaseCollation = $databaseCollation;
        }

        return $this->databaseCollation;
    }

    protected function determineCurrentSchemaName(): ?string
    {
        $schemaName = $this->connection->fetchOne('SELECT SCHEMA_NAME()');
        assert($schemaName !== false);

        return $schemaName;
    }

    protected function selectTableNames(string $databaseName): Result
    {
        // The "sysdiagrams" table must be ignored as it's internal SQL Server table for Database Diagrams
        $sql = <<<'SQL'
SELECT SCHEMA_NAME(schema_id) AS schema_name,
       name AS table_name
FROM sys.tables
WHERE name != 'sysdiagrams'
ORDER BY name
SQL;

        return $this->connection->executeQuery($sql);
    }

    protected function selectTableColumns(string $databaseName, ?string $tableName = null): Result
    {
        $params = [];

        $sql = sprintf(
            <<<'SQL'
                SELECT
                          scm.name AS schema_name,
                          tbl.name AS table_name,
                          col.name,
                          type.name AS type,
                          col.max_length AS length,
                          ~col.is_nullable AS notnull,
                          def.definition AS [default],
                          def.name AS df_name,
                          col.scale,
                          col.precision,
                          col.is_identity AS autoincrement,
                          col.collation_name AS collation,
                          -- CAST avoids driver error for sql_variant type
                          CAST(prop.value AS NVARCHAR(MAX)) AS comment
                FROM      sys.columns AS col
                JOIN      sys.types AS type
                ON        col.user_type_id = type.user_type_id
                JOIN      sys.tables AS tbl
                ON        col.object_id = tbl.object_id
                JOIN      sys.schemas AS scm
                ON        tbl.schema_id = scm.schema_id
                LEFT JOIN sys.default_constraints def
                ON        col.default_object_id = def.object_id
                AND       col.object_id = def.parent_object_id
                LEFT JOIN sys.extended_properties AS prop
                ON        tbl.object_id = prop.major_id
                AND       col.column_id = prop.minor_id
                AND       prop.name = 'MS_Description'
                WHERE     %s
                ORDER BY  scm.name,
                          tbl.name,
                          col.column_id
SQL,
            $this->getWhereClause($tableName, 'scm.name', 'tbl.name', $params),
        );

        return $this->connection->executeQuery($sql, $params);
    }

    protected function selectIndexColumns(string $databaseName, ?string $tableName = null): Result
    {
        $params = [];

        $sql = sprintf(
            <<<'SQL'
              SELECT
                       scm.name AS schema_name,
                       tbl.name AS table_name,
                       idx.name AS key_name,
                       col.name AS column_name,
                       ~idx.is_unique AS non_unique,
                       idx.is_primary_key AS [primary],
                       CASE idx.type
                           WHEN '1' THEN 'clustered'
                           WHEN '2' THEN 'nonclustered'
                           ELSE NULL
                       END AS flags
                FROM sys.tables AS tbl
                JOIN sys.schemas AS scm
                  ON tbl.schema_id = scm.schema_id
                JOIN sys.indexes AS idx
                  ON tbl.object_id = idx.object_id
                JOIN sys.index_columns AS idxcol
                  ON idx.object_id = idxcol.object_id
                 AND idx.index_id = idxcol.index_id
                JOIN sys.columns AS col
                  ON idxcol.object_id = col.object_id
                 AND idxcol.column_id = col.column_id
               WHERE %s
            ORDER BY scm.name,
                     tbl.name,
                     idx.index_id,
                     idxcol.key_ordinal
SQL,
            $this->getWhereClause($tableName, 'scm.name', 'tbl.name', $params),
        );

        return $this->connection->executeQuery($sql, $params);
    }

    protected function selectForeignKeyColumns(string $databaseName, ?string $tableName = null): Result
    {
        $params = [];

        $sql = sprintf(
            <<<'SQL'
                SELECT
                SCHEMA_NAME(f.schema_id) AS schema_name,
                OBJECT_NAME(f.parent_object_id) AS table_name,
                f.name AS ForeignKey,
                COL_NAME(fc.parent_object_id, fc.parent_column_id) AS ColumnName,
                SCHEMA_NAME(t.schema_id) ReferenceSchemaName,
                OBJECT_NAME(f.referenced_object_id) AS ReferenceTableName,
                COL_NAME(fc.referenced_object_id, fc.referenced_column_id) AS ReferenceColumnName,
                f.delete_referential_action_desc,
                f.update_referential_action_desc
                FROM sys.foreign_keys AS f
                INNER JOIN sys.foreign_key_columns AS fc
                ON f.object_id = fc.constraint_object_id
                INNER JOIN sys.tables AS t
                ON t.object_id = fc.referenced_object_id
                WHERE %s
                ORDER BY 1,
                         2,
                         3,
                         fc.constraint_column_id
SQL,
            $this->getWhereClause(
                $tableName,
                'SCHEMA_NAME(f.schema_id)',
                'OBJECT_NAME(f.parent_object_id)',
                $params,
            ),
        );

        return $this->connection->executeQuery($sql, $params);
    }

    /**
     * {@inheritDoc}
     */
    protected function fetchTableOptionsByTable(string $databaseName, ?string $tableName = null): array
    {
        $params = [];

        $sql = sprintf(
            <<<'SQL'
          SELECT
            scm.name AS schema_name,
            tbl.name AS table_name,
            p.value
          FROM
            sys.tables AS tbl
            JOIN sys.schemas AS scm
              ON tbl.schema_id = scm.schema_id
            INNER JOIN sys.extended_properties AS p ON p.major_id=tbl.object_id AND p.minor_id=0 AND p.class=1
          WHERE
              p.name = N'MS_Description'
          AND %s
SQL,
            $this->getWhereClause($tableName, 'scm.name', 'tbl.name', $params),
        );

        $tableOptions = [];
        foreach ($this->connection->iterateAssociative($sql, $params) as $data) {
            $data = array_change_key_case($data, CASE_LOWER);

            $tableOptions[$this->_getPortableTableDefinition($data)] = [
                'comment' => $data['value'],
            ];
        }

        return $tableOptions;
    }

    /**
     * Returns the where clause to filter schema and table name in a query.
     *
     * @param ?string      $tableName    The full qualified name of the table.
     * @param string       $schemaColumn The name of the column to compare the schema to in the where clause.
     * @param string       $tableColumn  The name of the column to compare the table to in the where clause.
     * @param list<string> $params
     */
    private function getWhereClause(
        ?string $tableName,
        string $schemaColumn,
        string $tableColumn,
        array &$params,
    ): string {
        $conditions = [];

        if ($tableName !== null) {
            if (str_contains($tableName, '.')) {
                [$schemaName, $tableName] = explode('.', $tableName);

                $conditions = [sprintf('%s = ?', $schemaColumn)];
                $params[]   = $schemaName;
            } else {
                $conditions = [sprintf('%s = SCHEMA_NAME()', $schemaColumn)];
            }

            $conditions[] = sprintf('%s = ?', $tableColumn);
            $params[]     = $tableName;
        }

        // The "sysdiagrams" table must be ignored as it's internal SQL Server table for Database Diagrams
        $conditions[] = sprintf("%s != 'sysdiagrams'", $tableColumn);

        return implode(' AND ', $conditions);
    }
}
