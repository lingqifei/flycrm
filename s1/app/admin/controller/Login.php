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

namespace app\admin\controller;

use app\common\controller\ControllerBase;
use app\weixin\logic\Portal as WeixinPortal;
use think\Session;

/**
 * 登录控制器
 */
class Login extends ControllerBase
{


    /**
     * 构造方法
     */
    public function __construct()
    {

        // 执行父类构造方法
        parent::__construct();

        $config = $this->logicLogin->getConfigData();
        $this->assign('info', $config);
        //d($x);
    }

    /**
     * 登录
     */
    public function login()
    {
        //记录跳转来源
        if (!empty($this->param['referer_url'])) {
            Session::set('referer_url', urldecode($this->param['referer_url']));
        }

        is_login() && $this->jump(RESULT_REDIRECT, '已登录则跳过登录页', url('admin/index/index'));

        IS_POST && $this->loginHandle($this->param['username'], $this->param['password'], $this->param['verify']);

        // 关闭布局
        $this->view->engine->layout(false);

        return $this->fetch('login');
    }


    /**
     * 登录=>微信登录
     */
    public function login_wx()
    {
        //不是微信中打开，跳转网页
        if (!is_weixin()) {
            $redirect = url('login/login');
            Header("Location: $redirect");
            exit;
        }

        $this->param['redirect'] = DOMAIN . SYS_DS_PROS . MODULE_NAME . SYS_DS_PROS . CONTROLLER_NAME . SYS_DS_PROS . ACTION_NAME;
        $this->param['scope'] = 'snsapi_userinfo';

        //加载微信
        $weixin = new \app\weixin\Portal();
        $info = $weixin->getAccessToken($this->param);

        if ($info['openid']) {
            $login_data['open_id'] = $info['openid'];
            $res = $this->logicLogin->loginChkOpenId($login_data);//openid验证
            $redirect = url('index/index');
            //判断是否有来源地址
            if (Session::has('referer_url')) {
                $redirect = Session::get('referer_url');
            }
            //验证成功后
            if ($res) {
                Header("Location: $redirect");
                exit;
            } else {
                $redirect = url('Login/login');
                $rtn = [RESULT_ERROR, '微信未绑定帐号，请使用帐号登录', $redirect];
                $this->jump($rtn);
            }
        }
    }

    /**
     * 登录成功=》微信绑定
     */
    public function login_wx_bind()
    {
        //加载微信
        $weixin = new \app\weixin\Portal();

        $this->param['redirect'] = DOMAIN . SYS_DS_PROS . MODULE_NAME . SYS_DS_PROS . CONTROLLER_NAME . SYS_DS_PROS . ACTION_NAME;
        $this->param['scope'] = 'snsapi_userinfo';
        $info = $weixin->getAccessToken($this->param);
        if ($info['openid']) {
            $userinfo = $weixin->getUserInfo($info);
            $login_data['open_id'] = $userinfo['openid'];
            $login_data['nickname'] = $userinfo['nickname'];
            $login_data['sex'] = $userinfo['sex'];
            $login_data['headimgurl'] = $userinfo['headimgurl'];

            $res = $this->logicLogin->loginBindOpenId($login_data);//绑定微信

            $redirect = url('index/index');

            //判断是否有来源地址
            if (Session::has('referer_url')) {
                $redirect = Session::get('referer_url');
            }
            if ($res) {
                Header("Location: $redirect");
                exit;
            }
        }
    }

    /**
     * 登录处理
     */
    public function loginHandle($username = '', $password = '', $verify = '')
    {

        $this->jump($this->logicLogin->loginHandle($username, $password, $verify));
    }

    /**
     * 注销登录
     */
    public function logout()
    {

        $this->jump($this->logicLogin->logout());
    }

    /**
     * 清理缓存
     */
    public function clearCache()
    {

        $this->jump($this->logicLogin->clearCache());
    }

}
