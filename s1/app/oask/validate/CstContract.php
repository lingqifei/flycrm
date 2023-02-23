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
class CstContract extends OaskBase
{

    // 验证规则
    protected $rule =   [

        'name'      => 'require',
        'contract_no'      => 'require',
        'customer_id'      => 'require',
        'money'      => 'require',
        'begin_date'      => 'require',
        'end_date'      => 'require',

    ];

    // 验证提示
    protected $message  =   [
        'name.require'      => '合同名称不能为空',
        'contract_no.require'      => '合同编号不能为空',
        'customer_id.require'      => '请选择客户名称',
        'money.require'      => '合同金额不能为空',
        'begin_date.require'      => '签订日期1不能为空',
        'end_date.require'      => '到期日期不能为空',

	];

    // 应用场景
    protected $scene = [

        'add'       =>  ['name','contract_no','customer_id','money','begin_date','end_date'],
        'edit'       =>  ['name','contract_no','customer_id','money','begin_date','end_date'],
    ];

}
