<?php
/*
*
* cms.Archives  内容发布系统-频道模型
*
* =========================================================
* 零起飞网络 - 专注于网站建设服务和行业系统开发
* 以质量求生存，以服务谋发展，以信誉创品牌 !
* ----------------------------------------------
* @copyright	Copyright (C) 2017-2018 07FLY Network Technology Co,LTD (www.07FLY.com) All rights reserved.
* @license    For licensing, see LICENSE.html or http://www.07fly.xyz/crm/license
* @author ：kfrs <goodkfrs@QQ.com> 574249366
* @version ：1.0
* @link ：http://www.07fly.xyz
*/

namespace app\oask\controller;

/**
 * 考勤列表管理-控制器
 */
class Attendance extends OaskBase
{

	/**
	 * 考勤列表列表=》模板
	 * @return mixed|string
	 */
	public function report()
	{
		if(IS_AJAX){
			return 	$this->logicAttendance->getAttendanceReport($this->param);
		}
		$type=$this->logicAttendanceType->getAttendanceTypeList('','','sort asc',false);
		$this->assign('type', $type);
		$this->common_data();
		return $this->fetch('report');
	}

	/**
	 * 个人考勤列表列表=》模板
	 * @return mixed|string
	 */
	public function myattend()
	{
		if(IS_AJAX){
			$staff_id=$this->logicHrmStaff->getHrmStaffFieldValue(['bind_user_id'=>SYS_USER_ID],'id');
			$this->param['staff_id']=$staff_id;
			return 	$this->logicAttendance->getAttendanceReport($this->param);
		}
		$type=$this->logicAttendanceType->getAttendanceTypeList('','','sort asc',false);
		$this->assign('type', $type);
		$this->common_data();
		return $this->fetch('myattend');
	}

	/**
	 * 个人考勤列表列表=》模板
	 * @return mixed|string
	 */
	public function myattend_detail()
	{
		if(IS_AJAX){
			$staff_id=$this->logicHrmStaff->getHrmStaffFieldValue(['bind_user_id'=>SYS_USER_ID],'id');
			$where = $this->logicAttendance->getWhere($this->param);
			return $this->logicAttendance->getAttendanceList($where, 'a.*,s.name as staff_name', 'a.id desc');
		}
		$this->common_data();
		return $this->fetch('myattend_detail');
	}

	/**
	 * 考勤列表列表=》模板
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
	 * 考勤列表列表-》json数据
	 * @return
	 */
	public function show_json()
	{
		$where = $this->logicAttendance->getWhere($this->param);
		$orderby = $this->logicAttendance->getOrderby($this->param);
		$list = $this->logicAttendance->getAttendanceList($where, 'a.*,s.name as staff_name', $orderby);
		return $list;
	}


	/**
	 * 考勤列表添加
	 * @return mixed|string
	 */
	public function add()
	{

		IS_POST && $this->jump($this->logicAttendance->attendanceAdd($this->param));

		$this->common_data();

		return $this->fetch('add');
	}

	/**
	 * 考勤列表编辑
	 * @return mixed|string
	 */

	public function edit()
	{

		IS_POST && $this->jump($this->logicAttendance->attendanceEdit($this->param));

		$this->common_data();
		$info = $this->logicAttendance->getAttendanceInfo(['id' => $this->param['id']]);
		$this->assign('info', $info);
		return $this->fetch('edit');
	}

	/**
	 * 考勤详细展示
	 * @return mixed|string
	 */

	public function detail()
	{

		//详细=>关联数据调用
		if (!empty($this->param['type'])) {
			$list = $this->logicAttendance->getAttendanceDetail($this->param);
			return $list;
		}
		$this->common_data();
		$info = $this->logicAttendance->getAttendanceInfo(['id' => $this->param['id']]);
		$this->assign('info', $info);
		return $this->fetch('detail');
	}

	/**
	 * 考勤列表删除
	 */
	public function del()
	{
		$this->jump($this->logicAttendance->attendanceDel($this->param));
	}


	/**
	 * 公共数据
	 * Author: lingqifei created by at 2020/6/15 0015
	 */
	public function common_data()
	{

		$sys_user = $this->logicSysUser->getSysUserSubList();
		$this->assign('sys_user_list', $sys_user);
		$this->assign('sys_user_id', SYS_USER_ID);

		$type_list = $this->logicAttendanceType->getAttendanceTypeTreeSelect();
		$this->assign('type_list', $type_list);

		$staff_list = $this->logicHrmStaff->getHrmStaffList('','','',false);
		$this->assign('staff_list', $staff_list);

		if (!empty($this->param['staff_id'])) {
			$this->assign('staff_id', $this->param['staff_id']);
		} else {
			$this->assign('staff_id', '0');
		}

		$this->assign('curr_month', format_time(null,'Y-m'));

	}

}
