<?php
/*
* install  系统安装
*
* =========================================================
* 零起飞网络 - 专注于网站建设服务和行业系统开发
* 以质量求生存，以服务谋发展，以信誉创品牌 !
* ----------------------------------------------
* @copyright	Copyright (C) 2017-2018 07FLY Network Technology Co,LTD (www.07FLY.com) All rights reserved.
* @license    For licensing, see LICENSE.html or http://www.07fly.net/html/business
* @author ：kfrs <goodkfrs@QQ.com> 574249366
* @version ：1.0
* @link ：http://www.07fly.xyz
*/

namespace app\install\logic;

use think\Db;

/**
 * 安装逻辑
 */
class Install
{
    
    /**
     * 检查安装数据
     */
    public function check($db = null, $admin = null)
    {
        
        // 检测管理员信息
        if (!is_array($admin) || empty($admin[0]) || empty($admin[1]) || empty($admin[3])) {

            return "请填写完整管理员信息";

        } else if ($admin[1] != $admin[2]) {

            return "确认密码和密码不一致";
        }
        
        // 检测数据库配置
        if (!is_array($db) || empty($db[0]) ||  empty($db[1]) || empty($db[2]) || empty($db[3])) {

            return "请填写完整的数据库配置";
        }
        
        return true;
    }
    
    /**
     * 安装
     */
    public function install($db = null, $admin = null)
    {
        
        $info = [];

        list($info['username'], $info['password'], $info['repassword'], $info['email']) = $admin;

        $db_config = [];

        list($db_config['type'], $db_config['hostname'], $db_config['database'], $db_config['username'], $db_config['password'],
             $db_config['hostport'], $db_config['prefix']) = $db;

        //创建数据库
        $dbname = $db_config['database'];

        $database_name = $db_config['database'];

        unset($db_config['database']);

        $db_object = Db::connect($db_config);

        $sql = "CREATE DATABASE IF NOT EXISTS `{$dbname}` DEFAULT CHARACTER SET utf8";

        if (!$db_object->execute($sql)) { return "创建数据库失败"; }

        //创建数据表
        $db_config['database'] = $database_name;

        $db_object_database = Db::connect($db_config);

        if (!create_tables($db_object_database, $db_config['prefix'])) { return "创建数据表失败"; }

        //注册超级帐号
        $auth  = build_auth_key();

        if (!register_administrator($db_object_database, $db_config['prefix'], $info, $auth)) { return "注册超级管理员失败"; }

        //创建配置文件
        if (!write_config($db_config, $auth)) { return "创建配置文件失败"; }
        
        return true;
    }
}
