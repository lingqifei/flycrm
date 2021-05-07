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
 * 权限组逻辑
 */
class SysAuth extends AdminBase
{
    
    /**
     * 获取权限分组列表
     */
    public function getAuthList($where = [], $field = true, $order = 'sort asc', $paginate = DB_LIST_ROWS)
    {
        
        return $this->modelSysAuth->getList($where, $field, $order, $paginate);
    }
    
    /**
     * 权限组添加
     */
    public function authAdd($data = [])
    {
        
        $validate_result = $this->validateSysAuth->scene('add')->check($data);
        
        if (!$validate_result) {
            
            return [RESULT_ERROR, $this->validateSysAuth->getError()];
        }
        
        $url = url('show');
        
        $data['sys_user_id'] = SYS_USER_ID;
        
        $result = $this->modelSysAuth->setInfo($data);
        
        $result && action_log('新增', '新增权限组，name：' . $data['name']);
        
        return $result ? [RESULT_SUCCESS, '权限组添加成功', $url] : [RESULT_ERROR, $this->modelSysAuth->getError()];
    }
    
    /**
     * 权限组编辑
     */
    public function authEdit($data = [])
    {
        
        $validate_result = $this->validateSysAuth->scene('edit')->check($data);
        
        if (!$validate_result) {
         
            return [RESULT_ERROR, $this->validateSysAuth->getError()];
        }
        
        $url = url('authList');
        
        $result = $this->modelSysAuth->setInfo($data);
        
        $result && action_log('编辑', '编辑权限组，name：' . $data['name']);
        
        return $result ? [RESULT_SUCCESS, '权限组编辑成功', $url] : [RESULT_ERROR, $this->modelSysAuth->getError()];
    }
    
    /**
     * 权限组删除
     */
    public function authDel($where = [])
    {
        
        $result = $this->modelSysAuth->deleteInfo($where,true);
        
        $result && action_log('删除', '删除权限组，where：' . http_build_query($where));
        
        return $result ? [RESULT_SUCCESS, '权限组删除成功'] : [RESULT_ERROR, $this->modelSysAuth->getError()];
    }
    
    /**
     * 获取权限组信息
     */
    public function getAuthInfo($where = [], $field = true)
    {

        return $this->modelSysAuth->getInfo($where, $field);
    }

    /**
     * 设置用户组权限节点
     */
    public function setAuthRules($data = [])
    {
        
        $data['rules'] = !empty($data['rules']) ? implode(',', array_unique($data['rules'])) : '';
        
        $url = url('show');
        
        $result = $this->modelSysAuth->setInfo($data);
        if ($result) {
            
            action_log('授权', '设置权限组权限，id：' . $data['id']);

            //$this->updateSubAuthByAuth($data['id']);

            return [RESULT_SUCCESS, '权限设置成功', $url];
        } else {
            
            return [RESULT_ERROR, $this->modelSysAuth->getError()];
        }
    }
    
    /**
     * 选择权限组
     */
    public function selectAuthList($auth_list = [], $user_auth_list = [])
    {
        
        $user_auth_ids = array_extract($user_auth_list, 'sys_auth_id');

        foreach ($auth_list as &$info) {
            in_array($info['id'], $user_auth_ids) ? $info['tag'] = 'active' :  $info['tag'] = '';
        }
            
        return $auth_list;
    }
    
    /**
     * 递归更新下级权限节点，确保下级权限不能超越上级
     * 若上级某权限被收回，则下级对应的权限同样被收回
     * 按会员更新
     */
    public function updateSubAuthByUser($sys_user_id = 0)
    {
        
        $auth_list = $this->logicSysAuthAccess->getUserAuthInfo($sys_user_id);
        
        $rules_str_list = array_extract($auth_list, 'rules');
        
        $rules_array_list = array_map("str2arr", $rules_str_list);
        
        $rules_array = [];
        
        foreach ($rules_array_list as $v) {
            
            $rules_array = array_merge($rules_array, $v);
        }
        
        // 当前授权会员的所有权限节点数组
        $rules_unique_array = array_unique($rules_array);
        
        $sub_sys_user_ids = $this->logicSysUser->getSubUserIds($sys_user_id);
        
        $sub_auth_list = $this->logicSysAuthAccess->getUserAuthInfo($sub_sys_user_ids);

        // 所有下级的权限组id集合
        $sub_auth_ids = array_unique(array_extract($sub_auth_list, 'auth_id'));
        
        $this->updateAuthRulesByStandard($rules_unique_array, $sub_auth_ids);
    }
    
    /**
     * 递归更新下级权限节点，确保下级权限不能超越上级
     * 若上级某权限被收回，则下级对应的权限同样被收回
     * 按权限组更新
     */
    public function updateSubAuthByAuth($auth_id = 0)
    {
        
        $auth_list = $this->logicSysAuthAccess->getSysAuthAccessList(['auth_id' => $auth_id]);
        
        $sys_user_arr_ids = array_unique(array_extract($auth_list, 'sys_user_id'));
        
        foreach ($sys_user_arr_ids as $id) {
            
            $this->updateSubAuthByUser($id);
        }
    }
    
    /**
     * 按参数$standard_rules_array权限节点数组标准，将参数$auth_ids权限组ID数组下的权限节点全部更新
     */
    public function updateAuthRulesByStandard($standard_rules_array = [], $auth_ids = [])
    {
        
        $auth_list = $this->getSysAuthList(['id' => ['in', $auth_ids]]);
        
        foreach ($auth_list as $v)
        {
            
            $rules_arr = str2arr($v['rules']);
            
            foreach ($rules_arr as $kk => $vv)
            {
                if (!in_array($vv, $standard_rules_array)) {
                    
                    unset($rules_arr[$kk]);
                }
            }
            
            $v['rules'] = arr2str(array_values($rules_arr));
            
            $this->modelSysAuth->setFieldValue(['id' => $v['id']], 'rules', $v['rules']);
        }
    }
}
