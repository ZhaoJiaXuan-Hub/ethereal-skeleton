<?php
function app(string $name = null)
{
    if ($name)
        return \Ethereal\Container::getContainer()->get($name);
    return Ethereal\Container::getContainer();
}

function response(mixed $data,int $code=200,array $header=[]):\Ethereal\http\Response
{
    return app('response')->setContent($data)->setCode($code)->setHeaders($header)->send();
}

function view(string $path,array $params = []): \Ethereal\http\Response
{
    return response(app(\Ethereal\view\ViewInterface::class)->render($path,$params));
}

function config(string $key = null)
{
    if ($key)
        return app('config')->get($key);
    return app('config');
}