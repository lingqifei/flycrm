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
