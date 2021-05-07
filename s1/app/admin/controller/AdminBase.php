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

use app\common\controller\ControllerBase;
use think\Hook;

/**
 * 后台基类控制器
 */
class AdminBase extends ControllerBase
{

	// 授权过的菜单列表
	protected $authMenuList = [];

	// 授权过的菜单url列表
	protected $authMenuUrlList = [];

	// 授权过的菜单树
	protected $authMenuTree = [];

	// 菜单视图
	protected $menuView = '';

	// 面包屑视图
	protected $crumbsView = '';

	// 页面标题
	protected $title = '';

	/**
	 * 构造方法
	 */
	public function __construct()
	{

		// 执行父类构造方法
		parent::__construct();

		// 初始化后台模块常量
		$this->initAdminConst();

		// 初始化后台模块信息
		$this->initAdminInfo();

		// 后台控制器钩子
		Hook::listen('hook_controller_admin_base', $this->request);
	}

	/**
	 * 初始化后台模块信息
	 */
	final private function initAdminInfo()
	{
		// 验证登录
		!SYS_USER_ID && $this->redirect('admin/login/login');

		// 获取授权菜单列表
		$this->authMenuList = $this->logicSysAuthAccess->getAuthMenuList(SYS_USER_ID);

		// 获得权限菜单URL列表
		$this->authMenuUrlList = $this->logicSysAuthAccess->getAuthMenuUrlList($this->authMenuList);

		//把授权菜单列表
		session('auth_menu_list', $this->authMenuList);
		session('auth_menu_url_list', $this->authMenuUrlList);
		session('sys_user_info', $user = $this->logicSysUser->getSysUserInfo(['id' => SYS_USER_ID]));

		// 检查菜单权限
		list($jump_type, $message) = $this->logicAdminBase->authCheck(URL, $this->authMenuUrlList);

		// 权限验证不通过则跳转提示
		RESULT_SUCCESS == $jump_type ?: $this->jump($jump_type, $message, url('/admin/index/index'));


		$this->initBaseInfo();

		// 初始化基础数据
		// IS_AJAX && !IS_PJAX ?: $this->initBaseInfo();

		// 若为PJAX则关闭布局
		// IS_AJAX && $this->view->engine->layout(false);
	}

	/**
	 * 初始化基础数据
	 */
	final private function initBaseInfo()
	{
		// 获取过滤后的菜单树
		$this->authMenuTree = $this->logicAdminBase->getMenuTree($this->authMenuList, $this->authMenuUrlList);

		// 菜单转换为视图
		$this->menuView = $this->logicSysMenu->menuToView($this->authMenuTree);

		// 菜单自动选择
		//$this->menuView = $this->logicSysMenu->selectMenu($this->menuView);

		// 获取面包屑
		$this->crumbsView = $this->logicSysMenu->getCrumbsView();

		// 获取当前栏目默认标题
		$this->title = $this->logicSysMenu->getDefaultTitle();

		// 获取当前登录帐号组织机组
		$this->org = $this->logicSysOrg->getSysOrgInfo(SYS_ORG_ID);

		// 设置组织机组
		$this->assign('sys_org', $this->org);

		// 设置页面标题
		$this->assign('page_title', $this->title);

		// 菜单视图
		$this->assign('menu_view', $this->menuView);

		// 面包屑视图
		$this->assign('crumbs_view', $this->crumbsView);

		// 授权菜单列表
		$this->assign('auth_menu_list', $this->authMenuList);

		// 登录会员信息
		$this->assign('sys_user_info', session('sys_user_info'));
	}

	/**
	 * 初始化后台模块常量
	 */
	final private function initAdminConst()
	{
		// 会员ID
		defined('SYS_USER_ID') or define('SYS_USER_ID', is_login());

		//组织ID
		defined('SYS_ORG_ID') or define('SYS_ORG_ID', get_org_id());

		//组织用户ID
		defined('SYS_ORG_USER_ID') or define('SYS_ORG_USER_ID', is_org_id());

		// 是否为超级管理员
		defined('IS_ROOT') or define('IS_ROOT', is_administrator());


	}

	/**
	 * 设置指定标题
	 */
	final protected function setTitle($title = '')
	{

		$this->assign('lqf_title', $title);
	}

	/**
	 * 获取内容头部视图
	 */
	final protected function getContentHeader($describe = '')
	{

		$title = empty($this->title) ? '' : $this->title;

		$describe_html = empty($describe) ? '' : '<small>' . $describe . '</small>';

		return "<section class='content-header'><input type='hidden' name='lqf_title_hidden' id='lqf_title_hidden' value='" . $title . "'/><h1>$title $describe_html</h1>$this->crumbsView</section>";
	}

	/**
	 * 重写fetch方法
	 */
	final protected function fetch($template = '', $vars = [], $replace = [], $config = [])
	{
		$content = parent::fetch($template, $vars, $replace, $config);

		IS_PJAX && $content = $this->getContentHeader() . $content;

		return $this->logicAdminBase->filter($content, $this->authMenuUrlList);
	}
}
