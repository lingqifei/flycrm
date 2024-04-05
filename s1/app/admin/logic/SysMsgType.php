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

use think\Db;

/**
 * 系统消息逻辑
 */
class SysMsgType extends AdminBase
{

    /**
     * 获取消息列表
     */
    public function getSysMsgTypeList($where = [], $field = true, $order = 'id desc', $paginate = DB_LIST_ROWS)
    {
        $list = $this->modelSysMsgType->getList($where, true, 'create_time desc', $paginate);
        return $list;
    }

    /**
     * 消息删除
     */
    public function getSysMsgTypeInfo($where = [])
    {
        return $this->modelSysMsgType->getInfo($where, true);
    }

    /**
     * 消息删除
     */
    public function sysMsgTypeDel($where = [])
    {
        return $this->modelSysMsgType->deleteInfo($where, true) ? [RESULT_SUCCESS, '删除成功'] : [RESULT_ERROR, $this->modelSysMsgType->getError()];
    }

    /**更新修改
     * @param array $data
     * @return array
     * Author: 开发人生 goodkfrs@qq.com
     * Date: 2021/9/8 0008 10:25
     */
    public function sysMsgTypeAdd($data = [])
    {
        $validate_result = $this->validateSysMsgType->scene('add')->check($data);
        if (!$validate_result) {
            return [RESULT_ERROR, $this->validateSysMsgType->getError()];
        }
        $result = $this->modelSysMsgType->setInfo($data);
        $result && action_log('添加', 'name：' . $data['name']);
        $url = url('show');
        return $result ? [RESULT_SUCCESS, '添加成功', $url] : [RESULT_ERROR, $this->modelSysMsgType->getError()];
    }

    /**更新修改
     * @param array $data
     * @return array
     * Author: 开发人生 goodkfrs@qq.com
     * Date: 2021/9/8 0008 10:25
     */
    public function sysMsgTypeEdit($data = [])
    {

        $validate_result = $this->validateSysMsgType->scene('edit')->check($data);
        if (!$validate_result) {
            return [RESULT_ERROR, $this->validateSysMsgType->getError()];
        }

        $url = url('show');
        $result = $this->modelSysMsgType->setInfo($data);
        $result && action_log('编辑', 'name：' . $data['name']);
        return $result ? [RESULT_SUCCESS, '编辑成功', $url] : [RESULT_ERROR, $this->modelSysMsgType->getError()];
    }

    /**
     * 获取列表搜索条件
     */
    public function getWhere($data = [])
    {
        $where = [];
        //关键字查
        !empty($data['keywords']) && $where['bus_name'] = ['like', '%' . $data['keywords'] . '%'];

        if (!empty($data['status'])) {
            $where['status'] = ['=', '' . $data['status'] . ''];
        }
        return $where;
    }

    /**
     * 获取排序条件
     */
    public function getOrderBy($data = [])
    {
        $order_by = "";
        //排序操作
        if (!empty($data['orderField'])) {
            $orderField = $data['orderField'];
            $orderDirection = $data['orderDirection'];
        } else {
            $orderField = "";
            $orderDirection = "";
        }
        if ($orderField == 'by_name') {
            $order_by = "a.name $orderDirection";
        } else if ($orderField == 'by_url') {
            $order_by = "a.url $orderDirection";
        } else {
            $order_by = "a.create_time asc";
        }
        return $order_by;
    }

    /**
     * 把对应的业务提醒扫描出来
     * Author: 开发人生 goodkfrs@qq.com
     * Date: 2021/10/28 0028 15:33
     */
    public function sysMsgTypeScan()
    {
        dlog('业务提醒扫描出来=>系统消息中', 'cronjob.txt');
        $list = $this->modelSysMsgType->getList([], 'name,type,hours,remind_sms,remind_sys,remind_email,remind_weixin,remind_nums,remind_interval', '', false);
        foreach ($list as $key => $row) {
            switch ($row['type']) {
                //线索跟进
                case 'cst_clue':
                    $this->modelSysMsgType->scanCstClue($row);
                    break;
                //客户跟进
                case 'cst_customer':
                    $this->modelSysMsgType->scanCstCustomer($row);
                    break;
                //商机跟进
                case 'cst_chance':
                    $this->modelSysMsgType->scanCstChance($row);
                    break;
                //销售合同到期
                case 'sal_contract_expire':
                    $this->modelSysMsgType->scanSalContractExpire($row);
                    break;
                //销售订单到期
                case 'sal_order_expire':
                    $this->modelSysMsgType->scanSalOrderExpire($row);
                    break;
                //日程开始提醒
                case 'oa_schedule':
                    $this->modelSysMsgType->scanOaSchedule($row);
                    break;
                //工单提醒
                case 'oa_service':
                    $this->modelSysMsgType->scanOaService($row);
                    break;
                //工单提醒
                case 'workflow_business_history':
                    $this->modelSysMsgType->scanWorkflowBusinessHistory($row);
                    break;
                default :
                    break;
            }
        }
    }
}