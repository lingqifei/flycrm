<?php
/*
*
* crm.rpc.RpcBase  crm内部接口 = 客户管理
*
* =========================================================
* 零起飞网络 - 专注于网站建设服务和行业系统开发
* 以质量求生存，以服务谋发展，以信誉创品牌 !
* ----------------------------------------------
* @copyright	Copyright (C) 2017-2018 07FLY Network Technology Co,LTD (www.07FLY.com) All rights reserved.
* @license    For licensing, see LICENSE.html or http://www.07fly.xyz/crm/license
* @author ：kfrs <goodkfrs@QQ.com> 574249366
* @version ：1.0
* @link ：http://www.07fly.xyz
*/
namespace app\admin\controller\api;

use app\common\controller\ApiBase;
use think\Hook;

/**
 * 后台基类控制器
 */
class Login extends ApiBase
{

	/**
	 * 基类初始化
	 */
	public function __construct()
	{

		parent::__construct();

		$this->logicApiBase->checkAccessToken($this->param);//下放到具体模块只使用

		// 接口控制器钩子
		Hook::listen('hook_controller_api_base', $this->request);

		debug('api_begin');
	}

	public function login(){
		$info = $this->logicLogin->loginHandleToApi($this->param);
		return $this->apiReturn($info);
	}

    /**
     * 注销登录
     */
    public function logout()
    {

        $result=$this->logicLogin->logout();

        return $this->apiReturn($result);
    }

}
