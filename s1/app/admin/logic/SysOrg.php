<?php
/**
 * 零起飞-(07FLY-CRM)
 * ==============================================
* 版权所有 2015-2028   成都零起飞网络，并保留所有权利。
* 网站地址: http://www.07fly.xyz
 * ----------------------------------------------
 * 如果商业用途务必到官方购买正版授权, 以免引起不必要的法律纠纷.
 * ==============================================
 * Author: kfrs <goodkfrs@QQ.com> 574249366
* Date: 2019-10-3
*/

namespace app\admin\logic;

/**
 * 组织机构逻辑
 */
class SysOrg extends AdminBase
{
    
    /**
     * 获取权限分组列表
     */
    public function getSysOrgList($where = [], $field = true, $order = 'create_time desc', $paginate = DB_LIST_ROWS)
    {
        $where['org_id'] = ['<=',1];
        return $this->modelSysOrg->getList($where, $field, $order, $paginate);
    }
    
    /**
     * 权限组添加
     */
    public function sysOrgAdd($data = [])
    {
        
        $validate_result = $this->validateSysOrg->scene('add')->check($data);
        
        if (!$validate_result) {
            
            return [RESULT_ERROR, $this->validateSysOrg->getError()];
        }
        
        $url = url('show');

        $result = $this->modelSysOrg->setInfo($data);
        
        $result && action_log('新增', '新增组织机构：name' . $data['company']);
        
        return $result ? [RESULT_SUCCESS, '组织机构添加成功', $url] : [RESULT_ERROR, $this->modelSysOrg->getError()];
    }
    
    /**
     * 权限组编辑
     */
    public function sysOrgEdit($data = [])
    {
        
        $validate_result = $this->validateSysOrg->scene('edit')->check($data);
        
        if (!$validate_result) {
         
            return [RESULT_ERROR, $this->validateSysOrg->getError()];
        }
        
        $url = url('sysOrg');
        
        $result = $this->modelSysOrg->setInfo($data);
        
        $result && action_log('编辑', '编辑组织机构，name：' . $data['username']);
        
        return $result ? [RESULT_SUCCESS, '组织机构辑成功', $url] : [RESULT_ERROR, $this->modelSysOrg->getError()];
    }
    
    /**
     * 权限组删除
     */
    public function sysOrgDel($where = [])
    {
        
        $result = $this->modelSysOrg->deleteInfo($where,true);
        
        $result && action_log('删除', '删除组织机构，where：' . http_build_query($where));
        
        return $result ? [RESULT_SUCCESS, '组织机构删除成功'] : [RESULT_ERROR, $this->modelSysOrg->getError()];

    }
    
    /**
     * 获取权限组信息
     */
    public function getSysOrgInfo($where = [], $field = true)
    {
        return $this->modelSysOrg->getInfo($where, $field);
    }

    /**
     * 获取权限组信息
     */
    public function create_user($data)
    {
        $where=[];
        !empty($data['username'])?$where['username']=['=',$data['username']]:'';
        !empty($data['id'])?$where['org_id']=['=',$data['id']]:'';
        $userinfo=$this->logicSysUser->getSysUserInfo($where);
        if($userinfo){
            return  [RESULT_ERROR, '当前企业的管理员帐号已存在'] ;
        }else{
            $updata=[
                'username'=>$data['username'],
                'password'=>data_md5_key($data['password']),
                'mobile'=>$data['mobile'],
                'intro'=>$data['intro'],
                'org_id'=>$data['id']
            ];
            $result = $this->modelSysUser->setInfo($updata);
            //初始化权限
            if($result){
                $auth_data=[
                    'sys_user_id'=>$result,
                    'sys_auth_id'=>1,//默认为企业会员权限
                    'org_id'=>$data['id'],
                ];
                $this->modelSysAuthAccess->setInfo($auth_data);
            }

            $result && action_log('新增', '企业会员系统初始化新增系统用户，name：' . $data['username']);
            return $result ? [RESULT_SUCCESS, '系统用户添加成功'] : [RESULT_ERROR, $this->modelSysUser->getError()];

        }
    }

}
