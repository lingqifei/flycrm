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
 * 会员验证器
 */
class Member extends ValidateBase
{
    
    // 验证规则
    protected $rule = [
        'username'  => 'require|length:6,30|unique:member',
        'password'  => 'require|length:6,30',
        'email'     => 'require|email|unique:member',
        'mobile'    => 'require|mobile|unique:member',
    ];

    // 验证提示
    protected $message = [
        'username.require'    => '用户名不能为空',
        'username.length'     => '用户名长度为6-30个字符之间',
        'username.unique'     => '用户名已存在',
        'password.require'    => '密码不能为空',
        'password.length'     => '密码长度为6-30个字符之间',
        'email.require'       => '邮箱不能为空',    
        'email.email'         => '邮箱格式不正确', 
        'email.unique'        => '邮箱已存在', 
        'mobile.require'      => '手机号码不能为空',    
        'mobile.unique'       => '手机号码已存在', 
    ];

    // 应用场景
    protected $scene = [
        'add'  =>  ['username','password','email'],
    ];
}
