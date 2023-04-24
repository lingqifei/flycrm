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
 * 注册验证器
 */
class Reg extends AdminBase
{
    
    // 验证规则
    protected $rule =   [
        
        'company'  => 'require',
        'username'  => 'require',
        'password'  => 'require',
        'verify'    => 'require|captcha',
    ];
    
    // 验证提示
    protected $message  =   [
        
        'company.require'    => '企业名称不能为空',
        'username.require'    => '用户名不能为空',
        'password.require'    => '密码不能为空',
        'verify.require'      => '验证码不能为空',
        'verify.captcha'      => '验证码不正确',
    ];

    // 应用场景
    protected $scene = [
        'reg'   =>  ['company','username','password', 'verify'],
    ];

}
