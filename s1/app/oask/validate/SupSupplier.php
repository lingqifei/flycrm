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
 * 供应商列表=》验证器
 */
class SupSupplier extends OaskBase
{

    // 验证规则
    protected $rule =   [

        'name'      => 'require',
        'linkman'      => 'require',
        'mobile'      => 'require',

    ];

    // 验证提示
    protected $message  =   [

        'name.require'      => '名称不能为空',
        'linkman.require'      => '首要联系人不能为空',
        'mobile.require'      => '手机号码不能这人',
    ];

    // 应用场景
    protected $scene = [

        'add'       =>  ['name','linkman','mobile'],
        'edit'       =>  ['name','linkman','mobile'],
    ];
    
}
