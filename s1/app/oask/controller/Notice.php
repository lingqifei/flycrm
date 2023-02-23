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
 * 公告管理-控制器
 */
class Notice extends OaskBase
{

	/**
	 * 构造方法
	 */
	public function __construct()
	{
		// 执行父类构造方法
		parent::__construct();
	}


	/**
	 * 公告列表=》模板
	 * @return mixed|string
	 */
	public function show()
	{
		return $this->fetch('show');
	}

	/**
	 * 公告列表-》json数据
	 * @return
	 */
	public function show_json()
	{

		$where = $this->logicNotice->getWhere($this->param);
		$orderby = $this->logicNotice->getOrderby($this->param);
		$list = $this->logicNotice->getNoticeList($where, 'a.*', $orderby);
		return $list;
	}


	/**
	 * 公告添加
	 * @return mixed|string
	 */
	public function add()
	{

		IS_POST && $this->jump($this->logicNotice->noticeAdd($this->param));
		return $this->fetch('add');
	}

	/**
	 * 公告编辑
	 * @return mixed|string
	 */

	public function edit()
	{

		IS_POST && $this->jump($this->logicNotice->noticeEdit($this->param));

		$info = $this->logicNotice->getNoticeInfo(['id' => $this->param['id']]);
		$this->assign('info', $info);

		return $this->fetch('edit');
	}

	/**
	 * 公告删除
	 */
	public function del()
	{
		$where = empty($this->param['id']) ? ['id' => 0] : ['id' => $this->param['id']];
		$this->jump($this->logicNotice->noticeDel($where));
	}

	/**
	 * 公告=>详细
	 * @return mixed|string
	 */

	public function detail()
	{

		$info = $this->logicNotice->getNoticeInfo(['id' => $this->param['id']]);
		$this->assign('info', $info);
		return $this->fetch('detail');
	}

}
