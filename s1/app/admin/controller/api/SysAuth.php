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


    /**获得授权菜单列表
     * @return mixed
     * Author: 开发人生 goodkfrs@qq.com
     * Date: 2022/7/25 0025 11:15
     */
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
