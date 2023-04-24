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

/**
 * 支付服务
 */
class Pay extends ServiceBase implements BaseInterface
{
    
    const NOTIFY_URL    = 'http://xxx/payment/notify';
    const CALLBACK_URL  = 'http://xxx/payment/notify';
    
    /**
     * 服务基本信息
     */
    public function serviceInfo()
    {
        
        return ['service_name' => '支付服务', 'service_class' => 'Pay', 'service_describe' => '系统支付服务，用于整合多个支付平台', 'author' => 'lingqifei', 'version' => '1.0'];
    }
    
}
