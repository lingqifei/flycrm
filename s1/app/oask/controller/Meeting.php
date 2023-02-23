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
 * 会议管理-控制器
 */
class Meeting extends OaskBase
{

	/**
	 * 会议列表=》模板
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
	 * 会议列表-》json数据
	 * @return
	 */
	public function show_json()
	{
		$where = $this->logicMeeting->getWhere($this->param);
		$orderby = $this->logicMeeting->getOrderby($this->param);
		$list = $this->logicMeeting->getMeetingList($where, 'a.*', $orderby);
		return $list;
	}


	/**
	 * 会议添加
	 * @return mixed|string
	 */
	public function add()
	{

		IS_POST && $this->jump($this->logicMeeting->meetingAdd($this->param));
		$this->common_data();
		return $this->fetch('add');
	}

	/**
	 * 会议编辑
	 * @return mixed|string
	 */

	public function edit()
	{

		IS_POST && $this->jump($this->logicMeeting->meetingEdit($this->param));

		$this->common_data();

		$info = $this->logicMeeting->getMeetingInfo(['id' => $this->param['id']]);
		$this->assign('info', $info);

		return $this->fetch('edit');
	}

	/**
	 * 会议删除
	 */
	public function del()
	{
		$where = empty($this->param['id']) ? ['id' => 0] : ['id' => $this->param['id']];
		$this->jump($this->logicMeeting->meetingDel($where));
	}

	/**
	 * 会议详细
	 * @return mixed|string
	 */

	public function detail()
	{
		$this->common_data();
		$info = $this->logicMeeting->getMeetingInfo(['id' => $this->param['id']]);
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

		$sys_user_list = $this->logicSysUser->getSysUserList('','','',false);
		$this->assign('sys_user_list', $sys_user_list);


		$status_list = $this->logicMeeting->getStatus();
		$this->assign('status_list', $status_list);


	}

}
