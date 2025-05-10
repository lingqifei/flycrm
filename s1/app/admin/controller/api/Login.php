<?php
// +----------------------------------------------------------------------
// | 07FLYERP [基于ThinkPHP5.0开发]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2021 http://www.07fly.xyz
// +----------------------------------------------------------------------
// | Professional because of focus  Persevering because of happiness
// +----------------------------------------------------------------------
// | Author: 开发人生 <goodkfrs@qq.com>
// +----------------------------------------------------------------------

namespace app\admin\controller\api;

use app\common\controller\ApiBase;
use think\Hook;

/**
 * 后台基类控制器
 */
class Login extends ApiBase
{

    /**
     * 基类初始化
     */
    public function __construct()
    {

        parent::__construct();

        $this->logicApiBase->checkAccessToken($this->param);//下放到具体模块只使用

        // 接口控制器钩子
        Hook::listen('hook_controller_api_base', $this->request);

        debug('api_begin');
    }

    public function login()
    {
        $info = $this->logicLogin->loginHandleToApi($this->param);
        return $this->apiReturn($info);
    }

    /**
     * 注销登录
     */
    public function logout()
    {

        $result = $this->logicLogin->logout();

        return $this->apiReturn($result);
    }

    /**消息列表
     * @return mixed
     * Author: 开发人生 goodkfrs@qq.com
     * Date: 2022/7/23 0023 9:49
     */
    public function get_config_data()
    {
        $config = $this->logicLogin->getConfigData();
        return $this->apiReturn($config);
    }

}
