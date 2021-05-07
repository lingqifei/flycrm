<?php
/**
 * 零起飞-(07FLY-CRM)
 * ==============================================
 * 版权所有 2015-2028   成都零起飞网络，并保留所有权利。
 * 网站地址: http://www.07fly.xyz
 * ----------------------------------------------------------------------------
 * 如果商业用途务必到官方购买正版授权, 以免引起不必要的法律纠纷.
 * ==============================================
 * Author: kfrs <goodkfrs@QQ.com> 574249366
 * Date: 2019-10-3
 */

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

//        if (!$validate_result) {
//            return [RESULT_ERROR, $this->validateReg->getError()];
//        }

        $org = $this->logicSysOrg->getSysOrgInfo(['username' => $data['username']]);

        if($org){
            return [RESULT_ERROR, '手机号码已经被注册了'];
        }else{
            //1、创建企业会员
            $orgData=[
                'company'=>$data['company'],
                'username'=>$data['username'],
                'password'=>data_md5_key($data['password']),
                'start_date'=>date("Y-m-d",TIME_NOW),
                'stop_date'=>date_calc(date("Y-m-d",TIME_NOW),'+1','month'),
                'mobile'=>$data['username'],
                'org_id'=>'1',
            ];
            $org_id = $this->modelSysOrg->setInfo($orgData);

            //2、默认企业管理员帐号
            $userData=[
                'username'=>$data['username'],
                'password'=>data_md5_key($data['password']),
                'org_id'=>$org_id
            ];
            $user_id = $this->modelSysUser->setInfo($userData);
            //3、初始权限
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
