<?php
/**
 * 零起飞-(07FLY-CRM)
 * ==============================================
 * 版权所有 2015-2028   成都零起飞网络，并保留所有权利。
 * 网站地址: http://www.07fly.xyz
 * ----------------------------------------------------------------------------
 * 如果商业用途务必到官方购买正版授权, 以免引起不必要的法律纠纷.
 * ==============================================
 * Regulationor: kfrs <goodkfrs@QQ.com> 574249366
 * Date: 2019-10-3
 */

namespace app\oask\logic;

use app\common\logic\TableField;

/**
 * 规章制度列表管理=》逻辑层
 */
class Regulation extends OaskBase
{



    public function __construct()
    {

    }

    /**
     * 规章制度列表列表
     * @param array $where
     * @param bool $field
     * @param string $order
     * @param int|mixed $paginate
     * @return
     */
    public function getRegulationList($where = [], $field = true, $order = 'update_time desc', $paginate = DB_LIST_ROWS)
    {
        $list = $this->modelRegulation->getList($where, $field, $order, $paginate);

        foreach ($list as &$row) {
            $row['type_name']=$this->modelRegulationType->getValue(['id'=>$row['type_id']],'name');
            $row['create_user_name']=$this->logicSysUser->getRealname($row['type_id']);
        }
        return $list;
    }

    /**
     * 规章制度列表添加
     * @param array $data
     * @return array
     */
    public function regulationAdd($data = [])
    {

        $validate_result = $this->validateRegulation->scene('add')->check($data);
        if (!$validate_result) {
            return [RESULT_ERROR, $this->validateRegulation->getError()];
        }
		$data['create_user_id'] = SYS_USER_ID;
		$result = $this->modelRegulation->setInfo($data);

        $url = url('show');
        $result && action_log('新增', '新增规章制度列表：' . $data['name']);
        return $result ? [RESULT_SUCCESS, '添加成功', $url] : [RESULT_ERROR, $this->modelRegulation->getError()];
    }

    /**
     * 规章制度列表编辑
     * @param array $data
     * @return array
     */
    public function regulationEdit($data = [])
    {

        $validate_result = $this->validateRegulation->scene('edit')->check($data);
        if (!$validate_result) {
            return [RESULT_ERROR, $this->validateRegulation->getError()];
        }

		$result = $this->modelRegulation->setInfo($data);

        $result && action_log('编辑', '编辑规章制度列表，name：' . $data['name']);
        $url = url('show');
        return $result ? [RESULT_SUCCESS, '编辑成功', $url] : [RESULT_ERROR, $this->modelRegulation->getError()];
    }

    /**
     * 规章制度列表删除
     * @param array $where
     * @return array
     */
    public function regulationDel($data = [])
    {
        if(!empty($data['id'])){
            $where['id'] = ['=',$data['id']];
        }else{
            $where['id'] = ['=',0];
        }
        $result = $this->modelRegulation->deleteInfo($where, true);
        $result && action_log('删除', '删除规章制度列表，where：' . http_build_query($where));
        return $result ? [RESULT_SUCCESS, '删除成功'] : [RESULT_ERROR, $this->modelRegulation->getError()];
    }

    /**规章制度列表信息
     * @param array $where
     * @param bool $field
     * @return
     */
    public function getRegulationInfo($where = [], $field = true)
    {
        $info= $this->modelRegulation->getInfo($where, $field);
        $info['create_user_name'] = $this->logicSysUser->getValue(['id'=>$info['create_user_id']],'realname');
        return $info;
    }


    /**销售合同列表信息
     * @param array $where
     * @param bool $field
     * @return
     */
    public function getRegulationDetail($data = [])
    {
        $rtnArray=[];
        $map = ['customer_id' => $data['id']];
        if ($data['type'] == 'trace') {
            $list =$this->logicCstTrace->getCstTraceList($map,'a.*,c.name as customer_name','',false);
        } else if ($data['type'] == 'linkman') {
			$list['data'] = $this->modelCstLinkman->getList($map, '', '', false);
			foreach ($list['data'] as &$row){
				$row['gender_text']=$this->modelCstLinkman->getGenderText($row['gender']);
			}
        } else if ($data['type'] == 'chance') {
            $list = $this->logicCstChance->getCstChanceList($map, 'a.*,c.name as customer_name,TIMESTAMPDIFF(DAY,a.link_time,DATE_FORMAT(NOW(), \'%Y-%m-%d %H:%i:%S\')) as nodays', '', false);
        } else if ($data['type'] == 'salcontract') {
            $list = $this->logicSalContract->getSalContractList($map, "a.*,c.name as customer_name", 'a.update_time desc', false);
            $listtype['total_money'] = array_sum(array_column($list['data'], 'money'));
        } else if ($data['type'] == 'recerecord') {
            $list = $this->serviceFinReceRecord->getFinReceRecordList($map, true, 'id desc', false);
        } else if ($data['type'] == 'invoice') {
            $list = $this->serviceFinInvoicePay->getFinInvoicePayList($map, true, 'id desc', false);
            $listtype['total_money'] = array_sum(array_column($list['data'], 'money'));
        }
        $rtnArray['data'] = $list['data'];
        $rtnArray['type'] = $data['type'];
        return $rtnArray;
    }


    /**
     * 获取列表搜索条件
     */
    public function getWhere($data = [])
    {

        $where = [];
        //关键字查
        !empty($data['keywords']) && $where['name|regulation_no|address|remark'] = ['like', '%' . $data['keywords'] . '%'];
        !empty($data['pid']) && $where['type_id'] = ['=', '' . $data['pid'] . ''];

        //购买日期
        if (!empty($data['begin_rangedate'])) {
            $range_date = str2arr($data['begin_rangedate'], "-");
            $where['begin_date'] = ['between', $range_date];
        }
        //到期日期
        if (!empty($data['end_rangedate'])) {
            $range_date = str2arr($data['end_rangedate'], "-");
            $where['end_date'] = ['between', $range_date];
        }

        return $where;
    }

    /**
     * 获取排序条件
     */
    public function getOrderBy($data = [])
    {
        $order_by = "";
        if (!empty($data['orderField'])) {
            $orderField = $data['orderField'];
            $orderDirection = $data['orderDirection'];
        } else {
            $orderField = "";
            $orderDirection = "";
        }
        if ($orderField == 'by_link') {
            $order_by = "link_time $orderDirection";
        } else if ($orderField == 'by_next') {
            $order_by = "next_time $orderDirection";
        } else if ($orderField == 'by_nodays') {
            $order_by = "nodays $orderDirection";
        } else {
            $order_by = "id desc";
        }
        return $order_by;
    }


}
