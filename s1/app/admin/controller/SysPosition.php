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
 * 职位控制器
 */
class SysPosition extends AdminBase
{
    /**
     * 职位列表
     */
    public function show()
    {
        return  $this->fetch('show');
    }


    /**
     * 职位列表
     */
    public function show_json()
    {
        $where = [];
        if (!empty($this->param['keywords'])) {
            $where['name'] = ['like', '%' . $this->param['keywords'] . '%'];
        }
        if (!empty($this->param['pid'])) {
            //$ids=$this->logicSysPosition->getDeptAllSon($this->param['pid']);
            $where['pid'] = ['in', $this->param['pid']];
        }else{
            $where['pid'] = ['in', '0'];
        }
        $list=$this->logicSysPosition->getSysPositionList($where);
        return $list;
    }


    /**
     * 职位列表
     */
    public function get_list_tree()
    {
        $tree=$this->logicSysPosition->getSysPositionListTree();
        return $tree;
    }

    /**
     * 职位添加
     */
    public function add()
    {

        IS_POST && $this->jump($this->logicSysPosition->sysPositionAdd($this->param));

        //获取职位Select结构数据
        $dept_select=$this->logicSysPosition->getSysPositionTreeSelect();
        $this->assign('dept_select', $dept_select);

        if (!empty($this->param['id'])) {
            $this->assign('pid', $this->param['id']);
        }else{
            $this->assign('pid', '0');
        }

        return $this->fetch('add');
    }
    
    /**
     * 职位编辑
     */
    public function edit()
    {

        IS_POST && $this->jump($this->logicSysPosition->sysPositionEdit($this->param));

        $info = $this->logicSysPosition->getSysPositionInfo(['id' => $this->param['id']]);

        //获取职位Select结构数据
        $dept_select=$this->logicSysPosition->getSysPositionTreeSelect();

        $this->assign('dept_select', $dept_select);
        $this->assign('info', $info);

        return $this->fetch('edit');

    }
    /**
     * 数据状态设置
     */
    public function del()
    {
        $where = empty($this->param['id']) ? ['id' => 0] : ['id' => $this->param['id']];
        $this->jump($this->logicSysPosition->sysPositionDel($where));
    }

    /**
     * 排序
     */
    public function set_visible()
    {
        $this->jump($this->logicAdminBase->setField('SysPosition', $this->param));
    }

    /**
     * 排序
     */
    public function set_sort()
    {
        $this->jump($this->logicAdminBase->setSort('SysPosition', $this->param));
    }

}
