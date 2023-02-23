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
 * 客户列表=》验证器
 */
class CstCustomer extends OaskBase
{

    // 验证规则
    protected $rule =   [

        'name'      => 'require|unique:cst_customer',
        'customerstatus'      => 'require',
        'linkman'      => 'require',
        'mobile'      => 'require',
        'next_time'      => 'require',

    ];

    // 验证提示
    protected $message  =   [

        'name.require'      => '名称不能为空',
        'name.unique'      => '客户名称已经存在',
        'customerstatus.require'      => '请选择客户状态',
        'linkman.require'      => '首要联系人不能为空',
        'mobile.require'      => '手机号码不能空',
    ];

    // 应用场景
    protected $scene = [

        'add'       =>  ['name','customerstatus','linkman','mobile'],
        'edit'       =>  ['name','customerstatus','linkman','mobile'],
    ];
    
}
