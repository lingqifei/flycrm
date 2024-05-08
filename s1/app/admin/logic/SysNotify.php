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
 * 系统公告=》逻辑层
 */
class SysNotify extends AdminBase
{
	/**
	 * 系统公告列表
	 * @param array $where
	 * @param bool $field
	 * @param string $order
	 * @param int|mixed $paginate
	 * @return
	 */
	public function getSysNotifyList($where = [], $field = true, $order = '', $paginate = DB_LIST_ROWS)
	{
		$list = $this->modelSysNotify->getList($where, $field, $order, $paginate)->toArray();
		if ($paginate === false) $list['data'] = $list;
		foreach ($list['data'] as &$row) {
			$row['rece_type_text'] = ($row['rece_type'] == '1') ? '指定人员' : '全体人员';
			$row['create_user_name'] = $this->modelSysUser->getValue(['id' => $row['create_user_id']], 'realname');
		}
		return $list;
	}

	/**
	 * 系统公告添加
	 * @param array $data
	 * @return array
	 */
	public function sysNotifyAdd($data = [])
	{
		$validate_result = $this->validateSysNotify->scene('add')->check($data);
		if (!$validate_result) {
			return [RESULT_ERROR, $this->validateSysNotify->getError()];
		}

		$data['create_user_id'] = SYS_USER_ID;
		$result = $this->modelSysNotify->setInfo($data);
		$data['notify_id'] = $result;

		//分发到每个帐号下面
		if ($data['rece_type'] == '1') {//近指人员
			$sys_user_arr = explode(',', $data['rece_user_id']);
		} else {
			$sys_user_arr = $this->modelSysUser->getColumn('', 'id');//系统所人员
		}
		foreach ($sys_user_arr as $user_id) {
			$user_data[] = [
				'owner_user_id' => $user_id,
				'notify_id' => $data['notify_id'],
				'create_user_id' => $data['create_user_id'],
				'create_time' => time(),
			];
		}
		Db::name('sys_notify_user')->insertAll($user_data);

		$url = url('show');
		$result && action_log('新增', '新增系统公告：' . $data['name']);

		return $result ? [RESULT_SUCCESS, '添加成功', $url] : [RESULT_ERROR, $this->modelSysNotify->getError()];
	}

	/**
	 * 系统公告编辑
	 * @param array $data
	 * @return array
	 */
	public function sysNotifyEdit($data = [])
	{

		$validate_result = $this->validateSysNotify->scene('edit')->check($data);
		if (!$validate_result) {
			return [RESULT_ERROR, $this->validateSysNotify->getError()];
		}

		$url = url('show');
		$result = $this->modelSysNotify->setInfo($data);
		$result && action_log('编辑', '编辑系统公告，name：' . $data['name']);
		return $result ? [RESULT_SUCCESS, '编辑成功', $url] : [RESULT_ERROR, $this->modelSysNotify->getError()];
	}

	/**
	 * 系统公告删除
	 * @param array $where
	 * @return array
	 */
	public function sysNotifyDel($data = [])
	{
		if(!empty($data['id'])){
			$where['id']=['in',$data['id']];
			$result = $this->modelSysNotify->deleteInfo($where, true);
			Db::name('sys_notify_user')->where('notify_id','in',$data['id'])->delete();
			$result && action_log('删除', '删除系统公告，where：' . http_build_query($where));
		}
		return $result ? [RESULT_SUCCESS, '删除成功'] : [RESULT_ERROR, $this->modelSysNotify->getError()];

	}

	/**系统公告信息
	 * @param array $where
	 * @param bool $field
	 * @return
	 */
	public function getSysNotifyInfo($where = [], $field = true)
	{

		$info = $this->modelSysNotify->getInfo($where, $field);
		$info['create_user_name']=$this->modelSysUser->getValue(['id'=>$info['create_user_id']],'realname');
		return $info;

	}

	/**系统主面显示自己的公告
	 * @param array $data
	 * @return mixed
	 * Author: 开发人生 goodkfrs@qq.com
	 * Date: 2021/10/29 0029 12:08
	 */
	public function getSysNotifyListMy($data=[])
	{
		$where=[];
		if($data['owner_user_id']){
			$where['u.owner_user_id'] =$data['owner_user_id'];
		}
		if (isset($data['read_state'])) {
			if(!empty($data['read_state']) || is_numeric($data['read_state'])){
				$where['read_state'] = ['=', '' . $data['read_state'] . ''];
			}
		}
		$this->modelSysNotify->alias('a');
		$join = [
			[SYS_DB_PREFIX . 'sys_notify_user u', 'a.id = u.notify_id','RIGHT'],
		];
		$this->modelSysNotify->join = $join;
		$list = $this->modelSysNotify->getList($where, 'a.name,a.create_user_id,a.id,a.create_time', 'u.create_time desc', false);
		foreach ($list as &$row){
			$row['create_user_name']=$this->modelSysUser->getValue(['id'=>$row['create_user_id']],'realname');
		}
		return $list;
	}

	/**
	 * 系统用户已经看更新
	 * @param array $where
	 * @return array
	 */
	public function sysNotifyUserRead($data = [])
	{
		if(!empty($data['id'])){
//			$where['notify_id']=['in',$data['id']];
//			$where['owner_user_id']=['=',SYS_USER_ID];
			Db::name('sys_notify_user')->where(['id'=>$data['id']])->update(['read_state'=>'1']);
		}

	}

}
