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
use app\common\controller\ControllerBase;
use app\admin\logic\AdminBase;
use app\admin\logic\SysAuthAccess;
use app\admin\logic\SysMenu;
use think\Hook;
/**
 * 模块基类
 */
class OaskBase extends ControllerBase{
// 授权过的菜单列表
	protected $authMenuList = [];

	// 授权过的菜单url列表
	protected $authMenuUrlList = [];

	protected $AdminBase = '';

	/**
	 * 构造方法
	 */
	public function __construct()
	{

		// 执行父类构造方法
		parent::__construct();


		// 后台控制器钩子
		Hook::listen('hook_controller_admin_base', $this->request);

		$this->adminBase = new AdminBase();

		// 会员ID
		defined('SYS_USER_ID') or define('SYS_USER_ID', is_login());

		// 是否为超级管理员
		defined('IS_ROOT') or define('IS_ROOT', is_administrator());

		//组织ID
		defined('SYS_ORG_ID') or define('SYS_ORG_ID', get_org_id());

		//关闭运营标签
		defined('SYS_ORG_STATUS') or define('SYS_ORG_STATUS', false);//关闭组织

		//组织管理员ID
		defined('SYS_ORG_USER_ID') or define('SYS_ORG_USER_ID', is_org_id());

		$logicSysMenu = new SysMenu();
		$SysAuthAccess = new SysAuthAccess();

		// 获取授权菜单列表
		$this->authMenuList = $SysAuthAccess->getAuthMenuList(SYS_USER_ID, MODULE_NAME);

		// 获得权限菜单URL列表
		$this->authMenuUrlList = $SysAuthAccess->getAuthMenuUrlList($this->authMenuList);


		// 获取过滤后的菜单树
		$this->authMenuTree = $logicSysMenu->getMenuTree($this->authMenuList, $this->authMenuUrlList);

		// 菜单转换为视图
		$this->menuView = $logicSysMenu->menuToView($this->authMenuTree);


		// 获取当前栏目默认标题
		$this->title = $logicSysMenu->getDefaultTitle();

		// 获取面包屑
		$this->crumbsView = $logicSysMenu->getCrumbsView();

		// 获取当前登录帐号组织机组
		$this->org = get_org_info();

		// 设置组织机组
		$this->assign('sys_org', $this->org);

		// 设置页面标题
		$this->assign('page_title', $this->title);

		// 面包屑视图
		$this->assign('crumbs_view', $this->crumbsView);

		// 菜单视图
		$this->assign('menu_view', $this->menuView);

		// 登录会员信息
		$this->assign('sys_user_info', session('sys_user_info'));

		// 初始化后台模块信息
		$this->initCmsInfo();

	}


	/**
	 * 初始化后台模块信息
	 */
	final private function initCmsInfo()
	{
		// 验证登录
		!SYS_USER_ID && $this->redirect('admin/login/login');

		// 检查菜单权限
		list($jump_type, $message) = $this->adminBase->authCheck(URL, $this->authMenuUrlList);

		// 权限验证不通过则跳转提示
		RESULT_SUCCESS == $jump_type ?: $this->jump($jump_type, $message, url('admin/index/index'));

	}

	/**
	 * 重写fetch方法,用于权限控制
	 */
	final protected function fetch($template = '', $vars = [], $replace = [], $config = [])
	{

		$content = parent::fetch($template, $vars, $replace, $config);

		//过滤界面没有权限的链接
		return $this->adminBase->filter($content, $this->authMenuUrlList);

	}
}
?>