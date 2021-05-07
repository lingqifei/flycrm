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

namespace app\admin\logic;

/**
 * 地区管理逻辑
 */
class SysArea extends AdminBase
{
    
    // 面包屑
    public static $crumbs       = [];
    
    // 地区管理结构
    public static $deptSelect   = [];

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
     * 获取地区管理信息
     */
    public function getSysAreaInfo($where = [], $field = true)
    {
        return $this->modelSysArea->getInfo($where, $field);
    }
    
    /**
     * 地区管理添加
     */
    public function sysAreaAdd($data = [])
    {

        $validate_result = $this->validateSysArea->scene('add')->check($data);
        if (!$validate_result) {
            return [RESULT_ERROR, $this->validateSysArea->getError()];
        }

        $result = $this->modelSysArea->setInfo($data);

        $result && action_log('新增', '新增地区管理，name：' . $data['name']);
        
        $url = url('show', ['pid' => $data['pid'] ? $data['pid'] : 0]);
        
        return $result ? [RESULT_SUCCESS, '添加成功', $result] : [RESULT_ERROR, $this->modelSysArea->getError()];
    }
    
    /**
     * 地区管理编辑
     */
    public function sysAreaEdit($data = [])
    {
        
        $validate_result = $this->validateSysArea->scene('edit')->check($data);
        
        if (!$validate_result) {
            return [RESULT_ERROR, $this->validateSysArea->getError()];
        }
        
        $url = url('show');


        $result = $this->modelSysArea->setInfo($data);

        $result && action_log('编辑', '编辑地区管理，name：' . $data['name']);
        
        return $result ? [RESULT_SUCCESS, '编辑成功', $url] : [RESULT_ERROR, $this->modelSysArea->getError()];
    }

    /**
     * 地区管理 负责人员设置
     */
    public function sysAreaManage($data = [])
    {

        $result = $this->modelSysArea->setInfo($data);
        $result=$this->logicSysAreaUser->sysAreaUserAdd($data['id'],$data['manager_user_id']);

        $result && action_log('编辑', '编辑地区管理员，name：' .$data['manager_user_id']);
        $url = url('show');
        return $result ? [RESULT_SUCCESS, '编辑成功', $url] : [RESULT_ERROR, $this->modelSysArea->getError()];
    }

    /**
     * 地区管理删除
     */
    public function sysAreaDel($where = [])
    {
        
        $result = $this->modelSysArea->deleteInfo($where,true);
        
        $result && action_log('删除', '删除地区管理，where：' . http_build_query($where));
        
        return $result ? [RESULT_SUCCESS, '删除成功'] : [RESULT_ERROR, $this->modelSysArea->getError()];
    }

    /**获得所有指定id所有父级
     * @param int $deptid
     * @param array $data
     * @return array
     */
    public function getDeptAllPid($deptid=0, $data=[])
    {
        $where['id']=['=',$deptid];
        $info = $this->modelSysArea->getInfo($where,true);
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
        $sons = $this->modelSysArea->getList($where,true,'sort asc',false);
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