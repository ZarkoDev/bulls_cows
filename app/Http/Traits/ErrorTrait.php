<?php

namespace App\Http\Traits;

trait ErrorTrait
{
    private $errors = [];

    public function getErrors()
    {
        return ['error' => $this->getErrorsToString()];
    }

    public function getErrorsToString()
    {
        return implode(';', $this->errors);
    }

    public function setError(string $message)
    {
        $this->errors[] = $message;
    }

    public function hasErrors()
    {
        return !empty($this->errors);
    }
}
