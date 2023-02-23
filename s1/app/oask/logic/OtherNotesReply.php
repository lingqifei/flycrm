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
 * 公告评论=》逻辑层
 */
class OtherNotesReply extends OaskBase
{
	/**
	 * 监管部门文件列表
	 * @param array $where
	 * @param bool $field
	 * @param string $order
	 * @param int|mixed $paginate
	 * @return
	 */
	public function getOtherNotesReplyList($where = [], $field = true, $order = 'a.create_time desc', $paginate = DB_LIST_ROWS)
	{
		$this->modelOtherNotesReply->alias('a');
		$list = $this->modelOtherNotesReply->getList($where, $field, $order, $paginate);
		foreach ($list as $key => &$row) {
			$row['create_user_name'] = $this->logicSysUser->getRealname($row['create_user_id']);
			if (!empty($row['reply_attachment'])) {
				$reply_arr = str2arr($row['reply_attachment']);
				$reply_txt = '';
				foreach ($reply_arr as $key2 => $val) {
					$filepath = get_file_url($val);
					$reply_txt .= '<p><a href="' . $filepath . '">' . $filepath . '</a></p>';
				}
				$row['remark'] = $row['remark'] . $reply_txt;
			}
		}
		return $list;

	}

	/**
	 * 监管部门文件添加
	 * @param array $data
	 * @return array
	 */
	public function otherNotesReplyAdd($data = [])
	{

		$validate_result = $this->validateOtherNotesReply->scene('add')->check($data);
		if (!$validate_result) {
			return [RESULT_ERROR, $this->validateOtherNotesReply->getError()];
		}
		$data['create_user_id'] = SYS_USER_ID;
		$result = $this->modelOtherNotesReply->setInfo($data);
		$url = url('show');
		$result && action_log('新增', '编辑监管部门文件评论：' . $data['remark']);

		return $result ? [RESULT_SUCCESS, '添加成功', $url] : [RESULT_ERROR, $this->modelOtherNotesReply->getError()];
	}

	/**
	 * 监管部门文件编辑
	 * @param array $data
	 * @return array
	 */
	public function otherNotesReplyEdit($data = [])
	{

		$validate_result = $this->validateOtherNotesReply->scene('edit')->check($data);

		if (!$validate_result) {

			return [RESULT_ERROR, $this->validateOtherNotesReply->getError()];
		}

		$url = url('show');

		$result = $this->modelOtherNotesReply->setInfo($data);

		$result && action_log('编辑', '编辑监管部门文件评论：' . $data['remark']);

		return $result ? [RESULT_SUCCESS, '编辑成功', $url] : [RESULT_ERROR, $this->modelOtherNotesReply->getError()];
	}

	/**
	 * 监管部门文件删除
	 * @param array $where
	 * @return array
	 */
	public function otherNotesReplyDel($where = [])
	{

		$result = $this->modelOtherNotesReply->deleteInfo($where, true);

		$result && action_log('删除', '删除监管部门文件，where：' . http_build_query($where));

		return $result ? [RESULT_SUCCESS, '删除成功'] : [RESULT_ERROR, $this->modelOtherNotesReply->getError()];
	}

	/**监管部门文件信息
	 * @param array $where
	 * @param bool $field
	 * @return
	 */
	public function getOtherNotesReplyInfo($where = [], $field = true)
	{
		return $this->modelOtherNotesReply->getInfo($where, $field);
	}

	/**
	 * 获取列表搜索条件
	 */
	public function getWhere($data = [])
	{
		$where = [];
		//关键字查
		!empty($data['keywords']) && $where['a.name|a.url'] = ['like', '%' . $data['keywords'] . '%'];

		if (!empty($data['other_notes_id']) || is_numeric($data['other_notes_id'])) {
			$where['a.other_notes_id'] = ['=', '' . $data['other_notes_id'] . ''];
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
