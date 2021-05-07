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

namespace app\admin\controller;
use think\db;
/**
 * 用户控制器
 */
class SysAuth extends AdminBase
{

    /**
     * 列表
     */
    public function show()
    {
        return  $this->fetch('show');
    }
    /**
     * 列表json数据
     */
    public function show_json()
    {
        $where = [];
        if(!empty($this->param['keywords'])){
            $where['name|intro']=['like','%'.$this->param['keywords'].'%'];
        }
        $list =$this->logicSysAuth->getAuthList($where)->toArray();
        return $list;
    }


    /**
     * 添加
     */
    public function add()
    {
        IS_POST && $this->jump($this->logicSysAuth->authAdd($this->param));

        return $this->fetch('add');
    }
    
    /**
     * 编辑
     */
    public function edit()
    {
        
        IS_POST && $this->jump($this->logicSysAuth->authEdit($this->param));

        $info = $this->logicSysAuth->getAuthInfo(['id' => $this->param['id']]);
        
        $this->assign('info', $info);

        return $this->fetch('edit');
    }
    /**
     * 数据状态设置
     */
    public function del()
    {
        $where = empty($this->param['id']) ? ['id' => 0] : ['id' => $this->param['id']];
        $this->jump($this->logicSysAuth->authDel($where));
    }

    /**
     * 菜单授权
     */
    public function menuAuth()
    {

        IS_POST && $this->jump($this->logicSysAuth->setAuthRules($this->param));

        //重新得到授权菜单
        $this->authMenuList = $this->logicSysAuthAccess->getAuthMenuList(SYS_USER_ID);

        // 获取未被过滤的菜单树
        $menu_tree = $this->logicAdminBase->getListTree($this->authMenuList);

        // 菜单转换为多选视图，支持无限级
        $menu_view = $this->logicSysMenu->menuToCheckboxView($menu_tree);

        $this->assign('list', $menu_view);

        $this->assign('id', $this->param['id']);

        return $this->fetch('menu_auth');
    }
}
