<?php
/*
*
* meeting.logic  逻辑层
*
* ----------------------------------------------
* 零起飞网络 - 专注于企业管理系统开发
* 以质量求生存，以服务谋发展，以信誉创品牌 !
* ----------------------------------------------
* @copyright Copyright (C) 2017-2022 07FLY Network Technology Co,LTD.
* @license For licensing, see LICENSE.html or http://www.07fly.xyz/html/business
* @author ：kfrs <goodkfrs@QQ.com> 574249366
* @version ：1.1.0
* @link ：http://www.07fly.xyz
* @Date:2022-12-20 09:50:11
*/

namespace app\meeting\logic;

/**
 * 逻辑层
 */
class MetReserve extends MeetingBase
{
    /**
     * 会议室预订分类列表
     * @param array $where
     * @param bool $field
     * @param string $order
     * @param int|mixed $paginate
     * @return
     */
    public function getMetReserveList($where = [], $field = true, $order = '', $paginate = DB_LIST_ROWS)
    {
        $list = $this->modelMetReserve->getList($where, $field, $order, $paginate);
        foreach ($list as &$row) {
            $row['room_name'] = $this->modelMetRoom->getValue(['id' => $row['room_id']], 'name');
        }
        return $list;
    }

    /**
     * 会议室预订列表=>按日期显示
     * @param array $where
     * @param bool $field
     * @param string $order
     * @param int|mixed $paginate
     * @return
     */
    public function getMetReserveDateList($data=[])
    {
        $where = [];
        if (!empty($data['room_id'])) {
            $where['id'] = ['=', $data['room_id']];
        }
        $curr_date = format_time(null, "Y-m-d");
        if (!empty($data['curr_date'])) {
            $curr_date = $data['curr_date'];
        }

        $list = $this->modelMetRoom->getList($where, '', '', $paginate = DB_LIST_ROWS);
        foreach ($list as &$row) {
            $room = $this->getRoomReserveArr($row['id'], $curr_date);
            $row['room'] = $room;
        }
        return $list;
    }


    /**
     * 查询房间日期的记录
     * @param $room_id
     * @param $nowdate
     * @return array
     * @author: 开发人生 goodkfrs@qq.com
     * @Time: 2023/1/3 16:00
     */
    public function getRoomReserveArr($room_id, $nowdate = 0)
    {
        dlog($nowdate);
        $condition['room_id'] = ['=', $room_id];
        $nowdate = !empty($nowdate) ? $nowdate : format_time(null, 'Y-m-d');

        $start_time = $nowdate . ' 6:00';
        $end_time = $nowdate . ' 22:00';
        $diff_hours = abs(strtotime($start_time) - strtotime($end_time)) / 3600;//相差几个小时


        for ($i = 0; $i <= $diff_hours; $i++) {

            //开始小时时间
            $start_hour = date_calc($start_time, $i, 'hour', 'Y-m-d H:i:s');
            $curr_hour = $hour = date('H', strtotime($start_hour));

            //设置每小时间内查询几次
            $interval = 15;//间隔时间
            $nums = 60 / $interval;//循环次数
            $width = 100 / $nums;//进度宽度

            $progress_bar = '<div style="background: #E5FDC3;width: 100%;height: 30px;line-height: 30px;">';

            for ($j = 0; $j < $nums; $j++) {

                //查询每小时一段时间内是否存在预订
                $start_minute = $j * $interval;
                $begin_time = date_calc($start_hour, $start_minute, 'minute', 'Y-m-d H:i:s');
                $end_time = date_calc($begin_time, $interval, 'minute', 'Y-m-d H:i:s');

                //$hours_str[$curr_hour][]=$begin_time.' 到 '.$end_time;

                $condition['start_time'] = ['<=', $begin_time];
                $condition['end_time'] = ['>=', $begin_time];
                $info = $this->modelMetReserve->getInfo($condition);
                if (!empty($info)) {
                    $stime = date('H:i', strtotime($info['start_time']));
                    $etime = date('H:i', strtotime($info['end_time']));
//                    $etime=format_time($info['end_time'],'H:i');
                    $progress_bar .= '<div style="background: #ff0000;display: inline-block;height:100%;width: ' . $width . '%;" title="' . $info['name'] . ',时间为：' . $stime . '~' . $etime . '"></div>';
                } else {
                    $progress_bar .= '<div style="background: #efefef;display: inline-block;height:100%;width: ' . $width . '%;"></div>';
                }

            }
            $progress_bar .= '</div>';

            $tmp['hour'] = $hour;
            $tmp['progress_bar'] = $progress_bar;
            $result[] = $tmp;
        }
        return $result;
    }


    /**
     * 会议室预订分类添加
     * @param array $data
     * @return array
     */
    public function metReserveAdd($data = [])
    {

        $validate_result = $this->validateMetReserve->scene('add')->check($data);

        if (!$validate_result) {

            return [RESULT_ERROR, $this->validateMetReserve->getError()];
        }
        $result = $this->modelMetReserve->setInfo($data);
        $url = url('show');
        $result && action_log('新增', '新增会议室预订分类：' . $data['name']);

        return $result ? [RESULT_SUCCESS, '添加成功', $url] : [RESULT_ERROR, $this->modelMetReserve->getError()];
    }

    /**
     * 会议室预订分类编辑
     * @param array $data
     * @return array
     */
    public function metReserveEdit($data = [])
    {

        $validate_result = $this->validateMetReserve->scene('edit')->check($data);

        if (!$validate_result) {

            return [RESULT_ERROR, $this->validateMetReserve->getError()];
        }

        $url = url('show');

        $result = $this->modelMetReserve->setInfo($data);

        $result && action_log('编辑', '编辑会议室预订分类，name：' . $data['name']);

        return $result ? [RESULT_SUCCESS, '编辑成功', $url] : [RESULT_ERROR, $this->modelMetReserve->getError()];
    }

    /**
     * 会议室预订分类删除
     * @param array $where
     * @return array
     */
    public function metReserveDel($where = [])
    {

        $result = $this->modelMetReserve->deleteInfo($where, true);

        $result && action_log('删除', '删除会议室预订分类，where：' . http_build_query($where));

        return $result ? [RESULT_SUCCESS, '删除成功'] : [RESULT_ERROR, $this->modelMetReserve->getError()];
    }

    /**会议室预订分类信息
     * @param array $where
     * @param bool $field
     * @return
     */
    public function getMetReserveInfo($where = [], $field = true)
    {
        return $this->modelMetReserve->getInfo($where, $field);
    }


    /**
     * 获取列表搜索条件
     */
    public function getWhere($data = [])
    {

        $where = [];
        //关键字查
        !empty($data['keywords']) && $where['name'] = ['like', '%' . $data['keywords'] . '%'];

        !empty($data['room_id']) && $where['room_id'] = ['=', '' . $data['room_id'] . ''];

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
        if ($orderField == 'by_sort') {
            $order_by = "sort $orderDirection";
        } else if ($orderField == 'by_name') {
            $order_by = "name $orderDirection";
        } else {
            $order_by = "id desc";
        }
        return $order_by;
    }
}

?>