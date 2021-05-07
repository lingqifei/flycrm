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

    /**
     * 短信发磅测试
     * Author: kfrs <goodkfrs@QQ.com> created by at 2020/7/12 0012
     */
    public function  testsms(){
        //$this->jump($this->logicService->testSms());
    }

}
