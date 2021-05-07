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
 * 用户逻辑
 */
class SysUser extends LogicBase
{
    /**
     * 获取列表
     */
    public function getUserList($where = [], $field = true, $order = 'id desc', $paginate = DB_LIST_ROWS)
    {
        return $this->modelSysUser->getList($where, $field, $order, $paginate);
    }
    
    /**
     * 获取单个信息
     */
    public function getUserInfo($where = [], $field = true)
    {
        return $this->modelSysUser->getInfo($where, $field);
    }

    /**
     * 获取列信息
     */
    public function getUserValue($where = [], $field = '')
    {
        return $this->modelSysUser->getValue($where, $field);
    }


    /**获取指定用户下属员工
     * @param int $id
     * @return array ex:[1,2,3,4]
     * Author: lingqifei created by at 2020/3/29 0029
     */
    public function getSysUserDeptSon($id=0){
        $ids=[];
        $info=$this->modelSysUser->getInfo(['id'=>$id]);
        if($info){
            $dept_son=$this->logicSysDept->getDeptAllSon($info['dept_id']);
            $map['dept_id']=['in',$dept_son];
            $ids=$this->modelSysUser->getColumn($map,'id');
        }
        return $ids;
    }


    /**获取指定用户下属员工
     * @param int $id
     * @return array  ex:[1,2,3,4]
     * Author: lingqifei created by at 2020/3/29 0029
     */
    public function getSysUserDeptSelfSon($id=SYS_USER_ID){
        $ids=[];
        $dept_id=$this->modelSysUser->getValue(['id'=>$id],'dept_id');
        if($dept_id){
            $dept_son=$this->logicSysDept->getDeptAllSon($dept_id);
            $dept_son[]=$dept_id;
            $map['dept_id']=['in',$dept_son];
            $ids=$this->modelSysUser->getColumn($map,'id');
        }
        return $ids;
    }

    /**获取指定用户下属员工列表信息
     * @param $stype
     * @return array （[0]=array(''1)）
     * Author: lingqifei created by at 2020/3/29 0029
     */
    public function  getSysUserSubList($stype=''){
        $where=[];
        $ids='';
        switch ($stype){
            case "selfson":
                $ids=$this->getSysUserDeptSelfSon();
                break;
            case "son":
                $ids=$this->getSysUserDeptSon();
                break;
            default:

                break;
        }
        $ids && $where['id']=['in',$ids];
        $list= $this->modelSysUser->getList($where, true, true, false)->toArray();
        return  $list;
    }

}
