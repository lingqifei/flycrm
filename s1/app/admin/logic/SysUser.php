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
    public function getSysUserList($where = [], $field = true, $order = 'id desc', $paginate = DB_LIST_ROWS)
    {
        $list = $this->modelSysUser->getList($where, $field, $order, $paginate)->toArray();
        if ($paginate === false) $list['data'] = $list;
        foreach ($list['data'] as &$row) {
            $row['dept_name'] = $this->modelSysDept->getValue(['id' => $row['dept_id']], 'name');
            $row['position_name'] = $this->modelSysPosition->getValue(['id' => $row['position_id']], 'name');
            $row['sys_auth_name'] = arr2str(array_column($this->logicSysAuthAccess->getUserAuthListName($row['id']), 'name'), ',');
        }
        return $list;
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
    public function sysUserDel($where = [], $data = [])
    {

        if (SYS_ADMINISTRATOR_ID == $data['id']) {
            return [RESULT_ERROR, '系统超级管理不能删除哦~'];
        }
        if (SYS_ORG_USER_ID == $data['id']) {
            return [RESULT_ERROR, '企业超级管理不能删除哦~'];
        }

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

        $where = ['sys_user_id' => ['in', $data['id']]];

        $this->modelSysAuthAccess->deleteInfo($where, true);

        if (empty($data['sys_auth_id'])) {
            return [RESULT_SUCCESS, '会员授权成功', $url];
        }

        $add_data = [];

        foreach ($data['sys_auth_id'] as $auth_id) {

            $add_data[] = ['sys_user_id' => $data['id'], 'sys_auth_id' => $auth_id];
        }

        if ($this->modelSysAuthAccess->setList($add_data)) {

            action_log('授权', '会员授权，id：' . $data['id']);

            //$this->logicSysAuth->updateSubAuthByUser($data['id']);

            return [RESULT_SUCCESS, '会员授权成功', $url];
        } else {

            return [RESULT_ERROR, $this->modelAuthGroupAccess->getError()];
        }
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
        $url = url('index/index');

        $result = $this->modelSysUser->setInfo($data);

        $result && action_log('编辑', '会员密码修改，id：' . $data['id']);

        return $result ? [RESULT_SUCCESS, '密码修改成功', $url] : [RESULT_ERROR, $this->modelSysUser->getError()];
    }

    /**
     * 重置密码
     */
    public function ResetPassword($data = [])
    {

        $validate_result = $this->validateSysUser->scene('resetpassword')->check($data);

        if (!$validate_result) {

            return [RESULT_ERROR, $this->validateSysUser->getError()];
        }
        $user = $this->getSysUserInfo(['id' => $data['id']]);

        $data['password'] = data_md5_key($data['password']);

        $url = url('index/index');

        $result = $this->modelSysUser->setInfo($data);

        $result && action_log('编辑', '重置密码修改，name：' . $user['username']);

        return $result ? [RESULT_SUCCESS, '重置密码修改', $url] : [RESULT_ERROR, $this->modelSysUser->getError()];
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

}
