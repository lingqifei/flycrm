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

namespace app\admin\controller\rpc;

use app\common\controller\ApiBase;
use think\Hook;

/**
 * 后台基类控制器
 */
class RpcBase extends ApiBase
{
    // 授权过的菜单列表
    protected $authMenuList     =   [];

    // 授权过的菜单url列表
    protected $authMenuUrlList  =   [];

    protected $AdminBase  =   '';

    /**
     * 构造方法
     */
    public function __construct()
    {

        // 执行父类构造方法
        parent::__construct();

        // 后台控制器钩子
        Hook::listen('hook_controller_api_access_base', $this->request);

        $authData=$this->param;
        $authData['access_token']=get_access_token();
        $this->logicApiBase->checkAccessToken($authData);
    }
}
