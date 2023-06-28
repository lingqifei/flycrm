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
 * 职位逻辑
 */
class SysPosition extends AdminBase
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
     * 职位添加
     */
    public function sysPositionAdd($data = [])
    {

        $validate_result = $this->validateSysPosition->scene('add')->check($data);
        if (!$validate_result) {
            return [RESULT_ERROR, $this->validateSysPosition->getError()];
        }

        $result = $this->modelSysPosition->setInfo($data);

        $result && action_log('新增', '新增职位，name：' . $data['name']);
        
        $url = url('show', ['pid' => $data['pid'] ? $data['pid'] : 0]);
        
        return $result ? [RESULT_SUCCESS, '添加成功', $result] : [RESULT_ERROR, $this->modelSysPosition->getError()];
    }
    
    /**
     * 职位编辑
     */
    public function sysPositionEdit($data = [])
    {
        
        $validate_result = $this->validateSysPosition->scene('edit')->check($data);
        
        if (!$validate_result) {
            return [RESULT_ERROR, $this->validateSysPosition->getError()];
        }
        
        $url = url('show');


        $result = $this->modelSysPosition->setInfo($data);

        $result && action_log('编辑', '编辑职位，name：' . $data['name']);
        
        return $result ? [RESULT_SUCCESS, '编辑成功', $url] : [RESULT_ERROR, $this->modelSysPosition->getError()];
    }
    
    /**
     * 职位删除
     */
    public function sysPositionDel($where = [])
    {
        
        $result = $this->modelSysPosition->deleteInfo($where,true);
        
        $result && action_log('删除', '删除职位，where：' . http_build_query($where));
        
        return $result ? [RESULT_SUCCESS, '删除成功'] : [RESULT_ERROR, $this->modelSysPosition->getError()];
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