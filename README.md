# Ethereal
一款轻量化PHP开发框架，基于CTRL+C以及CTRL+V高度整合开发而成。

### 当前已经支持

`容器`
`请求`
`路由`
`控制器`
`数据库`
`模型`
`中间件`
`视图`
`响应`
`日志`
`异常托管`
`swoole`

### 未来可能支持

`workerman`
`aop`
`env`
`event`
`session`
`redis`
`cache`

### 安装

`composer create-project zhaojiaxuan/ethereal-skeleton ethereal`

### 更新

`composer update zhaojiaxuan/ethereal-framework`

### 启动

#### FPM服务器

`运行文件 public/index.php`

#### Swoole-HTTP

`启动指令 php ./bin/swoole.php start`