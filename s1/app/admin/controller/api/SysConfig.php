<?php
/*
*
* admin.api.SysConfig  系统配置
*
* =========================================================
* 零起飞网络 - 专注于网站建设服务和行业系统开发
* 以质量求生存，以服务谋发展，以信誉创品牌 !
* ----------------------------------------------
* @copyright	Copyright (C) 2017-2018 07FLY Network Technology Co,LTD (www.07FLY.com) All rights reserved.
* @license    For licensing, see LICENSE.html or http://www.07fly.net/html/business
* @author ：kfrs <goodkfrs@QQ.com> 574249366
* @version ：1.0
* @link ：http://www.07fly.xyz
*/

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
