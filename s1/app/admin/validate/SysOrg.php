<?php
// +----------------------------------------------------------------------
// | 07FLYCRM [基于ThinkPHP5.0开发]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2021 http://www.07fly.xyz
// +----------------------------------------------------------------------
// | Professional because of focus  Persevering because of happiness
// +----------------------------------------------------------------------
// | Author: 开发人生 <goodkfrs@qq.com>
// +----------------------------------------------------------------------

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
