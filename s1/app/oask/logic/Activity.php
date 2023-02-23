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

/**
 * 营销活动管理=》逻辑层
 */
class Activity extends OaskBase
{
	/**
	 * 营销活动列表
	 * @param array $where
	 * @param bool $field
	 * @param string $order
	 * @param int|mixed $paginate
	 * @return
	 */
	public function getActivityList($where = [], $field = true, $order = 'a.create_time desc', $paginate = DB_LIST_ROWS)
	{
		$this->modelActivity->alias('a');
		$list = $this->modelActivity->getList($where, $field, $order, $paginate);
		foreach ($list as $key => &$row) {
			$row['create_user_name'] = $this->logicSysUser->getRealname($row['create_user_id']);
			$row['status_arr'] = $this->modelActivity->status($row['status']);
		}
		return $list;

	}

	/**
	 * 营销活动添加
	 * @param array $data
	 * @return array
	 */
	public function activityAdd($data = [])
	{

		$validate_result = $this->validateActivity->scene('add')->check($data);
		if (!$validate_result) {
			return [RESULT_ERROR, $this->validateActivity->getError()];
		}
		$data['create_user_id'] = SYS_USER_ID;
		$result = $this->modelActivity->setInfo($data);
		$url = url('show');
		$result && action_log('新增', '新增营销活动：' . $data['name']);

		return $result ? [RESULT_SUCCESS, '添加成功', $url] : [RESULT_ERROR, $this->modelActivity->getError()];
	}

	/**
	 * 营销活动编辑
	 * @param array $data
	 * @return array
	 */
	public function activityEdit($data = [])
	{

		$validate_result = $this->validateActivity->scene('edit')->check($data);

		if (!$validate_result) {

			return [RESULT_ERROR, $this->validateActivity->getError()];
		}

		$url = url('show');

		$result = $this->modelActivity->setInfo($data);

		$result && action_log('编辑', '编辑营销活动，name：' . $data['name']);

		return $result ? [RESULT_SUCCESS, '编辑成功', $url] : [RESULT_ERROR, $this->modelActivity->getError()];
	}

	/**
	 * 营销活动删除
	 * @param array $where
	 * @return array
	 */
	public function activityDel($where = [])
	{

		$result = $this->modelActivity->deleteInfo($where, true);

		$result && action_log('删除', '删除营销活动，where：' . http_build_query($where));

		return $result ? [RESULT_SUCCESS, '删除成功'] : [RESULT_ERROR, $this->modelActivity->getError()];
	}

	/**营销活动信息
	 * @param array $where
	 * @param bool $field
	 * @return
	 */
	public function getActivityInfo($where = [], $field = true)
	{
		return $this->modelActivity->getInfo($where, $field);
	}

	/**营销活动信息=>状态
	 * @param array $where
	 * @param bool $field
	 * @return
	 */
	public function getActivityStatus($key='')
	{
		return $this->modelActivity->status($key);
	}

	/**
	 * 获取列表搜索条件
	 */
	public function getWhere($data = [])
	{
		$where = [];
		//关键字查
		!empty($data['keywords']) && $where['a.name|a.url'] = ['like', '%' . $data['keywords'] . '%'];

		if (!empty($data['status']) || is_numeric($data['status'])) {
			$where['a.status'] = ['=', '' . $data['status'] . ''];
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

}
