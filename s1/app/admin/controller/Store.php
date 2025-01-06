<?php
// +----------------------------------------------------------------------
// | 07FLYCRM [基于ThinkPHP5.0开发]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2021 http://www.07fly.xyz
// +----------------------------------------------------------------------
// | Professional because of focus  Persevering because of happiness
// +----------------------------------------------------------------------
// | Author: 开发人生 <goodkfrs@qq.com>
// +----------------------------------------------------------------------

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
	 * 用户登录
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
	 * 显示应用插件例表
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
		return $this->logicStore->getCloudStoreList($this->param);
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
