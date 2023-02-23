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
 * 请示申请=》模型
 */
class WorkflowDeal extends OaskBase
{
    public function status($key = '')
    {
        $data = array(
            "0" => array(
                'id' => '临时单',
                'name' => '临时单',
                'html' => '<span class="label">临时单</span>',
            ),
            "1" => array(
                'id' => '1',
                'name' => '待处理',
                'html' => '<span class="label label-warning">待处理</span>',
            ),
            "2" => array(
                '2' => '已处理',
                'name' => '已处理',
                'html' => '<span class="label label-success">已处理</span>',
            ),
        );
        return (array_key_exists($key, $data)) ? $data[$key] : $data;
    }
    /**
     * 请示申请=》状态
     * 0=待处理，1=通过，2=拒绝，3=转发
     * @param string $key
     * @return array|mixed
     * Author: kfrs <goodkfrs@QQ.com> created by at 2020/10/28 0028
     */
    public function deal_status($key = '')
    {
        $data = array(
            "0" => array(
                'name' => '未知',
                'html' => '<span class="label">未知<span>',
                'action' => array(

                ),
            ),
            "1" => array(
                'name' => '通过',
                'html' => '<span class="label label-info">通过<span>',
                'action' => array(

                ),
            ),
            "2" => array(
                'name' => '拒绝',
                'html' => '<span class="label label-danger">拒绝<span>',
                'action' => array(
                ),
            ),
            "3" => array(
                'name' => '转发',
                'html' => '<span class="label label-danger">转发<span>',
                'action' => array(

                ),
            ),
        );
        return (array_key_exists($key, $data)) ? $data[$key] : $data;
    }

}
