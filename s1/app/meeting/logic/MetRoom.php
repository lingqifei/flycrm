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
class MetRoom extends MeetingBase
{
    /**
     * 会议室分类列表
     * @param array $where
     * @param bool $field
     * @param string $order
     * @param int|mixed $paginate
     * @return
     */
    public function getMetRoomList($where = [], $field = true, $order = 'sort asc', $paginate = DB_LIST_ROWS)
    {
        $list = $this->modelMetRoom->getList($where, $field, $order, $paginate)->toArray();
        return $list;
    }

    /**
     * 会议室分类添加
     * @param array $data
     * @return array
     */
    public function metRoomAdd($data = [])
    {

        $validate_result = $this->validateMetRoom->scene('add')->check($data);

        if (!$validate_result) {

            return [RESULT_ERROR, $this->validateMetRoom->getError()];
        }
        $result = $this->modelMetRoom->setInfo($data);
        $url = url('show');
        $result && action_log('新增', '新增会议室分类：' . $data['name']);

        return $result ? [RESULT_SUCCESS, '添加成功', $url] : [RESULT_ERROR, $this->modelMetRoom->getError()];
    }

    /**
     * 会议室分类编辑
     * @param array $data
     * @return array
     */
    public function metRoomEdit($data = [])
    {

        $validate_result = $this->validateMetRoom->scene('edit')->check($data);

        if (!$validate_result) {

            return [RESULT_ERROR, $this->validateMetRoom->getError()];
        }

        $url = url('show');

        $result = $this->modelMetRoom->setInfo($data);

        $result && action_log('编辑', '编辑会议室分类，name：' . $data['name']);

        return $result ? [RESULT_SUCCESS, '编辑成功', $url] : [RESULT_ERROR, $this->modelMetRoom->getError()];
    }

    /**
     * 会议室分类删除
     * @param array $where
     * @return array
     */
    public function metRoomDel($where = [])
    {

        $result = $this->modelMetRoom->deleteInfo($where, true);

        $result && action_log('删除', '删除会议室分类，where：' . http_build_query($where));

        return $result ? [RESULT_SUCCESS, '删除成功'] : [RESULT_ERROR, $this->modelMetRoom->getError()];
    }

    /**会议室分类信息
     * @param array $where
     * @param bool $field
     * @return
     */
    public function getMetRoomInfo($where = [], $field = true)
    {
        return $this->modelMetRoom->getInfo($where, $field);
    }

    /**会议室分类信息
     * @param array $where
     * @param bool $field
     * @return
     */
    public function getMetRoomOneName($id = 0)
    {

        $data = $this->modelMetRoom->getValue(['id' => $id], 'name');
        return $data;
    }

    /**
     * 获取列表搜索条件
     */
    public function getWhere($data = [])
    {

        $where = [];
        //关键字查
        !empty($data['keywords']) && $where['name|device'] = ['like', '%' . $data['keywords'] . '%'];

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
            $order_by = "sort asc";
        }
        return $order_by;
    }
}

?>