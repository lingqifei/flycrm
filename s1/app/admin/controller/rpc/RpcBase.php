<?php
/*
*
* 零起飞企业管理系统（07FLY-ESM）
*
* =========================================================
* 零起飞网络 - 专注于网站建设服务和行业系统开发
* 以质量求生存，以服务谋发展，以信誉创品牌 !
* ----------------------------------------------
* @copyright	Copyright (C) 2017-2018 07FLY Network Technology Co,LTD (www.07FLY.com) All rights reserved.
* @license    For licensing, see LICENSE.html or http://www.07fly.net/html/business
* @author ：kfrs <goodkfrs@QQ.com> 574249366
* @version ：1.0
* @link ：http://www.07fly.xyz
*/
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
