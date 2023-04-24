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
