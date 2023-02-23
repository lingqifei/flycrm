<?php
/**
 * 零起飞-(07FLY-CRM)
 * ==============================================
 * 版权所有 2015-2028   成都零起飞网络，并保留所有权利。
 * 网站地址: http://www.07fly.xyz
 * ----------------------------------------------------------------------------
 * 如果商业用途务必到官方购买正版授权, 以免引起不必要的法律纠纷.
 * ==============================================
 * Attendanceor: kfrs <goodkfrs@QQ.com> 574249366
 * Date: 2019-10-3
 */

namespace app\oask\logic;

use app\common\logic\TableField;
use think\Db;
use think\paginator\driver\Bootstrap;
/**
 * 考勤列表管理=》逻辑层
 */
class Attendance extends OaskBase
{

    private $files_path = '';

    public function __construct()
    {

    }

    /**
     * 考勤列表列表
     * @param array $where
     * @param bool $field
     * @param string $order
     * @param int|mixed $paginate
     * @return
     */
    public function getAttendanceList($where = [], $field = true, $order = '', $paginate = DB_LIST_ROWS)
    {

		$this->modelAttendance->alias('a');
		$join = [
			[SYS_DB_PREFIX . 'hrm_staff s', 's.id = a.staff_id', 'LEFT'],
		];
		$this->modelAttendance->join = $join;

        $list = $this->modelAttendance->getList($where, $field, $order, $paginate);

        foreach ($list as &$row) {
            $row['type_name']=$this->modelAttendanceType->getValue(['id'=>$row['type_id']],'name');
        }
        return $list;
    }

    /**
     * 考勤列表添加
     * @param array $data
     * @return array
     */
    public function attendanceAdd($data = [])
    {

        $validate_result = $this->validateAttendance->scene('add')->check($data);
        if (!$validate_result) {
            return [RESULT_ERROR, $this->validateAttendance->getError()];
        }
		$data['create_user_id'] = SYS_USER_ID;
		$result = $this->modelAttendance->setInfo($data);

        $url = url('show');
        $result && action_log('新增', '新增考勤列表：' . $data['staff_id']);
        return $result ? [RESULT_SUCCESS, '添加成功', $url] : [RESULT_ERROR, $this->modelAttendance->getError()];
    }

    /**
     * 考勤列表编辑
     * @param array $data
     * @return array
     */
    public function attendanceEdit($data = [])
    {

        $validate_result = $this->validateAttendance->scene('edit')->check($data);
        if (!$validate_result) {
            return [RESULT_ERROR, $this->validateAttendance->getError()];
        }

		$result = $this->modelAttendance->setInfo($data);

        $result && action_log('编辑', '编辑考勤列表，staff_id：' . $data['staff_id']);
        $url = url('show');
        return $result ? [RESULT_SUCCESS, '编辑成功', $url] : [RESULT_ERROR, $this->modelAttendance->getError()];
    }

    /**
     * 考勤列表删除
     * @param array $where
     * @return array
     */
    public function attendanceDel($data = [])
    {
        if(!empty($data['id'])){
            $where['id'] = ['=',$data['id']];
        }else{
            $where['id'] = ['=',0];
        }
        $result = $this->modelAttendance->deleteInfo($where, true);
        $result && action_log('删除', '删除考勤列表，where：' . http_build_query($where));
        return $result ? [RESULT_SUCCESS, '删除成功'] : [RESULT_ERROR, $this->modelAttendance->getError()];
    }

    /**考勤列表信息
     * @param array $where
     * @param bool $field
     * @return
     */
    public function getAttendanceInfo($where = [], $field = true)
    {
        $info= $this->modelAttendance->getInfo($where, $field);
        $info['create_user_name'] = $this->logicSysUser->getValue(['id'=>$info['create_user_id']],'realname');
        return $info;
    }

    /**
     * 获取列表搜索条件
     */
    public function getWhere($data = [])
    {

        $where = [];
        //关键字查
        !empty($data['keywords']) && $where['a.remark|s.name'] = ['like', '%' . $data['keywords'] . '%'];
        !empty($data['pid']) && $where['a.type_id'] = ['=', '' . $data['pid'] . ''];
        !empty($data['staff_id']) && $where['a.staff_id'] = ['=', '' . $data['staff_id'] . ''];
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
            $order_by = "a.id desc";
        }
        return $order_by;
    }

	/**
	 * 考勤报表列表列表
	 * @param array $where
	 * @param bool $field
	 * @param string $order
	 * @param int|mixed $paginate
	 * @return
	 */
	public function getAttendanceReport($data=[])
	{

		$prefix = SYS_DB_PREFIX;

		if (!empty($data['month'])) {
			$month = getMonthStartEndTime($data['month']);
		} else {
			$month = getMonthStartEndTime();
		}

		$where_string = '';
		if (!empty($data['staff_id'])) {
			$where_string = "WHERE staff.id = '".$data['staff_id']."'";
		}
		$type=$this->modelAttendanceType->getList('','','sort asc',false)->toArray();

		$field_sql_s='';
		$field_sql_c='';
		$time_len_sql='';
		$count_sql='';
		foreach ($type as $row){



			$feild_s ="type".$row['id']."s";
			$feild_c ="type".$row['id']."c";

			$ext_field[]=$feild_c;

			$field_sql_s .="IFNULL(attend.{$feild_s},0) as {$feild_s},";
			$field_sql_c .="IFNULL(attend.{$feild_c},0) as {$feild_c},";

			$time_len_sql .="SUM(CASE type_id WHEN '".$row['id']."' THEN time_len ELSE 0 END) AS {$feild_s},";
			$count_sql .="count(CASE type_id WHEN '".$row['id']."' THEN true ELSE null END) AS {$feild_c},";
		}

		$sql = "
SELECT 

	{$field_sql_s} 
	{$field_sql_c} 
	staff.name,attend.staff_id
	
FROM  {$prefix}hrm_staff  AS staff

LEFT JOIN 
	(
		SELECT 
		{$time_len_sql}
		{$count_sql}
		staff_id
		FROM {$prefix}attendance AS attend
		WHERE begin_time>'{$month['begin']}' and begin_time<'{$month['end']}'
		GROUP BY staff_id
	) AS attend
	
ON attend.staff_id=staff.id 

{$where_string}
		
		";

		//所有数据统计
		$cnt_list = $this->modelAttendance->query($sql);
		$totalRecord = count($cnt_list);

//分页数据统计
		$pageSize = empty($data['pageSize']) ? DB_LIST_ROWS : $data['pageSize'];
		$currPage = empty($data['pageNum']) ? 1 : $data['pageNum'];
		$limit = ($currPage - 1) * $pageSize;

		$data_sql = $sql . " LIMIT {$limit},{$pageSize}";
		$data_list = $this->modelAttendance->query($data_sql);
		$data_list = Bootstrap::make($data_list, $pageSize, $currPage, $totalRecord, false, ['path' => Bootstrap::getCurrentPath(), 'query' => request()->param()]);
		is_object($data_list) && $data_list = $data_list->toArray();

		$data_list['ext_field']=$ext_field;
return $data_list;
		//d($data_list);

	}

}
