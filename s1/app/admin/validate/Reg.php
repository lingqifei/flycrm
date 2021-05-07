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
