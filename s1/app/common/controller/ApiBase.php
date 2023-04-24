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


namespace app\common\controller;
use think\Hook;
/**
 * 插件控制器基类
 */
class ApiBase extends ControllerBase
{

	/**
	 * 基类初始化
	 */
	public function __construct()
	{

		parent::__construct();

		//$this->logicApiBase->checkUserTokenParam($this->param);//下放到具体模块只使用

        //$this->initRequestInfo();

		// 接口控制器钩子
		Hook::listen('hook_controller_api_base', $this->request);

		debug('api_begin');
	}

	/**
	 * API返回数据
	 */
	public function apiReturn($code_data = [], $return_data = [], $return_type = 'json')
	{

		debug('api_end');

		$result = $this->logicApiBase->apiReturn($code_data, $return_data, $return_type);

		return $result;
	}
	
}
