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
 * 菜单控制器
 */
class SysMenu extends AdminBase
{
    /**
     * 菜单列表
     */
    public function show()
    {
        return  $this->fetch('show');
    }
    /**
     * 菜单列表
     */
    public function show_json()
    {
        $where = [];
        if (!empty($this->param['keywords'])) {
            $where['name'] = ['like', '%' . $this->param['keywords'] . '%'];
        }
        if (!empty($this->param['pid'])) {
            //$ids=$this->logicSysDept->getDeptAllSon($this->param['pid']);
            $where['pid'] = ['in', $this->param['pid']];
        }else{
            $where['pid'] = ['in', '0'];
        }
        $list=$this->logicSysMenu->getSysMenuList($where,true,'sort asc',DB_LIST_ROWS);
        return $list;
    }

    /**
     * 菜单列表
     */
    public function get_list_tree()
    {

        $tree=$this->logicSysMenu->getSysMenuListTree();
        return $tree;
    }

    /**
     * 获取菜单Select结构数据
     */
    public function getMenuSelectData($oid,$sid)
    {
        $menu_select = $this->logicSysMenu->menuToSelect($oid,$sid);
        $this->assign('menu_select', $menu_select);
    }
    
    /**
     * 菜单添加
     */
    public function add()
    {
        IS_POST && $this->jump($this->logicSysMenu->sysMenuAdd($this->param));

        //获取菜单Select结构数据
        $menu_select=$this->logicSysMenu->getSysDeptTreeSelect();

        $this->assign('menu_select', $menu_select);
        if (!empty($this->param['id'])) {
            $this->assign('pid', $this->param['id']);
        }else{
            $this->assign('pid', '0');
        }

        return $this->fetch('add');
    }
    
    /**
     * 菜单编辑
     */
    public function edit()
    {
        IS_POST && $this->jump($this->logicSysMenu->sysMenuEdit($this->param));

        $info = $this->logicSysMenu->getSysMenuInfo(['id' => $this->param['id']]);
        //获取菜单Select结构数据
        $menu_select=$this->logicSysMenu->getSysDeptTreeSelect();

        $this->assign('menu_select', $menu_select);
        $this->assign('info', $info);

        return $this->fetch('edit');
    }
    /**
     * 数据状态设置
     */
    public function del()
    {
        $where = empty($this->param['id']) ? ['id' => 0] : ['id' => $this->param['id']];
        $this->jump($this->logicSysMenu->sysMenuDel($where));
    }

    /**
     * 启用
     */
    public function set_visible()
    {
        $this->jump($this->logicAdminBase->setField('SysMenu', $this->param));
    }

    /**
     * 排序
     */
    public function set_sort()
    {
        $this->jump($this->logicAdminBase->setSort('SysMenu', $this->param));
    }

	/**
	 * 字段修改
	 */
	public function set_field()
	{
		$this->jump($this->logicAdminBase->setField('SysMenu', $this->param));
	}
}
