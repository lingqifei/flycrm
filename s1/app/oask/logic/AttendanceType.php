<?php
/**
 * 零起飞-(07FLY-CRM)
 * ==============================================
 * 版权所有 2015-2028   成都零起飞网络，并保留所有权利。
 * 网站地址: http://www.07fly.xyz
 * ----------------------------------------------------------------------------
 * 如果商业用途务必到官方购买正版授权, 以免引起不必要的法律纠纷.
 * ==============================================
 * AttendanceTypeor: kfrs <goodkfrs@QQ.com> 574249366
 * Date: 2019-10-3
 */

namespace app\oask\logic;


/**
 * 考勤分类分类管理=》逻辑层
 */
class AttendanceType extends OaskBase
{
    /**
     * 考勤分类分类列表
     * @param array $where
     * @param bool $field
     * @param string $order
     * @param int|mixed $paginate
     * @return
     */
    public function getAttendanceTypeList($where = [], $field = true, $order = 'sort asc', $paginate = DB_LIST_ROWS)
    {
        return $this->modelAttendanceType->getList($where, $field, $order, $paginate)->toArray();
    }

    /**
     * 考勤分类分类添加
     * @param array $data
     * @return array
     */
    public function attendanceTypeAdd($data = [])
    {

        $validate_result = $this->validateAttendanceType->scene('add')->check($data);

        if (!$validate_result) {

            return [RESULT_ERROR, $this->validateAttendanceType->getError()];
        }
        $result = $this->modelAttendanceType->setInfo($data);
        $url = url('show');
        $result && action_log('新增', '新增考勤分类分类：' . $data['name']);

        return $result ? [RESULT_SUCCESS, '添加成功', $url] : [RESULT_ERROR, $this->modelAttendanceType->getError()];
    }

    /**
     * 考勤分类分类编辑
     * @param array $data
     * @return array
     */
    public function attendanceTypeEdit($data = [])
    {

        $validate_result = $this->validateAttendanceType->scene('edit')->check($data);

        if (!$validate_result) {

            return [RESULT_ERROR, $this->validateAttendanceType->getError()];
        }

        $url = url('show');

        $result = $this->modelAttendanceType->setInfo($data);

        $result && action_log('编辑', '编辑考勤分类分类，name：' . $data['name']);

        return $result ? [RESULT_SUCCESS, '编辑成功', $url] : [RESULT_ERROR, $this->modelAttendanceType->getError()];
    }

    /**
     * 考勤分类分类删除
     * @param array $where
     * @return array
     */
    public function attendanceTypeDel($where = [])
    {

        $result = $this->modelAttendanceType->deleteInfo($where,true);

        $result && action_log('删除', '删除考勤分类分类，where：' . http_build_query($where));

        return $result ? [RESULT_SUCCESS, '删除成功'] : [RESULT_ERROR, $this->modelAttendanceType->getError()];
    }

    /**考勤分类分类信息
     * @param array $where
     * @param bool $field
     * @return
     */
    public function getAttendanceTypeInfo($where = [], $field = true)
    {
        return $this->modelAttendanceType->getInfo($where, $field);
    }

    /**
     * 考勤分类分类列表=》树形结构
     * @param array $where
     * @param bool $field
     * @param string $order
     * @param int|mixed $paginate
     * @return
     */
    public function getAttendanceTypeListTree($where = [], $field = "id,name,pid", $order = 'sort asc', $paginate = false)
    {
        $list=$this->modelAttendanceType->getList($where, $field, $order, $paginate)->toArray();
        $data=list2tree($list);
        return $data;
    }

    /**
     * 考勤分类分类列表=》树形下拉
     * @param array $where
     * @param bool $field
     * @param string $order
     * @param int|mixed $paginate
     * @return
     */
    public function getAttendanceTypeTreeSelect($where = [], $field = "id,name,pid", $order = 'sort asc', $paginate = false)
    {
        $list=$this->modelAttendanceType->getList($where, $field, $order, $paginate)->toArray();
        $data=list2select($list);
        return $data;
    }

	/**获得所有指定id所有子级
	 * @param int $deptid
	 * @param array $data
	 * @return array
	 */
	public function getAttendanceTypeAllSon($deptid=0, $data=[])
	{
		$where['pid']=['=',$deptid];
		$sons = $this->modelAttendanceType->getList($where,true,'sort asc',false);
		if (count($sons) > 0) {
			foreach ($sons as $v) {
				$data[] = $v['id'];
				$data = $this->getAttendanceTypeAllSon($v['id'], $data); //注意写$data 返回给上级
			}
		}
		if (count($data) > 0) {
			return $data;
		} else {
			return false;
		}
		return $data;
	}


	/**指定id下级所有id及自己
	 * @param $id
	 * @return array
	 * Author: 开发人生 goodkfrs@qq.com
	 * Date: 2021/6/3 0003 17:06
	 */
	public function getAttendanceTypeSelfSon($id){
		$ids=$this->getAttendanceTypeAllSon($id);
		$ids[]=$id;
		return $ids;
	}

}
