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

namespace app\common\logic;

/**
 * 地区逻辑
 */
class SysArea extends LogicBase
{

    /**
     * 获取地区管理列表
     */
    public function getSysAreaList($where = [], $field = true, $order = 'sort asc', $paginate = DB_LIST_ROWS)
    {
        $where['org_id'] = ['>',0];
        return $this->modelSysArea->getList($where, $field, $order, $paginate);
    }

    //得到tree的数据
    public function getSysAreaListTree($where = [], $field = "id,name,pid", $order = 'sort asc', $paginate = false){

        $list=$this->getSysAreaList($where,$field,$order,$paginate)->toArray();
        $tree=list2tree($list);
        return $tree;
    }

    //得到tree的数据
    public function getSysAreaTreeSelect($where = [], $field = "id,name,pid", $order = 'sort asc', $paginate = false){

        $list=$this->getSysAreaList($where,$field,$order,$paginate)->toArray();
        $data=list2select($list);
        return $data;
    }


}