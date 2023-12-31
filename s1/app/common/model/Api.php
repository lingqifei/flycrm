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
 * 接口模型
 */
class Api extends ModelBase
{
    
    /**
     * 请求数据获取器
     */
    public function getRequestDataAttr()
    {
        
        return json_decode($this->data['request_data'], true);
    }
    
    /**
     * 响应数据获取器
     */
    public function getResponseDataAttr()
    {
        
        return json_decode($this->data['response_data'], true);
    }
    
    /**
     * API分组获取器
     */
    public function getGroupNameAttr()
    {
        
        return $this->modelApiGroup->getValue(['id' => $this->data['group_id']], 'name');
    }
    
    /**
     * 请求类型获取器
     */
    public function getRequestTypeTextAttr()
    {
        
        return $this->data['request_type'] ? 'GET' : 'POST';
    }
    
    /**
     * API状态获取器
     */
    public function getApiStatusTextAttr()
    {
        
        $array = parse_config_array('api_status_option');
        
        return $array[$this->data['api_status']];
    }
    
    /**
     * API研发者获取器
     */
    public function getDeveloperTextAttr()
    {
        
        $array = parse_config_array('team_developer');
        
        return $array[$this->data['developer']];
    }
}
