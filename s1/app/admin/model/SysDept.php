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


namespace app\admin\model;

/**
 * 部门模型
 */
class SysDept extends AdminBase
{
    
    /**
     * 隐藏状态获取器
     */
    public function getIsHideTextAttr()
    {
        
        $is_hide = [DATA_DISABLE => '否', DATA_NORMAL => '是'];
        
        return $is_hide[$this->data['is_hide']];
    }
}
