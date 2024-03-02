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
 * 服务控制器
 */
class Service extends AdminBase
{
    
    /**
     * 服务 or 驱动 列表
     */
    public function serviceList($service_name = null)
    {
        
        $title = is_null($service_name) ? '系统服务列表' : '服务驱动列表';
        
        $this->setTitle($title);
        
        $this->assign('list', $this->logicService->getServiceList($service_name));
        
        $view = is_null($service_name) ? 'service_list' : 'driver_list';
        
        return $this->fetch($view);
    }
    
    /**
     * 驱动安装
     */
    public function driverInstall()
    {
        
        IS_POST && $this->jump($this->logicService->driverInstall($this->param));

        //实例服务类
        $model = model(ucfirst($this->param['service_class']), LAYER_SERVICE_NAME);

        //用服务类 setDriver方法实例 $this->>driver
        $model->setDriver($this->param['driver_class']);

        $info = $this->logicService->getDriverInfo(['service_name' => $this->param['service_class'], 'driver_name' => $this->param['driver_class']]);
        
        $info['config'] = unserialize($info['config']);
        
        $this->assign('param', $model->driverParam());
        
        $this->assign('info',  $info);

        return $this->fetch('driver_install');
    }
    
    /**
     * 驱动卸载
     */
    public function driverUninstall()
    {
        
        $this->jump($this->logicService->driverUninstall($this->param));
    }

}
