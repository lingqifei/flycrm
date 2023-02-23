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
 * 公司内部文件管理-控制器
 */
class ShopFileDept extends OaskBase
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
	 * 公司内部文件列表=》模板
	 * @return mixed|string
	 */
	public function show()
	{
		return $this->fetch('show');
	}

	/**
	 * 公司内部文件列表-》json数据
	 * @return
	 */
	public function show_json()
	{

		$where = $this->logicShopFileDept->getWhere($this->param);
		$orderby = $this->logicShopFileDept->getOrderby($this->param);
		$list = $this->logicShopFileDept->getShopFileDeptList($where, 'a.*,s.name as shop_name', $orderby);
		return $list;
	}


	/**
	 * 公司内部文件添加
	 * @return mixed|string
	 */
	public function add()
	{

		IS_POST && $this->jump($this->logicShopFileDept->shopFileDeptAdd($this->param));
		return $this->fetch('add');
	}

	/**
	 * 公司内部文件编辑
	 * @return mixed|string
	 */

	public function edit()
	{

		IS_POST && $this->jump($this->logicShopFileDept->shopFileDeptEdit($this->param));

		$info = $this->logicShopFileDept->getShopFileDeptInfo(['id' => $this->param['id']]);
		$this->assign('info', $info);

		return $this->fetch('edit');
	}

	/**
	 * 公司内部文件删除
	 */
	public function del()
	{
		$where = empty($this->param['id']) ? ['id' => 0] : ['id' => $this->param['id']];
		$this->jump($this->logicShopFileDept->shopFileDeptDel($where));
	}

	/**
	 * 公司内部文件=>详细
	 * @return mixed|string
	 */

	public function detail()
	{

		$info = $this->logicShopFileDept->getShopFileDeptInfo(['id' => $this->param['id']]);
		$this->assign('info', $info);
		return $this->fetch('detail');
	}

}
