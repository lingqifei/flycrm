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


namespace app\common\error;

class CodeApiBase
{
    
    public static $success              = [API_CODE_NAME => 1,         API_MSG_NAME => '操作成功'];
    
    public static $accessTokenError     = [API_CODE_NAME => 1000001,   API_MSG_NAME => '访问Token错误'];
    
    public static $userTokenNull        = [API_CODE_NAME => 1000002,   API_MSG_NAME => '用户Token不能为空'];
    
    public static $apiUrlError          = [API_CODE_NAME => 1000003,   API_MSG_NAME => '接口路径错误'];
    
    public static $dataSignError        = [API_CODE_NAME => 1000004,   API_MSG_NAME => '数据签名错误'];
    
    public static $userTokenError       = [API_CODE_NAME => 1000005,   API_MSG_NAME => '用户Token解析错误'];

    public static $accessTokenNull       = [API_CODE_NAME => 1000006,   API_MSG_NAME => '访问Token不能为空'];

    public static $noPermission        = [API_CODE_NAME => 1000007,   API_MSG_NAME => '访问URL无权限'];

    public static $funCodeError        = [API_CODE_NAME => 1001000,   API_MSG_NAME => '模块中函数错误'];

}
