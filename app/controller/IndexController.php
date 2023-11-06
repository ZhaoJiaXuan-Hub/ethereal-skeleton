<?php

namespace App\controller;

use App\middleware\DefaultMiddleware;
use Ethereal\Controller;
use Ethereal\http\RequestInterface;
use Ethereal\http\Response;

class IndexController extends Controller
{
    protected $middleware = [
        DefaultMiddleware::class
    ];

    public function index (RequestInterface $request): Response
    {
        return response([
            'method'    =>  $request->getMethod(),
            'url'   =>  $request->getUri()
        ]);
    }

    public function json (RequestInterface $request): Response
    {
        return response([
            'code'  =>  200,
            'message'   =>  "获取成功",
            'data'  =>  [
                'method'    =>  $request->getMethod(),
                'uri'   =>  $request->getUri(),
            ]
        ]);
    }

    /**
     * @param RequestInterface $request
     * @return Response
     */
    public function view (RequestInterface $request): Response
    {
        $name = $request->input("name","Ethereal");
        app('log')->debug("{name} test",['name'=>$name]);
        app('log')->info("run succeed!");
        return view('index',[
            'name'  =>  $name
        ]);
    }
}