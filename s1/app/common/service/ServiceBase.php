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

namespace app\common\service;

use app\common\model\ModelBase;

/**
 * 基础服务
 */
class ServiceBase extends ModelBase
{
    
    // 驱动
    public $driver = null;
    
    /**
     * 驱动参数
     */
    public function driverParam()
    {
        
        return $this->driver->getDriverParam();
    }
    
    /**
     * 驱动配置信息
     */
    public function driverConfig($driver_name = '')
    {


        $driver_info = $this->modelDriver->getInfo(['driver_name' => $driver_name]);
        
        empty($driver_info) && exception('未安装此驱动，请先安装');
        
        $driver_info_arr = $driver_info->toArray();
        
        return unserialize($driver_info_arr['config']);
    }
    
    /**
     * 设置驱动
     */
    public function setDriver($driver_class = '')
    {
        
        $this->driver = model(ucfirst($driver_class), LAYER_SERVICE_NAME . SYS_DS_CONS . strtolower($this->name) . SYS_DS_CONS . SYS_DRIVER_DIR_NAME);
    }
    
    /**
     * 重写获取器获取驱动
     */
    public function __get($name)
    {
        
        if (!str_prefix($name, SYS_DRIVER_DIR_NAME)) {
            
            return parent::__get($name);
        }
        
        empty($this->driver) && $this->setDriver(sr($name, SYS_DRIVER_DIR_NAME));
        
        return $this->driver;
    }
}
