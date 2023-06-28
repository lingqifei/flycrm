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
 * 行政区域控制器
 */
class Region extends AdminBase
{

    public $upid='100000';

    public function __construct()
    {

        // 执行父类构造方法
        parent::__construct();

        if (!empty($this->param['upid'])) {
            $this->upid=$this->param['upid'];
            $this->assign('upid', $this->param['upid']);
        }else{
            $this->assign('upid', $this->upid);
        }



    }
    /**
     * 行政区域列表
     */
    public function show()
    {


        $regionpath=$this->logicRegion->getRegionPidPath($this->upid);

        $this->assign('regionpath', $regionpath);

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


        $this->assign('upid', $this->upid);


        return $this->fetch('add');
    }
    
    /**
     * 行政区域编辑
     */
    public function edit()
    {

        IS_POST && $this->jump($this->logicRegion->regionEdit($this->param));

        $info = $this->logicRegion->getRegionInfo(['id' => $this->param['id']]);

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
