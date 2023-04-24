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
 * 系统消息
 */
class SysMsgType extends AdminBase
{

	/**
	 * 消息列表
	 */
	public function show()
	{
		return $this->fetch('show');
	}

	/**
	 * 消息列表
	 */
	public function show_json()
	{
		$where = $this->logicSysMsgType->getWhere($this->param);
		$list = $this->logicSysMsgType->getSysMsgTypeList($where);
		return $list;
	}

	/**
	 * 营销活动添加
	 * @return mixed|string
	 */
	public function add()
	{
		IS_POST && $this->jump($this->logicSysMsgType->sysMsgTypeAdd($this->param));
		return $this->fetch('add');
	}

	/**
	 * 编辑
	 * @return mixed|string
	 */

	public function edit()
	{
		IS_POST && $this->jump($this->logicSysMsgType->sysMsgTypeEdit($this->param));

		$info = $this->logicSysMsgType->getSysMsgTypeInfo(['id' => $this->param['id']]);
		$this->assign('info', $info);

		return $this->fetch('edit');
	}

	/**
	 * 消息删除
	 */
	public function del($id = 0)
	{
		$this->jump($this->logicSysMsgType->sysMsgTypeDel(['id' => $id]));
	}

	/**
	 * 启用
	 */
	public function set_visible()
	{
		$this->jump($this->logicAdminBase->setField('SysMsgType', $this->param));
	}

	/**
	 * 扫描提醒中的业务到
	 */
	public function scanbus()
	{
		$this->logicSysMsgType->sysMsgTypeScan();
	}

}
