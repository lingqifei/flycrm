<?php
// +----------------------------------------------------------------------
// | 07FLYCRM [基于ThinkPHP5.0开发]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2021 http://www.07fly.xyz
// +----------------------------------------------------------------------
// | Professional because of focus  Persevering because of happiness
// +----------------------------------------------------------------------
// | Author: 开发人生 <goodkfrs@qq.com>
// +----------------------------------------------------------------------

namespace app\admin\logic;

use app\common\logic\LogicBase;

/**
 * Admin基础逻辑
 */
class AdminBase extends LogicBase
{
    /**
     * 获取过滤后的菜单树
     */
    public function getMenuTree($menu_list = [], $url_list = [])
    {
        foreach ($menu_list as $key => $menu_info) {
            list($status, $message) = $this->authCheck(strtolower($menu_info['url']), $url_list);
            [$message];
            //提取为菜单
            if ((!IS_ROOT && RESULT_ERROR == $status) || empty($menu_info['is_menu'])) {
                unset($menu_list[$key]);
            }
        }
        return $this->getListTree($menu_list);
    }

    /**
     * 获取列表树结构
     */
    public function getListTree($list = [])
    {
        if (is_object($list)) {
            $list = $list->toArray();
        }
        return list_to_tree(array_values($list), 'id', 'pid', 'child');
    }

    /**
     * 权限检测
     * url  当前访问的地址
     * url_list[] 当前授权地址数据
     */
    public function authCheck($url = '', $url_list = [])
    {
        $pass_data = [RESULT_SUCCESS, '权限检查通过'];
        //超管直接放行
        if (IS_ROOT) {
            return $pass_data;
        }

        //放行系统配置中允许通过的地址
        $allow_url = config('allow_url');
        $allow_url_list = parse_config_attr($allow_url);
        if (!empty($allow_url_list)) {
            foreach ($allow_url_list as $v) {
                if (!empty($v)) {
                    if (strpos(strtolower($v), strtolower($url)) !== false) {
                        return $pass_data;
                    }
                }
            }
        }

        //兼容配置文件允许的方法通过*****************************
        $allow_url_diy = config('allow_url_diy');
        $allow_url_list_diy = parse_config_attr($allow_url_diy);
        if (!empty($allow_url_list_diy)) {
            foreach ($allow_url_list_diy as $v) {
                if (!empty($v)) {
                    if (strpos(strtolower($v), strtolower($url)) !== false) {
                        return $pass_data;
                    }
                }
            }
        }

        //判断访问地址，是否存在授权地址数组中
        $result = in_array(strtolower($url), array_map("strtolower", $url_list)) ? true : false;

        !('index/index' == $url && !$result) ?: clear_login_session();

        return $result ? $pass_data : [RESULT_ERROR, '未授权操作,检查权限'];
    }


    /**
     * 通过完整URL获取检查标准URL
     * 注：这里地址必须为  /模块/控制器/方法
     */
    public function getCheckUrl($full_url = '')
    {
        // 去除项目基础URL部分（如 http://domain/admin/ -> 变为 user/edit）
        $temp_url = sr($full_url, URL_ROOT);

        // 去除GET参数部分（如 ?id=1）
        $path = parse_url($temp_url, PHP_URL_PATH);

        // 分割路径
        $url_array_tmp = explode(SYS_DS_PROS, $path);

        // 过滤掉空值
        $url_array_tmp = array_values(array_filter($url_array_tmp));

        // 获取控制器和方法的位置
        $controllerIndex = 0;
        $methodIndex = 1;

        // 如果定义了模块（非单模块模式），跳过模块名
        if (!defined('BIND_MODULE') || empty(BIND_MODULE)) {
            $controllerIndex = 1;
            $methodIndex = 2;
        }

        // 提取控制器和方法
        $controller = isset($url_array_tmp[$controllerIndex]) ? $url_array_tmp[$controllerIndex] : '';
        $method = isset($url_array_tmp[$methodIndex]) ? $url_array_tmp[$methodIndex] : '';

        // 去除方法中的后缀（如 .html）
        $dotPos = strpos($method, '.');
        if ($dotPos !== false) {
            $method = substr($method, 0, $dotPos);
        }
        $return_url = trim("$controller/$method", '/');

        // 组合返回值
        return $return_url;
    }

    /**
     * 过滤页面内容中无权限的链接标签 <lqf_link>...</lqf_link>
     * 根据权限判断是否显示或替换为禁止图标
     *
     * @param string $content 页面HTML内容
     * @param array $url_list 用户授权的URL列表
     * @return string 已过滤的内容
     */
    public function filter($content = '', $url_list = [])
    {
        // 匹配所有<lqf_link>标签内的内容
        preg_match_all('/<lqf_link\b[^>]*>(.*?)<\/lqf_link>/is', $content, $matches);
        $elements = $matches[0];

        // 已检查过的URL缓存，避免重复校验
        static $checkedUrls = [];

        foreach ($elements as $element) {
            // 提取 data-url 或 url 属性值
            if (preg_match('/(?:data-url|url)=(["\'])(.*?)(?:$1)/i', $element, $urlMatch)) {
                $full_url = $urlMatch[2];
                $checkUrl = $this->getCheckUrl($full_url);

                // 缓存已检查的URL，避免重复调用 authCheck
                if (!isset($checkedUrls[$checkUrl])) {
                    $checkedUrls[$checkUrl] = $this->authCheck($checkUrl, $url_list);
                }

                // 如果没有权限，替换为禁用图标
                if ($checkedUrls[$checkUrl][0] != RESULT_SUCCESS) {
                    $content = str_replace($element, '<i class="text-danger fa fa-power-off"></i>', $content);
                }
            }
        }

        return $content;
    }


    /**
     * 数据状态设置
     */
    public function setStatus($model = null, $param = null, $index = 'id')
    {
        if (empty($model) || empty($param)) {
            return [RESULT_ERROR, '非法操作'];
        }
        $status = (int)$param[DATA_STATUS_NAME];
        $model_str = LAYER_MODEL_NAME . $model;
        $obj = $this->$model_str;
        is_array($param['ids']) ? $ids = array_extract((array)$param['ids'], 'value') : $ids[] = (int)$param['ids'];
        $result = $obj->setFieldValue([$index => ['in', $ids]], DATA_STATUS_NAME, $status);
        $result && action_log('数据状态', '数据状态调整' . '，model：' . $model . '，ids：' . arr2str($ids) . '，status：' . $status);
        return $result ? [RESULT_SUCCESS, '操作成功'] : [RESULT_ERROR, $obj->getError()];
    }

    /**
     * 数据排序设置
     */
    public function setSort($model = null, $param = null)
    {
        $model_str = LAYER_MODEL_NAME . $model;
        $obj = $this->$model_str;
        $result = $obj->setFieldValue(['id' => (int)$param['id']], 'sort', (int)$param['value']);
        $result && action_log('数据排序', '数据排序调整' . '，model：' . $model . '，id：' . $param['id'] . '，value：' . $param['value']);
        return $result ? [RESULT_SUCCESS, '操作成功'] : [RESULT_ERROR, $obj->getError()];
    }

    /**
     * 数据设置
     */
    public function setField($model = null, $param = null)
    {
        $model_str = LAYER_MODEL_NAME . $model;
        $obj = $this->$model_str;
        $result = $obj->setFieldValue(['id' => $param['id']], $param['name'], $param['value']);
        $result && action_log('数据更新', '数据更新调整' . '，model：' . $model . '，id：' . $param['id'] . '，name：' . $param['name'] . '，value：' . $param['value']);
        return $result ? [RESULT_SUCCESS, '操作成功'] : [RESULT_ERROR, $obj->getError()];
    }

    /**
     * 获取首页数据
     */
    public function getIndexData()
    {
        $query = new \think\db\Query();
        $system_info_mysql = $query->query("select version() as v;");
        // 系统信息
        $data['lqf_version'] = SYS_VERSION;
        $data['think_version'] = THINK_VERSION;
        $data['os'] = PHP_OS;
        $data['software'] = $_SERVER['SERVER_SOFTWARE'];
        $data['mysql_version'] = $system_info_mysql[0]['v'];
        $data['upload_max'] = ini_get('upload_max_filesize');
        $data['php_version'] = PHP_VERSION;

        // 产品信息
        $data['product_name'] = '零起飞企业管理系统';
        $data['author'] = '零起飞';
        $data['website'] = 'www.07fly.xyz';
        $data['qun'] = '<a href="//shang.qq.com/wpa/qunwpa?idkey=b587b0c97d7a7e17b805c05f5c2e4aa1a2a16958edee01c2d5208ac675e6d4aa" target="_blank">575085787</a>';
        $data['document'] = '<a target="_blank" href="http://www.07fly.xyz">http://www.07fly.xyz</a>';
        return $data;
    }

    /**
     * 获取首页数据
     */
    public function getConfigData()
    {
        return $this->modelSysKey->getAuthConfigData();
    }
}
