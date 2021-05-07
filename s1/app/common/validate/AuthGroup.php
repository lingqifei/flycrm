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

namespace app\common\validate;

/**
 * 权限分组验证器
 */
class AuthGroup extends ValidateBase
{
    
    // 验证规则
    protected $rule =   [
        'title'          => 'require|length:1,10',
        'description'    => 'length:0,50',
    ];

    // 验证提示
    protected $message  =   [
        'title.require'         => '权限组标题不能为空',
        'title.length'          => '权限组长度为1-10个字符之间',
        'description.length'    => '权限组描述长度为0-50个字符之间',
    ];
}
