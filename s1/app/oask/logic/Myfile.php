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

/**
 * 我的文件管理=》逻辑层
 */
class Myfile extends OaskBase
{
    /**
     * 我的文件列表
     * @param array $where
     * @param bool $field
     * @param string $order
     * @param int|mixed $paginate
     * @return
     */
    public function getMyfileList($where = [], $field = true, $order = 'create_time desc', $paginate = DB_LIST_ROWS)
    {
        return $this->modelMyfile->getList($where, $field, $order, $paginate)->toArray();
    }

    /**
     * 我的文件添加
     * @param array $data
     * @return array
     */
    public function myfileAdd($data = [])
    {

        $validate_result = $this->validateMyfile->scene('add')->check($data);
        if (!$validate_result) {
            return [RESULT_ERROR, $this->validateMyfile->getError()];
        }
        $data['create_user_id']=SYS_USER_ID;
        $result = $this->modelMyfile->setInfo($data);
        $url = url('show');
        $result && action_log('新增', '新增我的文件：' . $data['name']);

        return $result ? [RESULT_SUCCESS, '添加成功', $url] : [RESULT_ERROR, $this->modelMyfile->getError()];
    }

    /**
     * 我的文件编辑
     * @param array $data
     * @return array
     */
    public function myfileEdit($data = [])
    {

        $validate_result = $this->validateMyfile->scene('edit')->check($data);

        if (!$validate_result) {

            return [RESULT_ERROR, $this->validateMyfile->getError()];
        }

        $url = url('show');

        $result = $this->modelMyfile->setInfo($data);

        $result && action_log('编辑', '编辑我的文件，name：' . $data['name']);

        return $result ? [RESULT_SUCCESS, '编辑成功', $url] : [RESULT_ERROR, $this->modelMyfile->getError()];
    }

    /**
     * 我的文件删除
     * @param array $where
     * @return array
     */
    public function myfileDel($where = [])
    {

        $result = $this->modelMyfile->deleteInfo($where,true);

        $result && action_log('删除', '删除我的文件，where：' . http_build_query($where));

        return $result ? [RESULT_SUCCESS, '删除成功'] : [RESULT_ERROR, $this->modelMyfile->getError()];
    }

    /**我的文件信息
     * @param array $where
     * @param bool $field
     * @return
     */
    public function getMyfileInfo($where = [], $field = true)
    {
        return $this->modelMyfile->getInfo($where, $field);
    }

    /**
     * 获取列表搜索条件
     */
    public function getWhere($data = [])
    {

        $where['create_user_id'] = ['=',SYS_USER_ID];
        //关键字查
        !empty($data['keywords']) && $where['name|url'] = ['like', '%'.$data['keywords'].'%'];

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
        if( $orderField=='by_name' ){
            $order_by ="name $orderDirection";
        }else if($orderField=='by_url'){
            $order_by ="url $orderDirection";
        }else{
            $order_by ="create_time asc";
        }
        return $order_by;
    }

}
