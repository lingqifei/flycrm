<?php
/*
*
* hrm.controller  模型
*
* =========================================================
* 零起飞网络 - 专注于网站建设服务和行业系统开发
* 以质量求生存，以服务谋发展，以信誉创品牌 !
* ----------------------------------------------
* @copyright	Copyright (C) 2017-2022 07FLY Network Technology Co,LTD.
* @license    For licensing, see LICENSE.html or http://www.07fly.xyz/license
* @author ：kfrs <goodkfrs@QQ.com> 574249366
* @version ：1.0.1
* @link ：http://www.07fly.xyz
*/

namespace app\oask\controller;

/**
 * 员工合同控制器模块基类
 */
class HrmStaffContract extends OaskBase
{

	/**
	 * 员工合同列表=》模板
	 * @return mixed|string
	 */
	public function show()
	{
		$this->common_data();
		return $this->fetch('show');
	}

	/**
	 * 员工合同列表-》json数据
	 * @return
	 */
	public function show_json()
	{
		$orderby = $this->logicHrmStaffContract->getOrderby($this->param);
		$where = $this->logicHrmStaffContract->getWhere($this->param);
		$list = $this->logicHrmStaffContract->getHrmStaffContractList($where,'a.*,s.name as staff_name',$orderby);
		return $list;
	}

	/**
	 * 员工合同添加
	 * @return mixed|string
	 */
	public function add()
	{

		IS_POST && $this->jump($this->logicHrmStaffContract->hrmStaffContractAdd($this->param));
		$this->common_data();
		return $this->fetch('add');
	}

	/**
	 * 员工合同编辑
	 * @return mixed|string
	 */

	public function edit()
	{

		IS_POST && $this->jump($this->logicHrmStaffContract->hrmStaffContractEdit($this->param));
		$info = $this->logicHrmStaffContract->getHrmStaffContractInfo(['id' => $this->param['id']]);
		$this->assign('info', $info);
		$this->common_data();
		return $this->fetch('edit');
	}


	/**
	 * 员工合同=>详细
	 * @return mixed|string
	 */

	public function detail()
	{
		$this->common_data();
		$info = $this->logicHrmStaffContract->getHrmStaffContractInfo(['id' => $this->param['id']]);
		$this->assign('info', $info);
		return $this->fetch('detail');
	}

	/**
	 * 员工合同管理删除
	 */
	public function del()
	{
		$where = empty($this->param['id']) ? ['id' => 0] : ['id' => $this->param['id']];
		$this->jump($this->logicHrmStaffContract->hrmStaffContractDel($where));
	}


	/**
	 * 公共数据
	 * Author: lingqifei created by at 2020/6/15 0015
	 */
	public function common_data()
	{

		$this->assign('sys_user_id', SYS_USER_ID);

		$staff_list = $this->logicHrmStaff->getHrmStaffList('','','',false);
		$this->assign('staff_list', $staff_list);

		if (!empty($this->param['staff_id'])) {
			$this->assign('staff_id', $this->param['staff_id']);
		} else {
			$this->assign('staff_id', '0');
		}

	}

}

?>