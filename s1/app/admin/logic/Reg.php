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

/**
 * 登录逻辑
 */
class Reg extends AdminBase
{

    /**
     * 登录处理
     */
    public function regHandle($data=[])
    {
        $validate_result = $this->validateReg->scene('reg')->check($data);
        if (!$validate_result) {
            return [RESULT_ERROR, $this->validateReg->getError()];
        }
        $org = $this->logicSysOrg->getSysOrgInfo(['username' => $data['username']]);
        if($org){
            throw_response_error('手机号码已经被注册了');
        }else{
            //1、创建企业会员
            $orgData=[
                'company'=>$data['company'],
                'username'=>$data['username'],
                'password'=>data_md5_key($data['password']),
                'start_date'=>date("Y-m-d",TIME_NOW),
                'stop_date'=>date_calc(date("Y-m-d",TIME_NOW),'+1','month'),
                'mobile'=>$data['username'],
                'org_id'=>'1',//默认企业会员为
            ];
            $org_id = $this->modelSysOrg->setInfo($orgData);

            //2、默认企业管理员帐号
            $userData=[
                'username'=>$data['username'],
                'realname'=>$data['company'],
                'password'=>data_md5_key($data['password']),
                'org_id'=>$org_id   //企业的id
            ];
            $user_id = $this->modelSysUser->setInfo($userData);

            //3、初始权限,设置为默认的企业会员
            $authData=[
                'sys_user_id'=>$user_id,
                'sys_auth_id'=>1,//默认为企业会员权限
                'org_id'=>$org_id,
            ];
            $result=$this->modelSysAuthAccess->setInfo($authData);
            $url = url('Login/login');
            return $user_id ? [RESULT_SUCCESS, '注册企业会员成功',$url] : [RESULT_ERROR, $this->modelSysAuthAccess->getError()];
        }
    }
}