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

namespace app\admin\controller\api;

use app\admin\controller\api\AdminApiBase;

/**
 * 系统配置
 */
class SysConfig extends AdminApiBase
{
    /**消息列表
     * @return mixed
     * Author: 开发人生 goodkfrs@qq.com
     * Date: 2022/7/23 0023 9:49
     */
    public function get_conf_data()
    {
        $config = $this->logicLogin->getConfigData();
        return $this->apiReturn($config);
    }
}
