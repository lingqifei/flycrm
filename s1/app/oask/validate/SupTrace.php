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

namespace app\oask\validate;

/**
 * 跟进列表=》验证器
 */
class SupTrace extends OaskBase
{

    // 验证规则
    protected $rule =   [

        'link_time'      => 'require',
        'link_body'      => 'require',
        'supplier_id'      => 'require',
        'linkman_id'      => 'require',
        'salemode'      => 'require',
        'salestage'      => 'require',
        'next_time'      => 'require',

    ];

    // 验证提示
    protected $message  =   [
        'link_time.require'      => '沟通时间不能为空',
        'link_body.require'      => '沟通内容不能为空',
        'supplier_id.require'      => '请选择客户名称',
        'linkman_id.require'      => '联系人不能为空',
        'salemode.require'      => '跟进方式不能为空',
        'salestage.require'      => '沟通阶段不能为空',
		'next_time.require'      => '下次联系时间不能为空',

	];

    // 应用场景
    protected $scene = [

        'add'       =>  ['link_body','supplier_id'],
        'edit'       =>  ['link_body','supplier_id'],
    ];

}
