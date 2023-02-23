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
 * 其它记录管理-控制器
 */
class OtherNotes extends OaskBase
{

	/**
	 * 构造方法
	 */
	public function __construct()
	{
		// 执行父类构造方法
		parent::__construct();

		$sys_user_list= $this->logicSysUser->getSysUserList('','','',false);
		$this->assign('sys_user_list', $sys_user_list);

	}


	/**
	 * 其它记录列表=》模板
	 * @return mixed|string
	 */
	public function show()
	{
		return $this->fetch('show');
	}

	/**
	 * 其它记录列表-》json数据
	 * @return
	 */
	public function show_json()
	{

		$where = $this->logicOtherNotes->getWhere($this->param);
		$orderby = $this->logicOtherNotes->getOrderby($this->param);
		$list = $this->logicOtherNotes->getOtherNotesList($where, 'a.*', $orderby);
		return $list;
	}


	/**
	 * 其它记录添加
	 * @return mixed|string
	 */
	public function add()
	{

		IS_POST && $this->jump($this->logicOtherNotes->otherNotesAdd($this->param));
		return $this->fetch('add');
	}

	/**
	 * 其它记录编辑
	 * @return mixed|string
	 */

	public function edit()
	{

		IS_POST && $this->jump($this->logicOtherNotes->otherNotesEdit($this->param));

		$info = $this->logicOtherNotes->getOtherNotesInfo(['id' => $this->param['id']]);
		$this->assign('info', $info);

		return $this->fetch('edit');
	}

	/**
	 * 其它记录删除
	 */
	public function del()
	{
		$where = empty($this->param['id']) ? ['id' => 0] : ['id' => $this->param['id']];
		$this->jump($this->logicOtherNotes->otherNotesDel($where));
	}

	/**
	 * 其它记录=>详细
	 * @return mixed|string
	 */

	public function detail()
	{

		$info = $this->logicOtherNotes->getOtherNotesInfo(['id' => $this->param['id']]);
		$this->assign('info', $info);
		return $this->fetch('detail');
	}

}
