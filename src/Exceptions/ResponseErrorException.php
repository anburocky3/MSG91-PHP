<?php


namespace Anburocky3\Msg91\Exceptions;

use Exception;
use Throwable;

/**
 * Thrown when we don't receive a success response
 */
class ResponseErrorException extends Exception
{
    /**
     * Response Errors
     * @var array|null
     */
    protected ?array $errors;


    /**
     * Construct the exception. Note: The message is NOT binary safe.
     * @link https://php.net/manual/en/exception.construct.php
     * @param string $message [optional] The Exception message to throw.
     * @param int $code [optional] The Exception code.
     * @param null|Throwable $previous [optional] The previous throwable used for the exception chaining.
     */
    public function __construct($message = "", $code = 0, Throwable $previous = null, $errors)
    {
        $this->errors = $errors;
        parent::__construct($message, $code, $previous);
    }

    /**
     * @return array|null
     */
    public function getErrors(): ?array
    {
        return $this->errors;
    }
}
