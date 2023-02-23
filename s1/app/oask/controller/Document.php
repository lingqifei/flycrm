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
 * 公文管理-控制器
 */
class Document extends OaskBase
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
	 * 公文列表=》模板
	 * @return mixed|string
	 */
	public function show()
	{
		return $this->fetch('show');
	}

	/**
	 * 公文列表-》json数据
	 * @return
	 */
	public function show_json()
	{

		$where = $this->logicDocument->getWhere($this->param);
		$orderby = $this->logicDocument->getOrderby($this->param);
		$list = $this->logicDocument->getDocumentList($where, 'a.*', $orderby);
		return $list;
	}


	/**
	 * 公文添加
	 * @return mixed|string
	 */
	public function add()
	{

		IS_POST && $this->jump($this->logicDocument->documentAdd($this->param));
		return $this->fetch('add');
	}

	/**
	 * 公文编辑
	 * @return mixed|string
	 */

	public function edit()
	{

		IS_POST && $this->jump($this->logicDocument->documentEdit($this->param));

		$info = $this->logicDocument->getDocumentInfo(['id' => $this->param['id']]);
		$this->assign('info', $info);

		return $this->fetch('edit');
	}

	/**
	 * 公文删除
	 */
	public function del()
	{
		$where = empty($this->param['id']) ? ['id' => 0] : ['id' => $this->param['id']];
		$this->jump($this->logicDocument->documentDel($where));
	}

	/**
	 * 公文=>详细
	 * @return mixed|string
	 */

	public function detail()
	{

		$info = $this->logicDocument->getDocumentInfo(['id' => $this->param['id']]);
		$this->assign('info', $info);
		return $this->fetch('detail');
	}

}
