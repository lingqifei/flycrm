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
 * 采购记录=》验证器
 */
class SupSales extends OaskBase
{

    // 验证规则
    protected $rule =   [

        'name'      => 'require',
        'purchase_date'      => 'require',
        'supplier_id'      => 'require',
        'money'      => 'require',
        'begin_date'      => 'require',
        'end_date'      => 'require',

    ];

    // 验证提示
    protected $message  =   [
        'name.require'      => '采购名称不能为空',
        'purchase_date.require'      => '采购日期不能为空',
        'supplier_id.require'      => '请选择供应商名称',
        'money.require'      => '采购金额不能为空',
        'begin_date.require'      => '签订日期不能为空',
        'end_date.require'      => '到期日期不能为空',

	];

    // 应用场景
    protected $scene = [

        'add'       =>  ['name','purchase_date','supplier_id','money'],
        'edit'       =>  ['name','purchase_date','supplier_id','money'],
    ];

}
