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

/**
 * 授权逻辑
 */
class SysAuthAccess extends AdminBase
{

	/**
	 * 获得权限菜单列表
	 */
	public function getAuthMenuList($sys_user_id = 0,$model='')
	{

		$sort = 'sort';

		if (IS_ROOT) {
			$map=[];
			if(!empty($model)) $map['module']=['in',$model];
			return $this->logicSysMenu->getSysMenuList($map, true, $sort);
		}

		// 获取用户组列表
		$group_list = $this->getUserAuthInfo($sys_user_id);

		$menu_ids = [];

		foreach ($group_list as $group_info) {

			// 合并多个分组的权限节点并去重
			!empty($group_info['rules']) && $menu_ids = array_unique(array_merge($menu_ids, explode(',', trim($group_info['rules'], ','))));
		}

		//2019-12-11 新增加加用户单独权限设置
		$userinfo = session('sys_user_info');
		$menu_ids = array_unique(array_merge($menu_ids, explode(',', trim($userinfo['rules'], ','))));

		// 户单独权限设置************end

		if (empty($menu_ids))  return $menu_ids;// 若没有权限节点则返回空数组

		// 查询条件=>区别按模块
		$where['id'] = ['in', $menu_ids];
		if(!empty($model)) $where['module'] = ['in', $model];//判断模块是否开启
		return $this->logicSysMenu->getSysMenuList($where, true, $sort)->toArray();
	}

	/**
	 * 获得权限菜单URL列表
	 */
	public function getAuthMenuUrlList($auth_menu_list = [])
	{

		$auth_list = [];

		foreach ($auth_menu_list as $info) {
			$auth_list[] = $info['url'];
		}

		return $auth_list;
	}

	/**
	 * 获取会员所属权限组信息
	 */
	public function getUserAuthInfo($sys_user_id = 0)
	{

		$this->modelSysAuthAccess->alias('a');

		is_array($sys_user_id) ? $where['a.sys_user_id'] = ['in', $sys_user_id] : $where['a.sys_user_id'] = $sys_user_id;

        //移租户条件权限
        if(DATA_ORG_STATUS) $where['a.' . DATA_ORG_NAME] = ['>', 0];

		$field = 'a.sys_user_id, a.sys_auth_id, g.name, g.intro, g.rules';
		$join = [
			[SYS_DB_PREFIX . 'sys_auth g', 'a.sys_auth_id = g.id'],
		];
		$this->modelSysAuthAccess->join = $join;

		return $this->modelSysAuthAccess->getList($where, $field, '', false);
	}


    /**
     * 获取会员所属权限组名称
     * @param int $sys_user_id
     * @return string  角色1，角色2...,
     * Author: 开发人生 goodkfrs@qq.com
     * Date: 2022/6/25 0025 9:21
     */
    public function getUserAuthListName($sys_user_id = 0)
	{
        $where['sys_user_id'] = $sys_user_id;
        $auth_list= $this->modelSysAuthAccess->getColumn($where, 'sys_auth_id');
        $auth_name='';
        if($auth_list){
            $where2['id']=['in',$auth_list];
            $auth_name=$this->modelSysAuth->getColumn($where2, 'name');
            if($auth_name){
                $auth_name=arr2str($auth_name);
            }
        }
        return $auth_name;
	}


	/**
	 * 获取授权列表
	 */
	public function getSysAuthAccessList($where = [], $field = 'sys_user_id,sys_user_id', $order = 'sys_user_id', $paginate = false)
	{

		return $this->modelSysAuthAccess->getList($where, $field, $order, $paginate);
	}

}
