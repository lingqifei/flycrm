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
 * 用户逻辑
 */
class SysUser extends AdminBase
{

    // 面包屑
    public static $crumbs = [];

    // 菜单Select结构
    public static $menuSelect = [];


    /**
     * 获取列表
     */
    public function getAllList($where = [], $field = true, $order = 'id desc', $paginate = DB_LIST_ROWS)
    {
        $list = $this->modelSysUser->getList($where, $field, $order, $paginate);
        return $list;
    }

    /**
     * 获取列表
     */
    public function getSysUserList($where = [], $field = true, $order = 'id desc', $paginate = DB_LIST_ROWS)
    {
        $list = $this->modelSysUser->getList($where, $field, $order, $paginate)->toArray();
        if ($paginate === false) $list['data'] = $list;
        foreach ($list['data'] as &$row) {
            $row['dept_name'] = $this->modelSysDept->getValue(['id' => $row['dept_id']], 'name');
            $row['position_name'] = $this->modelSysPosition->getValue(['id' => $row['position_id']], 'name');
            $row['sys_auth_name'] = $this->logicSysAuthAccess->getUserAuthListName($row['id']);
        }
        return $list;
    }

    /**
     * 获取列
     */
    public function getSysUserColumn($where = [], $field = true)
    {
        return $this->modelSysUser->getColumn($where, $field);
    }

    /**
     * 获取单个信息
     */
    public function getSysUserInfo($where = [], $field = true)
    {
        return $this->modelSysUser->getInfo($where, $field);
    }

    /**
     * 添加
     */
    public function sysUserAdd($data = [])
    {

        $validate_result = $this->validateSysUser->scene('add')->check($data);
        if (!$validate_result) {
            return [RESULT_ERROR, $this->validateSysUser->getError()];
        }

        $data['password'] = data_md5_key($data['password']);
        $data['org_id'] = SYS_ORG_ID;

        $result = $this->modelSysUser->setInfo($data);

        $result && action_log('新增', '新增系统用户，name：' . $data['username']);
        $url = url('show');
        return $result ? [RESULT_SUCCESS, '系统用户添加成功', $url] : [RESULT_ERROR, $this->modelSysUser->getError()];
    }

    /**
     * 编辑
     */
    public function sysUserEdit($data = [])
    {

        $validate_result = $this->validateSysUser->scene('edit')->check($data);
        if (!$validate_result) {
            return [RESULT_ERROR, $this->validateSysUser->getError()];
        }

        $url = url('show');
        $result = $this->modelSysUser->setInfo($data);
        $result && action_log('编辑', '编辑用户，name：' . $data['username']);
        return $result ? [RESULT_SUCCESS, '编辑用户成功', $url] : [RESULT_ERROR, $this->modelSysUser->getError()];
    }

    /**
     * 删除
     */
    public function sysUserDel($data = [])
    {

        if (empty($data['id'])) {
            throw_response_error('选择执行的参数');
        }

        $ids = str2arr($data['id']);

        //防止误删超级权限
        if (in_array(SYS_ADMINISTRATOR_ID, $ids)) {
            throw_response_error('系统超级管理不能删除哦');
        }
        if (in_array(SYS_ADMINISTRATOR_ID, $ids)) {
            throw_response_error('企业超级管理不能删除哦');
        }

        $where['id'] = ['in', $ids];
        $result = $this->modelSysUser->deleteInfo($where, true);
        $result && action_log('删除', '删除用户，where：' . http_build_query($where));
        return $result ? [RESULT_SUCCESS, '用户删除成功'] : [RESULT_ERROR, $this->modelSysUser->getError()];
    }

    /**
     * 会员添加到权限
     */
    public function addToAuth($data = [])
    {

        $url = url('show');

        if (SYS_ADMINISTRATOR_ID == $data['id']) {
            return [RESULT_ERROR, '系统超级管理不能授权哦~', $url];
        }
        if (SYS_ORG_USER_ID == $data['id']) {
            return [RESULT_ERROR, '企业超级管理不能授权哦~', $url];
        }

        //清除之前权限与用户的映射关联
        $where = ['sys_user_id' => ['in', $data['id']]];
        $this->modelSysAuthAccess->deleteInfo($where, true);

        if (empty($data['sys_auth_id'])) {
            return [RESULT_SUCCESS, '会员授权成功', $url];
        }

        $user_ids = str2arr($data['id']);//兼容多个用户批量设置,id=1,2,3,4
        $add_data = [];
        foreach ($user_ids as $userid) {
            foreach ($data['sys_auth_id'] as $auth_id) {
                $add_data[] = ['sys_user_id' => $userid, 'sys_auth_id' => $auth_id];
            }
        }
        $result = $this->modelSysAuthAccess->setList($add_data);

        $result && action_log('授权', '会员授权，id：' . $data['id']);

        return $result ? [RESULT_SUCCESS, '会员授权成功'] : [RESULT_ERROR, $this->modelSysAuthAccess->getError()];

    }

    /**
     * 设置用户权限节点
     */
    public function setUserRules($data = [])
    {

        $data['rules'] = !empty($data['rules']) ? implode(',', array_unique($data['rules'])) : '';

        $url = url('show');

        $result = $this->modelSysUser->setInfo($data);
        if ($result) {

            action_log('授权', '设置用户权限，id：' . $data['id']);
            return [RESULT_SUCCESS, '权限设置成功', $url];
        } else {

            return [RESULT_ERROR, $this->modelSysUser->getError()];
        }
    }

    /**
     * 修改密码
     */
    public function editPassword($data = [])
    {

        $validate_result = $this->validateSysUser->scene('password')->check($data);
        if (!$validate_result) {
            return [RESULT_ERROR, $this->validateSysUser->getError()];
        }

        $user = $this->getSysUserInfo(['id' => $data['id']]);

        if (data_md5_key($data['old_password']) != $user['password']) {
            return [RESULT_ERROR, '旧密码输入不正确'];
        }

        $data['id'] = SYS_USER_ID;
        $data['password'] = data_md5_key($data['password']);
        $result = $this->modelSysUser->setInfo($data);

        $result && action_log('编辑', '会员密码修改，id：' . $data['id']);

        $url = url('index/index');
        return $result ? [RESULT_SUCCESS, '密码修改成功', $url] : [RESULT_ERROR, $this->modelSysUser->getError()];
    }

    /**
     * 重置密码
     */
    public function resetPassword($data = [])
    {

        $validate_result = $this->validateSysUser->scene('resetpassword')->check($data);
        if (!$validate_result) {

            return [RESULT_ERROR, $this->validateSysUser->getError()];
        }

        $md5password = data_md5_key($data['password']);
        $where['id'] = ['in', $data['id']];

        $result = $this->modelSysUser->setFieldValue($where, 'password', $md5password);

        $result && action_log('编辑', '重置密码修改，name：' . $data['username']);

        $url = url('index/index');
        return $result ? [RESULT_SUCCESS, '重置密码修改', $url] : [RESULT_ERROR, $this->modelSysUser->getError()];
    }

    /**
     * 设置职位
     */
    public function setPosition($data = [])
    {

        $where['id'] = ['in', $data['id']];
        $result = $this->modelSysUser->setFieldValue($where, 'position_id', $data['position_id']);

        $result && action_log('编辑', '设置职位，name：' . $data['username']);

        $url = url('index/index');
        return $result ? [RESULT_SUCCESS, '操作成功', $url] : [RESULT_ERROR, $this->modelSysUser->getError()];
    }

    /**
     * 设置部门
     */
    public function setDept($data = [])
    {

        $where['id'] = ['in', $data['id']];
        $result = $this->modelSysUser->setFieldValue($where, 'dept_id', $data['dept_id']);

        $result && action_log('编辑', '设置部门，name：' . $data['username']);

        $url = url('index/index');
        return $result ? [RESULT_SUCCESS, '操作成功', $url] : [RESULT_ERROR, $this->modelSysUser->getError()];
    }

    /**
     * 设置会员信息
     */
    public function setUserValue($where = [], $field = '', $value = '')
    {

        return $this->modelSysUser->setFieldValue($where, $field, $value);
    }


    /**
     * 查询条件
     *
     * @return array|mixed
     * Author: kfrs <goodkfrs@QQ.com> created by at 2020/7/19 0019
     */
    public function getWhere($data = [])
    {
        $where = [];
        if (!empty($data['keywords'])) {
            $where['username|mobile|realname'] = ['like', '%' . $data['keywords'] . '%'];
        }
        if (!empty($data['pid'])) {
            $ids = $this->logicSysDept->getDeptAllSon($data['pid']);
            $ids[] = $data['pid'];
            $where['dept_id'] = ['in', $ids];
        }
        return $where;
    }


    /**
     * 获取指定用户下属员工列表信息
     * @param $stype
     * @return array （[0]=array(''1)）
     * Author: lingqifei created by at 2020/3/29 0029
     */
    public function getSysUserSons1($id = 1, $type = 'selfson'){
        $ids = [];
        $user = $this->modelSysUser->getInfo(['id' => $id], 'dept_id,position_id');

        if (!empty($user)) {

            //下属职位
            $posi_son=[];
            if (!empty($user['position_id'])) {
                $posi_son = $this->logicSysPosition->getPositionAllSon($user['position_id']);
            }

            //默认为，同部门内下属职位用户id
            $where['dept_id'] = ['=', $user['dept_id']];//自己部门
            $where['position_id'] = ['in', $posi_son];//自己及下属
            $ids = $this->modelSysUser->getColumn($where, 'id');

            //叠加权限,获得当前职位的数据查看权限
            $data_role = $this->modelSysPosition->getValue(['id' => $user['position_id']], 'data_role');

            $role_ids = [];

            //所在部门,同部门其它同事id
            if ($data_role == 2) {

                $role_ids = $this->modelSysUser->getColumn(['dept_id' => $user['dept_id']], 'id');

            } elseif ($data_role == 3) {//所在部门及所在部门的下级部门同事id

                $dept_son = $this->logicSysDept->getDeptAllSon($user['dept_id']);
                $dept_son[] = $user['dept_id'];
                $role_ids = $this->modelSysUser->getColumn(['dept_id' => ['in', $dept_son]], 'id');

            } elseif ($data_role == 4) {//全部数据,所有同事的id

                $role_ids = $this->modelSysUser->getColumn([], 'id');

            }
            $ids = array_merge($ids, $role_ids);
        }

        if ($type == 'selfson') $ids[] = $id;
        if ($type == 'son')  $ids = delArrValue($ids,$id);//删除本身id
        $ids = array_unique($ids);//去除重复的

        $condition= [];
        $ids && $condition['id'] = ['in', $ids];
        $list = $this->modelSysUser->getList($condition, true, true, false)->toArray();
        return $list;

    }

}
