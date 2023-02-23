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
 * 会议评论=》逻辑层
 */
class MeetingReply extends OaskBase
{
	/**
	 * 会议评论列表
	 * @param array $where
	 * @param bool $field
	 * @param string $order
	 * @param int|mixed $paginate
	 * @return
	 */
	public function getMeetingReplyList($where = [], $field = true, $order = 'a.create_time desc', $paginate = DB_LIST_ROWS)
	{
		$this->modelMeetingReply->alias('a');
		$list = $this->modelMeetingReply->getList($where, $field, $order, $paginate);
		foreach ($list as $key => &$row) {
			$row['create_user_name'] = $this->logicSysUser->getRealname($row['create_user_id']);
		}
		return $list;

	}

	/**
	 * 会议文件添加
	 * @param array $data
	 * @return array
	 */
	public function meetingReplyReplyAdd($data = [])
	{

		$validate_result = $this->validateMeetingReply->scene('add')->check($data);
		if (!$validate_result) {
			return [RESULT_ERROR, $this->validateMeetingReply->getError()];
		}
		$data['create_user_id'] = SYS_USER_ID;
		$result = $this->modelMeetingReply->setInfo($data);
		$url = url('show');
		$result && action_log('新增', '编辑会议文件评论：' . $data['remark']);

		return $result ? [RESULT_SUCCESS, '添加成功', $url] : [RESULT_ERROR, $this->modelMeetingReply->getError()];
	}

	/**
	 * 会议文件编辑
	 * @param array $data
	 * @return array
	 */
	public function meetingReplyReplyEdit($data = [])
	{

		$validate_result = $this->validateMeetingReply->scene('edit')->check($data);

		if (!$validate_result) {

			return [RESULT_ERROR, $this->validateMeetingReply->getError()];
		}

		$url = url('show');

		$result = $this->modelMeetingReply->setInfo($data);

		$result && action_log('编辑', '编辑会议文件评论：' . $data['remark']);

		return $result ? [RESULT_SUCCESS, '编辑成功', $url] : [RESULT_ERROR, $this->modelMeetingReply->getError()];
	}

	/**
	 * 会议文件删除
	 * @param array $where
	 * @return array
	 */
	public function meetingReplyReplyDel($where = [])
	{

		$result = $this->modelMeetingReply->deleteInfo($where, true);

		$result && action_log('删除', '删除会议文件，where：' . http_build_query($where));

		return $result ? [RESULT_SUCCESS, '删除成功'] : [RESULT_ERROR, $this->modelMeetingReply->getError()];
	}

	/**会议文件信息
	 * @param array $where
	 * @param bool $field
	 * @return
	 */
	public function getMeetingReplyInfo($where = [], $field = true)
	{
		return $this->modelMeetingReply->getInfo($where, $field);
	}

	/**
	 * 获取列表搜索条件
	 */
	public function getWhere($data = [])
	{
		$where = [];
		//关键字查
		!empty($data['keywords']) && $where['a.name|a.url'] = ['like', '%' . $data['keywords'] . '%'];

		if (!empty($data['meeting_id']) || is_numeric($data['meeting_id'])) {
			$where['a.meeting_id'] = ['=', '' . $data['meeting_id'] . ''];
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
