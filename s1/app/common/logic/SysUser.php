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

namespace app\common\logic;

/**
 * 用户逻辑
 */
class SysUser extends LogicBase
{
	/**
	 * 获取列表
	 */
	public function getSysUserList($where = [], $field = true, $order = 'id desc', $paginate = DB_LIST_ROWS)
	{
		return $this->modelSysUser->getList($where, $field, $order, $paginate);
	}

	/**
	 * 获取单个信息
	 */
	public function getSysUserInfo($where = [], $field = true)
	{
		return $this->modelSysUser->getInfo($where, $field);
	}

	/**
	 * 获取列信息
	 */
	public function getSysUserValue($where = [], $field = '')
	{
		return $this->modelSysUser->getValue($where, $field);
	}

	/**获得用户真实名称
	 * @param $ids
	 * @param bool $string
	 * Author: 开发人生 goodkfrs@qq.com
	 * Date: 2021/8/10 0010 14:25
	 */
	public function getRealname($ids, $string=true)
	{
		$where['id']=['in',$ids];
		$users = $this->modelSysUser->getColumn($where, 'realname');
		if($string && !empty($users)){
			return arr2str($users);
		}
		return $users;
	}

	/**获取当前员工所在部部门员工
	 * @param int $id
	 * @return array ex:[1,2,3,4]
	 * Author: lingqifei created by at 2020/3/29 0029
	 */
	public function getSysUserDept($id = SYS_USER_ID)
	{
		$ids = [];
		$info = $this->modelSysUser->getInfo(['id' => $id]);
		if ($info) {
			$map['dept_id'] = ['in', $info['dept_id']];
			$ids = $this->modelSysUser->getColumn($map, 'id');
		}
		return $ids;
	}


	/**获取当前员工所在部的下级部门员工
	 * @param int $id
	 * @return array ex:[1,2,3,4]
	 * Author: lingqifei created by at 2020/3/29 0029
	 */
	public function getSysUserDeptSon($id = SYS_USER_ID)
	{
		$ids = [];
		$info = $this->modelSysUser->getInfo(['id' => $id]);
		if ($info) {
			$dept_son = $this->logicSysDept->getDeptAllSon($info['dept_id']);
			$map['dept_id'] = ['in', $dept_son];
			$ids = $this->modelSysUser->getColumn($map, 'id');
		}
		return $ids;
	}


	/**获取当前员工所在部的下级部门员工+本部门员工
	 * @param int $id
	 * @return array  ex:[1,2,3,4]
	 * Author: lingqifei created by at 2020/3/29 0029
	 */
	public function getSysUserDeptSelfSon($id = SYS_USER_ID)
	{
		$ids = [];
		$dept_id = $this->modelSysUser->getValue(['id' => $id], 'dept_id');
		if ($dept_id) {
			$dept_son = $this->logicSysDept->getDeptAllSon($dept_id);
			$dept_son[] = $dept_id;
			$map['dept_id'] = ['in', $dept_son];
			$ids = $this->modelSysUser->getColumn($map, 'id');
		}
		return $ids;
	}


	/**获取指定用户=》数据管理权限范围
	 * 1=个人 (只能操作自己和下属的数据)
	 * 2=所属部门 (能操作自己、下属、和自己所属部门的数据)
	 * 3=所属部门及下属部门 (所属部门及下属部门 能操作自己、下属和自己所属部门及其子部门的数据)
	 * 4=全公司 (能操作全公司的数据)
	 * @param int $id
	 * @param string $type
	 * @return array
	 * Author: 开发人生 goodkfrs@qq.com
	 * Date: 2021/7/30 0030 10:06
	 */
	public function getSysUserViewId($id = 0, $type = 'selfson')
	{
		$ids = [];
		$user = $this->modelSysUser->getInfo(['id' => $id], 'dept_id,position_id');

		if (!empty($user)) {

			//下属职位
			$posi_son=[];
			if (!empty($user['position_id'])) {
				$posi_son = $this->logicSysPosition->getPositionAllSon($user['position_id']);
			}

			$where['dept_id'] = ['=', $user['dept_id']];//自己部门
			$where['position_id'] = ['in', $posi_son];//自己及下属
			$ids = $this->modelSysUser->getColumn($where, 'id');
			//叠加权限
			$data_role = $this->modelSysPosition->getValue(['id' => $user['position_id']], 'data_role');

			$role_ids = [];
			if ($data_role == 2) {//所属部门其它同事

				$role_ids = $this->modelSysUser->getColumn(['dept_id' => $user['dept_id']], 'id');

			} elseif ($data_role == 3) {//所属部门及下属部门

				$dept_son = $this->logicSysDept->getDeptAllSon($user['dept_id']);
				$dept_son[] = $user['dept_id'];
				$role_ids = $this->modelSysUser->getColumn(['dept_id' => ['in', $dept_son]], 'id');

			} elseif ($data_role == 4) {//全部数据

				$role_ids = $this->modelSysUser->getColumn([], 'id');

			}
			$ids = array_merge($ids, $role_ids);
		}

		if ($type == 'selfson') $ids[] = $id;
		if ($type == 'son')  $ids = delArrValue($ids,$id);
		$ids = array_unique($ids);
		return $ids;

	}

	/**获取指定用户下属员工列表信息
	 * @param $stype
	 * @return array （[0]=array(''1)）
	 * Author: lingqifei created by at 2020/3/29 0029
	 */
	public function getSysUserSubList($sys_user_id = SYS_USER_ID, $type = 'selfson')
	{
		$where = [];
		$ids = $this->getSysUserViewId($sys_user_id, $type);
		$ids && $where['id'] = ['in', $ids];
		$list = $this->modelSysUser->getList($where, true, true, false)->toArray();
		return $list;
	}


	/**获取用户上级管理人员id
	 * @param int $id
	 * @param string $type
	 * @return mixed
	 * Author: 开发人生 goodkfrs@qq.com
	 * Date: 2021/9/13 0013 16:12
	 */
	public function getSysUserSuperior($id=SYS_USER_ID,$type=''){
		$userinfo=$this->modelSysUser->getInfo(['id'=>$id]);
		$superior_position_id=$this->logicSysPosition->getPositionPid($userinfo['position_id']);
		$where['position_id']=['=',$superior_position_id];
		$where['dept_id']=['=',$userinfo['dept_id']];
		$superior=$this->modelSysUser->getInfo($where,'id,username,realname,dept_id,position_id');
		return $superior;
	}

}
