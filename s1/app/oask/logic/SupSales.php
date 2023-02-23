<?php
/**
 * 零起飞-(07FLY-CRM)
 * ==============================================
 * 版权所有 2015-2028   成都零起飞网络，并保留所有权利。
 * 网站地址: http://www.07fly.xyz
 * ----------------------------------------------------------------------------
 * 如果商业用途务必到官方购买正版授权, 以免引起不必要的法律纠纷.
 * ==============================================
 * SupSalesor: kfrs <goodkfrs@QQ.com> 574249366
 * Date: 2019-10-3
 */

namespace app\oask\logic;

use app\common\logic\TableField;

/**
 * 采购记录管理=》逻辑层
 */
class SupSales extends OaskBase
{
    /**
     * 采购记录列表
     * @param array $where
     * @param bool $field
     * @param string $order
     * @param int|mixed $paginate
     * @return
     */
    public function getSupSalesList($where = [], $field = 'a.*,c.name as supplier_name', $order = 'a.update_time desc', $paginate = DB_LIST_ROWS)
    {
        $this->modelSupSales->alias('a');
        $join = [
            [SYS_DB_PREFIX . 'sup_supplier c', 'c.id = a.supplier_id','LEFT'],
        ];
        $this->modelSupSales->join=$join;
        $list =  $this->modelSupSales->getList($where, $field, $order, $paginate)->toArray();
        if($paginate===false) $list['data']=$list;
        foreach ($list['data']  as  &$row){
            $row['create_user_name']=$this->logicSysUser->getRealname($row['create_user_id']);
        }
        return $list;
    }

    /**
     * 采购记录添加
     * @param array $data
     * @return array
     */
    public function supSalesAdd($data = [])
    {

        $validate_result = $this->validateSupSales->scene('add')->check($data);
        if (!$validate_result) {
            return [RESULT_ERROR, $this->validateSupSales->getError()];
        }
		$data['create_user_id']=SYS_USER_ID;
        $result = $this->modelSupSales->setInfo($data);

        $url = url('show');
        $result && action_log('新增', '新增采购记录：' . $data['name']);
        return $result ? [RESULT_SUCCESS, '添加成功', $url] : [RESULT_ERROR, $this->modelSupSales->getError()];
    }

    /**
     * 采购记录编辑
     * @param array $data
     * @return array
     */
    public function supSalesEdit($data = [])
    {

        $validate_result = $this->validateSupSales->scene('edit')->check($data);
        if (!$validate_result) {
            return [RESULT_ERROR, $this->validateSupSales->getError()];
        }
        $result = $this->modelSupSales->setInfo($data);
        $result && action_log('编辑', '编辑采购记录，name：' . $data['name']);
        $url = url('show');
        return $result ? [RESULT_SUCCESS, '编辑成功', $url] : [RESULT_ERROR, $this->modelSupSales->getError()];
    }

    /**
     * 采购记录删除
     * @param array $where
     * @return array
     */
    public function supSalesDel($where = [])
    {

        $result = $this->modelSupSales->deleteInfo($where,true);

        $result && action_log('删除', '删除采购记录，where：' . http_build_query($where));

        return $result ? [RESULT_SUCCESS, '删除成功'] : [RESULT_ERROR, $this->modelSupSales->getError()];
    }

    /**采购记录信息
     * @param array $where
     * @param bool $field
     * @return
     */
    public function getSupSalesInfo($where = [], $field = true)
    {
        $info= $this->modelSupSales->getInfo($where, $field);
		$info['create_user_name']=$this->logicSysUser->getRealname($info['create_user_id']);
		$info['supplier_name']=$this->modelCstCustomer->getValue(['id'=>$info['supplier_id']],'name');

		return $info;
    }


    /**
     * 获取列表搜索条件
     */
    public function getWhere($data = [])
    {

        $where = [];
        //关键字查
        !empty($data['keywords']) && $where['a.remark|a.name'] = ['like', '%'.$data['keywords'].'%'];


        //下次联系时间
        if(!empty($data['purchase_rangedate'])){
            $range_date=str2arr($data['purchase_rangedate'],"-");
            $where['a.purchase_date'] = ['between', $range_date];
        }
        //联系时间
        if(!empty($data['end_rangedate'])){
            $range_date=str2arr($data['end_rangedate'],"-");
            $where['a.end_date'] = ['between', $range_date];
        }


        return $where;
    }

    /**
     * 获取排序条件
     */
    public function getOrderBy($data = [])
    {
        if(!empty($data['orderField'])){
            $orderField = $data['orderField'];
            $orderDirection = $data['orderDirection'];
        }else{
            $orderField="";
            $orderDirection="";
        }
        if( $orderField=='by_link' ){
            $order_by ="a.link_time $orderDirection";
        }else if($orderField=='by_next'){
            $order_by ="a.next_time $orderDirection";
        }else{
            $order_by ="a.create_time desc";
        }
        return $order_by;
    }

    /**
     * 列表下载
     * @param array $where
     * @param bool $field
     * @param string $order
     * @param int|mixed $paginate
     * @return
     */
    public function getSupSalesListDown($where = [], $field = '', $order = 'a.id desc', $paginate = false)
    {
        $this->modelSupSales->alias('a');
        $join = [
            [SYS_DB_PREFIX . 'cst_supplier c', 'c.id = a.supplier_id','LEFT'],
        ];
        $this->modelSupSales->join=$join;
        $list =  $this->modelSupSales->getList($where, $field, $order, $paginate)->toArray();

        foreach ($list as &$row) {
            $row['supplier_name'] = $this->modelCstCustomer->getValue(['id' => $row['supplier_id']], 'name');
            $row['linkman_name'] = $this->modelCstLinkman->getValue(['id' => $row['linkman_id']], 'name');
            $row['chance_name'] = $this->modelCstLinkman->getValue(['id' => $row['chance_id']], 'name');
            $row['create_user_name'] = $this->modelSysUser->getValue(['id' => $row['create_user_id']], 'realname');
            $row['owner_user_name'] = $this->modelSysUser->getValue(['id' => $row['owner_user_id']], 'realname');
        }

        $titles = "联系时间,联系方式,客户名称,沟通内容,下次联系时间,当前状态,创建时间,更新时间,创建人";
        $keys = "link_time,salemode,supplier_name,link_body,next_time,salestage,create_time,update_time,create_user_name";

        action_log('下载', '沟通记录列表');
        export_excel($titles, $keys, $list, '沟通记录列表');
    }

}
