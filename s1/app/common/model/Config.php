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
 * 配置模型
 */
class Config extends ModelBase
{
    /**
     * 状态获取器
     */
    public function getStatusTextAttr()
    {

        $status = [DATA_DELETE => '删除', DATA_DISABLE => "<span class='badge badge-danger'>禁用</span>", DATA_NORMAL => "<span class='badge badge-success'>启用</span>"];
        return $status[$this->data[DATA_STATUS_NAME]];
    }
}
