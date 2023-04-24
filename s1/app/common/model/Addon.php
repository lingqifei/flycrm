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


namespace app\common\model;

/**
 * 插件模型
 */
class Addon extends ModelBase
{
    
    /**
     * 获取插件模型层实例
     */
    public function __get($name)
    {
        
        return addon_ioc($this, $name, LAYER_MODEL_NAME);
    }
}
