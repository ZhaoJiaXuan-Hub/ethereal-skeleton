<?php
! defined('BASE_PATH') && define('BASE_PATH', dirname(__DIR__, 1));
ini_set('display_errors', 'on');
ini_set('display_startup_errors', 'on');
ini_set('memory_limit', '1G');
error_reporting(E_ALL);
require_once __DIR__ . '/../vendor/autoload.php';

use Ethereal\http\Request;
use Ethereal\http\RequestInterface;
use Ethereal\swoole\Context;

$start = function () {
    Swoole\Runtime::enableCoroutine($flags = SWOOLE_HOOK_ALL);

    // 绑定主机 端口
    $http = new Swoole\Http\Server('0.0.0.0', 9501);
    $http->set([
        // 进程pid文件
        'pid_file' => BASE_PATH . '/runtime/storage/swoole.pid',
        'enable_coroutine' => true, // 开启异步协程化
        'worker_num' => 4  // Worker进程数
    ]);


    // 绑定request
    app()->bind(RequestInterface::class, function () {
        return Context::get('request');
    }, false);


    $http->on('request', function ($request, $response) {
        if ($request->server['path_info'] == '/favicon.ico' || $request->server['request_uri'] == '/favicon.ico') {
            $response->end();
            Context::delete();
            return;
        }
        $server = $request->server;
        // 用协程上下文保存当前的request
        Context::put('request', Request::create(
            $server['path_info'],
            $server['request_method'],
            $server,
            $request->get,
            $request->post
        ));
        echo "CID:".Swoole\Coroutine::getCid()." METHOD:{$server['request_method']} URI:{$server['path_info']}" . PHP_EOL;
        $content = app("route")->dispatch(app(RequestInterface::class));
        $headers = $content->getHeaders();
        foreach ($headers as $index=>$item)
            $response->header($index, $item);
        $response->end(
            $content->getContent()
        );

        Context::delete();
    });

    echo "
      _   _                         _ 
  ___| |_| |__   ___ _ __ ___  __ _| |
 / _ \ __| '_ \ / _ \ '__/ _ \/ _` | |
|  __/ |_| | | |  __/ | |  __/ (_| | |
 \___|\__|_| |_|\___|_|  \___|\__,_|_|     
    " . PHP_EOL;

    echo "START SUCCESS!" . PHP_EOL;
    $http->start();
};

$stop = function () {

    if (!file_exists(BASE_PATH . '/runtime/storage/swoole.pid'))
        return;
    $pid = file_get_contents(BASE_PATH . '/runtime/storage/swoole.pid');
    Swoole\Process::kill($pid);
};

$handle = $argv[1];

// 启动
if ($handle == 'start')
    $start();

// 停止
elseif ($handle == 'stop')
    $stop();