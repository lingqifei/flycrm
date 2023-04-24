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

namespace app\admin\controller;

use think\db;

/**
 * 用户控制器
 */
class SysOrg extends AdminBase
{

	/**
	 * 菜单列表
	 */
	public function show()
	{
		return $this->fetch('show');
	}

	public function show_json()
	{
		$where = [];
		if (!empty($this->param['keywords'])) {
			$where['username|mobile|realname'] = ['like', '%' . $this->param['keywords'] . '%'];
		}
		$list = $this->logicSysOrg->getSysOrgList($where)->toArray();
		return $list;
	}


	/**
	 * 菜单添加
	 */
	public function add()
	{
		IS_POST && $this->jump($this->logicSysOrg->sysOrgAdd($this->param));

		return $this->fetch('add');
	}

	/**
	 * 系统用户编辑
	 */
	public function edit()
	{

		IS_POST && $this->jump($this->logicSysOrg->sysOrgEdit($this->param));

		$info = $this->logicSysOrg->getSysOrgInfo(['id' => $this->param['id']]);

		$this->assign('info', $info);

		return $this->fetch('edit');
	}

	/**
	 * 数据状态设置
	 */
	public function del()
	{
		$where = empty($this->param['id']) ? ['id' => 0] : ['id' => $this->param['id']];
		$this->jump($this->logicSysOrg->sysOrgDel($where));
	}

	/**
	 * 会员授权
	 */
	public function create_user()
	{

		IS_POST && $this->jump($this->logicSysOrg->create_user($this->param));

		$info = $this->logicSysOrg->getSysOrgInfo(['id' => $this->param['id']]);

		$this->assign('info', $info);

		return $this->fetch('create_user');
	}
}
