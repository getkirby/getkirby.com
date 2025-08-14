<?php

declare(strict_types=1);

namespace Doctrine\DBAL\Exception;

use Throwable;

/**
 * Marker interface for all exceptions where retrying the transaction makes sense.
 */
interface RetryableException extends Throwable
{
}
