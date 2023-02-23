<?php
/*
*
* hrm.logic  模型
*
* =========================================================
* 零起飞网络 - 专注于网站建设服务和行业系统开发
* 以质量求生存，以服务谋发展，以信誉创品牌 !
* ----------------------------------------------
* @copyright	Copyright (C) 2017-2022 07FLY Network Technology Co,LTD.
* @license    For licensing, see LICENSE.html or http://www.07fly.xyz/license
* @author ：kfrs <goodkfrs@QQ.com> 574249366
* @version ：1.0
* @link ：http://www.07fly.xyz
*/

namespace app\oask\logic;

use app\common\logic\LogicBase;

/**
 * 员工奖罚 逻辑 模块基类
 */
class HrmStaffReward extends OaskBase
{


	/**
	 * 员工奖罚理列表
	 * @param array $where
	 * @param bool $field
	 * @param string $order
	 * @param int|mixed $paginate
	 * @return array
	 */
	public function getHrmStaffRewardList($where = [], $field = true, $order = '', $paginate = DB_LIST_ROWS)
	{
		$this->modelHrmStaffReward->alias('a');
		$join = [
			[SYS_DB_PREFIX . 'hrm_staff s', 's.id = a.staff_id', 'LEFT'],
		];
		$this->modelHrmStaffReward->join = $join;

		$list = $this->modelHrmStaffReward->getList($where, $field, $order, $paginate);
		foreach ($list as &$row) {
			$row['create_user_name'] = $this->modelSysUser->getValue(['id' => $row['create_user_id']], 'realname');
		}
		return $list;
	}

	/**
	 * 员工奖罚管理添加
	 * @param array $data
	 * @return array
	 */
	public function hrmStaffRewardAdd($data = [])
	{
		$validate_result = $this->validateHrmStaffReward->scene('add')->check($data);
		if (!$validate_result) {
			return [RESULT_ERROR, $this->validateHrmStaffReward->getError()];
		}

		$data['create_user_id'] = SYS_USER_ID;
		$result = $this->modelHrmStaffReward->setInfo($data);

		$result && action_log('新增', '新增员工奖罚管理：' . $data['name']);
		$url = url('show');
		return $result ? [RESULT_SUCCESS, '添加成功', $url] : [RESULT_ERROR, $this->modelHrmStaffReward->getError()];
	}

	/**
	 * 员工奖罚管理编辑
	 * @param array $data
	 * @return array
	 */
	public function hrmStaffRewardEdit($data = [])
	{

		$validate_result = $this->validateHrmStaffReward->scene('edit')->check($data);
		if (!$validate_result) {
			return [RESULT_ERROR, $this->validateHrmStaffReward->getError()];
		}
		$result = $this->modelHrmStaffReward->setInfo($data);

		$url = url('show');
		$result && action_log('编辑', '编辑员工奖罚管理，name：' . $data['name']);
		return $result ? [RESULT_SUCCESS, '编辑成功', $url] : [RESULT_ERROR, $this->modelHrmStaffReward->getError()];
	}

	/**
	 * 员工奖罚管理删除
	 * @param array $where
	 * @return array
	 */
	public function hrmStaffRewardDel($where = [])
	{

		$result = $this->modelHrmStaffReward->deleteInfo($where, true);

		$result && action_log('删除', '删除员工奖罚管理，where：' . http_build_query($where));

		return $result ? [RESULT_SUCCESS, '删除成功'] : [RESULT_ERROR, $this->modelHrmStaffReward->getError()];
	}

	/**员工奖罚管理信息
	 * @param array $where
	 * @param bool $field
	 * @return
	 */
	public function getHrmStaffRewardInfo($where = [], $field = true)
	{

		$info = $this->modelHrmStaffReward->getInfo($where, $field);
		$info['create_user_name'] = $this->modelSysUser->getValue(['id' => $info['create_user_id']], 'realname');
		return $info;
	}

	/**
	 * 员工奖罚管理=》类型
	 * @return mixed
	 * Author: kfrs <goodkfrs@QQ.com> created by at 2020/11/27 0027
	 */
	public function getType($key = '')
	{
		return $this->modelHrmStaffReward->type($key);
	}


	/**
	 * 获取列表搜索条件
	 */
	public function getWhere($data = [])
	{

		$where = [];
		//关键字查
		!empty($data['keywords']) && $where['name|remark|contract_no'] = ['like', '%' . $data['keywords'] . '%'];

		//开始日期范围
		if (!empty($data['begin_rangedate'])) {
			$range_date = str2arr($data['begin_rangedate'], "-");
			$where['begin_date'] = ['between', $range_date];
		}
		//结束日期范围
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

?>