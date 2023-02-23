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
 * 供应商列表管理=》逻辑层
 */
class SupSupplier extends OaskBase
{
    /**
     * 供应商列表列表
     * @param array $where
     * @param bool $field
     * @param string $order
     * @param int|mixed $paginate
     * @return
     */
    public function getSupSupplierList($where = [], $field = true, $order = 'update_time desc', $paginate = DB_LIST_ROWS)
    {

        $list =  $this->modelSupSupplier->getList($where, $field, $order, $paginate)->toArray();
        foreach ($list['data']  as  &$row){
            //$row['status_text']=$this->logicCstDict->getCstDictOneName($row['status']);
			$row['create_user_name']=$this->logicSysUser->getRealname($row['create_user_id']);
        }
        return $list;
    }

    /**
     * 供应商列表列表
     * @param array $where
     * @param bool $field
     * @param string $order
     * @param int|mixed $paginate
     * @return
     */
    public function getSupSupplierSelect()
    {
        $map=[
            "listtype"=>'selfson'
        ];
        $where=$this->getWhere($map);
        $list =  $this->modelSupSupplier->getList($where, 'name,id', 'update_time desc', false)->toArray();
        return $list;
    }

    /**
     * 供应商列表添加
     * @param array $data
     * @return array
     */
    public function supSupplierAdd($data = [])
    {

        $validate_result = $this->validateSupSupplier->scene('add')->check($data);
        if (!$validate_result) {
            return [RESULT_ERROR, $this->validateSupSupplier->getError()];
        }

        $adddata=$data;
        $adddata['create_user_id']=SYS_USER_ID;

        $supplier_id  = $this->modelSupSupplier->setInfo($adddata);

        //增加到联系人
        $linkmandata=[
            'supplier_id'=>$supplier_id,
            'name'=>$data['linkman'],
            'mobile'=>$data['mobile'],
            'create_user_id'=>SYS_USER_ID,
        ];
        $result=$this->modelSupLinkman->setInfo($linkmandata);

        $url = url('show');
        $result && action_log('新增', '新增供应商列表：' . $data['name']);
        return $result ? [RESULT_SUCCESS, '添加成功', $url] : [RESULT_ERROR, $this->modelSupSupplier->getError()];
    }

    /**
     * 供应商列表编辑
     * @param array $data
     * @return array
     */
    public function supSupplierEdit($data = [])
    {

        $validate_result = $this->validateSupSupplier->scene('edit')->check($data);
        if (!$validate_result) {
            return [RESULT_ERROR, $this->validateSupSupplier->getError()];
        }

        $result = $this->modelSupSupplier->setInfo($data);

        $result && action_log('编辑', '编辑供应商列表，name：' . $data['name']);
        $url = url('show');
        return $result ? [RESULT_SUCCESS, '编辑成功', $url] : [RESULT_ERROR, $this->modelSupSupplier->getError()];
    }

    /**
     * 供应商列表删除
     * @param array $where
     * @return array
     */
    public function supSupplierDel($where = [])
    {

        $result = $this->modelSupSupplier->deleteInfo($where,true);

        $result && action_log('删除', '删除供应商列表，where：' . http_build_query($where));
        return $result ? [RESULT_SUCCESS, '删除成功'] : [RESULT_ERROR, $this->modelSupSupplier->getError()];
    }

    /**供应商列表信息
     * @param array $where
     * @param bool $field
     * @return
     */
    public function getSupSupplierInfo($where = [], $field = true)
    {
        return $this->modelSupSupplier->getInfo($where, $field);
    }


    /**销售合同列表信息
     * @param array $where
     * @param bool $field
     * @return
     */
    public function getSupSupplierDetail($data=[])
    {
        $map=['supplier_id'=>$data['id']];
		if ($data['type'] == 'trace') {
			$list = $this->logicSupTrace->getSupTraceList($map, 'a.*,c.name as supplier_name', '', false);
		}else if($data['type']=='contract'){
			$list = $this->logicSupContract->getSupContractList($map, 'a.*,c.name as supplier_name', '', false);
            $listtype['total_money']=array_sum(array_column($list,'money'));
        }else if($data['type']=='sales'){
			$list = $this->logicSupSales->getSupSalesList($map, "a.*,c.name as supplier_name", 'a.create_time desc', false);
			$listtype['total_money'] = array_sum(array_column($list['data'], 'money'));
        }
        $listtype['data']=$list['data'];
        $listtype['type']=$data['type'];
        return $listtype;
    }


    /**
     * 获取列表搜索条件
     */
    public function getWhere($data = [])
    {

        $where = [];
        //关键字查
        !empty($data['keywords']) && $where['name|linkman|tel|mobile|address|delegate|channel|address_mail|linkman_other'] = ['like', '%'.$data['keywords'].'%'];
        !empty($data['firmcategory']) && $where['firmcategory'] = ['like', '%'.$data['customerstatus'].'%'];
        !empty($data['level']) && $where['level'] = ['like', '%'.$data['level'].'%'];
        !empty($data['agreement']) && $where['agreement'] = ['like', '%'.$data['agreement'].'%'];

        //查看公开程度
        if(isset($data['openstatus'])){
            if (!empty($data['openstatus']) || is_numeric($data['openstatus'])){
                $where['openstatus'] = ['=',$data['openstatus']];
            }
        }

        //查看下属数据
        if(!empty($data['listtype'])){
            if($data['listtype']=='selfson'){
                $ids=$this->logicSysUser->getSysUserDeptSelfSon(SYS_USER_ID);
            }else if($data['listtype']=='self'){
                $ids=SYS_USER_ID;
            }else if($data['listtype']=='son'){
                $ids=$this->logicSysUser->getSysUserDeptSon(SYS_USER_ID);
            }
            $where['owner_user_id'] = ['in', $ids];
        }

        return $where;
    }

    /**
     * 获取排序条件
     */
    public function getOrderBy($data = [])
    {
        $order_by="";
        if(!empty($data['orderField'])){
            $orderField = $data['orderField'];
            $orderDirection = $data['orderDirection'];
        }else{
            $orderField="";
            $orderDirection="";
        }
        if( $orderField=='by_name' ){
            $order_by ="name $orderDirection";
        }else if($orderField=='by_ecotype'){
            $order_by ="ecotype $orderDirection";
        }else if($orderField=='by_industry'){
            $order_by ="industry  $orderDirection";
        }else{
            $order_by ="id desc";
        }
        return $order_by;
    }

    /**
     * 供应商列表下载
     * @param array $where
     * @param bool $field
     * @param string $order
     * @param int|mixed $paginate
     * @return
     */
    public function getSupSupplierListDown($where = [], $field = true, $order = 'id desc', $paginate = DB_LIST_ROWS)
    {
        $list =  $this->modelSupSupplier->getList($where, $field, $order, false)->toArray();

        foreach ($list as  &$row){
            $row['create_user_name']=$this->modelSysUser->getValue(['id'=>$row['create_user_id']],'realname');
            $row['owner_user_name']=$this->modelSysUser->getValue(['id'=>$row['owner_user_id']],'realname');
        }

        $titles = "供应商名称,联系人,手机,电话,电话,QQ,地址,备注,经济类型,客户等级,客户行业,满意度,信誉度,创建时间,更新时间,归属人,创建人";
        $keys   = "name,linkman,mobile,tel,qicq,weixin,address,remark,ecotype,level,industry,satisfy,credit,create_time,update_time,owner_user_name,create_user_name";

        action_log('下载', '客户列表列表');
        export_excel($titles, $keys, $list, '客户列表');
    }

}
