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

/**
 * 用户公告管理-控制器
 */
class SysNotifyUser extends AdminBase
{

	/**
	 * 用户公告列表=》模板
	 * @return mixed|string
	 */
	public function show()
	{
		return $this->fetch('show');
	}

	/**
	 * 用户公告列表-》json数据
	 * @return
	 */
	public function show_json()
	{

		$where = $this->logicSysNotifyUser->getWhere($this->param);
		$list = $this->logicSysNotifyUser->getSysNotifyUserList($where, 'a.*,n.name,n.content,n.create_user_id', 'a.id desc');
		return $list;
	}

	/**
	 * 用户公告编辑
	 * @return mixed|string
	 */

	public function detail()
	{
		$this->logicSysNotifyUser->sysNotifyUserRead($this->param);
		$info = $this->logicSysNotifyUser->getSysNotifyUserInfo(['a.id' => $this->param['id']]);
		$this->assign('info', $info);
		return $this->fetch('detail');
	}

	/**
	 * 用户公告标已经读
	 * @return mixed|string
	 */

	public function read()
	{
		IS_POST && $this->jump($this->logicSysNotifyUser->sysNotifyUserRead($this->param));
	}

	/**
	 * 用户公告删除
	 */
	public function del()
	{
		$where = empty($this->param['id']) ? ['id' => 0] : ['id' => $this->param['id']];
		$this->jump($this->logicSysNotifyUser->sysNotifyUserDel($where));
	}

}
