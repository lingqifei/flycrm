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
