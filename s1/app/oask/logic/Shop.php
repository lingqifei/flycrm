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
 * 门店列表管理=》逻辑层
 */
class Shop extends OaskBase
{
    /**
     * 门店列表列表
     * @param array $where
     * @param bool $field
     * @param string $order
     * @param int|mixed $paginate
     * @return
     */
    public function getShopList($where = [], $field = true, $order = 'create_time desc', $paginate = DB_LIST_ROWS)
    {

        $list =  $this->modelShop->getList($where, $field, $order, $paginate);
        foreach ($list  as  &$row){
            //$row['status_text']=$this->logicCstDict->getCstDictOneName($row['status']);
        }
        return $list->toArray();
    }

    /**
     * 门店列表列表
     * @param array $where
     * @param bool $field
     * @param string $order
     * @param int|mixed $paginate
     * @return
     */
    public function getShopSelect()
    {
        $map=[
            "listtype"=>'selfson'
        ];
        $where=$this->getWhere($map);
        $list =  $this->modelShop->getList($where, 'name,id', 'update_time desc', false)->toArray();
        return $list;
    }

    /**
     * 门店列表添加
     * @param array $data
     * @return array
     */
    public function shopAdd($data = [])
    {

        $validate_result = $this->validateShop->scene('add')->check($data);
        if (!$validate_result) {
            return [RESULT_ERROR, $this->validateShop->getError()];
        }

        $adddata=$data;
        $adddata['create_user_id']=SYS_USER_ID;

        $supplier_id  = $this->modelShop->setInfo($adddata);

        //增加到联系人
        $linkmandata=[
            'supplier_id'=>$supplier_id,
            'name'=>$data['linkman'],
            'mobile'=>$data['mobile'],
            'create_user_id'=>SYS_USER_ID,
        ];
        $result=$this->modelSupLinkman->setInfo($linkmandata);

        $url = url('show');
        $result && action_log('新增', '新增门店列表：' . $data['name']);
        return $result ? [RESULT_SUCCESS, '添加成功', $url] : [RESULT_ERROR, $this->modelShop->getError()];
    }

    /**
     * 门店列表编辑
     * @param array $data
     * @return array
     */
    public function shopEdit($data = [])
    {

        $validate_result = $this->validateShop->scene('edit')->check($data);
        if (!$validate_result) {
            return [RESULT_ERROR, $this->validateShop->getError()];
        }

        $result = $this->modelShop->setInfo($data);

        $result && action_log('编辑', '编辑门店列表，name：' . $data['name']);
        $url = url('show');
        return $result ? [RESULT_SUCCESS, '编辑成功', $url] : [RESULT_ERROR, $this->modelShop->getError()];
    }

    /**
     * 门店列表删除
     * @param array $where
     * @return array
     */
    public function shopDel($where = [])
    {

        $result = $this->modelShop->deleteInfo($where,true);

        $result && action_log('删除', '删除门店列表，where：' . http_build_query($where));
        return $result ? [RESULT_SUCCESS, '删除成功'] : [RESULT_ERROR, $this->modelShop->getError()];
    }

    /**门店列表信息
     * @param array $where
     * @param bool $field
     * @return
     */
    public function getShopInfo($where = [], $field = true)
    {
        return $this->modelShop->getInfo($where, $field);
    }


    /**销售合同列表信息
     * @param array $where
     * @param bool $field
     * @return
     */
    public function getShopDetail($data=[])
    {
        $map=['supplier_id'=>$data['id']];
        if($data['type']=='linkman'){
            $list=$this->modelSupLinkman->getList($map, true, '', false)->toArray();
        }else if($data['type']=='poscontract'){
            $list=$this->modelPosContract->getList($map, "*", '', false)->toArray();
            $listtype['total_money']=array_sum(array_column($list,'money'));
        }else if($data['type']=='payrecord'){
            $list=$this->modelFinPayRecord->getList($map, true, '', false)->toArray();
        }else if($data['type']=='invoice'){
            $list=$this->modelFinInvoiceRece->getList($map, true, '', false)->toArray();
            $listtype['total_money']=array_sum(array_column($list,'money'));
        }
        $listtype['data']=$list;
        $listtype['type']=$data['type'];
        return $listtype;
    }


    /**
     * 获取列表搜索条件
     */
    public function getWhere($data = [])
    {

        $where = [];
        //关键字查
        !empty($data['keywords']) && $where['name|linkman|tel|mobile|address'] = ['like', '%'.$data['keywords'].'%'];
        !empty($data['industry']) && $where['industry'] = ['like', '%'.$data['customerstatus'].'%'];

        //查看公开程度
        if(isset($data['openstatus'])){
            if (!empty($data['openstatus']) || is_numeric($data['openstatus'])){
                $where['openstatus'] = ['=',$data['openstatus']];
            }
        }


        return $where;
    }

    /**
     * 获取排序条件
     */
    public function getOrderBy($data = [])
    {
        $order_by="";
        if(!empty($data['orderField'])){
            $orderField = $data['orderField'];
            $orderDirection = $data['orderDirection'];
        }else{
            $orderField="";
            $orderDirection="";
        }
        if( $orderField=='by_name' ){
            $order_by ="name $orderDirection";
        }else if($orderField=='by_ecotype'){
            $order_by ="ecotype $orderDirection";
        }else if($orderField=='by_industry'){
            $order_by ="industry  $orderDirection";
        }else{
            $order_by ="id desc";
        }
        return $order_by;
    }

    /**
     * 门店列表下载
     * @param array $where
     * @param bool $field
     * @param string $order
     * @param int|mixed $paginate
     * @return
     */
    public function getShopListDown($where = [], $field = true, $order = 'id desc', $paginate = DB_LIST_ROWS)
    {
        $list =  $this->modelShop->getList($where, $field, $order, false)->toArray();

        foreach ($list as  &$row){
            $row['create_user_name']=$this->modelSysUser->getValue(['id'=>$row['create_user_id']],'realname');
            $row['owner_user_name']=$this->modelSysUser->getValue(['id'=>$row['owner_user_id']],'realname');
        }

        $titles = "门店名称,联系人,手机,电话,电话,QQ,地址,备注,经济类型,客户等级,客户行业,满意度,信誉度,创建时间,更新时间,归属人,创建人";
        $keys   = "name,linkman,mobile,tel,qicq,weixin,address,remark,ecotype,level,industry,satisfy,credit,create_time,update_time,owner_user_name,create_user_name";

        action_log('下载', '客户列表列表');
        export_excel($titles, $keys, $list, '客户列表');
    }

}
