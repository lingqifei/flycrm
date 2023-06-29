<?php
/*
*
* Comm  共公频道模型
*
* ----------------------------------------------
* 零起飞网络 - 专注于企业管理系统开发
* 以质量求生存，以服务谋发展，以信誉创品牌 !
* ----------------------------------------------
* @copyright	Copyright (C) 2017-2018 07FLY Network Technology Co,LTD All rights reserved.
* @license    For licensing, see LICENSE.html
* @author ：kfrs <goodkfrs@QQ.com> 574249366
* @version ：1.0
* @link ：http://www.07fly.xyz
*/

namespace app\material\controller;

/**
 * 共公管理-控制器
 * 客户查询=》客户合同订单业务相关回显示
 * 供应商查询=》供应商合同订单业务相关回显示
 */
class Comm extends MaterialBase
{

    /**查询选择组件
     * @return mixed
     * Author: 开发人生 goodkfrs@qq.com
     * Date: 2022/8/2 0002 11:20
     */
    public function suggest_search()
    {
        $list = $this->logicComm->getSuggestDataList($this->param);
        //返回的格式
        $rtnArr = [
            'value' => $list,
            'code' => '200',
        ];
        echo json_encode($rtnArr);
    }

    /**查询选择组件=>选中后回示信息
     * @return mixed
     * Author: 开发人生 goodkfrs@qq.com
     * Date: 2022/8/2 0002 11:20
     */
    public function suggest_info()
    {
        $info = $this->logicComm->getSuggestDataInfo($this->param);
        echo json_encode($info);
    }

}
