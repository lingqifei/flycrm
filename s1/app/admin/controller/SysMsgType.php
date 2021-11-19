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
