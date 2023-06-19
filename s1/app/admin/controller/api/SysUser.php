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
 * 系统用户
 */
class SysUser extends AdminApiBase
{
    /**
     * 消息列表
     * @return mixed
     * Author: 开发人生 goodkfrs@qq.com
     * Date: 2022/7/23 0023 9:49
     */
    public function get_sys_user_sons(){

		$list = $this->logicSysUser->getSysUserSons1();
		return $this->apiReturn($list);
	}


}
