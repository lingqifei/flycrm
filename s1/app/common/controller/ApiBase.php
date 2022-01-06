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
