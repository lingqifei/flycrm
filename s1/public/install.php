<?php
// PHP版本验证需要大于5.6.0
if (version_compare(PHP_VERSION, '5.6.0', '<')) {
    
    die('OneBase Require PHP > 5.6.0 !');
}

// 绑定安装模块
define('BIND_MODULE', 'install');

// 定义应用目录
define('APP_PATH', __DIR__ . '/../app/');

// 加载框架引导文件
require __DIR__ . '/../core/start.php';