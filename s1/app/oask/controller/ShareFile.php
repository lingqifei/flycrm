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
 * 共享文件文件管理-控制器
 */
class ShareFile extends OaskBase
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
	 * 共享文件文件列表=》模板
	 * @return mixed|string
	 */
	public function show()
	{
		return $this->fetch('show');
	}

	/**
	 * 共享文件文件列表-》json数据
	 * @return
	 */
	public function show_json()
	{

		$where = $this->logicShareFile->getWhere($this->param);
		$orderby = $this->logicShareFile->getOrderby($this->param);
		$list = $this->logicShareFile->getShareFileList($where, 'a.*,s.name as shop_name', $orderby);
		return $list;
	}


	/**
	 * 共享文件文件添加
	 * @return mixed|string
	 */
	public function add()
	{

		IS_POST && $this->jump($this->logicShareFile->shareFileAdd($this->param));
		return $this->fetch('add');
	}

	/**
	 * 共享文件文件编辑
	 * @return mixed|string
	 */

	public function edit()
	{

		IS_POST && $this->jump($this->logicShareFile->shareFileEdit($this->param));

		$info = $this->logicShareFile->getShareFileInfo(['id' => $this->param['id']]);
		$this->assign('info', $info);

		return $this->fetch('edit');
	}

	/**
	 * 共享文件文件删除
	 */
	public function del()
	{
		$where = empty($this->param['id']) ? ['id' => 0] : ['id' => $this->param['id']];
		$this->jump($this->logicShareFile->shareFileDel($where));
	}

	/**
	 * 共享文件文件=>详细
	 * @return mixed|string
	 */

	public function detail()
	{

		$info = $this->logicShareFile->getShareFileInfo(['id' => $this->param['id']]);
		$this->assign('info', $info);
		return $this->fetch('detail');
	}

}
