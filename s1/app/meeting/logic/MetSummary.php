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
class MetSummary extends MeetingBase
{
    /**
     * 会议室纪要分类列表
     * @param array $where
     * @param bool $field
     * @param string $order
     * @param int|mixed $paginate
     * @return
     */
    public function getMetSummaryList($where = [], $field = true, $order = 'id desc', $paginate = DB_LIST_ROWS)
    {
        $list = $this->modelMetSummary->getList($where, $field, $order, $paginate);
        foreach ($list as &$row){
            $row['room_name']=$this->modelMetRoom->getValue(['id'=>$row['room_id']],'name');
        }
        return $list;
    }

    /**
     * 会议室纪要分类添加
     * @param array $data
     * @return array
     */
    public function metSummaryAdd($data = [])
    {

        $validate_result = $this->validateMetSummary->scene('add')->check($data);

        if (!$validate_result) {

            return [RESULT_ERROR, $this->validateMetSummary->getError()];
        }
        $result = $this->modelMetSummary->setInfo($data);
        $url = url('show');
        $result && action_log('新增', '新增会议室纪要分类：' . $data['name']);

        return $result ? [RESULT_SUCCESS, '添加成功', $url] : [RESULT_ERROR, $this->modelMetSummary->getError()];
    }

    /**
     * 会议室纪要分类编辑
     * @param array $data
     * @return array
     */
    public function metSummaryEdit($data = [])
    {

        $validate_result = $this->validateMetSummary->scene('edit')->check($data);

        if (!$validate_result) {

            return [RESULT_ERROR, $this->validateMetSummary->getError()];
        }

        $url = url('show');

        $result = $this->modelMetSummary->setInfo($data);

        $result && action_log('编辑', '编辑会议室纪要分类，name：' . $data['name']);

        return $result ? [RESULT_SUCCESS, '编辑成功', $url] : [RESULT_ERROR, $this->modelMetSummary->getError()];
    }

    /**
     * 会议室纪要分类删除
     * @param array $where
     * @return array
     */
    public function metSummaryDel($where = [])
    {

        $result = $this->modelMetSummary->deleteInfo($where, true);

        $result && action_log('删除', '删除会议室纪要分类，where：' . http_build_query($where));

        return $result ? [RESULT_SUCCESS, '删除成功'] : [RESULT_ERROR, $this->modelMetSummary->getError()];
    }

    /**会议室纪要分类信息
     * @param array $where
     * @param bool $field
     * @return
     */
    public function getMetSummaryInfo($where = [], $field = true)
    {
        return $this->modelMetSummary->getInfo($where, $field);
    }

    /**会议室纪要分类信息
     * @param array $where
     * @param bool $field
     * @return
     */
    public function getMetSummaryOneName($id = 0)
    {

        $data = $this->modelMetSummary->getValue(['id' => $id], 'name');
        return $data;
    }

    /**
     * 获取列表搜索条件
     */
    public function getWhere($data = [])
    {

        $where = [];
        //关键字查
        !empty($data['keywords']) && $where['name|content|resolution|trace_body'] = ['like', '%' . $data['keywords'] . '%'];
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