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

use app\admin\controller\api\AdminApiBase;

/**
 * 系统消息接口
 */
class SysAuth extends AdminApiBase
{

	// 授权过的菜单列表
	protected $authMenuList = [];

	// 授权过的菜单url列表
	protected $authMenuUrlList = [];


	public function sys_auth_access(){



		$user=decoded_user_token($this->param['user_token']);

		$userData=obj2arr($user['data']);

		// 获取授权菜单列表，=》根据开启的模块=》查询菜单
		$visibleModel=$this->logicSysModule->getSysModuleColumn(['visible'=>'1'],'name');

		$visibleModel[]='admin';//默认开启admin

		$this->authMenuList = $this->logicSysAuthAccess->getAuthMenuList($userData['id'],$visibleModel);

		// 获得权限菜单URL列表
		$list=$this->authMenuUrlList = $this->logicSysAuthAccess->getAuthMenuUrlList($this->authMenuList);

		//返回的数据
		return $this->apiReturn($list);

	}
}
