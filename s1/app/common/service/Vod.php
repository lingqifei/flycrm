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
 * 视频点播服务
 */
class Vod extends ServiceBase implements BaseInterface
{
    
    /**
     * 服务基本信息
     */
    public function serviceInfo()
    {
        
        return ['service_name' => '视频点播服务', 'service_class' => 'Vod', 'service_describe' => '系统视频点播服务，用于整合多个视频点播服务平台', 'author' => 'lingqifei', 'version' => '1.0'];
    }
}
