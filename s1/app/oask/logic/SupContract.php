<?php
/**
 * 零起飞-(07FLY-CRM)
 * ==============================================
 * 版权所有 2015-2028   成都零起飞网络，并保留所有权利。
 * 网站地址: http://www.07fly.xyz
 * ----------------------------------------------------------------------------
 * 如果商业用途务必到官方购买正版授权, 以免引起不必要的法律纠纷.
 * ==============================================
 * SupContractor: kfrs <goodkfrs@QQ.com> 574249366
 * Date: 2019-10-3
 */

namespace app\oask\logic;

use app\common\logic\TableField;

/**
 * 销售合同管理=》逻辑层
 */
class SupContract extends OaskBase
{
    /**
     * 销售合同列表
     * @param array $where
     * @param bool $field
     * @param string $order
     * @param int|mixed $paginate
     * @return
     */
    public function getSupContractList($where = [], $field = 'a.*,c.name as supplier_name', $order = 'a.update_time desc', $paginate = DB_LIST_ROWS)
    {
        $this->modelSupContract->alias('a');
        $join = [
            [SYS_DB_PREFIX . 'sup_supplier c', 'c.id = a.supplier_id','LEFT'],
        ];
        $this->modelSupContract->join=$join;
        $list =  $this->modelSupContract->getList($where, $field, $order, $paginate)->toArray();
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
    public function supContractAdd($data = [])
    {

        $validate_result = $this->validateSupContract->scene('add')->check($data);
        if (!$validate_result) {
            return [RESULT_ERROR, $this->validateSupContract->getError()];
        }
		$data['create_user_id']=SYS_USER_ID;
        $result = $this->modelSupContract->setInfo($data);


		if(!empty($data['remind_date'])){
			sys_msg('sup_contract',$result,$data['name'],SYS_USER_ID,$data['remind_date']);
		}

        $url = url('show');
        $result && action_log('新增', '新增销售合同：' . $data['name']);
        return $result ? [RESULT_SUCCESS, '添加成功', $url] : [RESULT_ERROR, $this->modelSupContract->getError()];
    }

    /**
     * 销售合同编辑
     * @param array $data
     * @return array
     */
    public function supContractEdit($data = [])
    {

        $validate_result = $this->validateSupContract->scene('edit')->check($data);
        if (!$validate_result) {
            return [RESULT_ERROR, $this->validateSupContract->getError()];
        }
        $result = $this->modelSupContract->setInfo($data);
        $result && action_log('编辑', '编辑销售合同，name：' . $data['name']);
        $url = url('show');
        return $result ? [RESULT_SUCCESS, '编辑成功', $url] : [RESULT_ERROR, $this->modelSupContract->getError()];
    }

    /**
     * 销售合同删除
     * @param array $where
     * @return array
     */
    public function supContractDel($where = [])
    {

        $result = $this->modelSupContract->deleteInfo($where,true);

        $result && action_log('删除', '删除销售合同，where：' . http_build_query($where));

        return $result ? [RESULT_SUCCESS, '删除成功'] : [RESULT_ERROR, $this->modelSupContract->getError()];
    }

    /**销售合同信息
     * @param array $where
     * @param bool $field
     * @return
     */
    public function getSupContractInfo($where = [], $field = true)
    {
        $info= $this->modelSupContract->getInfo($where, $field);
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

		if(!empty($data['supplier_id'])){
			$where['a.supplier_id'] = ['=', $data['supplier_id']];
		}

		if(!empty($data['status'])){
			$where['a.status'] = ['=', $data['status']];
		}

		if(!empty($data['create_user_id'])){
			$where['a.create_user_id'] = ['=', $data['create_user_id']];
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
    public function getSupContractListDown($where = [], $field = '', $order = 'a.id desc', $paginate = false)
    {
        $this->modelSupContract->alias('a');
        $join = [
            [SYS_DB_PREFIX . 'cst_supplier c', 'c.id = a.supplier_id','LEFT'],
        ];
        $this->modelSupContract->join=$join;
        $list =  $this->modelSupContract->getList($where, $field, $order, $paginate)->toArray();

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
