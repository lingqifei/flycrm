<?php
/**
 * 零起飞-(07FLY-CRM)
 * ==============================================
 * 版权所有 2015-2028   成都零起飞网络，并保留所有权利。
 * 网站地址: http://www.07fly.xyz
 * ----------------------------------------------
 * 如果商业用途务必到官方购买正版授权, 以免引起不必要的法律纠纷.
 * ==============================================
 * Author: kfrs <goodkfrs@QQ.com> 574249366
 * Date: 2023-03-06
 */

namespace app\material\logic;

use app\common\logic\TableField;

/**
 * 商品分类管理=》逻辑层
 */
class MaterialCategory extends MaterialBase
{
    /**
     * 商品分类列表
     * @param array $where
     * @param bool $field
     * @param string $order
     * @param int|mixed $paginate
     * @return
     */
    public function getMaterialCategoryList($where = [], $field = true, $order = 'sort asc', $paginate = DB_LIST_ROWS)
    {
        $list= $this->modelMaterialCategory->getList($where, $field, $order, $paginate);
        foreach ($list as &$row){
            $row['litpic']=get_picture_url($row['litpic']);
        }
        return $list;
    }

    /**
     * 商品分类添加
     * @param array $data
     * @return array
     */
    public function materialCategoryAdd($data = [])
    {

        $validate_result = $this->validateMaterialCategory->scene('add')->check($data);

        if (!$validate_result) {

            return [RESULT_ERROR, $this->validateMaterialCategory->getError()];
        }
        $result = $this->modelMaterialCategory->setInfo($data);
        $url = url('show');
        $result && action_log('新增', '新增商品分类：' . $data['name']);
        return $result ? [RESULT_SUCCESS, '添加成功', $url] : [RESULT_ERROR, $this->modelMaterialCategory->getError()];
    }

    /**
     * 商品分类编辑
     * @param array $data
     * @return array
     */
    public function materialCategoryEdit($data = [])
    {

        $validate_result = $this->validateMaterialCategory->scene('edit')->check($data);

        if (!$validate_result) {

            return [RESULT_ERROR, $this->validateMaterialCategory->getError()];
        }

        $url = url('show');

        $result = $this->modelMaterialCategory->setInfo($data);

        $result && action_log('编辑', '编辑商品分类，name：' . $data['name']);

        return $result ? [RESULT_SUCCESS, '编辑成功', $url] : [RESULT_ERROR, $this->modelMaterialCategory->getError()];
    }

    /**
     * 商品分类删除
     * @param array $where
     * @return array
     */
    public function materialCategoryDel($where = [])
    {

        $result = $this->modelMaterialCategory->deleteInfo($where,true);

        $result && action_log('删除', '删除商品分类，where：' . http_build_query($where));

        return $result ? [RESULT_SUCCESS, '删除成功'] : [RESULT_ERROR, $this->modelMaterialCategory->getError()];
    }

    /**商品分类信息
     * @param array $where
     * @param bool $field
     * @return
     */
    public function getMaterialCategoryInfo($where = [], $field = true)
    {
        return $this->modelMaterialCategory->getInfo($where, $field);
    }

    /**
     * 商品分类列表=》树形结构
     * @param array $where
     * @param bool $field
     * @param string $order
     * @param int|mixed $paginate
     * @return
     */
    public function getMaterialCategoryListTree($where = [], $field = "id,name,pid", $order = 'sort asc', $paginate = false)
    {
        $list=$this->modelMaterialCategory->getList($where, $field, $order, $paginate)->toArray();
        $data=list2tree($list);
        return $data;
    }

    /**
     * 商品分类列表=》树形下拉
     * @param array $where
     * @param bool $field
     * @param string $order
     * @param int|mixed $paginate
     * @return
     */
    public function getMaterialCategoryTreeSelect($where = [], $field = "id,name,pid", $order = 'sort asc', $paginate = false)
    {
        $list=$this->modelMaterialCategory->getList($where, $field, $order, $paginate)->toArray();
        $data=list2select($list);
        return $data;
    }


    /**获得所有指定id所有父级
     * @param int $deptid
     * @param array $data
     * @return array
     */
    public function getMaterialCategoryAllPid($deptid=0, $data=[])
    {
        $where['id']=['=',$deptid];
        $info = $this->modelMaterialCategory->getInfo($where,true);
        if(!empty($info) && $info['pid']){
            $data[]=$info['pid'];
            return $this->getMaterialCategoryAllPid($info['pid'],$data);
        }
        return $data;
    }

    /**获得所有指定id所有子级
     * @param int $deptid
     * @param array $data
     * @return array
     */
    public function getMaterialCategoryAllSon($deptid=0, $data=[])
    {
        $where['pid']=['=',$deptid];
        $sons = $this->modelMaterialCategory->getList($where,true,'sort asc',false);
        if (count($sons) > 0) {
            foreach ($sons as $v) {
                $data[] = $v['id'];
                $data = $this->getMaterialCategoryAllSon($v['id'], $data); //注意写$data 返回给上级
            }
        }
        if (count($data) > 0) {
            return $data;
        } else {
            return false;
        }
        return $data;
    }

    /**获取指定用户下属员工
     * @param int $id
     * @return array  ex:[1,2,3,4]
     * Author: lingqifei created by at 2020/3/29 0029
     */
    public function getMaterialCategorySelfSon($id){
        $ids=$this->getMaterialCategoryAllSon($id);
        $ids[]=$id;
        return $ids;
    }

    
}
