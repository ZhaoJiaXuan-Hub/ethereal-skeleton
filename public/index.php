<?php
! defined('BASE_PATH') && define('BASE_PATH', dirname(__DIR__, 1));
require_once __DIR__ . '/../vendor/autoload.php';
$container = Ethereal\Container::class;
$container::getContainer()->bind('app',Ethereal\App::class);
$app = $container::getContainer()->get('app');
$app->run();