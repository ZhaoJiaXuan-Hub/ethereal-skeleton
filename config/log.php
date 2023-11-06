<?php

return [
    'default' => 'file1',
    'channels' => [
        'file1' => [ // 文件类型的日志
            'driver' => 'stack',
            'path' => BASE_PATH . '/runtime/storage',
            'format' => '[%s][%s] %s', // 格式化类型  分别代表:[日期][日志级别]消息
        ]
    ]

];