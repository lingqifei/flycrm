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
namespace app\oask\model;

/**
 * 跟进列表管理=》模型
 */
class Contract extends OaskBase
{
    //线路类型
    public static function getLineType($sType = '')
    {
        $lineTypeArr = array("1"=>"跟踪","2"=>"成功","3"=>"失败","4"=>"搁置","5"=>"失效");
        if (!empty($sType)) {
            if (!in_array($sType[0], array_keys($lineTypeArr))) {
                return $sType;
            } else {
                return $lineTypeArr[$sType[0]];
            }
        }
        return $lineTypeArr;
    }
}
