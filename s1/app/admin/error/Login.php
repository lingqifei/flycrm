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

namespace app\admin\error;

class Login
{
    
    public static $passwordError            = [API_CODE_NAME => 1010001, API_MSG_NAME => '登录密码错误'];
    
    public static $usernameOrPasswordEmpty  = [API_CODE_NAME => 1010002, API_MSG_NAME => '用户名或密码不能为空'];
    
    public static $registerFail             = [API_CODE_NAME => 1010003, API_MSG_NAME => '注册失败'];
    
    public static $oldOrNewPassword         = [API_CODE_NAME => 1010004, API_MSG_NAME => '旧密码或新密码不能为空'];
    
    public static $changePasswordFail       = [API_CODE_NAME => 1010005, API_MSG_NAME => '密码修改失败'];
    
}
