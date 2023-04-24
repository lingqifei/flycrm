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
class SysMsg extends AdminBase
{

	/**
	 * 消息列表
	 */
	public function show()
	{

        $type_list=$this->logicSysMsgType->getSysMsgTypeList('','','',false);
        $this->assign('type_list', $type_list);
		return $this->fetch('show');
	}

	/**
	 * 消息列表
	 */
	public function show_my()
	{
        $this->comm_data();
		return $this->fetch('show_my');
	}

	/**
	 * 消息列表
	 */
	public function show_json()
	{
		$where = $this->logicSysMsg->getWhere($this->param);
        $orderby = $this->logicSysMsg->getOrderby($this->param);
		$list = $this->logicSysMsg->getSysMsgList($where,true,$orderby);
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

    /**
     * 公共数据
     * @return void
     * @author: 开发人生 goodkfrs@qq.com
     * @Time: 2022/12/13 16:06
     */
    public function comm_data()
	{
        $type_list=$this->logicSysMsgType->getSysMsgTypeList('','','',false);
        $this->assign('type_list', $type_list);
	}

}
