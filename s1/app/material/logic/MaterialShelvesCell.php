<?php
/**
 * 零起飞-(07FLY-CRM)
 * ==============================================
 * 版权所有 2015-2028   成都零起飞网络，并保留所有权利。
 * 网站地址: http://www.07fly.xyz
 * ----------------------------------------------
 * 如果商业用途务必到官方购买正版授权, 以免引起不必要的法律纠纷.
 * ==============================================
 * author: kfrs <goodkfrs@QQ.com> 574249366
 * Date: 2023-02-06
 */

namespace app\material\logic;

use app\common\logic\TableField;

/**
 * 货架格子管理=》逻辑层
 */
class MaterialShelvesCell extends MaterialBase
{
    /**
     * 货架格子列表
     * @param array $where
     * @param bool $field
     * @param string $order
     * @param int|mixed $paginate
     * @return
     */
    public function getMaterialShelvesCellList($where = [], $field = true, $order = 'sort asc', $paginate = DB_LIST_ROWS)
    {
        $list = $this->modelMaterialShelvesCell->getList($where, $field, $order, $paginate);
        foreach ($list as &$row) {
            $row['use_status_arr'] = $this->modelMaterialShelvesCell->user_status($row['use_status']);
        }
        return $list;
    }

    /**
     * 货架格子添加
     * @param array $data
     * @return array
     */
    public function materialShelvesCellAdd($data = [])
    {

        $validate_result = $this->validateMaterialShelvesCell->scene('add')->check($data);
        if (!$validate_result) {
            return [RESULT_ERROR, $this->validateMaterialShelvesCell->getError()];
        }

        for ($i = $data['start_num']; $i <= $data['end_num']; $i++) {
            $shelves_cell_code = $data['shelves_code'] . str_pad($i, 5, '0', STR_PAD_LEFT);
            $into_list = $data;
            $into_list['shelves_cell_code'] = $shelves_cell_code;
            $into_list['create_user_id'] = SYS_USER_ID;
            $result = $this->modelMaterialShelvesCell->setInfo($into_list);
        }
        $url = url('show');
        return $result ? [RESULT_SUCCESS, '添加成功', $url] : [RESULT_ERROR, $this->modelMaterialShelvesCell->getError()];
    }

    /**
     * 货架格子编辑
     * @param array $data
     * @return array
     */
    public function materialShelvesCellEdit($data = [])
    {

        $validate_result = $this->validateMaterialShelvesCell->scene('edit')->check($data);
        if (!$validate_result) {
            return [RESULT_ERROR, $this->validateMaterialShelvesCell->getError()];
        }
        $url = url('show');
        $result = $this->modelMaterialShelvesCell->setInfo($data);
        $result && action_log('编辑', '编辑货架格子，name：' . $data['shelves_cell_code']);
        return $result ? [RESULT_SUCCESS, '编辑成功', $url] : [RESULT_ERROR, $this->modelMaterialShelvesCell->getError()];
    }

    /**
     * 货架格子删除
     * @param array $where
     * @return array
     */
    public function materialShelvesCellDel($data = [])
    {
        if (!empty($data['id'])) {
            $where['id'] = ['in', $data['id']];
        } else {
            throw_response_error('无选择数据');
        }

        $result = $this->modelMaterialShelvesCell->deleteInfo($where, true);

        $result && action_log('删除', '删除货架格子，where：' . http_build_query($where));

        return $result ? [RESULT_SUCCESS, '删除成功'] : [RESULT_ERROR, $this->modelMaterialShelvesCell->getError()];
    }

    /**货架格子信息
     * @param array $where
     * @param bool $field
     * @return
     */
    public function getMaterialShelvesCellInfo($where = [], $field = true)
    {
        return $this->modelMaterialShelvesCell->getInfo($where, $field);
    }

    /**
     * 获取列表搜索条件
     */
    public function getWhere($data = [])
    {

        $where = [];
        //关键字查
        !empty($data['keywords']) && $where['shelves_cell_code|shelves_code'] = ['like', '%' . $data['keywords'] . '%'];

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
