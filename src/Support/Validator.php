<?php


namespace Anburocky3\Msg91\Support;

/**
 * Class Validator
 * @package Anburocky3\Msg91\Support
 */
class Validator
{
    /**
     * Validation errors
     * @var array
     */
    protected array $errors = [];

    /**
     * Add an error
     * @param string $key
     * @param string $error
     * @return $this;
     */
    public function addError(string $key, string $error): Validator
    {
        $this->errors[$key] = $this->errors[$key] ?? [];
        $this->errors[$key][] = $error;

        return $this;
    }

    /**
     * Get the validation errors
     * @return array
     */
    public function errors(): array
    {
        return $this->errors;
    }

    public function isValid(): bool
    {
        return ! count($this->errors);
    }
}
