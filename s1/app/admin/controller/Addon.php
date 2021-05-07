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

/**
 * 插件控制器
 */
class Addon extends AdminBase
{
    
    /**
     * 执行插件控制器
     */
    public function execute($addon_name = null, $controller_name = null, $action_name = null)
    {
        
        return $this->logicAddon->executeAction($addon_name, $controller_name, $action_name);
    }
    
    /**
     * 执行插件安装
     */
    public function addon_install($name = null)
    {
        
        $this->jump($this->logicAddon->addonInstall($name));
    }
    
    /**
     * 执行插件卸载
     */
    public function addon_uninstall($name = null)
    {
        
        $this->jump($this->logicAddon->addonUninstall($name));
    }
    
    /**
     * 插件列表
     */
    public function addon_list()
    {

        $this->assign('list', $this->logicAddon->getAddonList());

        return $this->fetch('addon_list');
    }

    
    /**
     * 钩子列表
     */
    public function hook_list()
    {
        $this->assign('list', $this->logicAddon->getHookList());
        return $this->fetch('hook_list');
    }


}
