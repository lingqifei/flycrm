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
 * 部门逻辑
 */
class SysDept extends LogicBase
{
    
    // 面包屑
    public static $crumbs       = [];
    
    // 部门Select结构
    public static $deptSelect   = [];

    /**
     * 获取部门列表
     */
    public function getSysDeptList($where = [], $field = true, $order = 'sort asc', $paginate = DB_LIST_ROWS)
    {
        $where['org_id'] = ['>',0];
        return $this->modelSysDept->getList($where, $field, $order, $paginate);
    }

    //得到tree的数据
    public function getSysDeptListTree($where = [], $field = "id,name,pid", $order = 'sort asc', $paginate = false){

        $list=$this->getSysDeptList($where,$field,$order,$paginate)->toArray();
        $tree=list2tree($list);
        return $tree;
    }

	//得到tree的数据
	public function getSysDeptTreeSelect($where = [], $field = "id,name,pid", $order = 'sort asc', $paginate = false)
	{
		$list = $this->getSysDeptList($where, $field, $order, $paginate)->toArray();
		$data = list2select($list);
		return $data;
	}

    //得到tree的数据
    public function getSysDeptSelectData($where = [], $field = "id,name,pid", $order = 'sort asc', $paginate = false){

        $list=$this->getSysDeptList($where,$field,$order,$paginate)->toArray();
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
     * 获取部门信息
     */
    public function getSysDeptInfo($where = [], $field = true)
    {
        return $this->modelSysDept->getInfo($where, $field);
    }
    
    /**
     * 部门添加
     */
    public function sysDeptAdd($data = [])
    {

        $validate_result = $this->validateSysDept->scene('add')->check($data);
        if (!$validate_result) {
            return [RESULT_ERROR, $this->validateSysDept->getError()];
        }

        $result = $this->modelSysDept->setInfo($data);

        $result && action_log('新增', '新增部门，name：' . $data['name']);
        
        $url = url('show', ['pid' => $data['pid'] ? $data['pid'] : 0]);
        
        return $result ? [RESULT_SUCCESS, '部门添加成功', $result] : [RESULT_ERROR, $this->modelSysDept->getError()];
    }
    
    /**
     * 部门编辑
     */
    public function sysDeptEdit($data = [])
    {
        
        $validate_result = $this->validateSysDept->scene('edit')->check($data);
        
        if (!$validate_result) {
            return [RESULT_ERROR, $this->validateSysDept->getError()];
        }
        
        $url = url('show');


        $result = $this->modelSysDept->setInfo($data);

        $result && action_log('编辑', '编辑部门，name：' . $data['name']);
        
        return $result ? [RESULT_SUCCESS, '部门编辑成功', $url] : [RESULT_ERROR, $this->modelSysDept->getError()];
    }
    
    /**
     * 部门删除
     */
    public function sysDeptDel($where = [])
    {
        
        $result = $this->modelSysDept->deleteInfo($where,true);
        
        $result && action_log('删除', '删除部门，where：' . http_build_query($where));
        
        return $result ? [RESULT_SUCCESS, '部门删除成功'] : [RESULT_ERROR, $this->modelSysDept->getError()];
    }


    /**获得所有指定id所有父级
     * @param int $deptid
     * @param array $data
     * @return array
     */
    public function getDeptAllPid($deptid=0, $data=[])
    {
        $where['id']=['=',$deptid];
        $info = $this->modelSysDept->getInfo($where,true);
        if(!empty($info) && $info['pid']){
            $data[]=$info['pid'];
            return $this->getDeptAllPid($info['pid'],$data);
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
        $where['pid']=['=',$deptid];
        $sons = $this->modelSysDept->getList($where,true,'sort asc',false);
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