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

namespace app\common\error;

class CodeApiBase
{
    
    public static $success              = [API_CODE_NAME => 1,         API_MSG_NAME => '操作成功'];
    
    public static $accessTokenError     = [API_CODE_NAME => 1000001,   API_MSG_NAME => '访问Toekn错误'];
    
    public static $userTokenNull        = [API_CODE_NAME => 1000002,   API_MSG_NAME => '用户Toekn不能为空'];
    
    public static $apiUrlError          = [API_CODE_NAME => 1000003,   API_MSG_NAME => '接口路径错误'];
    
    public static $dataSignError        = [API_CODE_NAME => 1000004,   API_MSG_NAME => '数据签名错误'];
    
    public static $userTokenError       = [API_CODE_NAME => 1000005,   API_MSG_NAME => '用户Toekn解析错误'];

    public static $accessTokenNull        = [API_CODE_NAME => 1000006,   API_MSG_NAME => '访问Toekn不能为空'];

    public static $funCodeError        = [API_CODE_NAME => 1001000,   API_MSG_NAME => '模块中函数错误'];

}
