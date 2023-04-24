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

namespace addon\region;

use app\common\controller\AddonBase;
use addon\AddonInterface;

/**
 * 区域选择插件
 */
class Region extends AddonBase implements AddonInterface
{
    
    /**
     * 实现钩子
     */
    public function RegionSelect($param = [])
    {

        if(empty($param['addons_model'])){
            $param['addons_model']='admin';
        }else{
            $param['addons_model']=$param['addons_model'];
        }
        $this->assign('addons_data', $param);
        
        $this->assign('addons_config', $this->addonConfig($param));
        
        $this->fetch('index/index');
    }
    
    /**
     * 插件安装
     */
    public function addonInstall()
    {
        
        return [RESULT_SUCCESS, '安装成功'];
    }
    
    /**
     * 插件卸载
     */
    public function addonUninstall()
    {
        
        return [RESULT_SUCCESS, '卸载成功'];
    }
    
    /**
     * 插件基本信息
     */
    public function addonInfo()
    {
        
        return ['name' => 'Region', 'title' => '区域选择', 'describe' => '区域三级联动选择插件', 'author' => 'lingqifei', 'version' => '1.0'];
    }
    
    /**
     * 插件配置信息
     */
    public function addonConfig($param)
    {
        
        return $param;
    }
}
