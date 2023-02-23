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
 * 员工档案控制器模块基类
 */
class HrmStaff extends OaskBase
{

	/**
	 * 员工档案列表=》模板
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
		$where = $this->logicHrmStaff->getWhere($this->param);
		$list = $this->logicHrmStaff->getHrmStaffList($where);
		return $list;
	}

	/**
	 * 员工档案添加
	 * @return mixed|string
	 */
	public function add()
	{

		IS_POST && $this->jump($this->logicHrmStaff->hrmStaffAdd($this->param));
		$this->common_data();
		return $this->fetch('add');
	}

	/**
	 * 员工档案编辑
	 * @return mixed|string
	 */

	public function edit()
	{

		IS_POST && $this->jump($this->logicHrmStaff->hrmStaffEdit($this->param));
		$info = $this->logicHrmStaff->getHrmStaffInfo(['id' => $this->param['id']]);
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
			$list = $this->logicHrmStaff->getHrmStaffDetail($this->param);
			return $list;
		}
		$this->common_data();
		$info = $this->logicHrmStaff->getHrmStaffInfo(['id' => $this->param['id']]);
		$this->assign('info', $info);
		return $this->fetch('detail');
	}

	/**
	 * 员工档案管理删除
	 */
	public function del()
	{
		$where = empty($this->param['id']) ? ['id' => 0] : ['id' => $this->param['id']];
		$this->jump($this->logicHrmStaff->hrmStaffDel($where));
	}

	/**
	 * 离职
	 */
	public function leave()
	{
		IS_POST && $this->jump($this->logicHrmStaff->hrmStaffLeave($this->param));

		$info = $this->logicHrmStaff->getHrmStaffInfo(['id' => $this->param['id']]);
		$this->assign('info', $info);
		$this->common_data();
		return $this->fetch('leave');
	}

	/**
	 * 入职
	 */
	public function entry()
	{
		IS_POST && $this->jump($this->logicHrmStaff->hrmStaffEntry($this->param));

		$info = $this->logicHrmStaff->getHrmStaffInfo(['id' => $this->param['id']]);
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

		IS_POST && $this->jump($this->logicHrmStaff->hrmStaffFormal($this->param));
		$info = $this->logicHrmStaff->getHrmStaffInfo(['id' => $this->param['id']]);
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

		$sys_user = $this->logicHrmStaff->getBindSysUserList();
		$this->assign('sys_user_list', $sys_user);

		$this->assign('sys_user_id', SYS_USER_ID);


		$status_list = $this->logicHrmStaff->getStatus();
		$this->assign('status_list', $status_list);

		$degree_list = $this->logicHrmStaff->getDegree();
		$this->assign('degree_list', $degree_list);

	}

}

?>