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
 * 员工档案 逻辑 模块基类
 */
class HrmStaff extends OaskBase
{


	/**查询未绑定的系统员工编号
	 * @return array
	 * Author: 开发人生 goodkfrs@qq.com
	 * Date: 2021/5/27 0027 10:40
	 */
	public function getBindSysUserList()
	{
		$sys_user = $this->logicSysUser->getSysUserList('','','',false);
		$bind_user= $this->modelHrmStaff->getColumn('', 'bind_user_id');

		$not_bind_data=[];
		foreach ($sys_user as $key=>$row){
			if(!in_array($row['id'],$bind_user)){
				$not_bind_data[]=$row;
			}
		}
		return $not_bind_data;
	}

	/**
	 * 员工档案理列表
	 * @param array $where
	 * @param bool $field
	 * @param string $order
	 * @param int|mixed $paginate
	 * @return array
	 */
	public function getHrmStaffList($where = [], $field = true, $order = '', $paginate = DB_LIST_ROWS)
	{
		$list = $this->modelHrmStaff->getList($where, $field, $order, $paginate);
		foreach ($list as &$row) {
			$row['create_user_name'] = $this->modelSysUser->getValue(['id' => $row['create_user_id']], 'realname');
			$row['bind_user_name'] = $this->modelSysUser->getValue(['id' => $row['bind_user_id']], 'username');
			$row['status_arr'] = $this->getStatus($row['status']);
			$row['gender'] = ($row['gender']==1)?'男':'女';
		}
		return $list;
	}

	/**
	 * 员工档案管理添加
	 * @param array $data
	 * @return array
	 */
	public function hrmStaffAdd($data = [])
	{
		$validate_result = $this->validateHrmStaff->scene('add')->check($data);
		if (!$validate_result) {
			return [RESULT_ERROR, $this->validateHrmStaff->getError()];
		}

		$data['create_user_id'] = SYS_USER_ID;
		$result = $this->modelHrmStaff->setInfo($data);

		$result && action_log('新增', '新增员工档案管理：' . $data['name']);
		$url = url('show');
		return $result ? [RESULT_SUCCESS, '添加成功', $url] : [RESULT_ERROR, $this->modelHrmStaff->getError()];
	}

	/**
	 * 员工档案管理编辑
	 * @param array $data
	 * @return array
	 */
	public function hrmStaffEdit($data = [])
	{

		$validate_result = $this->validateHrmStaff->scene('edit')->check($data);
		if (!$validate_result) {
			return [RESULT_ERROR, $this->validateHrmStaff->getError()];
		}
		$result = $this->modelHrmStaff->setInfo($data);

		$url = url('show');
		$result && action_log('编辑', '编辑员工档案管理，name：' . $data['name']);
		return $result ? [RESULT_SUCCESS, '编辑成功', $url] : [RESULT_ERROR, $this->modelHrmStaff->getError()];
	}

	/**
	 * 员工档案管理删除
	 * @param array $where
	 * @return array
	 */
	public function hrmStaffDel($where = [])
	{

		$result = $this->modelHrmStaff->deleteInfo($where, true);

		$result && action_log('删除', '删除员工档案管理，where：' . http_build_query($where));

		return $result ? [RESULT_SUCCESS, '删除成功'] : [RESULT_ERROR, $this->modelHrmStaff->getError()];
	}


	/**
	 * 离职
	 * @param array $where
	 * @return array
	 */
	public function hrmStaffLeave($data = [])
	{

		$where['id'] =['in',$data['id']];
		$data=[
			'status'=>'0',
			'quit_date'=>$data['quit_date'],
		];
		$result = $this->modelHrmStaff->setInfo($data,$where);
		$result && action_log('离职', '员工离职，where：' . http_build_query($where));
		return $result ? [RESULT_SUCCESS, '操作成功'] : [RESULT_ERROR, $this->modelCstWebsite->getError()];
	}

	/**
	 * 入职
	 * @param array $where
	 * @return array
	 */
	public function hrmStaffEntry($data = [])
	{

		$where['id'] =['in',$data['id']];
		$data=[
			'status'=>'1',
			'entry_date'=>$data['entry_date'],
		];
		$result = $this->modelHrmStaff->setInfo($data,$where);
		$result && action_log('入职', '员工入职，where：' . http_build_query($where));
		return $result ? [RESULT_SUCCESS, '操作成功'] : [RESULT_ERROR, $this->modelHrmStaff->getError()];
	}

	/**
	 * 员工转正
	 * @param array $data
	 * @return array
	 */
	public function hrmStaffFormal($data = [])
	{

		$validate_result = $this->validateHrmStaff->scene('formal')->check($data);
		if (!$validate_result) {
			return [RESULT_ERROR, $this->validateHrmStaff->getError()];
		}
		$result = $this->modelHrmStaff->setInfo($data);

		$url = url('show');
		$result && action_log('转正', '编辑员工档案转正，name：' . $data['name']. $data['formal_date']);
		return $result ? [RESULT_SUCCESS, '编辑成功', $url] : [RESULT_ERROR, $this->modelHrmStaff->getError()];
	}


	/**员工档案管理信息
	 * @param array $where
	 * @param bool $field
	 * @return
	 */
	public function getHrmStaffInfo($where = [], $field = true)
	{

		$info = $this->modelHrmStaff->getInfo($where, $field);
		$info['bind_user_name'] = $this->modelSysUser->getValue(['id' => $info['bind_user_id']], 'username');
		$info['create_user_name'] = $this->modelSysUser->getValue(['id' => $info['create_user_id']], 'realname');
		return $info;
	}

	/**员工档案管理信息
	 * @param array $where
	 * @param bool $field
	 * @return
	 */
	public function getHrmStaffFieldValue($where = [], $field = true)
	{

		$info = $this->modelHrmStaff->getValue($where, $field);
		return $info;
	}

	/**
	 * 员工档案管理=》状态
	 * @return mixed
	 * Author: kfrs <goodkfrs@QQ.com> created by at 2020/11/27 0027
	 */
	public function getStatus($key = '')
	{
		return $this->modelHrmStaff->status($key);
	}

	/**
	 * 员工档案管理=》学历
	 * @return mixed
	 * Author: kfrs <goodkfrs@QQ.com> created by at 2020/11/27 0027
	 */
	public function getDegree($key = '')
	{
		return $this->modelHrmStaff->degree($key);
	}

	/**
	 * 获取列表搜索条件
	 */
	public function getWhere($data = [])
	{

		$where = [];
		//关键字查
		!empty($data['keywords']) && $where['name|content|service_no'] = ['like', '%' . $data['keywords'] . '%'];

		//!empty($data['status']) && $where['status'] = ['=', '' . $data['status'] . ''];

		if(!empty($data['status']) || is_numeric($data['status'])){
			$where['status'] = ['=', '' . $data['status'] . ''];
		}

		//开始日期范围
		if (!empty($data['entry_rangedate'])) {
			$range_date = str2arr($data['entry_rangedate'], "-");
			$where['entry_date'] = ['between', $range_date];
		}
		//结束日期范围
		if (!empty($data['quit_rangedate'])) {
			$range_date = str2arr($data['handle_rangedate'], "-");
			$where['quit_date'] = ['between', $range_date];
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