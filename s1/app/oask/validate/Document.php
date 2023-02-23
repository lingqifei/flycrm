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
 * 公文=》验证器
 */
class Document extends OaskBase
{

    // 验证规则
    protected $rule =   [

        'name'      => 'require',
        'body'      => 'require',
        'shop_id'      => 'require',

    ];

    // 验证提示
    protected $message  =   [

        'name.require'      => '标题不能为空',
        'body.require'      => '内容不能为空',
        'shop_id.require'      => '选择门店不能为空',
    ];

    // 应用场景
    protected $scene = [
        'add'       =>  ['name','body'],
        'edit'       =>  ['name','body'],
    ];
    
}
