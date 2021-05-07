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
 * 地区控制器
 */
class SysArea extends AdminBase
{
    /**
     * 地区列表
     */
    public function show()
    {
        return  $this->fetch('show');
    }


    /**
     * 地区列表
     */
    public function show_json()
    {
        $where = [];
        if (!empty($this->param['keywords'])) {
            $where['name'] = ['like', '%' . $this->param['keywords'] . '%'];
        }
        if (!empty($this->param['pid'])) {
            //$ids=$this->logicSysArea->getDeptAllSon($this->param['pid']);
            $where['pid'] = ['in', $this->param['pid']];
        }else{
            $where['pid'] = ['in', '0'];
        }
        $list=$this->logicSysArea->getSysAreaList($where);
        return $list;
    }


    /**
     * 地区列表
     */
    public function get_list_tree()
    {
        $tree=$this->logicSysArea->getSysAreaListTree();
        return $tree;
    }

    /**
     * 地区添加
     */
    public function add()
    {

        IS_POST && $this->jump($this->logicSysArea->sysAreaAdd($this->param));

        //获取地区Select结构数据
        $dept_select=$this->logicSysArea->getSysAreaTreeSelect();
        $this->assign('dept_select', $dept_select);

        if (!empty($this->param['id'])) {
            $this->assign('pid', $this->param['id']);
        }else{
            $this->assign('pid', '0');
        }

        return $this->fetch('add');
    }
    
    /**
     * 地区编辑
     */
    public function edit()
    {

        IS_POST && $this->jump($this->logicSysArea->sysAreaEdit($this->param));

        $info = $this->logicSysArea->getSysAreaInfo(['id' => $this->param['id']]);

        //获取地区Select结构数据
        $dept_select=$this->logicSysArea->getSysAreaTreeSelect();

        $this->assign('dept_select', $dept_select);
        $this->assign('info', $info);

        return $this->fetch('edit');
    }

    /**
     * 地区负责人员编辑
     */
    public function manage()
    {

        IS_POST && $this->jump($this->logicSysArea->sysAreaManage($this->param));

        $info = $this->logicSysArea->getSysAreaInfo(['id' => $this->param['id']]);

        $this->assign('info', $info);

        return $this->fetch('manage');
    }

    /**
     * 数据状态设置
     */
    public function del()
    {
        $where = empty($this->param['id']) ? ['id' => 0] : ['id' => $this->param['id']];
        $this->jump($this->logicSysArea->sysAreaDel($where));
    }

    /**
     * 排序
     */
    public function set_visible()
    {
        $this->jump($this->logicAdminBase->setField('SysArea', $this->param));
    }

    /**
     * 排序
     */
    public function set_sort()
    {
        $this->jump($this->logicAdminBase->setSort('SysArea', $this->param));
    }

}
