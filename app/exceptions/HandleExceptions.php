<?php

namespace App\exceptions;

use Ethereal\HandleExceptions as BaseHandleExceptions;
class HandleExceptions extends BaseHandleExceptions
{
    protected $ignore = [
        ErrorMessageException::class
    ];
}