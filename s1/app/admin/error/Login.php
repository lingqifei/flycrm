<?php
/**
 * 零起飞-(07FLY-ERP)
 * ==============================================
 * 版权所有 2015-2028   成都零起飞网络，并保留所有权利。
 * 网站地址: http://www.07fly.xyz
 * ----------------------------------------------------------------------------
 * 如果商业用途务必到官方购买正版授权, 以免引起不必要的法律纠纷.
 * ==============================================
 * AuthDomainor: kfrs <goodkfrs@QQ.com> 574249366
 * Date: 2019-10-3
 */

namespace app\admin\error;

class Login
{
    
    public static $passwordError            = [API_CODE_NAME => 1010001, API_MSG_NAME => '登录密码错误'];
    
    public static $usernameOrPasswordEmpty  = [API_CODE_NAME => 1010002, API_MSG_NAME => '用户名或密码不能为空'];
    
    public static $registerFail             = [API_CODE_NAME => 1010003, API_MSG_NAME => '注册失败'];
    
    public static $oldOrNewPassword         = [API_CODE_NAME => 1010004, API_MSG_NAME => '旧密码或新密码不能为空'];
    
    public static $changePasswordFail       = [API_CODE_NAME => 1010005, API_MSG_NAME => '密码修改失败'];
    
}
