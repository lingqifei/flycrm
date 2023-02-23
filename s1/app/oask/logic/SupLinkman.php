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

namespace app\oask\logic;

use app\common\logic\TableField;

/**
 * 供应商联系人列表管理=》逻辑层
 */
class SupLinkman extends OaskBase
{
    /**
     * 供应商联系人列表列表
     * @param array $where
     * @param bool $field
     * @param string $order
     * @param int|mixed $paginate
     * @return
     */
    public function getSupLinkmanList($where = [], $field = 'a.*,s.name as supplier_name', $order = 'a.update_time desc', $paginate = DB_LIST_ROWS)
    {
        $this->modelSupLinkman->alias('a');
        $join = [
            [SYS_DB_PREFIX . 'sup_supplier s', 's.id = a.supplier_id','LEFT'],
        ];
        $this->modelSupLinkman->join=$join;

        $list =  $this->modelSupLinkman->getList($where, $field, $order, $paginate)->toArray();

        if($paginate===false) $list['data']=$list;

        foreach ($list['data']  as  &$row){

        }
        return $list;
    }

    /**
     * 供应商联系人列表列表
     * @param array $where
     * @param bool $field
     * @param string $order
     * @param int|mixed $paginate
     * @return array()
     */
    public function getSupLinkmanSelect()
    {
        $map=[
            "listtype"=>'selfson'
        ];
        $where=$this->getWhere($map);
        $this->modelSupLinkman->alias('a');
        $join = [
            [SYS_DB_PREFIX . 'sup_supplier s', 's.id = a.supplier_id','LEFT'],
        ];
        $this->modelSupLinkman->join=$join;

        $list =  $this->modelSupLinkman->getList($where, 'a.id,a.name', '', false)->toArray();

        return $list;
    }

    /**
     * 供应商联系人列表添加
     * @param array $data
     * @return array
     */
    public function supLinkmanAdd($data = [])
    {

        $validate_result = $this->validateSupLinkman->scene('add')->check($data);

        if (!$validate_result) {

            return [RESULT_ERROR, $this->validateSupLinkman->getError()];
        }
        $result = $this->modelSupLinkman->setInfo($data);
        $url = url('show');
        $result && action_log('新增', '新增供应商联系人列表：' . $data['name']);

        return $result ? [RESULT_SUCCESS, '添加成功', $url] : [RESULT_ERROR, $this->modelSupLinkman->getError()];
    }

    /**
     * 供应商联系人列表编辑
     * @param array $data
     * @return array
     */
    public function supLinkmanEdit($data = [])
    {

        $validate_result = $this->validateSupLinkman->scene('edit')->check($data);

        if (!$validate_result) {

            return [RESULT_ERROR, $this->validateSupLinkman->getError()];
        }

        $url = url('show');

        $result = $this->modelSupLinkman->setInfo($data);

        $result && action_log('编辑', '编辑供应商联系人列表，name：' . $data['name']);

        return $result ? [RESULT_SUCCESS, '编辑成功', $url] : [RESULT_ERROR, $this->modelSupLinkman->getError()];
    }

    /**
     * 供应商联系人列表删除
     * @param array $where
     * @return array
     */
    public function supLinkmanDel($where = [])
    {

        $result = $this->modelSupLinkman->deleteInfo($where,true);

        $result && action_log('删除', '删除供应商联系人列表，where：' . http_build_query($where));

        return $result ? [RESULT_SUCCESS, '删除成功'] : [RESULT_ERROR, $this->modelSupLinkman->getError()];
    }

    /**供应商联系人列表信息
     * @param array $where
     * @param bool $field
     * @return
     */
    public function getSupLinkmanInfo($where = [], $field = true)
    {
        return $this->modelSupLinkman->getInfo($where, $field);
    }


    /**
     * 获取列表搜索条件
     */
    public function getWhere($data = [])
    {

        $where = [];
        //关键字查
        !empty($data['keywords']) && $where['a.name|a.mobile|a.tel|a.address'] = ['like', '%'.$data['keywords'].'%'];

        if(!empty($data['listtype'])){
            if($data['listtype']=='selfson'){
                $ids=$this->logicSysUser->getSysUserDeptSelfSon(SYS_USER_ID);
            }else if($data['listtype']=='self'){
                $ids=SYS_USER_ID;
            }else if($data['listtype']=='son'){
                $ids=$this->logicSysUser->getSysUserDeptSon(SYS_USER_ID);
            }
            $where['s.owner_user_id'] = ['in', $ids];
        }

        return $where;
    }

    /**
     * 获取排序条件
     */
    public function getOrderBy($data = [])
    {
        $order_by="";
        //排序操作
        if(!empty($data['orderField'])){
            $orderField = $data['orderField'];
            $orderDirection = $data['orderDirection'];
        }else{
            $orderField="";
            $orderDirection="";
        }
        if( $orderField=='by_supplier' ){
            $order_by ="s.name $orderDirection";
        }else if($orderField=='by_next'){
            $order_by ="a.next_time $orderDirection";
        }else{
            $order_by ="a.create_time desc";
        }
        return $order_by;
    }

    /**
     * 联系人列表下载
     * @param array $where
     * @param bool $field
     * @param string $order
     * @param int|mixed $paginate
     * @return
     */
    public function getSupLinkmanListDown($where = [], $field = '', $order = 'a.id desc', $paginate = false)
    {
        $this->modelSupLinkman->alias('a');
        $join = [
            [SYS_DB_PREFIX . 'sup_supplier s', 's.id = a.supplier_id','LEFT'],
        ];
        $this->modelSupLinkman->join=$join;

        $list =  $this->modelSupLinkman->getList($where, $field, $order, $paginate)->toArray();

        foreach ($list as &$row) {
            $row['gender_text'] = ($row['gender']==1)?'男':'女';
            $row['supplier_name'] = $this->modelSupSupplier->getValue(['id' => $row['supplier_id']], 'name');
            $row['create_user_name'] = $this->modelSysUser->getValue(['id' => $row['create_user_id']], 'realname');
        }

        $titles = "名称,姓别,职位,手机,电话,qq,邮箱,地址,邮编,备注,供应商名称,创建时间,创建人";
        $keys = "name,gender_text,postion,mobile,tel,qicq,email,address,zipcode,remark,supplier_name,create_time,create_user_name";

        action_log('下载', '供应商联系人列表');
        export_excel($titles, $keys, $list, '供应商联系人列表');
    }
}
