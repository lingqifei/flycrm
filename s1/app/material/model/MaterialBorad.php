<?php
/**
 * 零起飞-(07FLY-CRM)
 * ==============================================
 * 版权所有 2015-2028   成都零起飞网络，并保留所有权利。
 * 网站地址: http://www.07fly.xyz
 * ----------------------------------------------
 * 如果商业用途务必到官方购买正版授权, 以免引起不必要的法律纠纷.
 * ==============================================
 * Author: kfrs <goodkfrs@QQ.com> 574249366
 * Date: 2023-02-06
 */
namespace app\material\model;

/**
 * 板材管理=》模型
 */
class MaterialBorad extends MaterialBase
{
    /**
     * 使用状态
     * @param $key
     * @return string|string[]|\string[][]
     * @author: 开发人生 goodkfrs@qq.com
     * @Time: 2023/1/4 11:51
     */
    public function user_status($key = null)
    {
        $data = array(
            "1" => array(
                'id' => '1',
                'name' => '未用',
                'color' => '#FAD734',
                'html' => '<span class="label label-success1">未用<span>',
            ),
            "2" => array(
                'id' => '2',
                'name' => '锁定',
                'color' => '#23B7E5',
                'html' => '<span class="label label-warning">锁定<span>',
            ),
            "3" => array(
                'id' => '3',
                'name' => '已用',
                'color' => '#27C24C',
                'html' => '<span class="label label-default">已用<span>',
            ),
            "4" => array(
                'id' => '4',
                'name' => '报废',
                'color' => '#27C24C',
                'html' => '<span class="label label-danger">报废<span>',
            )
        );

        //返回数据
        if (!empty($key)) {
            if (array_key_exists($key, $data)) {
                return $data[$key];
            } else {
                return '~未知~';
            }
        } else {
            return $data;
        }
    }

}
