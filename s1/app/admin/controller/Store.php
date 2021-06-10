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

namespace app\admin\controller;

use think\response\Json;

/**
 * 应用市市场控制器
 */
class Store extends AdminBase
{

	/**
	 * 基类初始化
	 */
	public function __construct()
	{
		// 执行父类构造方法
		parent::__construct();

//		$info=$this->logicStore->getCloudUserInfo();
//		$this->assign('userinfo', $info);
	}


	/**
	 * 显示备份例表
	 */
	public function user()
	{
		IS_POST && $this->jump($this->logicStore->cloudUserLogin($this->param));

		$info=$this->logicStore->getCloudUserInfo();
		$this->assign('info', $info);

		return $this->fetch('user');
	}

	/**
	 * 云会员登出
	 */
	public function userloginout()
	{
		$this->jump($this->logicStore->cloudUserLoginout($this->param));
	}

	/**
	 * 显示备份例表
	 */
	public function apps()
	{

		return $this->fetch('apps');
	}

	/**
	 * 显示备份例表
	 */
	public function apps_json()
	{
		return $this->logicStore->getCloudStoreList();
	}

	/**
	 * 订单检查
	 */
	public function app_order_check()
	{
		return $this->logicStore->getCloudAppOrderCheck($this->param);
	}

	/**
	 * 云应用安装
	 */
	public function install()
	{
		$userinfo=$this->logicStore->getCloudUserInfo();
		if(empty($userinfo)){
			return $this->user();
			exit;
		}else{
			$orderinfo=$this->logicStore->getCloudAppOrderInfo($this->param);
			$this->assign('userinfo', $userinfo);
			$this->assign('orderinfo', $orderinfo);
			return $this->fetch('install');
		}
	}

	/**
	 * 下载安装
	 */
	public function down_install()
	{
		$this->jump($this->logicStore->getCloudAppDownInstall($this->param));
	}

	/**
	 * 云应用升级
	 */
	public function upgrade()
	{
		$userinfo=$this->logicStore->getCloudUserInfo();
		if(empty($userinfo)){
			return $this->user();
			exit;
		}else{
			$orderinfo=$this->logicStore->getCloudAppOrderInfo($this->param);
//			d($orderinfo);
			$this->assign('userinfo', $userinfo);
			$this->assign('orderinfo', $orderinfo);
			return $this->fetch('upgrade');
		}
	}

	/**
	 * 下载升级
	 */
	public function down_upgrade()
	{
		$this->jump($this->logicStore->getCloudAppDownUpgrade($this->param));
	}

}
