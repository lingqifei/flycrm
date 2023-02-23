<?php
/**
 * 零起飞-(07FLY-CRM)
 * ==============================================
 * 版权所有 2015-2028   成都零起飞网络，并保留所有权利。
 * 网站地址: http://www.07fly.xyz
 * ----------------------------------------------------------------------------
 * 如果商业用途务必到官方购买正版授权, 以免引起不必要的法律纠纷.
 * ==============================================
 * Myfileor: kfrs <goodkfrs@QQ.com> 574249366
 * Date: 2019-10-3
 */

namespace app\oask\controller;

/**
 * 我的文件管理-控制器
 */
class Myfile extends OaskBase
{

	/**
	 * 我的文件列表=》模板
	 * @return mixed|string
	 */
	public function show()
	{
		return $this->fetch('show');
	}

	/**
	 * 我的文件列表-》json数据
	 * @return
	 */
	public function show_json()
	{

		$where = $this->logicMyfile->getWhere($this->param);
		$orderby = $this->logicMyfile->getOrderby($this->param);
		$list = $this->logicMyfile->getMyfileList($where, true, $orderby);
		return $list;
	}


	/**
	 * 我的文件添加
	 * @return mixed|string
	 */
	public function add()
	{

		IS_POST && $this->jump($this->logicMyfile->myfileAdd($this->param));
		return $this->fetch('add');
	}

	/**
	 * 我的文件编辑
	 * @return mixed|string
	 */

	public function edit()
	{

		IS_POST && $this->jump($this->logicMyfile->myfileEdit($this->param));

		$info = $this->logicMyfile->getMyfileInfo(['id' => $this->param['id']]);
		$this->assign('info', $info);

		return $this->fetch('edit');
	}

	/**
	 * 我的文件删除
	 */
	public function del()
	{
		$where = empty($this->param['id']) ? ['id' => 0] : ['id' => $this->param['id']];
		$this->jump($this->logicMyfile->myfileDel($where));
	}

	/**
	 * 我的文件编辑
	 * @return mixed|string
	 */

	public function detail()
	{

		$info = $this->logicMyfile->getMyfileInfo(['id' => $this->param['id']]);
		$this->assign('info', $info);
		return $this->fetch('detail');
	}

}
