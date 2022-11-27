<?php
/*
* 零起飞企业管理系统（07FLY-ERP）
*
* =========================================================
* 零起飞网络 - 专注于网站建设服务和行业系统开发
* 以质量求生存，以服务谋发展，以信誉创品牌 !
* ----------------------------------------------
* @copyright Copyright (C) 2017-2025 07FLY Network Technology Co,LTD.
* @license For licensing, see LICENSE.html or http://www.07fly.xyz/html/business
* @author ：kfrs <goodkfrs@QQ.com> 574249366
* @version ：1.1.0
* @link ：http://www.07fly.xyz
* @Date:[datetime]
*/

namespace app\[spacename]\controller;

use app\common\controller\ControllerBase;
use app\admin\logic\AdminBase;
use app\admin\logic\SysAuthAccess;
use app\admin\logic\SysMenu;
use think\Hook;

/**
 * 后台基类控制器
 */
class [ModuleBase] extends ControllerBase
{
    // 授权过的菜单列表
    protected $authMenuList     =   [];

    // 授权过的菜单url列表
    protected $authMenuUrlList  =   [];

    protected $AdminBase  =   '';

    /**
     * 构造方法
     */
    public function __construct()
    {

        // 执行父类构造方法
        parent::__construct();


        // 后台控制器钩子
        Hook::listen('hook_controller_admin_base', $this->request);

        $this->adminBase=new AdminBase();

        // 会员ID
        defined('SYS_USER_ID')    or  define('SYS_USER_ID',     is_login());

        // 是否为超级管理员
        defined('IS_ROOT')      or  define('IS_ROOT',  is_administrator());

        //组织ID
        defined('SYS_ORG_ID')    or  define('SYS_ORG_ID', get_org_id());

        //关闭运营标签
        defined('SYS_ORG_STATUS') or  define('SYS_ORG_STATUS',false);//关闭组织

        //组织管理员ID
        defined('SYS_ORG_USER_ID')    or  define('SYS_ORG_USER_ID',     is_org_id());

        $logicSysMenu=new SysMenu();
        $SysAuthAccess=new SysAuthAccess();

        // 获取授权菜单列表
        $this->authMenuList = $SysAuthAccess->getAuthMenuList(SYS_USER_ID);

        // 获得权限菜单URL列表
        $this->authMenuUrlList = $SysAuthAccess->getAuthMenuUrlList($this->authMenuList);


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

        // 初始化模块信息授权
        $this->initAuthInfo();

    }


    /**
     * 初始化模块信息授权
     */
    final private function initAuthInfo()
    {
        // 验证登录
        !SYS_USER_ID && $this->redirect('admin/login/login');

        // 检查菜单权限
        list($jump_type, $message) = $this->adminBase->authCheck(URL, $this->authMenuUrlList);

        // 权限验证不通过则跳转提示
        RESULT_SUCCESS == $jump_type ?: $this->jump($jump_type, $message, url('admin/index/index'));

    }

    /**
     * 重写fetch方法,用于模板的权限控制
     */
    final protected function fetch($template = '', $vars = [], $replace = [], $config = [])
    {
        $content = parent::fetch($template, $vars, $replace, $config);
        //过滤界面没有权限的链接
        return $this->adminBase->filter($content, $this->authMenuUrlList);
    }
}
?>