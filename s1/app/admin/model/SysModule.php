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


namespace app\admin\model;

/**
 * 模块模型
 */
class SysModule extends AdminBase
{

    /**
     * 模块状态
     * @param string $key
     * @return array|mixed
     * Author: lingqifei created by at 2020/6/3 0003
     */
    public  function status($key = '')
    {
        $data = array(
            "0" => array(
                'name' => '未安装',
                'html' => '<span class="label label-warning">未安装<span>',
                'action' => array(
                    '0' => array(
                        'url' => url('install'),
                        'class' => 'ajax-get',
                        'color' => '#27c24c',
                        'name' => '安装'
                    ),
                    '1' => array(
                        'url' => url('del'),
                        'class' => 'ajax-del confirm',
                        'color' => '#F05050',
                        'name' => '删除'
                    ),
                ),
            ),
            "1" => array(
                'name' => '已安装',
                'html' => '<span class="label label-info">已安装<span>',
                'action' => array(
                    '0' => array(
                        'url' => url('uninstall'),
                        'class' => 'ajax-get confirm',
                        'color' => '#23b7e5',
                        'name' => '卸载'
                    ),
                ),
            ),
        );
        return (array_key_exists($key,$data))?$data[$key]:$data;
    }



}
