<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

// [ 应用入口文件 ]


//获得访客的IP
function get_ip()
{
    $ip = false;
    if (!empty($_SERVER["HTTP_CLIENT_IP"])) {
        $ip = $_SERVER["HTTP_CLIENT_IP"];
    }
    if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ips = explode(", ", $_SERVER['HTTP_X_FORWARDED_FOR']);
        if ($ip) {
            array_unshift($ips, $ip);
            $ip = FALSE;
        }
        for ($i = 0; $i < count($ips); $i++) {
            if (!preg_match("/^(10│172.16│192.168)./", $ips[$i])) {
                $ip = $ips[$i];
                break;
            }
        }
    }
    return ($ip ? $ip : $_SERVER['REMOTE_ADDR']);
}


/*
 * 根据ip地址查询城市名称=》查询库中城市的IP地址
 * */
function  get_city(){
    $ip=get_ip();
    //根据IP地址定位所在城市
    //①使用淘宝IP库
    $res = @file_get_contents("http://ip.taobao.com/service/getIpInfo.php?ip=$ip");

    $res = json_decode($res,true);

    print_r($res);
    exit;
    return $city_id;
}

get_city();

// 定义应用目录
define('APP_PATH', __DIR__ . './app/');
// 定义缓存目录
define('RUNTIME_PATH','./Runtime/');
// 定义模板文件默认目录
define("TMPL_PATH","./template/");
// 加载框架引导文件
require __DIR__ . './core/start.php';
