<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
// 行为目录路径
define('BEHAVIOR_PATH', 'app\\common\\behavior\\');

// 应用行为扩展定义文件
$data= [
    // 应用初始化
    'app_init'     => [],
    // 应用开始
    'app_begin'    => [],
    // 模块初始化
    'module_init'  => [],
    // 操作开始执行
    'action_begin' => [],
    // 视图内容过滤
    'view_filter'  => [],
    // 日志写入
    'log_write'    => [],
    // 应用结束
    'app_end'      => [],
];

if (defined('BIND_MODULE') && BIND_MODULE == 'install') {
    return $data;
}
$data['app_init']   = [BEHAVIOR_PATH . 'InitBase', BEHAVIOR_PATH . 'InitHook'];

return $data;