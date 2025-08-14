<?php

declare(strict_types=1);

namespace Doctrine\DBAL\Schema\Exception;

use Doctrine\DBAL\Schema\Name\UnqualifiedName;
use Doctrine\DBAL\Schema\SchemaException;
use LogicException;

use function sprintf;

final class InvalidIndexDefinition extends LogicException implements SchemaException
{
    public static function nameNotSet(): self
    {
        return new self('Index name is not set.');
    }

    public static function columnsNotSet(UnqualifiedName $indexName): self
    {
        return new self(sprintf('Columns are not set for index %s.', $indexName->toString()));
    }

    public static function fromNonPositiveColumnLength(UnqualifiedName $columnName, int $length): self
    {
        return new self(sprintf(
            'Indexed column length must be a positive integer, %d given for column %s.',
            $length,
            $columnName->toString(),
        ));
    }
}
