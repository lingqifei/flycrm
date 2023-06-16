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

use think\db;

/**
 * 用户控制器
 */
class SysUser extends AdminBase
{

    /**
     * 菜单列表
     */
    public function show()
    {
        return $this->fetch('show');
    }

    /**
     * 选择查看
     */
    public function lookup()
    {

        if (IS_AJAX) {
            $where = $this->logicSysUser->getWhere($this->param);
            $list = $this->logicSysUser->getAllList($where,'id,username,realname');
            return $list;
        }

        //input ids name
        if (!empty($this->param['input_ids'])) {
            $this->assign('input_ids', $this->param['input_ids']);
        } else {
            $this->assign('input_ids', 'input_ids');
        }
        //input texts name
        if (!empty($this->param['input_text'])) {
            $this->assign('input_text', $this->param['input_text']);
        } else {
            $this->assign('input_text', 'input_text');
        }

        //回示区域
        if (!empty($this->param['lookupgroup'])) {
            $this->assign('lookupgroup', $this->param['lookupgroup']);
        } else {
            $this->assign('lookupgroup', 'lookupgroup');
        }

        //input ids name
        if (!empty($this->param['achieve'])) {
            $this->assign('achieve', $this->param['achieve']);
            return $this->fetch('lookup_achieve');
        }

        //选择方式
        if (!empty($this->param['pagetype'])) {
            switch ($this->param['pagetype']) {
                case 'one';
                    return $this->fetch('lookup_one');
            }
        }

        return $this->fetch('lookup');
    }


    //数据浏览
    public function show_json()
    {
        $where = $this->logicSysUser->getWhere($this->param);
        $list = $this->logicSysUser->getSysUserList($where);
        return $list;
    }

    /**
     * 菜单添加
     */
    public function add()
    {
        IS_POST && $this->jump($this->logicSysUser->sysUserAdd($this->param));

        $this->common_data();

        return $this->fetch('add');
    }

    /**
     * 系统用户编辑
     */
    public function edit()
    {

        IS_POST && $this->jump($this->logicSysUser->sysUserEdit($this->param));

        $info = $this->logicSysUser->getSysUserInfo(['id' => $this->param['id']]);

        $this->assign('info', $info);

        $this->common_data();

        return $this->fetch('edit');
    }

    /**
     * 系统用户编辑-》个人信息
     */
    public function editInfo()
    {

        IS_POST && $this->jump($this->logicSysUser->sysUserEdit($this->param));

        $info = $this->logicSysUser->getSysUserInfo(['id' => $this->param['id']]);

        $this->assign('info', $info);

        return $this->fetch('edit_info');
    }

    /**
     * 系统用户编辑->密码
     */
    public function editPwd()
    {

        IS_POST && $this->jump($this->logicSysUser->editPassword($this->param));

        $info = $this->logicSysUser->getSysUserInfo(['id' => $this->param['id']]);

        $this->assign('info', $info);

        return $this->fetch('edit_pwd');
    }

    /**
     * 系统用户编辑->密码
     */
    public function reset_pwd()
    {

        IS_POST && $this->jump($this->logicSysUser->resetPassword($this->param));

        $where['id'] = ['in', $this->param['id']];
        $sys_user_name = $this->logicSysUser->getSysUserColumn($where, 'realname');
        $sys_user_name && $sys_user_name = arr2str($sys_user_name);
        $this->assign('sys_user_name', $sys_user_name);
        $this->assign('id', $this->param['id']);
        return $this->fetch('reset_pwd');
    }

    /**
     * 删除
     */
    public function del()
    {
        $where = empty($this->param['id']) ? ['id' => 0] : ['id' => $this->param['id']];
        $this->jump($this->logicSysUser->sysUserDel($this->param));
    }

    /**
     * 会员授权=>权限角色
     */
    public function userAuth()
    {

        IS_POST && $this->jump($this->logicSysUser->addToAuth($this->param));

        // 所有的权限组
        $auth_list = $this->logicSysAuth->getAuthList($where = [], $field = true, $order = 'sort asc', $paginate = false);

        // 当前帐号已经有了的权限组
        $sys_user_auth_list = $this->logicSysAuthAccess->getUserAuthInfo($this->param['id']);

        // 选择权限组
        $list = $this->logicSysAuth->selectAuthList($auth_list, $sys_user_auth_list);
        $this->assign('list', $list);

        $where['id'] = ['in', $this->param['id']];
        $sys_user_name = $this->logicSysUser->getSysUserColumn($where, 'realname');
        $sys_user_name && $sys_user_name = arr2str($sys_user_name);
        $this->assign('sys_user_name', $sys_user_name);
        $this->assign('id', $this->param['id']);

        return $this->fetch('sys_user_auth');
    }

    /**
     * 会员栏目授权
     */
    public function userRules()
    {

        IS_POST && $this->jump($this->logicSysUser->setUserRules($this->param));

        //重新得到授权菜单
        $this->authMenuList = $this->logicSysAuthAccess->getAuthMenuList(SYS_USER_ID);

        // 获取未被过滤的菜单树
        $menu_tree = $this->logicAdminBase->getListTree($this->authMenuList);

        // 菜单转换为多选视图，支持无限级
        $menu_view = $this->logicSysMenu->menuToCheckboxView($menu_tree);

        $this->assign('list', $menu_view);

        $this->assign('id', $this->param['id']);

        return $this->fetch('user_rules');

    }


    /**
     * 系统用户->设置职位
     */
    public function userPosition()
    {

        IS_POST && $this->jump($this->logicSysUser->setPosition($this->param));

        $where['id'] = ['in', $this->param['id']];
        $sys_user_name = $this->logicSysUser->getSysUserColumn($where, 'realname');
        $sys_user_name && $sys_user_name = arr2str($sys_user_name);

        $this->assign('sys_user_name', $sys_user_name);
        $this->assign('id', $this->param['id']);

        $this->common_data();

        return $this->fetch('user_position');
    }

    /**
     * 系统用户->设置部门
     */
    public function userDept()
    {

        IS_POST && $this->jump($this->logicSysUser->setDept($this->param));

        $where['id'] = ['in', $this->param['id']];
        $sys_user_name = $this->logicSysUser->getSysUserColumn($where, 'realname');
        $sys_user_name && $sys_user_name = arr2str($sys_user_name);

        $this->assign('sys_user_name', $sys_user_name);
        $this->assign('id', $this->param['id']);

        $this->common_data();

        return $this->fetch('user_dept');
    }

    /**
     * 公共数据
     * Author: lingqifei created by at 2020/6/16 0016
     */
    public function common_data()
    {
        //获取菜单Select结构数据
        $dept_select = $this->logicSysDept->getSysDeptTreeSelect();
        $this->assign('dept_select', $dept_select);

        //获取菜单Select结构数据
        $position_listt = $this->logicSysPosition->getSysPositionTreeSelect();
        $this->assign('sys_position_list', $position_listt);

    }

}
