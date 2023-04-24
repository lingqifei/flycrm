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
