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
 * 规章制度评论=》逻辑层
 */
class RegulationReply extends OaskBase
{
	/**
	 * 规章制度评论列表
	 * @param array $where
	 * @param bool $field
	 * @param string $order
	 * @param int|mixed $paginate
	 * @return
	 */
	public function getRegulationReplyList($where = [], $field = true, $order = 'a.create_time desc', $paginate = DB_LIST_ROWS)
	{
		$this->modelRegulationReply->alias('a');
		$list = $this->modelRegulationReply->getList($where, $field, $order, $paginate);
		foreach ($list as $key => &$row) {
			$row['create_user_name'] = $this->logicSysUser->getRealname($row['create_user_id']);
		}
		return $list;

	}

	/**
	 * 规章制度文件添加
	 * @param array $data
	 * @return array
	 */
	public function regulationReplyReplyAdd($data = [])
	{

		$validate_result = $this->validateRegulationReply->scene('add')->check($data);
		if (!$validate_result) {
			return [RESULT_ERROR, $this->validateRegulationReply->getError()];
		}
		$data['create_user_id'] = SYS_USER_ID;
		$result = $this->modelRegulationReply->setInfo($data);
		$url = url('show');
		$result && action_log('新增', '编辑规章制度文件评论：' . $data['remark']);

		return $result ? [RESULT_SUCCESS, '添加成功', $url] : [RESULT_ERROR, $this->modelRegulationReply->getError()];
	}

	/**
	 * 规章制度文件编辑
	 * @param array $data
	 * @return array
	 */
	public function regulationReplyReplyEdit($data = [])
	{

		$validate_result = $this->validateRegulationReply->scene('edit')->check($data);

		if (!$validate_result) {

			return [RESULT_ERROR, $this->validateRegulationReply->getError()];
		}

		$url = url('show');

		$result = $this->modelRegulationReply->setInfo($data);

		$result && action_log('编辑', '编辑规章制度文件评论：' . $data['remark']);

		return $result ? [RESULT_SUCCESS, '编辑成功', $url] : [RESULT_ERROR, $this->modelRegulationReply->getError()];
	}

	/**
	 * 规章制度文件删除
	 * @param array $where
	 * @return array
	 */
	public function regulationReplyReplyDel($where = [])
	{

		$result = $this->modelRegulationReply->deleteInfo($where, true);

		$result && action_log('删除', '删除规章制度文件，where：' . http_build_query($where));

		return $result ? [RESULT_SUCCESS, '删除成功'] : [RESULT_ERROR, $this->modelRegulationReply->getError()];
	}

	/**规章制度文件信息
	 * @param array $where
	 * @param bool $field
	 * @return
	 */
	public function getRegulationReplyInfo($where = [], $field = true)
	{
		return $this->modelRegulationReply->getInfo($where, $field);
	}

	/**
	 * 获取列表搜索条件
	 */
	public function getWhere($data = [])
	{
		$where = [];
		//关键字查
		!empty($data['keywords']) && $where['a.name|a.url'] = ['like', '%' . $data['keywords'] . '%'];

		if (!empty($data['regulation_id']) || is_numeric($data['regulation_id'])) {
			$where['a.regulation_id'] = ['=', '' . $data['regulation_id'] . ''];
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
