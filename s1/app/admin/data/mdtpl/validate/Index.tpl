<?php
/*
* [modulename].validate  模型
*
* ----------------------------------------------
* 零起飞网络 - 专注于企业管理系统开发
* 以质量求生存，以服务谋发展，以信誉创品牌 !
* ----------------------------------------------
* @Copyright Copyright (C) 2017-2025 07FLY Network Technology Co,LTD.
* @License For licensing, see LICENSE.html
* @Author ：kfrs <goodkfrs@QQ.com> 574249366
* @Version ：1.1.0
* @Link ：http://www.07fly.xyz
* @Date:[datetime]
*/
namespace app\[spacename]\validate;

/**
 * 模块基类
 */
class Index extends [ModuleBase] {
    // 验证规则
    protected $rule =   [
      'name'      => 'require',
      'username'      => 'require|unique:sys_user',
      'password'      => 'require|confirm|length:6,20',
      'password'      => 'require|length:6,20',
      'email'         => 'require|email',
      'realname'      => 'require',
      'mobile'        => 'unique',
      'old_password'  => 'require',
    ];

    // 验证提示
    protected $message  =   [
      'name.require'      => '名称不能为空',
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
      'add'       =>  ['name'],
      'edit'      =>  ['name'],
      //'password'  =>  ['password','old_password'],
      //'resetpassword'  =>  ['password']
    ];
}
?>