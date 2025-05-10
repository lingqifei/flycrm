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

namespace app\admin\logic;

use app\admin\error\Login as LoginError;
use think\Session;

/**
 * 登录逻辑
 */
class Login extends AdminBase
{

    /**
     * 登录处理
     */
    public function loginHandle($username = '', $password = '', $verify = '')
    {

        $validate_result = $this->validateLogin->scene('admin')->check(compact('username', 'password', 'verify'));
        if (!$validate_result) {
            return [RESULT_ERROR, $this->validateLogin->getError()];
        }

        $user = $this->logicSysUser->getSysUserInfo(['username' => $username]);

        if (!empty($user['password']) && data_md5_key($password) == $user['password']) {

            $this->loginHandleSession($user);

            action_log('登录', '登录操作，username：' . $username);
            return [RESULT_SUCCESS, '登录成功', url('index/index')];

        } else {

            $error = empty($user['id']) ? '用户账号不存在' : '密码输入错误';

            return [RESULT_ERROR, $error];
        }
    }

    /**
     * 登录后绑定openid=》微信浏览中
     * @param array $data
     * @return int
     * Author: 开发人生 goodkfrs@qq.com
     * Date: 2022/5/19 0019 16:26
     */
    public function loginBindOpenId($data = [])
    {
        $openiduser = $this->modelSysUser->getInfo(['open_id' => $data['open_id']]);
        $res = true;
        if (empty($openiduser)) {
            $user = Session::get('sys_user_info');
            $userData = [
//                'nickname'=>empty($data['nickname'])?'':$data['nickname'],
//                'username'=>date("ymdHis").rand(1000,9999),
                'open_id' => $data['open_id'],
//                'gender'=>empty($data['sex'])?'1':$data['sex'],
//                'head_pic'=>empty($data['headimgurl'])?'':$data['headimgurl'],
            ];
            $res = $this->modelSysUser->updateInfo(['id' => $user['id']], $userData);
        }
        return $res;
    }

    /**
     * openid检查是否存在
     * @param array $data
     * @return int
     * Author: 开发人生 goodkfrs@qq.com
     * Date: 2022/5/19 0019 16:26
     */
    public function loginChkOpenId($data = [])
    {
        $user = $this->modelSysUser->getInfo(['open_id' => $data['open_id']]);
        if (!empty($user)) {
            $this->loginHandleSession($user);
            return $user['id'];
        } else {
            return 0;
        }
    }

    //扫码绑定微信检查
    public function bindSceneQrcode($data = [])
    {
        $user = $this->modelSysUser->getInfo(['scene_qrcode' => $data['scene_qrcode']]);
        if ($user) {
            return [RESULT_SUCCESS, '扫码绑定成功', url('Index/index')];
        }
        return [RESULT_ERROR, '未检查到绑定数据！'];
    }

    /**
     * 扫码登录检查，
     * @param array $data
     * @return int 成功为id,失败为0
     * Author: 开发人生 goodkfrs@qq.com
     * Date: 2021/12/24 0024 17:28
     */
    public function loginSceneQrcode($data = [])
    {
        $user = $this->modelSysUser->getInfo(['scene_qrcode' => $data['scene_qrcode']]);
        if ($user) {
            //登录session
            $this->loginHandleSession($user);
            return [RESULT_SUCCESS, '扫码登录成功', url('Index/index')];
        }
        return [RESULT_ERROR, '未检查到登录'];
    }

    /**
     * 登录处理
     */
    public function loginHandleToApi($data = [])
    {
        if (empty($data['username']) || empty($data['password'])) {
            return [RESULT_ERROR, '用户名称和密码不能空~'];
            exit;
        }
        $user = $this->logicSysUser->getSysUserInfo(['username' => $data['username']]);
        if (!empty($user['password']) && data_md5_key($data['password']) == $user['password']) {
            $this->loginHandleSession($user);
            //生成user token
            $user_token = encoded_user_token($user);
            $user_token['userinfo'] = [
                'id' => $user['id'],
                'username' => $user['username'],
                'realname' => $user['realname'],
                'gender' => $user['gender'],
                'dept_id' => $user['position_id'],
                'position_id' => $user['position_id'],
                'email' => $user['email']
            ];
            return [RESULT_SUCCESS, '登录成功', url('index/index'), $user_token];
        } else {
            $error = empty($user['id']) ? '用户账号不存在' : '密码输入错误';
            return [RESULT_ERROR, $error];
        }
    }

    /**
     * 登录成功后Session处理
     * Author: 开发人生 goodkfrs@qq.com
     * Date: 2022/5/24 0024 18:25
     */
    public function loginHandleSession($user)
    {
        $auth = ['sys_user_id' => $user['id'], 'sys_org_id' => $user['org_id'], TIME_UT_NAME => TIME_NOW];

        $org = $this->logicSysOrg->getSysOrgInfo(['id' => $user['org_id']]);

        is_object($user) && $user->toArray();

        session('sys_org_info', $org);
        session('sys_user_info', $user);
        session('sys_user_auth', $auth);
        session('sys_user_auth_sign', data_auth_sign($auth));

        define('SYS_ORG_ID', $user['org_id']);//定义企业组织ID

        define('SYS_ORG_USER_ID', ($user['username'] == $org['username']) ? $user['id'] : DATA_DISABLE);//企业超级管理员ID
    }

    /**
     * 退出登录
     */
    public function logout()
    {
        clear_login_session();
        return [RESULT_SUCCESS, '退出成功', url('admin/Login/login')];
    }

    /**
     * 清理缓存
     */
    public function clearCache()
    {
        \think\Cache::clear();
        return [RESULT_SUCCESS, '清理成功', url('index/index')];
    }
}
