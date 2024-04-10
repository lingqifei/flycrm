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
 * 品牌分类管理=》逻辑层
 */
class MaterialBrand extends MaterialBase
{
    /**
     * 品牌分类列表
     * @param array $where
     * @param bool $field
     * @param string $order
     * @param int|mixed $paginate
     * @return
     */
    public function getMaterialBrandList($where = [], $field = true, $order = 'sort asc', $paginate = DB_LIST_ROWS)
    {
        $list= $this->modelMaterialBrand->getList($where, $field, $order, $paginate);
        foreach ($list as &$row){
            $row['litpic']=get_picture_url($row['litpic']);
        }
        return $list;
    }

    /**
     * 品牌分类添加
     * @param array $data
     * @return array
     */
    public function materialBrandAdd($data = [])
    {

        $validate_result = $this->validateMaterialBrand->scene('add')->check($data);

        if (!$validate_result) {

            return [RESULT_ERROR, $this->validateMaterialBrand->getError()];
        }
        $result = $this->modelMaterialBrand->setInfo($data);
        $url = url('show');
        $result && action_log('新增', '新增品牌分类：' . $data['name']);

        return $result ? [RESULT_SUCCESS, '添加成功', $url] : [RESULT_ERROR, $this->modelMaterialBrand->getError()];
    }

    /**
     * 品牌分类编辑
     * @param array $data
     * @return array
     */
    public function materialBrandEdit($data = [])
    {

        $validate_result = $this->validateMaterialBrand->scene('edit')->check($data);

        if (!$validate_result) {

            return [RESULT_ERROR, $this->validateMaterialBrand->getError()];
        }

        $url = url('show');

        $result = $this->modelMaterialBrand->setInfo($data);

        $result && action_log('编辑', '编辑品牌分类，name：' . $data['name']);

        return $result ? [RESULT_SUCCESS, '编辑成功', $url] : [RESULT_ERROR, $this->modelMaterialBrand->getError()];
    }

    /**
     * 品牌分类删除
     * @param array $where
     * @return array
     */
    public function materialBrandDel($where = [])
    {

        $result = $this->modelMaterialBrand->deleteInfo($where,true);

        $result && action_log('删除', '删除品牌分类，where：' . http_build_query($where));

        return $result ? [RESULT_SUCCESS, '删除成功'] : [RESULT_ERROR, $this->modelMaterialBrand->getError()];
    }

    /**品牌分类信息
     * @param array $where
     * @param bool $field
     * @return
     */
    public function getMaterialBrandInfo($where = [], $field = true)
    {
        return $this->modelMaterialBrand->getInfo($where, $field);
    }

    /**品牌分类信息
     * @param array $where
     * @param bool $field
     * @return
     */
    public function getMaterialBrandOneName($id=0)
    {

        $data= $this->modelMaterialBrand->getValue(['id'=>$id],'name');
        return $data;
    }

    /**
     * 获取列表搜索条件
     */
    public function getWhere($data = [])
    {

        $where = [];
        //关键字查
        !empty($data['keywords']) && $where['name'] = ['like', '%'.$data['keywords'].'%'];

        return $where;
    }

    /**
     * 获取排序条件
     */
    public function getOrderBy($data = [])
    {
        $order_by="";
        //排序操作
        if(!empty($data['orderField'])){
            $orderField = $data['orderField'];
            $orderDirection = $data['orderDirection'];
        }else{
            $orderField="";
            $orderDirection="";
        }
        if( $orderField=='by_sort' ){
            $order_by ="sort $orderDirection";
        }else if($orderField=='by_name'){
            $order_by ="name $orderDirection";
        }else{
            $order_by ="sort asc";
        }
        return $order_by;
    }

}
