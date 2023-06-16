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
	 * 通过完整URL获取检查标准URL
     * 注：这里地址必须为  /模块/控制器/方法
	 */
	public function getCheckUrl($full_url = '')
	{

		$temp_url = sr($full_url, URL_ROOT);

		$url_array_tmp = explode(SYS_DS_PROS, $temp_url);

		//解析出的地址为
        /*
            $url_array_tmp=array(4) {
            [0] => string(0) ""
            [1] => string(5) "admin"
            [2] => string(9) "SysModule"
            [3] => string(11) "upload.html"
            }
        */

		//获得真地址
		$subscript = 1;
		if(empty($url_array_tmp[0])) $subscript=1;
		!defined('BIND_MODULE') && $subscript++;
		$return_url = $url_array_tmp[$subscript] . SYS_DS_PROS . $url_array_tmp[++$subscript];

		//$return_url = $url_array_tmp[1] . SYS_DS_PROS . $url_array_tmp[2]. SYS_DS_PROS . $url_array_tmp[3];
		$index = strpos($return_url, '.');

		$index !== false && $return_url = substr($return_url, DATA_DISABLE, $index);

		return $return_url;
	}

	/**
	 * 过滤页面内容权限地方，不存在权限直接过滤掉
	 */
	public function filter($content = '', $url_list = [])
	{

		$results = [];

		preg_match_all('/<lqf_link>.*?[\s\S]*?<\/lqf_link>/', $content, $results);
		foreach ($results[0] as $a) {

			$match_results = [];

			preg_match_all('/data-url="(.+?)"|url="(.+?)"/', $a, $match_results);

			$full_url = '';
			if (empty($match_results[1][0]) && empty($match_results[2][0])) {
				continue;
			} elseif (!empty($match_results[1][0])) {
				$full_url = $match_results[1][0];
			} else {
				$full_url = $match_results[2][0];
			}

			//正则到内容在的地址，判断是否有权限
			if (!empty($full_url)) {
				$url = $this->getCheckUrl($full_url);
				$result = $this->authCheck($url, $url_list);
				$result[0] != RESULT_SUCCESS && $content = sr($content, $a, '<i class="text-danger fa fa-power-off"></i>');
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
		$auth = $this->logicUpgrade->upgrade_auth_check();
//        $auth['code'] = 1;
		if ($auth['code'] == 1) {
			$data['seo_title'] = config('seo_title');
			$data['seo_description'] = config('seo_description');
			$data['seo_keywords'] = config('seo_keywords');
			$data['login_title'] = config('login_title');
			$data['login_desc'] = config('login_desc');
			$data['login_demo'] = config('login_demo');
			$data['login_copyright'] = config('login_copyright');
			$data['main_title'] = config('main_title');
			$data['main_weburl'] = config('main_weburl');
			$data['top_links'] = '';
            $data['top_links_right']='';
			$data['is_grant'] = 0;
		} else {
			$data['seo_title'] = '07FLY-ERP是一款开放式的管理平台，能快速搭建适合自己的是一款开放式的管理平台-零起飞科技';
			$data['seo_description'] = '07FLY-ERP是一款开放式的管理平台，能容纳管理各种数据、实现信息互通共享；能快速搭建适合自己的是一款开放式的管理平台，能容纳管理各种数据、实现信息互通共享；';
			$data['seo_keywords'] = 'CMS（会员中心）、办工OA、客户CRM、进销ERP、财务管理FMS、项目管理PMS';
			$data['login_title'] = '零起飞企业管理系统';
			$data['login_desc'] = '软件集ERP、CRM、OA在线办公等主要功能，PC和手机端一体化管理';
			$data['login_demo'] = '<font color="red">演示帐号/密码：admin/123456</font>';
			$data['login_copyright'] = '<a href="http://www.07fly.xyz">技术支持:零起飞网络</a>';
			$data['main_title'] = '零起飞网络中心';
			$data['main_weburl'] = 'http://www.07fly.xyz/';
			$data['top_links'] = '
					<a href="http://v1.07fly.xyz/" target="_blank" title="07FLY-CRM开源系统V1版本">V1版本</a>
                    <a href="http://v2.07fly.xyz/" target="_blank" title="07FLY-CRM开源系统V2版本">V2版本</a>
                    <a href="http://erp.07fly.xyz/" target="_blank" title="07FLY-ERP企业管理系统">S1版本</a>
                    <a href="http://djt.07fly.xyz/" target="_blank" title="旅行社ERP管理软件地接版">地接通</a>
                  ';
            $data['top_links_right']  = '<li><a href="'.url('admin/Store/apps').'" class="J_menuItem" target="_blank"><i class="fa fa-fire"></i>应用</a></li>';
            $data['top_links_right'] .= '<li><a href="http://http.07fly.xyz/" target="_blank" title="零起飞网络">官网</a></li>';
            $data['is_grant'] = 1;
		}
		$data['document'] = '<a target="_blank" href="http://www.07fly.xyz">http://www.07fly.xyz</a>';
		return $data;
	}
}
