<?php
namespace App\exceptions;

use Exception;
class ErrorMessageException extends Exception
{
    public function render(): array
    {
        return  [
            'code' => $this->getCode(),
            'message' => $this->getMessage()
        ];
    }
}