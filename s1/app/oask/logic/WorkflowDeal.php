<?php
/**
 * 零起飞-(07FLY-CRM)
 * ==============================================
 * 版权所有 2015-2028   成都零起飞网络，并保留所有权利。
 * 网站地址: http://www.07fly.xyz
 * ----------------------------------------------------------------------------
 * 如果商业用途务必到官方购买正版授权, 以免引起不必要的法律纠纷.
 * ==============================================
 * WorkflowDealor: kfrs <goodkfrs@QQ.com> 574249366
 * Date: 2019-10-3
 */

namespace app\oask\logic;

use think\Db;
use think\Request;

/**
 * 请示申请=》逻辑层
 */
class WorkflowDeal extends OaskBase
{
    /**
     * 请示申请列表
     * @param array $where
     * @param bool $field
     * @param string $order
     * @param int|mixed $paginate
     * @return
     */
    public function getWorkflowDealList($where = [], $field = true, $order = 'id desc', $paginate = DB_LIST_ROWS)
    {
        $list = $this->modelWorkflowDeal->getList($where, $field, $order, $paginate)->toArray();
        if ($paginate === false) $list['data'] = $list;
        foreach ($list['data'] as &$row) {
            $row['deal_user_name'] = $this->modelSysUser->getValue(['id' => $row['deal_user_id']], 'realname');
            $row['workflow_name'] = $this->modelWorkflow->getValue(['id' => $row['workflow_id']], 'name');
            $row['status_arr'] = $this->modelWorkflowDeal->status($row['status']);
            $row['deal_status_arr'] = $this->modelWorkflowDeal->deal_status($row['deal_status']);
        }
        return $list;
    }

	/**
	 * 请示申请列表
	 * @param array $where
	 * @param bool $field
	 * @param string $order
	 * @param int|mixed $paginate
	 * @return
	 */
	public function getWorkflowDealListPage($where = [], $field = 'a.*,w.name as workflow_name,w.create_user_id', $order = 'a.id desc', $paginate = DB_LIST_ROWS)
	{

		$this->modelWorkflowDeal->alias('a');
		$join = [
			[SYS_DB_PREFIX . 'workflow w', 'w.id = a.workflow_id', 'LEFT'],
		];
		$this->modelWorkflowDeal->join = $join;

		$list = $this->modelWorkflowDeal->getList($where, $field, $order, $paginate)->toArray();
		if ($paginate === false) $list['data'] = $list;
		foreach ($list['data'] as &$row) {
			$row['deal_user_name'] = $this->modelSysUser->getValue(['id' => $row['deal_user_id']], 'realname');
			$row['create_user_name'] = $this->modelSysUser->getValue(['id' => $row['create_user_id']], 'realname');
			$row['status_arr'] = $this->modelWorkflowDeal->status($row['status']);
			$row['deal_status_arr'] = $this->modelWorkflowDeal->deal_status($row['deal_status']);
		}
		return $list;
	}

    /**
     * 请示申请添加
     * @param array $data
     * @return array
     */
    public function workflowDealAddInterface($data = [])
    {
		if (empty($data['workflow_id'])) {
			return [RESULT_ERROR, '工作流程参数id不能为空'];
			exit;
		}

		//删除工作流程中临单，
		$condition['workflow_id'] = ['=', $data['workflow_id']];
		$condition['deal_status'] = ['=', 0];
		$this->modelWorkflowDeal->deleteInfo($condition, true);

		//如果有处理人员添加上,新建审核
		if (!empty($data['deal_user_id'])) {
			$deal_arr=str2arr($data['deal_user_id']);
			$into_data=[];
			foreach ($deal_arr as $key=>$val){
				if($key===0){
					$status=1;
				}else{
					$status=0;
				}
				$into_data[]=[
					'sort'=>$key+1,
					'workflow_id'=>$data['workflow_id'],
					'deal_user_id'=>$val,
					'status'=>$status,
				];
			}
			$this->modelWorkflowDeal->setList($into_data);
		}
    }


    /**请示申请信息
     * @param array $where
     * @param bool $field
     * @return
     */
    public function getWorkflowDealInfo($where = [], $field = true)
    {
        $info = $this->modelWorkflowDeal->getInfo($where, $field);
        $info['deal_user_name'] = $this->modelSysUser->getValue(['id' => $info['deal_user_id']], 'realname');
		$info['status_arr'] = $this->modelWorkflowDeal->status($info['status']);
		$info['deal_status_arr'] = $this->modelWorkflowDeal->deal_status($info['deal_status']);
        return $info;
    }


    /**
     * 请候状态
     * @return mixed
     * Author: kfrs <goodkfrs@QQ.com> created by at 2020/10/23 0023
     */
    public function getStatus($key='')
    {
        return $this->modelWorkflowDeal->status($key);
    }

	/**
	 * 请候状态
	 * @return mixed
	 * Author: kfrs <goodkfrs@QQ.com> created by at 2020/10/23 0023
	 */
	public function getDealStatus($key='')
	{
		return $this->modelWorkflowDeal->deal_status($key);
	}

    /**
     * 获取列表搜索条件
     */
    public function getWhere($data = [])
    {

        $where = [];
		$where['a.deal_user_id'] = ['=', SYS_USER_ID];
        //关键字查
        !empty($data['keywords']) && $where['a.deal_remark|w.name'] = ['like', '%' . $data['keywords'] . '%'];

        //状态
        if (!empty($data['status']) || is_numeric($data['status']) === true) {
            $where['a.status'] = ['=', $data['status']];
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
     * 请示申请=》审核提交
     * @param array $data
     * @return array
     * Author: kfrs <goodkfrs@QQ.com> created by at 2020/9/18 0018
     */
    public function workflowDealApproval($data = [])
    {
        if (empty($data['workflow_id']) || empty($data['id'])) {
            return [RESULT_ERROR, '参数workflow_id~id不能为空'];
            exit;
        }

		$info = $this->modelWorkflowDeal->getInfo(['id'=>$data['id']], 'workflow_id,sort');

        if($info){

			//1 通过审核时
			if($data['deal_status']==1){

				//1、需要查下一条数据
				$sort=$info['sort']+1;
				$map['workflow_id']=['=',$info['workflow_id']];
				$map['sort']=['=',$sort];
				$map['status']=['=','0'];
				$nextId=$this->modelWorkflowDeal->getValue($map,'id');

				if($nextId){//下一流程

					$this->modelWorkflowDeal->setFieldValue(['id'=>$nextId],'status','1');

				}else{//流程已经走完了

					$this->modelWorkflow->setFieldValue(['id'=>$info['workflow_id']],'status','2');

				}

			}else{

				//拒绝直接返回，重新提交
				$this->modelWorkflow->setFieldValue(['id'=>$info['workflow_id']],'status','3');

			}

		}

		//更新审核记录表
        $updData=[
        	'deal_status'=>$data['deal_status'],
        	'deal_remark'=>$data['deal_remark'],
        	'status'=>2,//表示处理
        	'deal_time'=>format_time(),
		];

        $result = $this->modelWorkflowDeal->updateInfo(['id' => $data['id']],$updData);
        $result && action_log('提交', '提交请示审核：' . $data['id']);
        return $result ? [RESULT_SUCCESS, '提交请示审核', ''] : [RESULT_ERROR, $this->modelSalOrder->getError()];
    }

}
