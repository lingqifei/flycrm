<?php
/**
 * 零起飞-(07FLY-CRM)
 * ==============================================
 * 版权所有 2015-2028   成都零起飞网络，并保留所有权利。
 * 网站地址: http://www.07fly.xyz
 * ----------------------------------------------------------------------------
 * 如果商业用途务必到官方购买正版授权, 以免引起不必要的法律纠纷.
 * ==============================================
 * CstContractor: kfrs <goodkfrs@QQ.com> 574249366
 * Date: 2019-10-3
 */

namespace app\oask\logic;

use app\common\logic\TableField;

/**
 * 销售合同管理=》逻辑层
 */
class CstContract extends OaskBase
{
    /**
     * 销售合同列表
     * @param array $where
     * @param bool $field
     * @param string $order
     * @param int|mixed $paginate
     * @return
     */
    public function getCstContractList($where = [], $field = 'a.*,c.name as customer_name', $order = 'a.update_time desc', $paginate = DB_LIST_ROWS)
    {
        $this->modelCstContract->alias('a');
        $join = [
            [SYS_DB_PREFIX . 'cst_customer c', 'c.id = a.customer_id','LEFT'],
        ];
        $this->modelCstContract->join=$join;
        $list =  $this->modelCstContract->getList($where, $field, $order, $paginate)->toArray();
        if($paginate===false) $list['data']=$list;
        foreach ($list['data']  as  &$row){
            $row['create_user_name']=$this->logicSysUser->getRealname($row['create_user_id']);
        }
        return $list;
    }

    /**
     * 销售合同添加
     * @param array $data
     * @return array
     */
    public function cstContractAdd($data = [])
    {

        $validate_result = $this->validateCstContract->scene('add')->check($data);
        if (!$validate_result) {
            return [RESULT_ERROR, $this->validateCstContract->getError()];
        }
		$data['create_user_id']=SYS_USER_ID;
        $result = $this->modelCstContract->setInfo($data);

        $url = url('show');
        $result && action_log('新增', '新增销售合同：' . $data['name']);
        return $result ? [RESULT_SUCCESS, '添加成功', $url] : [RESULT_ERROR, $this->modelCstContract->getError()];
    }

    /**
     * 销售合同编辑
     * @param array $data
     * @return array
     */
    public function cstContractEdit($data = [])
    {

        $validate_result = $this->validateCstContract->scene('edit')->check($data);
        if (!$validate_result) {
            return [RESULT_ERROR, $this->validateCstContract->getError()];
        }
        $result = $this->modelCstContract->setInfo($data);
        $result && action_log('编辑', '编辑销售合同，name：' . $data['name']);
        $url = url('show');
        return $result ? [RESULT_SUCCESS, '编辑成功', $url] : [RESULT_ERROR, $this->modelCstContract->getError()];
    }

    /**
     * 销售合同删除
     * @param array $where
     * @return array
     */
    public function cstContractDel($where = [])
    {

        $result = $this->modelCstContract->deleteInfo($where,true);

        $result && action_log('删除', '删除销售合同，where：' . http_build_query($where));

        return $result ? [RESULT_SUCCESS, '删除成功'] : [RESULT_ERROR, $this->modelCstContract->getError()];
    }

    /**销售合同信息
     * @param array $where
     * @param bool $field
     * @return
     */
    public function getCstContractInfo($where = [], $field = true)
    {
        $info= $this->modelCstContract->getInfo($where, $field);
		$info['create_user_name']=$this->logicSysUser->getRealname($info['create_user_id']);

		return $info;
    }


    /**
     * 获取列表搜索条件
     */
    public function getWhere($data = [])
    {

        $where = [];
        //关键字查
        !empty($data['keywords']) && $where['a.contract_no|a.name'] = ['like', '%'.$data['keywords'].'%'];

		if(!empty($data['customer_id'])){
			$where['a.customer_id'] = ['=', $data['customer_id']];
		}


		//下次联系时间
        if(!empty($data['begin_rangedate'])){
            $range_date=str2arr($data['begin_rangedate'],"-");
            $where['a.begin_date'] = ['between', $range_date];
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
    public function getCstContractListDown($where = [], $field = '', $order = 'a.id desc', $paginate = false)
    {
        $this->modelCstContract->alias('a');
        $join = [
            [SYS_DB_PREFIX . 'cst_customer c', 'c.id = a.customer_id','LEFT'],
        ];
        $this->modelCstContract->join=$join;
        $list =  $this->modelCstContract->getList($where, $field, $order, $paginate)->toArray();

        foreach ($list as &$row) {
            $row['customer_name'] = $this->modelCstCustomer->getValue(['id' => $row['customer_id']], 'name');
            $row['linkman_name'] = $this->modelCstLinkman->getValue(['id' => $row['linkman_id']], 'name');
            $row['chance_name'] = $this->modelCstLinkman->getValue(['id' => $row['chance_id']], 'name');
            $row['create_user_name'] = $this->modelSysUser->getValue(['id' => $row['create_user_id']], 'realname');
            $row['owner_user_name'] = $this->modelSysUser->getValue(['id' => $row['owner_user_id']], 'realname');
        }

        $titles = "联系时间,联系方式,客户名称,沟通内容,下次联系时间,当前状态,创建时间,更新时间,创建人";
        $keys = "link_time,salemode,customer_name,link_body,next_time,salestage,create_time,update_time,create_user_name";

        action_log('下载', '沟通记录列表');
        export_excel($titles, $keys, $list, '沟通记录列表');
    }

}
