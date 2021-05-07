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
 * 职位逻辑
 */
class SysPosition extends LogicBase
{
    
    // 面包屑
    public static $crumbs       = [];
    
    // 职位Select结构
    public static $deptSelect   = [];

    /**
     * 获取职位列表
     */
    public function getSysPositionList($where = [], $field = true, $order = 'sort asc', $paginate = DB_LIST_ROWS)
    {
        $where['org_id'] = ['>',0];
        return $this->modelSysPosition->getList($where, $field, $order, $paginate);
    }

    //得到tree的数据
    public function getSysPositionListTree($where = [], $field = "id,name,pid", $order = 'sort asc', $paginate = false){

        $list=$this->getSysPositionList($where,$field,$order,$paginate)->toArray();
        $tree=list2tree($list);
        return $tree;
    }

    //得到tree的数据
    public function getSysPositionTreeSelect($where = [], $field = "id,name,pid", $order = 'sort asc', $paginate = false){

        $list=$this->getSysPositionList($where,$field,$order,$paginate)->toArray();
        $data=list2select($list);
        return $data;
    }

    //得到tree的数据
    public function getSysPositionSelectData($where = [], $field = "id,name,pid", $order = 'sort asc', $paginate = false){

        $list=$this->getSysPositionList($where,$field,$order,$paginate)->toArray();
        $tree=list2tree($list);
        $data=$this->deptToSelect($tree);

        return $data;
    }

    /**
     * 树形转Select
     */
    public function deptToSelect($dept_list = [], $level = 0, $name = 'name', $child = 'nodes')
    {
        $dept_list_count = count($dept_list);
        if(is_array($dept_list)){
            foreach ($dept_list as $k => $info) {

                empty($k) && ++$level;

                $tmp_str = str_repeat("&nbsp;", $level * 4) . "├";

                $info[$name] = $tmp_str . $info[$name] . "&nbsp;";

                array_push(self::$deptSelect, $info);

                if (!array_key_exists($child, $info)) {

                    $k != $dept_list_count - DATA_NORMAL ? : $level > DATA_NORMAL && --$level;

                } else {

                    $tmp_ary = $info[$child];

                    unset($info[$child]);

                    $this->deptToSelect($tmp_ary, $level, $name, $child);
                }
            }
        }
        return self::$deptSelect;
    }


    /**
     * 获取职位信息
     */
    public function getSysPositionInfo($where = [], $field = true)
    {
        return $this->modelSysPosition->getInfo($where, $field);
    }

    /**
     * 获得指定职位上级iID
     * @param int $deptid
     * @return Number   0/1..N
     */
    public function getPositionPid($posid=0)
    {
        $where['id']=['=',$posid];
        $pid= $this->modelSysPosition->getValue($where,'pid');
        if($pid){
            return $pid;
        }else{
            return  0;
        }
    }

    /**获得所有指定id所有父级
     * @param int $deptid
     * @param array $data
     * @return array
     */
    public function getPositionAllPid($deptid=0, $data=[])
    {
        $where['id']=['=',$deptid];
        $info = $this->modelSysPosition->getInfo($where,true);
        if(!empty($info) && $info['pid']){
            $data[]=$info['pid'];
            return $this->getPositionAllPid($info['pid'],$data);
        }
        return $data;
    }

    /**获得所有指定id所有子级
     * @param int $deptid
     * @param array $data
     * @return array
     */
    public function getPositionAllSon($deptid=0, $data=[])
    {
        $where['pid']=['=',$deptid];
        $sons = $this->modelSysPosition->getList($where,true,'sort asc',false);
        if (count($sons) > 0) {
            foreach ($sons as $v) {
                $data[] = $v['id'];
                $data = $this->getPositionAllSon($v['id'], $data); //注意写$data 返回给上级
            }
        }
        if (count($data) > 0) {
            return $data;
        } else {
            return false;
        }
        return $data;
    }


}