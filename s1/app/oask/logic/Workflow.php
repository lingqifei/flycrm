<?php
/**
 * 零起飞-(07FLY-CRM)
 * ==============================================
 * 版权所有 2015-2028   成都零起飞网络，并保留所有权利。
 * 网站地址: http://www.07fly.xyz
 * ----------------------------------------------------------------------------
 * 如果商业用途务必到官方购买正版授权, 以免引起不必要的法律纠纷.
 * ==============================================
 * Workflowor: kfrs <goodkfrs@QQ.com> 574249366
 * Date: 2019-10-3
 */

namespace app\oask\logic;

use think\Db;
use think\Request;

/**
 * 请示申请=》逻辑层
 */
class Workflow extends OaskBase
{
    /**
     * 请示申请列表
     * @param array $where
     * @param bool $field
     * @param string $order
     * @param int|mixed $paginate
     * @return
     */
    public function getWorkflowList($where = [], $field = true, $order = 'id desc', $paginate = DB_LIST_ROWS)
    {
        $list = $this->modelWorkflow->getList($where, $field, $order, $paginate)->toArray();
        if ($paginate === false) $list['data'] = $list;
        foreach ($list['data'] as &$row) {
            $row['level_arr'] = $this->getLevel($row['level']);
            $row['create_user_name'] = $this->modelSysUser->getValue(['id' => $row['create_user_id']], 'realname');
            $row['deal_user_name'] = $this->logicSysUser->getRealname($row['deal_user_id']);
            $row['status_arr'] = $this->modelWorkflow->status($row['status']);
            $row['status_arr']['action'] = $this->logicOaskBase->checkActionUrl($row['status_arr']['action']);
        }
        return $list;
    }

    /**
     * 请示申请添加
     * @param array $data
     * @return array
     */
    public function workflowAdd($data = [])
    {
        $validate_result = $this->validateWorkflow->scene('add')->check($data);
        if (!$validate_result) {
            return [RESULT_ERROR, $this->validateWorkflow->getError()];
        }
        $data['create_user_id'] = SYS_USER_ID;

        $result = $this->modelWorkflow->setInfo($data);

        $result && action_log('新增', '新增请示信息');
        $url = url('show');
        return $result ? [RESULT_SUCCESS, '添加成功', $url] : [RESULT_ERROR, $this->modelWorkflow->getError()];
    }

    /**
     * 请示申请编辑
     * @param array $data
     * @return array
     */
    public function workflowEdit($data = [])
    {

        $validate_result = $this->validateWorkflow->scene('edit')->check($data);
        if (!$validate_result) {
            return [RESULT_ERROR, $this->validateWorkflow->getError()];
        }
        $result = $this->modelWorkflow->setInfo($data);

        $url = url('show');
        $result && action_log('编辑', '编辑请示申请');
        return $result ? [RESULT_SUCCESS, '编辑成功', $url] : [RESULT_ERROR, $this->modelWorkflow->getError()];
    }

    /**
     * 请示申请删除
     * @param array $where
     * @return array
     */
    public function workflowDel($data = [])
    {

        if (empty($data['id'])) {
            return [RESULT_ERROR, '选择删除的数据'];
            exit;
        }
        $where['id']=['in',$data['id']];
		$result = $this->modelWorkflow->deleteInfo($where, true);
		$map['in']=['workflow_id',$data['id']];
		$result && $this->modelWorkflowDeal->deleteInfo($where, true);
        $result && action_log('删除', '删除请示申请' . http_build_query($data));
        return $result ? [RESULT_SUCCESS, '删除成功'] : [RESULT_ERROR, $this->modelWorkflow->getError()];
    }

    /**请示申请信息
     * @param array $where
     * @param bool $field
     * @return
     */
    public function getWorkflowInfo($where = [], $field = true)
    {
        $info = $this->modelWorkflow->getInfo($where, $field);
        $info['level_name'] = $this->getLevel($info['level'])['name'];
        return $info;
    }


    /**
     * 请候状态
     * @return mixed
     * Author: kfrs <goodkfrs@QQ.com> created by at 2020/10/23 0023
     */
    public function getStatus()
    {
        return $this->modelWorkflow->status();
    }

    /**
     * 请示级别
     * @param string $key
     * @return mixed
     * Author: kfrs <goodkfrs@QQ.com> created by at 2020/10/23 0023
     */
    public function getLevel($key = '')
    {
        return $this->modelWorkflow->level($key);
    }

    /**
     * 获取列表搜索条件
     */
    public function getWhere($data = [])
    {

        $where = [];
        //关键字查
        !empty($data['keywords']) && $where['address|reason'] = ['like', '%' . $data['keywords'] . '%'];

        //状态
        if (!empty($data['status']) || is_numeric($data['status']) === true) {
            $where['status'] = ['=', $data['status']];
        }
        //状态
        if (!empty($data['level'])) {
            $where['level'] = ['=', $data['level']];
        }
        //创建时间
        if (!empty($data['create_rangedate'])) {
            $range_date = str2arr($data['create_rangedate'], "-");
            foreach ($range_date as &$date) {
                $date = strtotime($date);
            }
            $where['create_time'] = ['between', $range_date];
        }
        //开始时间
        if (!empty($data['start_rangedate'])) {
            $range_date = str2arr($data['start_rangedate'], "-");
            $where['start_time'] = ['between', $range_date];
        }
        //结束时间
        if (!empty($data['end_rangedate'])) {
            $range_date = str2arr($data['end_rangedate'], "-");
            $where['end_time'] = ['between', $range_date];
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


    /**
     * 请示申请=》更新状态
     * @param array $data
     * @return array
     * Author: kfrs <goodkfrs@QQ.com> created by at 2020/9/18 0018
     */
    public function setWorkflowCancel($data = [])
    {
        if (empty($data['status']) || empty($data['id'])) {
            return [RESULT_ERROR, '参数status不能为空'];
            exit;
        }

		//删除工作流程中临单，
		$condition['workflow_id'] = ['=', $data['id']];
		$condition['deal_status'] = ['=', 0];
		$this->modelWorkflowDeal->deleteInfo($condition, true);

        $result = $this->modelWorkflow->setFieldValue(['id' => $data['id']], 'status', $data['status']);
        $result && action_log('编辑', '撤消申请：' . $data['id']);
        return $result ? [RESULT_SUCCESS, '操作成功', ''] : [RESULT_ERROR, $this->modelSalOrder->getError()];
    }

    /**
     * 请示申请=》审核提交
     * @param array $data
     * @return array
     * Author: kfrs <goodkfrs@QQ.com> created by at 2020/9/18 0018
     */
    public function setWorkflowAuditSend($data = [])
    {
        if (empty($data['id'])) {
            return [RESULT_ERROR, '参数不能为空'];
            exit;
        }

		$info = $this->modelWorkflow->getInfo(['id'=>$data['id']], '');
        if(empty($info['deal_user_id'])){
			return [RESULT_ERROR, '选择的审核人员参数不能为空'];
			exit;
		}

		$info['workflow_id']=$info['id'];
		$res = $this->logicWorkflowDeal->workflowDealAddInterface($info);
		if ($res[0] == RESULT_ERROR) return $res;

        $result = $this->modelWorkflow->setFieldValue(['id' => $data['id']], 'status', $data['status']);
        $result && action_log('提交', '提交请示审核：' . $data['id']);

        return $result ? [RESULT_SUCCESS, '提交请示审核', ''] : [RESULT_ERROR, $this->modelSalOrder->getError()];
    }

}
