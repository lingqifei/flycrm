<?php
/**
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
 * 日常记录管理-控制器
 */
class ShopNotes extends OaskBase
{

	/**
	 * 构造方法
	 */
	public function __construct()
	{
		// 执行父类构造方法
		parent::__construct();

		$shop_list= $this->logicShop->getShopList('',"*",'',false);
		$this->assign('shop_list', $shop_list);

	}


	/**
	 * 日常记录列表=》模板
	 * @return mixed|string
	 */
	public function show()
	{
		return $this->fetch('show');
	}

	/**
	 * 日常记录列表-》json数据
	 * @return
	 */
	public function show_json()
	{

		$where = $this->logicShopNotes->getWhere($this->param);
		$orderby = $this->logicShopNotes->getOrderby($this->param);
		$list = $this->logicShopNotes->getShopNotesList($where, 'a.*,s.name as shop_name', $orderby);
		return $list;
	}


	/**
	 * 日常记录添加
	 * @return mixed|string
	 */
	public function add()
	{

		IS_POST && $this->jump($this->logicShopNotes->shopNotesAdd($this->param));
		return $this->fetch('add');
	}

	/**
	 * 日常记录编辑
	 * @return mixed|string
	 */

	public function edit()
	{

		IS_POST && $this->jump($this->logicShopNotes->shopNotesEdit($this->param));

		$info = $this->logicShopNotes->getShopNotesInfo(['id' => $this->param['id']]);
		$this->assign('info', $info);

		return $this->fetch('edit');
	}

	/**
	 * 日常记录删除
	 */
	public function del()
	{
		$where = empty($this->param['id']) ? ['id' => 0] : ['id' => $this->param['id']];
		$this->jump($this->logicShopNotes->shopNotesDel($where));
	}

	/**
	 * 日常记录=>详细
	 * @return mixed|string
	 */

	public function detail()
	{

		$info = $this->logicShopNotes->getShopNotesInfo(['id' => $this->param['id']]);
		$this->assign('info', $info);
		return $this->fetch('detail');
	}

}
