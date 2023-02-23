<?php
/**
 * 零起飞-(07FLY-CRM)
 * ==============================================
 * 版权所有 2015-2028   成都零起飞网络，并保留所有权利。
 * 网站地址: http://www.07fly.xyz
 * ----------------------------------------------------------------------------
 * 如果商业用途务必到官方购买正版授权, 以免引起不必要的法律纠纷.
 * ==============================================
 * CstLinkmanor: kfrs <goodkfrs@QQ.com> 574249366
 * Date: 2019-10-3
 */

namespace app\oask\controller;

/**
 * 采购记录管理-控制器
 */
class SupSales extends OaskBase
{

	/**
	 * 采购记录列表=》模板
	 * @return mixed|string
	 */
	public function show()
	{
		if (!empty($this->param['listtype'])) {
			$this->assign('listtype', $this->param['listtype']);
		} else {
			$this->assign('listtype', 'selfson');
		}
		$this->common_data();
		return $this->fetch('show');
	}

	/**
	 * 采购记录列表-》json数据
	 * @return
	 */
	public function show_json()
	{

		$where = $this->logicSupSales->getWhere($this->param);
		$orderby = $this->logicSupSales->getOrderby($this->param);
		$list = $this->logicSupSales->getSupSalesList($where, 'a.*,c.name as supplier_name', $orderby);
		return $list;
	}


	/**
	 * 采购记录添加
	 * @return mixed|string
	 */
	public function add()
	{

		IS_POST && $this->jump($this->logicSupSales->supSalesAdd($this->param));
		$this->common_data();
		return $this->fetch('add');
	}

	/**
	 * 采购记录编辑
	 * @return mixed|string
	 */

	public function edit()
	{

		IS_POST && $this->jump($this->logicSupSales->supSalesEdit($this->param));

		$this->common_data();

		$info = $this->logicSupSales->getSupSalesInfo(['id' => $this->param['id']]);
		$this->assign('info', $info);

		return $this->fetch('edit');
	}

	/**
	 * 采购记录删除
	 */
	public function del()
	{
		$where = empty($this->param['id']) ? ['id' => 0] : ['id' => $this->param['id']];
		$this->jump($this->logicSupSales->supSalesDel($where));
	}

	/**
	 * 采购记录详细
	 * @return mixed|string
	 */

	public function detail()
	{
		$this->common_data();
		$info = $this->logicSupSales->getSupSalesInfo(['id' => $this->param['id']]);
		$this->assign('info', $info);
		return $this->fetch('detail');
	}


	/**
	 * 公共数据
	 * Author: kfrs <goodkfrs@QQ.com> created by at 2020/6/20 0020
	 */
	public function common_data()
	{
		$dict = $this->logicCstDict->getCstDictListTypeall();
		$this->assign('dict', $dict);

		$sys_user = $this->logicSysUser->getSysUserDeptSelfSon();
		$this->assign('sys_user', $sys_user);

		$supplier_list = $this->logicSupSupplier->getSupSupplierSelect();
		$this->assign('supplier_list', $supplier_list);

		if (!empty($this->param['supplier_id'])) {
			$this->assign('supplier_id', $this->param['supplier_id']);
		} else {
			$this->assign('supplier_id', '0');
		}


	}

}
