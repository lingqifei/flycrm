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
 * 板材分类管理=》逻辑层
 */
class MaterialBorad extends MaterialBase
{
    /**
     * 板材分类列表
     * @param array $where
     * @param bool $field
     * @param string $order
     * @param int|mixed $paginate
     * @return
     */
    public function getMaterialBoradList($where = [], $field = true, $order = 'sort asc', $paginate = DB_LIST_ROWS)
    {
        $list = $this->modelMaterialBorad->getList($where, $field, $order, $paginate);
        foreach ($list as &$row) {
            $row['litpic'] = get_picture_url($row['litpic']);
            $row['use_status_arr'] = $this->modelMaterialBorad->user_status($row['use_status']);
        }
        return $list;
    }

    /**
     * 板材分类添加
     * @param array $data
     * @return array
     */
    public function materialBoradAdd($data = [])
    {

        $validate_result = $this->validateMaterialBorad->scene('add')->check($data);
        if (!$validate_result) {
            return [RESULT_ERROR, $this->validateMaterialBorad->getError()];
        }
        $result = $this->modelMaterialBorad->setInfo($data);


        $result && $this->modelMaterialShelvesCell->setUseStatus($data['shelves_cell_code'],2);

        $url = url('show');
        $result && action_log('新增', '新增板材分类：' . $data['name']);

        return $result ? [RESULT_SUCCESS, '添加成功', $url] : [RESULT_ERROR, $this->modelMaterialBorad->getError()];
    }

    /**
     * 板材分类编辑
     * @param array $data
     * @return array
     */
    public function materialBoradEdit($data = [])
    {

        $validate_result = $this->validateMaterialBorad->scene('edit')->check($data);

        if (!$validate_result) {

            return [RESULT_ERROR, $this->validateMaterialBorad->getError()];
        }

        $url = url('show');

        $result = $this->modelMaterialBorad->setInfo($data);

        $result && action_log('编辑', '编辑板材分类，name：' . $data['name']);

        return $result ? [RESULT_SUCCESS, '编辑成功', $url] : [RESULT_ERROR, $this->modelMaterialBorad->getError()];
    }

    /**
     * 板材=>更新状态
     * @param array $where
     * @return array
     */
    public function materialBoradUptStatus($data = [])
    {
        if (!empty($data['id'])) {
            $where['id'] = ['in', $data['id']];
        } else {
            throw_response_error('无选择数据');
        }
        $uptdata['use_status'] = $data['use_status'];
        $result = $this->modelMaterialBorad->updateInfo($where, $uptdata);

        //释放格子
        if($data['use_status']==3 || $data['use_status']==4){
            $shelves_cell_code=$this->modelMaterialBorad->getColumn($where, 'shelves_cell_code');
            $this->modelMaterialShelvesCell->setUseStatus($shelves_cell_code,1);//释放格子
        }
        $result && action_log('更新状态', '更新使用状态，where：' . http_build_query($where));
        return $result ? [RESULT_SUCCESS, '操作成功'] : [RESULT_ERROR, $this->modelMaterialBorad->getError()];
    }


    /**
     * 板材分类删除
     * @param array $where
     * @return array
     */
    public function materialBoradDel($where = [])
    {

        $result = $this->modelMaterialBorad->deleteInfo($where, true);

        $result && action_log('删除', '删除板材分类，where：' . http_build_query($where));

        return $result ? [RESULT_SUCCESS, '删除成功'] : [RESULT_ERROR, $this->modelMaterialBorad->getError()];
    }

    /**板材分类信息
     * @param array $where
     * @param bool $field
     * @return
     */
    public function getMaterialBoradInfo($where = [], $field = true)
    {
        return $this->modelMaterialBorad->getInfo($where, $field);
    }

    /**板材分类信息
     * @param array $where
     * @param bool $field
     * @return
     */
    public function getMaterialBoradOneName($id = 0)
    {

        $data = $this->modelMaterialBorad->getValue(['id' => $id], 'name');
        return $data;
    }

    /**
     * 获取列表搜索条件
     */
    public function getWhere($data = [])
    {

        $where = [];
        //关键字查
        !empty($data['keywords']) && $where['name'] = ['like', '%' . $data['keywords'] . '%'];

        !empty($data['colour_id']) && $where['colour_id'] = ['=', '' . $data['colour_id'] . ''];
        !empty($data['quality_id']) && $where['quality_id'] = ['=', '' . $data['quality_id'] . ''];
        !empty($data['shelves_cell_code']) && $where['shelves_cell_code'] = ['=', '' . $data['shelves_cell_code'] . ''];

        if (!empty($data['leng'])) {
            $where['leng'] = ['>=', '' . $data['leng'] . ''];
        }
        if (!empty($data['width'])) {
            $where['width'] = ['>=', '' . $data['width'] . ''];
        }
        if (!empty($data['area'])) {
            $where['area'] = ['>=', '' . $data['area'] . ''];
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
        if ($orderField == 'leng') {
            $order_by = "leng $orderDirection";
        } else if ($orderField == 'width') {
            $order_by = "width $orderDirection";
        } else if ($orderField == 'area') {
            $order_by = "area $orderDirection";
        } else {
            $order_by = "id desc";
        }
        return $order_by;
    }

}
