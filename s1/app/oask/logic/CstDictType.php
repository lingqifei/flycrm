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

namespace app\oask\logic;

use app\common\logic\TableField;

/**
 * 字典分类管理=》逻辑层
 */
class CstDictType extends OaskBase
{
    /**
     * 字典分类列表
     * @param array $where
     * @param bool $field
     * @param string $order
     * @param int|mixed $paginate
     * @return
     */
    public function getCstDictTypeList($where = [], $field = true, $order = 'sort asc', $paginate = DB_LIST_ROWS)
    {
        return $this->modelCstDictType->getList($where, $field, $order, $paginate)->toArray();
    }

    /**
     * 字典分类添加
     * @param array $data
     * @return array
     */
    public function cstDictTypeAdd($data = [])
    {

        $validate_result = $this->validateCstDictType->scene('add')->check($data);

        if (!$validate_result) {

            return [RESULT_ERROR, $this->validateCstDictType->getError()];
        }
        $result = $this->modelCstDictType->setInfo($data);
        $url = url('show');
        $result && action_log('新增', '新增字典分类：' . $data['name']);

        return $result ? [RESULT_SUCCESS, '添加成功', $url] : [RESULT_ERROR, $this->modelCstDictType->getError()];
    }

    /**
     * 字典分类编辑
     * @param array $data
     * @return array
     */
    public function cstDictTypeEdit($data = [])
    {

        $validate_result = $this->validateCstDictType->scene('edit')->check($data);

        if (!$validate_result) {

            return [RESULT_ERROR, $this->validateCstDictType->getError()];
        }

        $url = url('show');

        $result = $this->modelCstDictType->setInfo($data);

        $result && action_log('编辑', '编辑字典分类，name：' . $data['name']);

        return $result ? [RESULT_SUCCESS, '编辑成功', $url] : [RESULT_ERROR, $this->modelCstDictType->getError()];
    }

    /**
     * 字典分类删除
     * @param array $where
     * @return array
     */
    public function cstDictTypeDel($where = [])
    {

        $result = $this->modelCstDictType->deleteInfo($where,true);

        $result && action_log('删除', '删除字典分类，where：' . http_build_query($where));

        return $result ? [RESULT_SUCCESS, '删除成功'] : [RESULT_ERROR, $this->modelCstDictType->getError()];
    }

    /**字典分类信息
     * @param array $where
     * @param bool $field
     * @return
     */
    public function getCstDictTypeInfo($where = [], $field = true)
    {
        return $this->modelCstDictType->getInfo($where, $field);
    }

}
