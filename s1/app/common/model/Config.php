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
