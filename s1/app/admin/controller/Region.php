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
 * 行政区域控制器
 */
class Region extends AdminBase
{
    /**
     * 行政区域列表
     */
    public function show()
    {
        return  $this->fetch('show');
    }


    /**
     * 行政区域列表
     */
    public function show_json()
    {
        $where = [];
        if (!empty($this->param['keywords'])) {
            $where['name'] = ['like', '%' . $this->param['keywords'] . '%'];
        }
        if (!empty($this->param['upid'])) {
            $where['upid'] = ['in', $this->param['upid']];
        }else{
            $where['upid'] = ['in', '0'];
        }
        $list=$this->logicRegion->getRegionList($where);
        return $list;
    }


    /**
     * 行政区域列表
     */
    public function get_list_tree()
    {
        $tree=$this->logicRegion->getRegionListTree();
        return $tree;
    }

    /**
     * 行政区域添加
     */
    public function add()
    {

        IS_POST && $this->jump($this->logicRegion->regionAdd($this->param));

        //获取行政区域Select结构数据
        $dept_select=$this->logicRegion->getRegionTreeSelect();
        $this->assign('dept_select', $dept_select);

        if (!empty($this->param['id'])) {
            $this->assign('upid', $this->param['id']);
        }else{
            $this->assign('upid', '0');
        }

        return $this->fetch('add');
    }
    
    /**
     * 行政区域编辑
     */
    public function edit()
    {

        IS_POST && $this->jump($this->logicRegion->regionEdit($this->param));

        $info = $this->logicRegion->getRegionInfo(['id' => $this->param['id']]);

        //获取行政区域Select结构数据
        $dept_select=$this->logicRegion->getRegionTreeSelect();

        $this->assign('dept_select', $dept_select);
        $this->assign('info', $info);

        return $this->fetch('edit');
    }

    /**
     * 行政区域负责人员编辑
     */
    public function manage()
    {

        IS_POST && $this->jump($this->logicRegion->regionManage($this->param));

        $info = $this->logicRegion->getRegionInfo(['id' => $this->param['id']]);

        $this->assign('info', $info);

        return $this->fetch('manage');
    }

    /**
     * 数据状态设置
     */
    public function del()
    {
        $where = empty($this->param['id']) ? ['id' => 0] : ['id' => $this->param['id']];
        $this->jump($this->logicRegion->regionDel($where));
    }

    /**
     * 排序
     */
    public function set_visible()
    {
        $this->jump($this->logicAdminBase->setField('Region', $this->param));
    }

    /**
     * 排序
     */
    public function set_sort()
    {
        $this->jump($this->logicAdminBase->setSort('Region', $this->param));
    }

}
