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
class Workflow extends OaskBase
{
    public function level($key = '')
    {
        $data = array(
            "1" => array(
                'name' => '一般',
                'html' => '<span class="label">一般</span>',
            ),
            "2" => array(
                'name' => '紧急',
                'html' => '<span class="label label-primary">紧急</span>',
            ),
            "3" => array(
                'name' => '非常紧急',
                'html' => '<span class="label label-danger">非常紧急</span>',
            ),
        );
        return (array_key_exists($key, $data)) ? $data[$key] : $data;
    }
    /**
     * 请示申请=》状态
     * 0=临时单，1=待审核，2=已通过，3=被否决，4=被驳回，5=已撤销
     * @param string $key
     * @return array|mixed
     * Author: kfrs <goodkfrs@QQ.com> created by at 2020/10/28 0028
     */
    public function status($key = '')
    {
        $data = array(
            "0" => array(
                'name' => '待提交',
                'html' => '<span class="label">待提交<span>',
                'action' => array(
                    array(
                        'url' => url('audit_send',array('status'=>'1')),
                        'class' => 'ajax-get confirm',
                        'color' => '#23B7E5',
                        'name' => '提交审批'
                    ),
                    array(
                        'url' => url('edit'),
                        'class' => 'ajax-open',
                        'color' => '#1c84c6',
                        'name' => '修改'
                    ),
                    array(
                        'url' => url('del'),
                        'class' => 'ajax-del',
                        'color' => '#1c84c6',
                        'name' => '删除'
                    )
                ),
            ),
            "1" => array(
                'name' => '待审核',
                'html' => '<span class="label label-info">待审核<span>',
                'action' => array(
                    array(
                        'url' => url('audit_cancel',array('status'=>'5')),
                        'class' => 'ajax-get confirm',
                        'color' => '#23B7E5',
                        'name' => '撤销审核'
                    ),
                ),
            ),
            "2" => array(
                'name' => '已通过',
                'html' => '<span class="label label-success">已通过<span>',
                'action' => array(
                    array(
                        'url' => url('detail'),
                        'class' => 'ajax-open',
                        'color' => '#23B7E5',
                        'name' => '详细'
                    )
                ),
            ),
            "3" => array(
                'name' => '被否决',
                'html' => '<span class="label label-danger">被否决<span>',
                'action' => array(
                    array(
                        'url' => url('audit_send',array('status'=>'1')),
                        'class' => 'ajax-get confirm',
                        'color' => '#23B7E5',
                        'name' => '提交审核'
                    ),
                    array(
                        'url' => url('edit'),
                        'class' => 'ajax-open',
                        'color' => '#23B7E5',
                        'name' => '修改'
                    ),
                    array(
                        'url' => url('del'),
                        'class' => 'ajax-del',
                        'color' => '#23B7E5',
                        'name' => '删除'
                    ),
                ),
            ),
            "4" => array(
                'name' => '被驳回',
                'html' => '<span class="label label-warning">被驳回<span>',
                'action' => array(
                    array(
                        'url' => url('audit_send',array('status'=>'1')),
                        'class' => 'ajax-get confirm',
                        'color' => '#23B7E5',
                        'name' => '提交审核'
                    ),

                    array(
                        'url' => url('edit'),
                        'class' => 'ajax-open',
                        'color' => '#23B7E5',
                        'name' => '修改'
                    ),
                    array(
                        'url' => url('del'),
                        'class' => 'ajax-del',
                        'color' => '#23B7E5',
                        'name' => '删除'
                    ),
                ),
            ),
            "5" => array(
                'name' => '被撤消',
                'html' => '<span class="label label-default">被撤消<span>',
                'action' => array(
                    array(
                        'url' => url('audit_send',array('status'=>'1')),
                        'class' => 'ajax-get confirm',
                        'color' => '#23B7E5',
                        'name' => '提交审核'
                    ),
                    array(
                        'url' => url('edit'),
                        'class' => 'ajax-open',
                        'color' => '#23B7E5',
                        'name' => '修改'
                    ),
                    array(
                        'url' => url('del'),
                        'class' => 'ajax-del',
                        'color' => '#23B7E5',
                        'name' => '删除'
                    ),
                ),
            ),
        );
        return (array_key_exists($key, $data)) ? $data[$key] : $data;
    }

}
