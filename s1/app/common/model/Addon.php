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
