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
 * 编码规则控制器
 */
class SysSeqnum extends AdminBase
{
    /**
     * 编码规则列表
     */
    public function show()
    {
        return $this->fetch('show');
    }

    /**
     * 编码规则列表
     */
    public function show_json()
    {
        $where = [];
        if (!empty($this->param['keywords'])) {
            $where['name'] = ['like', '%' . $this->param['keywords'] . '%'];
        }
        $list = $this->logicSysSeqnum->getSysSeqnumList($where);
        return $list;
    }


    /**
     * 编码规则列表
     */
    public function get_list_tree()
    {
        $tree = $this->logicSysSeqnum->getSysSeqnumListTree();
        return $tree;
    }

    /**
     * 编码规则添加
     */
    public function add()
    {

        IS_POST && $this->jump($this->logicSysSeqnum->sysSeqnumAdd($this->param));

        return $this->fetch('add');
    }

    /**
     * 编码规则编辑
     */
    public function edit()
    {

        IS_POST && $this->jump($this->logicSysSeqnum->sysSeqnumEdit($this->param));
        $info = $this->logicSysSeqnum->getSysSeqnumInfo(['id' => $this->param['id']]);
        $this->assign('info', $info);
        return $this->fetch('edit');
    }

    /**
     * 数据状态设置
     */
    public function del()
    {
        $where = empty($this->param['id']) ? ['id' => 0] : ['id' => $this->param['id']];
        $this->jump($this->logicSysSeqnum->sysSeqnumDel($where));
    }

    /**
     * 排序
     */
    public function set_visible()
    {
        $this->jump($this->logicAdminBase->setField('SysSeqnum', $this->param));
    }

    /**
     * 排序
     */
    public function set_sort()
    {
        $this->jump($this->logicAdminBase->setSort('SysSeqnum', $this->param));
    }

}
