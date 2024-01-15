<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件

/**
 * 应用公共（函数）文件
 */

use think\Db;
use think\Response;
use think\Session;
use think\exception\HttpResponseException;
use app\common\logic\File as LogicFile;


// +---------------------------------------------------------------------+
// | 系统相关函数
// +---------------------------------------------------------------------+

/**
 * 检测用户是否登录
 * @return integer 0-未登录，大于0-当前登录用户ID
 */
function is_login()
{
    $member = session('sys_user_auth');
    if (empty($member)) {
        return DATA_DISABLE;
    } else {
        return session('sys_user_auth_sign') == data_auth_sign($member) ? $member['sys_user_id'] : DATA_DISABLE;
    }
}

/*
* 检测用户是的组织机构ID
* @return integer 0-未登录，大于0-当前登录用户组织ORG_ID
*/
function is_org_id()
{
    $member = session('sys_user_info');
    $org = session('sys_org_info');

    if (empty($member)) {
        return DATA_DISABLE;
    } else {
        $rtn = ($member['username'] == $org['username']) ? $member['id'] : DATA_DISABLE;
        return $rtn;
    }
}

/*
* 检测用户是的组织机构ID
* @return integer 0-未登录，大于0-当前登录用户组织ORG_ID
*/
function get_org_id()
{
    $member = session('sys_user_auth');

    if (empty($member)) {
        return DATA_DISABLE;
    } else {
        return session('sys_user_auth_sign') == data_auth_sign($member) ? $member['sys_org_id'] : DATA_DISABLE;
    }
}

/*
* 检测用户是的组织机构ID
* @return integer 0-未登录，大于0-当前登录用户ID
*/
function get_org_info()
{
    $org = session('sys_org_info');
    return $org;
}


/**
 * 系统非常规MD5加密方法
 * @param string $str 要加密的字符串
 * @return string
 */
function data_md5($str, $key = 'lingqifei')
{
    return '' === $str ? '' : md5(sha1($str) . $key);
}

/**
 * 使用上面的函数与系统加密KEY完成字符串加密
 * @param string $str 要加密的字符串
 * @return string
 */
function data_md5_key($str, $key = '')
{

    if (is_array($str)) {

        ksort($str);

        $data = http_build_query($str);

    } else {

        $data = (string)$str;
    }

    return empty($key) ? data_md5($data, SYS_ENCRYPT_KEY) : data_md5($data, $key);
}

/**
 * 数据签名认证
 * @param array $data 被认证的数据
 * @return string       签名
 */
function data_auth_sign($data)
{

    // 数据类型检测
    if (!is_array($data)) {

        $data = (array)$data;
    }

    // 排序
    ksort($data);

    // url编码并生成query字符串
    $code = http_build_query($data);

    // 生成签名
    $sign = sha1($code);

    return $sign;
}

/**
 * 检测当前用户是否为管理员
 * @return boolean true-管理员，false-非管理员
 */
function is_administrator($sys_user_id = null)
{

    $return_id = is_null($sys_user_id) ? is_login() : $sys_user_id;

    return $return_id && (intval($return_id) === SYS_ADMINISTRATOR_ID);
}

/**
 * 获取单例对象
 */
function get_sington_object($object_name = '', $class = null)
{

    $request = request();

    $request->__isset($object_name) ?: $request->bind($object_name, new $class());

    return $request->__get($object_name);
}

/**
 * 获取插件类的类名
 * @param strng $name 插件名
 */
function get_addon_class($name = '')
{

    $lower_name = strtolower($name);

    $class = SYS_ADDON_DIR_NAME . SYS_DS_CONS . $lower_name . SYS_DS_CONS . $name;

    return $class;
}

/**
 * 钩子
 */
function hook($tag = '', $params = [])
{

    \think\Hook::listen($tag, $params);
}

/**
 * 插件显示内容里生成访问插件的url
 * @param string $url url
 * @param array $param 参数
 */
function addons_url($url, $param = array())
{
    $parse_url = parse_url($url);
    $addons = $parse_url['scheme'];
    $controller = $parse_url['host'];
    $action = $parse_url['path'];

    if (empty($param['addons_model'])) {
        $model = 'admin';
    } else {
        $model = $param['addons_model'];
    }

    /* 基础参数 */
    $params_array = array(
        'addon_name' => $addons,
        'controller_name' => $controller,
        'action_name' => substr($action, 1),
    );

    $params = array_merge($params_array, $param); //添加额外参数

    //默认指向admin模块
    return url($model . '/addon/execute', $params);
}

/**
 * 插件对象注入
 */
function addon_ioc($this_class, $name, $layer)
{

    !str_prefix($name, $layer) && exception('逻辑与模型层引用需前缀:' . $layer);

    $class_arr = explode(SYS_DS_CONS, get_class($this_class));

    $sr_name = sr($name, $layer);

    $class_logic = SYS_ADDON_DIR_NAME . SYS_DS_CONS . $class_arr[DATA_NORMAL] . SYS_DS_CONS . $layer . SYS_DS_CONS . $sr_name;

    return get_sington_object(SYS_ADDON_DIR_NAME . '_' . $layer . '_' . $sr_name, $class_logic);
}

/**
 * 抛出响应异常
 */
function throw_response_exception($data = [], $type = 'json')
{

    $response = Response::create($data, $type);

    throw new HttpResponseException($response);
}

/**
 * 抛出响应异常
 */
function throw_response_error($msg = '', $code = '0')
{
    $data = ['code' => $code, 'msg' => $msg];
    throw_response_exception($data);
}

/**
 * 获取访问token
 */
function get_access_token()
{

    return md5('LingQiFei' . API_KEY);
}

/**
 * 格式化字节大小
 * @param number $size 字节数
 * @param string $delimiter 数字和单位分隔符
 * @return string            格式化后的带单位的大小
 */
function format_bytes($size, $delimiter = '')
{

    $units = array('B', 'KB', 'MB', 'GB', 'TB', 'PB');

    for ($i = 0; $size >= 1024 && $i < 5; $i++) {
        $size /= 1024;
    }

    return round($size, 2) . $delimiter . $units[$i];
}


// +---------------------------------------------------------------------+
// | 数组相关函数
// +---------------------------------------------------------------------+

/**
 * 把返回的数据集转换成Tree
 * @param array $list 要转换的数据集
 * @param string $pid parent标记字段
 * @param string $level level标记字段
 * @return array
 */
function list_to_tree($list, $pk = 'id', $pid = 'pid', $child = '_child', $root = 0)
{

    // 创建Tree
    $tree = [];

    if (!is_array($list)) {

        return false;
    }

    // 创建基于主键的数组引用
    $refer = [];

    foreach ($list as $key => $data) {

        $refer[$data[$pk]] =& $list[$key];
    }

    foreach ($list as $key => $data) {

        // 判断是否存在parent
        $parentId = $data[$pid];

        if ($root == $parentId) {

            $tree[] =& $list[$key];

        } else if (isset($refer[$parentId])) {

            is_object($refer[$parentId]) && $refer[$parentId] = $refer[$parentId]->toArray();

            $parent =& $refer[$parentId];

            $parent[$child][] =& $list[$key];
        }
    }

    return $tree;
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
    function list2select($list, $pId = 0, $level = 0, $pk = 'id', $pidk = 'pid', $name = 'name', $data = [])
    {
        foreach ($list as $k => $v) {
            $v['treename'] = str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;', $level) . '|--' . $v[$name];
            if ($v[$pidk] == $pId) { //父亲找到儿子
                $data[] = $v;
                $data = list2select($list, $v[$pk], $level + 1, $pk, $pidk, $name, $data);
            }
        }
        return $data;
    }
}

/**
 * 分析数组及枚举类型配置值 格式 a:名称1,b:名称2
 * @return array
 */
function parse_config_attr($string)
{

    $array = preg_split('/[,;\r\n]+/', trim($string, ",;\r\n"));

    if (strpos($string, ':')) {

        $value = [];

        foreach ($array as $val) {

            list($k, $v) = explode(':', $val);

            $value[$k] = $v;
        }

    } else {

        $value = $array;
    }

    return $value;
}

/**
 * 解析数组配置
 */
function parse_config_array($name = '')
{

    return parse_config_attr(config($name));
}

/**
 * 将二维数组数组按某个键提取出来组成新的索引数组
 */
function array_extract($array = [], $key = 'id')
{

    $count = count($array);

    $new_arr = [];

    for ($i = 0; $i < $count; $i++) {

        if (!empty($array) && !empty($array[$i][$key])) {

            $new_arr[] = $array[$i][$key];
        }
    }

    return $new_arr;
}

/**
 * 根据某个字段获取关联数组
 */
function array_extract_map($array = [], $key = 'id')
{


    $count = count($array);

    $new_arr = [];

    for ($i = 0; $i < $count; $i++) {

        $new_arr[$array[$i][$key]] = $array[$i];
    }

    return $new_arr;
}

/**
 * 页面数组提交后格式转换
 */
function transform_array($array)
{

    $new_array = array();
    $key_array = array();

    foreach ($array as $key => $val) {

        $key_array[] = $key;
    }

    $key_count = count($key_array);

    foreach ($array[$key_array[0]] as $i => $val) {

        $temp_array = array();

        for ($j = 0; $j < $key_count; $j++) {

            $key = $key_array[$j];
            $temp_array[$key] = $array[$key][$i];
        }

        $new_array[] = $temp_array;
    }

    return $new_array;
}

/**
 * 页面数组转换后的数组转json
 */
function transform_array_to_json($array)
{

    return json_encode(transform_array($array));
}

/**
 * 关联数组转索引数组
 */
function relevance_arr_to_index_arr($array)
{

    $new_array = [];

    foreach ($array as $v) {

        $temp_array = [];

        foreach ($v as $vv) {
            $temp_array[] = $vv;
        }

        $new_array[] = $temp_array;
    }

    return $new_array;
}

/**
 * 数组转换为字符串，主要用于把分隔符调整到第二个参数
 * @param array $arr 要连接的数组
 * @param string $glue 分割符
 * @return string
 */
function arr2str($arr, $glue = ',')
{

    return implode($glue, $arr);
}

/**
 * 数组转字符串二维
 * @param array $arr 要连接的数组
 * @param string $glue 分割符
 * @return string
 */
function arr22str($arr)
{

    $t = '';
    $temp = [];
    foreach ($arr as $v) {
        $v = join(",", $v);
        $temp[] = $v;
    }
    foreach ($temp as $v) {
        $t .= $v . ",";
    }
    $t = substr($t, 0, -1);
    return $t;
}


if (!function_exists('get_arr_column')) {
    /**
     * 获取数组中的某一列
     *
     * @param array $arr 数组
     * @param string $key_name 列名
     * @return array  返回那一列的数组
     */
    function get_arr_column($arr, $key_name)
    {
        if (function_exists('array_column')) {
            return array_column($arr, $key_name);
        }

        $arr2 = array();
        foreach ($arr as $key => $val) {
            $arr2[] = $val[$key_name];
        }
        return $arr2;
    }
}


// +---------------------------------------------------------------------+
// | 字符串相关函数
// +---------------------------------------------------------------------+

/**
 * 字符串转换为数组，主要用于把分隔符调整到第二个参数
 * @param string $str 要分割的字符串
 * @param string $glue 分割符
 * @return array
 */
function str2arr($str, $glue = ',')
{

    return explode($glue, $str);
}

/**
 * 字符串替换
 */
function sr($str = '', $target = '', $content = '')
{

    return str_replace($target, $content, $str);
}

/**
 * 字符串前缀验证
 */
function str_prefix($str, $prefix)
{

    return strpos($str, $prefix) === DATA_DISABLE ? true : false;
}

// +---------------------------------------------------------------------+
// | 文件相关函数
// +---------------------------------------------------------------------+

/**
 * 获取目录下所有文件
 */
function file_list($path = '')
{

    $file = scandir($path);

    foreach ($file as $k => $v) {

        if (is_dir($path . SYS_DS_PROS . $v)) {

            unset($file[$k]);
        }
    }

    return array_values($file);
}

/**
 * 获取目录列表
 */
function get_dir($dir_name)
{

    $dir_array = [];

    if (false != ($handle = opendir($dir_name))) {

        $i = 0;

        while (false !== ($file = readdir($handle))) {

            if ($file != "." && $file != ".." && !strpos($file, ".")) {

                $dir_array[$i] = $file;

                $i++;
            }
        }

        closedir($handle);
    }

    return $dir_array;
}

/**
 * 获取文件根目录
 */
function get_file_root_path()
{

    $root_arr = explode(SYS_DS_PROS, URL_ROOT);

    array_pop($root_arr);

    $root_url = arr2str($root_arr, SYS_DS_PROS);

    return $root_url . SYS_DS_PROS;
}

/**
 * 获取图片url=》根据picture id
 */
function get_picture_url($id = 0, $member = 'picture')
{

    $fileLogic = get_sington_object('fileLogic', LogicFile::class);

    if (is_numeric($id)) {
        return $fileLogic->getPictureUrl($id, $member);
    } else {
        //1、表示为多张图的id 如：1，2，3，4
        if (strpos($id, '/') === false) {

            return $fileLogic->getPictureUrl($id, $member);

        } else if (strpos($id, 'http') === 0) {//表示外网路路不要转换 如：http://www.07fly.com/upload/img/demo.jpg

            return $id;

        } else if (strpos($id, '/') === 0) {//表示路径为绝对路路不要转换 如：/upload/img/demo.jpg

            return $id;

        } else {//表示为相对路径：imgaes/demo.jpg

            return $fileLogic->getPictureWebUrl($id);

        }
    }
}


/**
 * 获取图片url=>根据地址
 */
function get_picture_url2($path = '')
{

    $fileLogic = get_sington_object('fileLogic', LogicFile::class);

    return $fileLogic->getPictureWebUrl($path);
}

/**
 * 获取文件url=>根据 file id
 */
function get_file_url($id = 0)
{

    $fileLogic = get_sington_object('fileLogic', LogicFile::class);

    if (is_numeric($id)) {

        return $fileLogic->getFileUrl($id);

    } else {
        //文件路径
        if (strpos($id, '/') === false) {

            return $fileLogic->getFileUrl($id);

        } else {//文件编号 1,2,..n

            return $fileLogic->getFileWebUrl($id);

        }
    }
}

/**
 * 获取文件url=>根据 file url
 */
function get_file_url2($path = '')
{

    $fileLogic = get_sington_object('fileLogic', LogicFile::class);

    return $fileLogic->getFileWebUrl($path);
}


/**
 * 下载内容中图片
 */
function get_picture_body($body = '')
{

    $fileLogic = get_sington_object('fileLogic', LogicFile::class);

    return $fileLogic->pictureDown($body);
}

/**
 * 删除所有空目录
 * @param String $path 目录路径
 */
function rm_empty_dir($path)
{

    if (!(is_dir($path) && ($handle = opendir($path)) !== false)) {

        return false;
    }

    while (($file = readdir($handle)) !== false) {

        if (!($file != '.' && $file != '..')) {

            continue;
        }

        $curfile = $path . SYS_DS_PROS . $file;// 当前目录

        if (!is_dir($curfile)) {

            continue;
        }

        rm_empty_dir($curfile);

        if (count(scandir($curfile)) == 2) {

            rmdir($curfile);
        }
    }

    closedir($handle);
}


// +---------------------------------------------------------------------+
// | 时间相关函数
// +---------------------------------------------------------------------+

/**
 * 时间戳格式化
 * @param int $time
 * @return string 完整的时间显示
 */
function format_time($time = null, $format = 'Y-m-d H:i:s')
{
    if (null === $time || empty($time)) {
        $time = TIME_NOW;
    }
    if(!is_numeric($time)){
        $time=strtotime($time);
    }
    return date($format, intval($time));
}

/**
 * 获取指定日期段内每一天的日期
 * @param Date $startdate 开始日期
 * @param Date $enddate 结束日期
 * @return Array
 */
function get_date_from_range($startdate, $enddate)
{
    $stimestamp = strtotime($startdate);
    $etimestamp = strtotime($enddate);
    // 计算日期段内有多少天
    $days = ($etimestamp - $stimestamp) / 86400 + 1;
    // 保存每天日期
    $date = [];
    for ($i = 0; $i < $days; $i++) {
        $date[] = date('Y-m-d', $stimestamp + (86400 * $i));
    }
    return $date;
}

// +---------------------------------------------------------------------+
// | 调试函数
// +---------------------------------------------------------------------+

/**
 * 将数据保存为PHP文件，用于调试
 */
function sf($arr = [], $fpath = './test.php')
{

    $data = "<?php\nreturn " . var_export($arr, true) . ";\n?>";

    file_put_contents($fpath, $data);
}

/**
 * dump函数缩写
 */
function d($arr = [])
{
    dump($arr);
}

/**
 * dump与die组合函数缩写
 */
function dd($arr = [])
{
    dump($arr);
    die;
}

/**
 * 日志输出保存函数
 */
function dlog($var, $file = 'dlog.txt', $label = null, $flags = ENT_SUBSTITUTE)
{
    $fpath = RUNTIME_PATH . $file;
    $label = (null === $label) ? '' : rtrim($label) . ':';
    ob_start();
    var_dump($var);
    $output = ob_get_clean();
    $output = preg_replace('/\]\=\>\n(\s+)/m', '] => ', $output);
    if (IS_CLI) {
        $output = PHP_EOL . $label . $output . PHP_EOL;
    } else {
        if (!extension_loaded('xdebug')) {
            $output = htmlspecialchars($output, $flags);
        }
        $output = $label . $output;
    }
    $output = "\r\n" . $output . "\r\n";
    file_put_contents($fpath, date('Y-m-d H:i:s') . ' ' . 'pid:' . $output, FILE_APPEND | LOCK_EX);
}

// +---------------------------------------------------------------------+
// | 其他函数
// +---------------------------------------------------------------------+

/**
 * 通过类创建逻辑闭包
 */
function create_closure($object = null, $method_name = '', $parameter = [])
{

    $func = function () use ($object, $method_name, $parameter) {

        return call_user_func_array([$object, $method_name], $parameter);
    };

    return $func;
}

/**
 * 通过闭包控制缓存
 */
function auto_cache($key = '', $func = null, $time = 3)
{

    $result = cache($key);

    if (empty($result)) {

        $result = $func();

        !empty($result) && cache($key, $result, $time);
    }

    return $result;
}

/**
 * 通过闭包列表控制事务
 */
function closure_list_exe($list = [])
{

    Db::startTrans();

    try {

        foreach ($list as $closure) {

            $closure();
        }

        Db::commit();

        return true;
    } catch (\Exception $e) {

        Db::rollback();

        throw $e;
    }
}

/**
 * 自动封装事务
 */
function trans($parameter = [], $callback = null)
{

    try {

        Db::startTrans();

        $backtrace = debug_backtrace(false, 2);

        array_shift($backtrace);

        $class = $backtrace[0]['class'];

        $result = (new $class())->$callback($parameter);

        Db::commit();

        return $result;

    } catch (Exception $ex) {

        Db::rollback();

        throw new Exception($ex->getMessage());
    }
}

/**
 * 更新缓存版本
 */
function update_cache_version($obj = null)
{

    $lqf_auto_cache = cache('lqf_auto_cache');

    if (is_string($obj)) {
        $lqf_auto_cache[$obj]['version']++;
    } else {
        !empty($lqf_auto_cache[$obj->getTable()]['version']) && $lqf_auto_cache[$obj->getTable()]['version']++;
    }

    cache('lqf_auto_cache', $lqf_auto_cache);
}

//api签名函数
use \Firebase\JWT\JWT;

// 解密user_token
function decoded_user_token($token = '')
{
    vendor('firebase/php-jwt/src/JWT');
    try {
        $decoded = JWT::decode($token, API_KEY . JWT_KEY, array('HS256'));
        return (array)$decoded;
    } catch (Exception $ex) {
        return $ex->getMessage();
    }
}

//获取解密信息中的data
function get_member_by_token($token = '')
{
    $result = decoded_user_token($token);
    return $result['data'];
}

// 数据验签时数据字段过滤
function sign_field_filter($data = [])
{
    $data_sign_filter_field_array = config('data_sign_filter_field');
    foreach ($data_sign_filter_field_array as $v) {
        if (array_key_exists($v, $data)) {
            unset($data[$v]);
        }
    }
    return $data;
}

// 过滤后的数据生成数据签名
function create_sign_filter($data = [], $key = '')
{
    $filter_data = sign_field_filter($data);
    return empty($key) ? data_md5_key($filter_data, API_KEY) : data_md5_key($filter_data, $key);
}

//签名注册
function encoded_user_token($param)
{
    $key = API_KEY . JWT_KEY;
    $jwt_data = [
        'id' => $param['id'],
        'org_id' => $param['org_id'],
        'username' => $param['username'],
        'create_time' => $param['create_time']
    ];
    $token = [
        "iss" => "lingqifei JWT",         // 签发者
        "iat" => TIME_NOW,              // 签发时间
        "exp" => TIME_NOW + 30*24*3600,   // 过期时间
        "aud" => 'lingqifei',             // 接收方
        "sub" => 'lingqifei',             // 面向的用户
        "data" => $jwt_data
    ];
    vendor('firebase/php-jwt/src/JWT');
    $jwt = JWT::encode($token, $key);
    $jwt_data['user_token'] = $jwt;
    return $jwt_data;
}