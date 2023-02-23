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
 * 通讯录列表=》验证器
 */
class Contacts extends OaskBase
{

    // 验证规则
    protected $rule =   [

        'name'      => 'require',
        'type_id'      => 'require',
        'mobile'      => 'require',

    ];

    // 验证提示
    protected $message  =   [

        'name.require'      => '姓名不能为空',
        'type_id.require'      => '选择分类不能为空',
        'mobile.require'      => '联系电话不能为空',

    ];

    // 应用场景
    protected $scene = [

        'add'       =>  ['name','type_id','mobile'],
        'edit'       =>  ['name','type_id','mobile'],
    ];
    
}
