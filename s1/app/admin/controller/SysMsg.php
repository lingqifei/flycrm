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
class SysMsg extends AdminBase
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
	public function show_my()
	{
		return $this->fetch('show_my');
	}

	/**
	 * 消息列表
	 */
	public function show_json()
	{
		$where = $this->logicSysMsg->getWhere($this->param);
		$list = $this->logicSysMsg->getSysMsgList($where);
		return $list;
	}

	/**
	 * 营销活动添加
	 * @return mixed|string
	 */
	public function add()
	{
		IS_POST && $this->jump($this->logicSysMsg->sysMsgAdd($this->param));
		return $this->fetch('add');
	}

	/**
	 * 编辑
	 * @return mixed|string
	 */

	public function edit()
	{

		IS_POST && $this->jump($this->logicSysMsg->sysMsgEdit($this->param));

		$info = $this->logicSysMsg->getSysMsgInfo(['id' => $this->param['id']]);
		$this->assign('info', $info);

		return $this->fetch('edit');
	}

	/**
	 * 消息删除
	 */
	public function del()
	{
		$this->jump($this->logicSysMsg->sysMsgDel($this->param));
	}

	/**
	 * 启用
	 */
	public function set_visible()
	{
		$this->jump($this->logicAdminBase->setField('SysMsg', $this->param));
	}

	/**
	 * 标记处理
	 */
	public function set_deal()
	{
		$this->jump($this->logicSysMsg->sysMsgSetDeal($this->param));
	}

}
