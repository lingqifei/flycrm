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

namespace app\admin\logic;

/**
 * 行政区域管理逻辑
 */
class Region extends AdminBase
{
    
    // 面包屑
    public static $crumbs       = [];
    
    // 行政区域管理结构
    public static $deptSelect   = [];

    /**
     * 获取行政区域管理列表
     */
    public function getRegionList($where = [], $field = true, $order = 'sort asc', $paginate = DB_LIST_ROWS)
    {
        return $this->modelRegion->getList($where, $field, $order, $paginate);
    }

    //得到tree的数据
    public function getRegionListTree($where = [], $field = "id,name,upid", $order = 'sort asc', $paginate = false){

        $list=$this->getRegionList($where,$field,$order,$paginate)->toArray();
        $tree=list2tree($list,0,0,'id','upid');
        return $tree;
    }

    //得到tree的数据
    public function getRegionTreeSelect($where = [], $field = "id,name,upid", $order = 'sort asc', $paginate = false){

        $list=$this->getRegionList($where,$field,$order,$paginate)->toArray();
        $data=list2select($list, $pId = 0, $level = 0, $pk = 'id', $pidk = 'upid');
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
     * 获取行政区域管理信息
     */
    public function getRegionInfo($where = [], $field = true)
    {
        return $this->modelRegion->getInfo($where, $field);
    }
    
    /**
     * 行政区域管理添加
     */
    public function regionAdd($data = [])
    {

        $validate_result = $this->validateRegion->scene('add')->check($data);
        if (!$validate_result) {
            return [RESULT_ERROR, $this->validateRegion->getError()];
        }

        $result = $this->modelRegion->setInfo($data);

        $result && action_log('新增', '新增行政区域管理，name：' . $data['name']);
        
        $url = url('show', ['upid' => $data['upid'] ? $data['upid'] : 0]);
        
        return $result ? [RESULT_SUCCESS, '添加成功', $result] : [RESULT_ERROR, $this->modelRegion->getError()];
    }
    
    /**
     * 行政区域管理编辑
     */
    public function regionEdit($data = [])
    {
        
        $validate_result = $this->validateRegion->scene('edit')->check($data);
        
        if (!$validate_result) {
            return [RESULT_ERROR, $this->validateRegion->getError()];
        }
        
        $url = url('show');


        $result = $this->modelRegion->setInfo($data);

        $result && action_log('编辑', '编辑行政区域管理，name：' . $data['name']);
        
        return $result ? [RESULT_SUCCESS, '编辑成功', $url] : [RESULT_ERROR, $this->modelRegion->getError()];
    }

    /**
     * 行政区域管理 负责人员设置
     */
    public function regionManage($data = [])
    {

        $result = $this->modelRegion->setInfo($data);
        $result=$this->logicRegionUser->regionUserAdd($data['id'],$data['manager_user_id']);

        $result && action_log('编辑', '编辑行政区域管理员，name：' .$data['manager_user_id']);
        $url = url('show');
        return $result ? [RESULT_SUCCESS, '编辑成功', $url] : [RESULT_ERROR, $this->modelRegion->getError()];
    }

    /**
     * 行政区域管理删除
     */
    public function regionDel($where = [])
    {
        
        $result = $this->modelRegion->deleteInfo($where,true);
        
        $result && action_log('删除', '删除行政区域管理，where：' . http_build_query($where));
        
        return $result ? [RESULT_SUCCESS, '删除成功'] : [RESULT_ERROR, $this->modelRegion->getError()];
    }

    /**获得所有指定id所有父级
     * @param int $deptid
     * @param array $data
     * @return array
     */
    public function getDeptAllPid($deptid=0, $data=[])
    {
        $where['id']=['=',$deptid];
        $info = $this->modelRegion->getInfo($where,true);
        if(!empty($info) && $info['upid']){
            $data[]=$info['upid'];
            return $this->getDeptAllPid($info['upid'],$data);
        }
        return $data;
    }

    /**获得所有指定id所有子级
     * @param int $deptid
     * @param array $data
     * @return array
     */
    public function getDeptAllSon($deptid=0, $data=[])
    {
        $where['upid']=['=',$deptid];
        $sons = $this->modelRegion->getList($where,true,'sort asc',false);
        if (count($sons) > 0) {
            foreach ($sons as $v) {
                $data[] = $v['id'];
                $data = $this->getDeptAllSon($v['id'], $data); //注意写$data 返回给上级
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