<?php
/**
 * 零起飞-(07FLY-CRM)
 * ==============================================
 * 版权所有 2015-2028   成都零起飞网络，并保留所有权利。
 * 网站地址: http://www.07fly.xyz
 * ----------------------------------------------------------------------------
 * 如果商业用途务必到官方购买正版授权, 以免引起不必要的法律纠纷.
 * ==============================================
 * Author: kfrs <goodkfrs@QQ.com> 574249366
 * Date: 2019-10-3
 */


use app\admin\logic\Log as LogicLog;

/**
 * 记录行为日志
 */
function action_log($name = '', $describe = '')
{

    $logLogic = get_sington_object('logLogic', LogicLog::class);
    
    $logLogic->logAdd($name, $describe);
}

/**
 * 清除登录 session
 */
function clear_login_session()
{
    session('sys_user_info',      null);
    session('sys_user_auth',      null);
    session('sys_user_auth_sign', null);
}

//得到把列表数据=》数形参数
if (!function_exists("list2tree")) {

    function list2tree($list, $pId = 0, $level = 0, $pk = 'id', $pidk = 'pid', $name = 'name')
    {
        $tree = [];
        foreach ($list as $k => $v) {
            if ($v[$pidk] == $pId) { //父亲找到儿子
                $v['nodes'] = list2tree($list, $v[$pk], $level + 1, $pk, $pidk, $name);
                $v['level'] = $level + 1;
                $v['treename'] = str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;', $level) . '|--' . $v[$name];
                $v['tags'] = $v['id'];
                $v['text'] = $v[$name];
                $tree[] = $v;
            }
        }
        return $tree;
    }
}

if (!function_exists("list2tree2menu")) {

    //得到把列表数据=》数形参数
    //导出为菜单格式
    function list2tree2menu($list, $pId = 0, $pk = 'id', $pidk = 'pid', $name = 'name')
    {
        $tree = [];
        $tmp=[];
        foreach ($list as $k => $v) {
            if ($v[$pidk] == $pId) { //父亲找到儿子
                $tmp['name']=$v['name'];
                $tmp['sort']=$v['sort'];
                $tmp['module']=$v['module'];
                $tmp['url']=$v['url'];
                $tmp['visible']=$v['visible'];
                $tmp['is_shortcut']=$v['is_shortcut'];
                $tmp['is_menu']=$v['is_menu'];
                $tmp['icon']=$v['icon'];
                $tmp['url']=$v['url'];
                $tmp['nodes'] = list2tree2menu($list, $v[$pk], $pk, $pidk, $name);
                $tree[] = $tmp;
            }
        }
        return $tree;
    }
}

if (!function_exists("list2select")) {

    /**r把列表数据转为树形下拉
     * @param $list
     * @param int $pId
     * @param int $level
     * @param string $pk
     * @param string $pidk
     * @param string $name
     * @return array|string
     * Author: lingqifei created by at 2020/4/1 0001
     */
    function list2select($list, $pId = 0, $level = 0, $pk = 'id', $pidk = 'pid', $name = 'name',$data=[])
    {
        foreach ($list as $k => $v) {
            $v['treename'] = str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;', $level) . '|--' . $v[$name];
            if ($v[$pidk] == $pId) { //父亲找到儿子
                $data[] =$v;
                $data   = list2select($list, $v[$pk], $level + 1, $pk, $pidk, $name,$data);
            }
        }
        return $data;
    }
}

if (!function_exists('parse_sql')) {
    /**
     * 解析sql语句
     * @param  string $content sql内容
     * @param  int $limit  如果为1，则只返回一条sql语句，默认返回所有
     * @param  array $prefix 替换表前缀
     * @return array|string 除去注释之后的sql语句数组或一条语句
     */
    function parse_sql($sql = '', $limit = 0, $prefix = []) {
        // 被替换的前缀
        $from = '';
        // 要替换的前缀
        $to = '';

        // 替换表前缀
        if (!empty($prefix)) {
            $to   = current($prefix);
            $from = current(array_flip($prefix));
        }

        if ($sql != '') {
            // 纯sql内容
            $pure_sql = [];

            // 多行注释标记
            $comment = false;

            // 按行分割，兼容多个平台
            $sql = str_replace(["\r\n", "\r"], "\n", $sql);
            $sql = explode("\n", trim($sql));

            // 循环处理每一行
            foreach ($sql as $key => $line) {
                // 跳过空行
                if ($line == '') {
                    continue;
                }

                // 跳过以#或者--开头的单行注释
                if (preg_match("/^(#|--)/", $line)) {
                    continue;
                }

                // 跳过以/**/包裹起来的单行注释
                if (preg_match("/^\/\*(.*?)\*\//", $line)) {
                    continue;
                }

                // 多行注释开始
                if (substr($line, 0, 2) == '/*') {
                    $comment = true;
                    continue;
                }

                // 多行注释结束
                if (substr($line, -2) == '*/') {
                    $comment = false;
                    continue;
                }

                // 多行注释没有结束，继续跳过
                if ($comment) {
                    continue;
                }

                // 替换表前缀
                if ($from != '') {
                    $line = str_replace('`'.$from, '`'.$to, $line);
                }
                if ($line == 'BEGIN;' || $line =='COMMIT;') {
                    continue;
                }
                // sql语句
                array_push($pure_sql, $line);
            }

            // 只返回一条语句
            if ($limit == 1) {
                return implode($pure_sql, "");
            }

            // 以数组形式返回sql语句
            $pure_sql = implode($pure_sql, "\n");
            $pure_sql = explode(";\n", $pure_sql);
            return $pure_sql;
        } else {
            return $limit == 1 ? '' : [];
        }
    }
}


if (!function_exists('isJson')) {

    /**
    * 判断字符串是否为 Json 格式
    *
    * @param string $data Json 字符串
    * @param bool $assoc 是否返回关联数组。默认返回对象
    *
    * @return array|bool|object 成功返回转换后的对象或数组，失败返回 false
    */
    function isJson($data = '', $assoc = false) {
        $data = json_decode($data, $assoc);
        if (($data && is_object($data)) || (is_array($data) && !empty($data))) {
            return $data;
        }
        return false;
    }
}



