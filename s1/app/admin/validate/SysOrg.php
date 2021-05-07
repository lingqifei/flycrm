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

namespace app\admin\validate;

/**
 * 企业组织 验证器
 */
class SysOrg extends AdminBase
{

    // 验证规则
    protected $rule =   [

        'username'      => 'require|unique:sys_user',
       // 'password'      => 'require|confirm|length:6,20',
        'password'      => 'require|length:6,20',
        'email'         => 'require|email',
        'realname'      => 'require',
        'mobile'        => 'unique',
        'old_password'  => 'require',
    ];

    // 验证提示
    protected $message  =   [

        'username.require'      => '用户名不能为空',
        'username.unique'       => '用户名已存在',
        'realname.require'      => '真实名称不能为空',
        'password.require'      => '密码不能为空',
        'password.confirm'      => '两次密码不一致',
        'password.length'       => '密码长度为6-20字符',
        'email.require'         => '邮箱不能为空',
        'email.email'           => '邮箱格式不正确',
        'email.unique'          => '邮箱已存在',
        'old_password.require'  => '旧密码不能为空',
    ];

    // 应用场景
    protected $scene = [

        'add'       =>  ['username','password'],
        'edit'      =>  ['company'],
        'password'  =>  ['password','old_password']
    ];
    
}
