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

namespace addon;

/**
 * 插件接口
 */
interface AddonInterface
{
    
    /**
     * 插件安装
     */
    public function addonInstall();
    
    /**
     * 插件卸载
     */
    public function addonUninstall();
    
    /**
     * 插件信息
     */
    public function addonInfo();
    
    /**
     * 插件配置信息
     */
    public function addonConfig($param);
}
