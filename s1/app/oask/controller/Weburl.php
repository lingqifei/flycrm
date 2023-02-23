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
 * 网址列表管理-控制器
 */
class Weburl extends OaskBase
{

	/**
	 * 网址列表列表=》模板
	 * @return mixed|string
	 */
	public function show()
	{
		return $this->fetch('show');
	}

	/**
	 * 网址列表列表-》json数据
	 * @return
	 */
	public function show_json()
	{

		$where = $this->logicWeburl->getWhere($this->param);
		$orderby = $this->logicWeburl->getOrderby($this->param);
		$list = $this->logicWeburl->getWeburlList($where, true, $orderby);
		return $list;
	}


	/**
	 * 网址列表添加
	 * @return mixed|string
	 */
	public function add()
	{

		IS_POST && $this->jump($this->logicWeburl->weburlAdd($this->param));
		return $this->fetch('add');
	}

	/**
	 * 网址列表编辑
	 * @return mixed|string
	 */

	public function edit()
	{

		IS_POST && $this->jump($this->logicWeburl->weburlEdit($this->param));

		$info = $this->logicWeburl->getWeburlInfo(['id' => $this->param['id']]);
		$this->assign('info', $info);

		return $this->fetch('edit');
	}

	/**
	 * 网址列表删除
	 */
	public function del()
	{
		$where = empty($this->param['id']) ? ['id' => 0] : ['id' => $this->param['id']];
		$this->jump($this->logicWeburl->weburlDel($where));
	}

	/**
	 * 排序
	 */
	public function set_visible()
	{
		$this->jump($this->logicOaskBase->setField('Weburl', $this->param));
	}

	/**
	 * 排序
	 */
	public function set_sort()
	{
		$this->jump($this->logicOaskBase->setSort('Weburl', $this->param));
	}

}
