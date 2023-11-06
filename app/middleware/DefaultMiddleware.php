<?php

namespace App\middleware;

use Ethereal\http\RequestInterface;

class DefaultMiddleware
{
    public function handle(RequestInterface $request, \Closure $next)
    {
        return $next($request);
    }
}