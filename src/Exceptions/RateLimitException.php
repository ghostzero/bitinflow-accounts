<?php

declare(strict_types=1);

namespace GhostZero\BitinflowAccounts\Exceptions;

use Exception;

/**
 * @author René Preuß <rene@preuss.io>
 */
class RateLimitException extends Exception
{
    public function __construct($message = 'Rate Limit exceeded', $code = 0, Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}