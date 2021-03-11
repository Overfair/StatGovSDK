<?php

declare(strict_types=1);

namespace Overfair\StatGovSDK\Exceptions;

use Exception;
use Throwable;

/**
 * Class ApiException
 * @package Overfair\StatGovSDK\Exceptions
 */
class ApiException extends Exception
{
    /**
     * ApiException constructor.
     * @param string $message
     * @param int|null $code
     * @param Throwable|null $previous
     */
    public function __construct(string $message, int $code = null, Throwable $previous = null)
    {
        parent::__construct($message, $code ?? 0, $previous);
    }

}