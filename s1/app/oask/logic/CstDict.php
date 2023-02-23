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
class CstDict extends OaskBase
{
    /**
     * 字典分类列表
     * @param array $where
     * @param bool $field
     * @param string $order
     * @param int|mixed $paginate
     * @return
     */
    public function getCstDictList($where = [], $field = true, $order = 'sort asc', $paginate = DB_LIST_ROWS)
    {
        return $this->modelCstDict->getList($where, $field, $order, $paginate)->toArray();
    }

    /**
     * 字典分类添加
     * @param array $data
     * @return array
     */
    public function cstDictAdd($data = [])
    {

        $validate_result = $this->validateCstDict->scene('add')->check($data);

        if (!$validate_result) {

            return [RESULT_ERROR, $this->validateCstDict->getError()];
        }
        $result = $this->modelCstDict->setInfo($data);
        $url = url('show');
        $result && action_log('新增', '新增字典分类：' . $data['name']);

        return $result ? [RESULT_SUCCESS, '添加成功', $url] : [RESULT_ERROR, $this->modelCstDict->getError()];
    }

    /**
     * 字典分类编辑
     * @param array $data
     * @return array
     */
    public function cstDictEdit($data = [])
    {

        $validate_result = $this->validateCstDict->scene('edit')->check($data);

        if (!$validate_result) {

            return [RESULT_ERROR, $this->validateCstDict->getError()];
        }

        $url = url('show');

        $result = $this->modelCstDict->setInfo($data);

        $result && action_log('编辑', '编辑字典分类，name：' . $data['name']);

        return $result ? [RESULT_SUCCESS, '编辑成功', $url] : [RESULT_ERROR, $this->modelCstDict->getError()];
    }

    /**
     * 字典分类删除
     * @param array $where
     * @return array
     */
    public function cstDictDel($where = [])
    {

        $result = $this->modelCstDict->deleteInfo($where,true);

        $result && action_log('删除', '删除字典分类，where：' . http_build_query($where));

        return $result ? [RESULT_SUCCESS, '删除成功'] : [RESULT_ERROR, $this->modelCstDict->getError()];
    }

    /**字典分类信息
     * @param array $where
     * @param bool $field
     * @return
     */
    public function getCstDictInfo($where = [], $field = true)
    {
        return $this->modelCstDict->getInfo($where, $field);
    }


    /**
     * @param $typetag
     * @param string $val
     * @return array
     * Author: lingqifei created by at 2020/3/24 0024
     */
    public function getCstDictListTypetag($typetag)
    {
        $where = [];
        $list = $this->modelCstDict->getList(['typetag'=>$typetag], true, 'sort asc', false)->toArray();
        $data=[];
        foreach ($list as $row){
            $data[$row['id']]=$row['name'];
        }
        return $data;
    }

    /**按标签分类输出
     * @return array
     * Author: lingqifei created by at 2020/3/24 0024
     */
    public function getCstDictListTypeall()
    {
        $list = $this->modelCstDict->getList('', true, 'sort asc', false)->toArray();
        $data=[];
        foreach ($list as $row){
            $data[$row['typetag']][]=$row;
        }
        return $data;
    }

    /**字典分类信息
     * @param array $where
     * @param bool $field
     * @return
     */
    public function getCstDictOneName($id=0)
    {

        $data= $this->modelCstDict->getValue(['id'=>$id],'name');
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
        !empty($data['typetag']) && $where['typetag'] = ['=', $data['typetag']];

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
        }else if($orderField=='by_typetag'){
            $order_by ="typetag $orderDirection";
        }else{
            $order_by ="sort asc";
        }
        return $order_by;
    }

}
