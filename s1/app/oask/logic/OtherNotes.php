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
 * 其它记录管理=》逻辑层
 */
class OtherNotes extends OaskBase
{
	/**
	 * 其它记录列表
	 * @param array $where
	 * @param bool $field
	 * @param string $order
	 * @param int|mixed $paginate
	 * @return
	 */
	public function getOtherNotesList($where = [], $field = true, $order = 'a.create_time desc', $paginate = DB_LIST_ROWS)
	{
		$this->modelOtherNotes->alias('a');
		$list = $this->modelOtherNotes->getList($where, $field, $order, $paginate);
		foreach ($list as $key => &$row) {
			$row['create_user_name'] = $this->logicSysUser->getRealname($row['create_user_id']);
			$row['owner_user_name'] = $this->logicSysUser->getRealname($row['owner_user_id']);
			$row['update_user_name'] = $this->logicSysUser->getRealname($row['update_user_id']);
			$row['body'] = html_msubstr($row['body'],0,100);
		}
		return $list;

	}

	/**
	 * 其它记录添加
	 * @param array $data
	 * @return array
	 */
	public function otherNotesAdd($data = [])
	{

		$validate_result = $this->validateOtherNotes->scene('add')->check($data);
		if (!$validate_result) {
			return [RESULT_ERROR, $this->validateOtherNotes->getError()];
		}
		$data['create_user_id'] = SYS_USER_ID;
		$data['update_time'] = time();
		$result = $this->modelOtherNotes->setInfo($data);
		$url = url('show');
		$result && action_log('新增', '新增其它记录：' . $data['name']);

		return $result ? [RESULT_SUCCESS, '添加成功', $url] : [RESULT_ERROR, $this->modelOtherNotes->getError()];
	}

	/**
	 * 其它记录编辑
	 * @param array $data
	 * @return array
	 */
	public function otherNotesEdit($data = [])
	{

		$validate_result = $this->validateOtherNotes->scene('edit')->check($data);

		if (!$validate_result) {

			return [RESULT_ERROR, $this->validateOtherNotes->getError()];
		}

		$url = url('show');
		$data['update_user_id'] = SYS_USER_ID;
		$result = $this->modelOtherNotes->setInfo($data);

		$result && action_log('编辑', '编辑其它记录，name：' . $data['name']);

		return $result ? [RESULT_SUCCESS, '编辑成功', $url] : [RESULT_ERROR, $this->modelOtherNotes->getError()];
	}

	/**
	 * 其它记录删除
	 * @param array $where
	 * @return array
	 */
	public function otherNotesDel($where = [])
	{

		$result = $this->modelOtherNotes->deleteInfo($where, true);

		$result && action_log('删除', '删除其它记录，where：' . http_build_query($where));

		return $result ? [RESULT_SUCCESS, '删除成功'] : [RESULT_ERROR, $this->modelOtherNotes->getError()];
	}

	/**其它记录信息
	 * @param array $where
	 * @param bool $field
	 * @return
	 */
	public function getOtherNotesInfo($where = [], $field = true)
	{
		$info = $this->modelOtherNotes->getInfo($where, $field);

		$info['create_user_name'] = $this->logicSysUser->getRealname($info['create_user_id']);
		$info['owner_user_name'] = $this->logicSysUser->getRealname($info['owner_user_id']);
		$info['update_user_name'] = $this->logicSysUser->getRealname($info['update_user_id']);

		return $info;

	}

	/**
	 * 获取列表搜索条件
	 */
	public function getWhere($data = [])
	{
		$where = [];

		//关键字查
		!empty($data['keywords']) && $where['a.name|a.body|a.linkman'] = ['like', '%' . $data['keywords'] . '%'];

		!empty($data['owner_user_id']) && $where['a.owner_user_id'] = ['=', '' . $data['owner_user_id'] . ''];

		if ( isset($data['other_id']) && (!empty($data['other_id']) || is_numeric($data['other_id'])) ) {
			$where['a.other_id'] = ['=', '' . $data['other_id'] . ''];
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
