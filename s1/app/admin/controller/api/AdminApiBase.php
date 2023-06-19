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

namespace app\admin\controller\api;

use app\common\controller\ApiBase;
use think\Hook;

/**
 * 后台基类控制器
 */
class AdminApiBase extends ApiBase
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

        //$this->param['access_token']=get_access_token();

        //检查user_token
        $this->logicApiBase->checkUserTokenParam($this->param);

        //根据用户token初始化常量
        if (!empty($usertoken['data'])) {

            $userinfo = obj2arr($usertoken['data']);

            // 会员ID
            defined('SYS_USER_ID') or define('SYS_USER_ID', $userinfo['id']);

            //组织ID
            defined('SYS_ORG_ID') or define('SYS_ORG_ID', $userinfo['org_id']);

            //组织用户ID
            defined('SYS_ORG_USER_ID') or define('SYS_ORG_USER_ID', is_org_id());

            // 是否为超级管理员
            defined('IS_ROOT') or define('IS_ROOT', is_administrator($userinfo['id']));
        }

		// 是否为超级管理员
		defined('IS_ROOT') or define('IS_ROOT', is_administrator());

    }
}
