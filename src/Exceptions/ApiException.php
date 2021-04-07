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
     * @var string|null
     */
    protected ?string $object;

    /**
     * @var string|null
     */
    protected ?string $description;

    /**
     * ApiException constructor.
     *
     * @param string|null $object
     * @param string|null $description
     * @param Throwable|null $previous
     */
    public function __construct(?string $object, ?string $description, Throwable $previous = null)
    {
        $this->object = $object;
        $this->description = $description;
        $message = "Description: $description; Obj: $object";
        parent::__construct($message, $code ?? 0, $previous);
    }
}