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

namespace app\oask\controller;

/**
 * 员工档案控制器模块基类
 */
class ShopStaff extends OaskBase
{

	/**
	 * 工单管理列表=》模板
	 * @return mixed|string
	 */
	public function show()
	{
		if (!empty($this->param['listtype'])) {
			$this->assign('listtype', $this->param['listtype']);
		} else {
			$this->assign('listtype', 'all');
		}
		$this->common_data();
		return $this->fetch('show');
	}

	/**
	 * 员工档案列表-》json数据
	 * @return
	 */
	public function show_json()
	{
		$where = $this->logicShopStaff->getWhere($this->param);
		$list = $this->logicShopStaff->getShopStaffList($where);
		return $list;
	}


	/**
	 * 员工档案添加
	 * @return mixed|string
	 */
	public function add()
	{

		IS_POST && $this->jump($this->logicShopStaff->hrmStaffAdd($this->param));
		$this->common_data();
		return $this->fetch('add');
	}

	/**
	 * 员工档案编辑
	 * @return mixed|string
	 */

	public function edit()
	{

		IS_POST && $this->jump($this->logicShopStaff->hrmStaffEdit($this->param));
		$info = $this->logicShopStaff->getShopStaffInfo(['id' => $this->param['id']]);
		$this->assign('info', $info);
		$this->common_data();
		return $this->fetch('edit');
	}


	/**
	 * 员工档案=>详细
	 * @return mixed|string
	 */

	public function detail()
	{
		//详细面中关联参数调用
		if (!empty($this->param['type'])) {
			$list = $this->logicShopStaff->getShopStaffDetail($this->param);
			return $list;
		}
		$this->common_data();
		$info = $this->logicShopStaff->getShopStaffInfo(['id' => $this->param['id']]);
		$this->assign('info', $info);
		return $this->fetch('detail');
	}

	/**
	 * 员工档案管理删除
	 */
	public function del()
	{
		$where = empty($this->param['id']) ? ['id' => 0] : ['id' => $this->param['id']];
		$this->jump($this->logicShopStaff->hrmStaffDel($where));
	}

	/**
	 * 离职
	 */
	public function leave()
	{
		IS_POST && $this->jump($this->logicShopStaff->hrmStaffLeave($this->param));

		$info = $this->logicShopStaff->getShopStaffInfo(['id' => $this->param['id']]);
		$this->assign('info', $info);
		$this->common_data();
		return $this->fetch('leave');
	}

	/**
	 * 入职
	 */
	public function entry()
	{
		IS_POST && $this->jump($this->logicShopStaff->hrmStaffEntry($this->param));

		$info = $this->logicShopStaff->getShopStaffInfo(['id' => $this->param['id']]);
		$this->assign('info', $info);
		$this->common_data();
		return $this->fetch('entry');
	}

	/**
	 * 员工转正
	 * @return mixed|string
	 */

	public function formal()
	{

		IS_POST && $this->jump($this->logicShopStaff->hrmStaffFormal($this->param));
		$info = $this->logicShopStaff->getShopStaffInfo(['id' => $this->param['id']]);
		$this->assign('info', $info);
		$this->common_data();
		return $this->fetch('formal');
	}

	/**
	 * 公共数据
	 * Author: lingqifei created by at 2020/6/15 0015
	 */
	public function common_data()
	{
		$shop_list= $this->logicShop->getShopList('',"*",'',false);
		$this->assign('shop_list', $shop_list);

		if (!empty($this->param['customer_id'])) {
			$this->assign('customer_id', $this->param['customer_id']);
		} else {
			$this->assign('customer_id', '0');
		}

		$status_list = $this->logicShopStaff->getStatus();
		$this->assign('status_list', $status_list);

		$degree_list = $this->logicShopStaff->getDegree();
		$this->assign('degree_list', $degree_list);

	}

}

?>