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