<?php
/**
 * 零起飞-(07FLY-CRM)
 * ==============================================
 * 版权所有 2015-2028   成都零起飞网络，并保留所有权利。
 * 网站地址: http://www.07fly.xyz
 * ----------------------------------------------------------------------------
 * 如果商业用途务必到官方购买正版授权, 以免引起不必要的法律纠纷.
 * ==============================================
 * SupTraceor: kfrs <goodkfrs@QQ.com> 574249366
 * Date: 2019-10-3
 */

namespace app\oask\logic;

use app\common\logic\TableField;

/**
 * 跟进列表管理=》逻辑层
 */
class SupTrace extends OaskBase
{
    /**
     * 跟进列表列表
     * @param array $where
     * @param bool $field
     * @param string $order
     * @param int|mixed $paginate
     * @return
     */
    public function getSupTraceList($where = [], $field = 'a.*,c.name as supplier_name', $order = 'a.create_time desc', $paginate = DB_LIST_ROWS)
    {
        $this->modelSupTrace->alias('a');
        $join = [
            [SYS_DB_PREFIX . 'sup_supplier c', 'c.id = a.supplier_id','LEFT'],
        ];
        $this->modelSupTrace->join=$join;
        $list =  $this->modelSupTrace->getList($where, $field, $order, $paginate)->toArray();
        if($paginate===false) $list['data']=$list;
        foreach ($list['data']  as  &$row){
			$row['create_user_name']=$this->logicSysUser->getRealname($row['create_user_id']);

			if (!empty($row['attachment'])) {
				$reply_arr = str2arr($row['attachment']);
				$reply_txt = '<br>附件：</br>';
				foreach ($reply_arr as $key2 => $val) {
					$filepath = get_file_url($val);
					$reply_txt .= '<p><a href="' . $filepath . '">' . $filepath . '</a></p>';
				}
				$row['link_body'] = $row['link_body'] . $reply_txt;
			}
        }
        return $list;
    }

    /**
     * 跟进列表添加
     * @param array $data
     * @return array
     */
    public function supTraceAdd($data = [])
    {

        $validate_result = $this->validateSupTrace->scene('add')->check($data);
        if (!$validate_result) {
            return [RESULT_ERROR, $this->validateSupTrace->getError()];
        }
        $data['create_user_id']=SYS_USER_ID;
        $result = $this->modelSupTrace->setInfo($data);
        $url = url('show');
        $result && action_log('新增', '新增跟进列表：' . $data['link_body']);
        return $result ? [RESULT_SUCCESS, '添加成功', $url] : [RESULT_ERROR, $this->modelSupTrace->getError()];
    }

    /**
     * 跟进列表编辑
     * @param array $data
     * @return array
     */
    public function supTraceEdit($data = [])
    {

        $validate_result = $this->validateSupTrace->scene('edit')->check($data);
        if (!$validate_result) {
            return [RESULT_ERROR, $this->validateSupTrace->getError()];
        }

        $result = $this->modelSupTrace->setInfo($data);

        $result && action_log('编辑', '编辑跟进列表，name：' . $data['link_body']);
        $url = url('show');
        return $result ? [RESULT_SUCCESS, '编辑成功', $url] : [RESULT_ERROR, $this->modelSupTrace->getError()];
    }

    /**
     * 跟进列表删除
     * @param array $where
     * @return array
     */
    public function supTraceDel($where = [])
    {

        $result = $this->modelSupTrace->deleteInfo($where,true);

        $result && action_log('删除', '删除跟进列表，where：' . http_build_query($where));

        return $result ? [RESULT_SUCCESS, '删除成功'] : [RESULT_ERROR, $this->modelSupTrace->getError()];
    }

    /**跟进列表信息
     * @param array $where
     * @param bool $field
     * @return
     */
    public function getSupTraceInfo($where = [], $field = true)
    {
        return $this->modelSupTrace->getInfo($where, $field);
    }

	/**
	 * 请候状态
	 * @return mixed
	 * Author: kfrs <goodkfrs@QQ.com> created by at 2020/10/23 0023
	 */
	public function getStatus()
	{
		return $this->modelSupTrace->status();
	}

    /**
     * 获取列表搜索条件
     */
    public function getWhere($data = [])
    {

        $where = [];
        //关键字查
        !empty($data['keywords']) && $where['a.link_body'] = ['like', '%'.$data['keywords'].'%'];

        if(!empty($data['supplier_id'])){
			$where['a.supplier_id'] = ['=', $data['supplier_id']];
		}

        //下次联系时间
        if(!empty($data['next_rangedate'])){
            $range_date=str2arr($data['next_rangedate'],"-");
            $where['a.next_time'] = ['between', $range_date];
        }
        //联系时间
        if(!empty($data['link_rangedate'])){
            $range_date=str2arr($data['link_rangedate'],"-");
            $where['a.link_time'] = ['between', $range_date];
        }

        if(!empty($data['listtype'])){
            if($data['listtype']=='selfson'){
                $ids=$this->logicSysUser->getSysUserDeptSelfSon(SYS_USER_ID);
            }else if($data['listtype']=='self'){
                $ids=SYS_USER_ID;
            }else if($data['listtype']=='son'){
                $ids=$this->logicSysUser->getSysUserDeptSon(SYS_USER_ID);
            }
            $where['c.owner_user_id'] = ['in', $ids];
        }
		!empty($data['create_user_id']) && $where['a.create_user_id'] = ['=', ''.$data['create_user_id'].''];
		!empty($data['supplier_id']) && $where['a.supplier_id'] = ['=', ''.$data['supplier_id'].''];
		!empty($data['status']) && $where['a.status'] = ['=', ''.$data['status'].''];
        return $where;
    }

    /**
     * 获取排序条件
     */
    public function getOrderBy($data = [])
    {
        if(!empty($data['orderField'])){
            $orderField = $data['orderField'];
            $orderDirection = $data['orderDirection'];
        }else{
            $orderField="";
            $orderDirection="";
        }
        if( $orderField=='by_link' ){
            $order_by ="a.link_time $orderDirection";
        }else if($orderField=='by_next'){
            $order_by ="a.next_time $orderDirection";
        }else{
            $order_by ="a.create_time desc";
        }
        return $order_by;
    }

    /**
     * 列表下载
     * @param array $where
     * @param bool $field
     * @param string $order
     * @param int|mixed $paginate
     * @return
     */
    public function getSupTraceListDown($where = [], $field = '', $order = 'a.id desc', $paginate = false)
    {
        $this->modelSupTrace->alias('a');
        $join = [
            [SYS_DB_PREFIX . 'cst_supplier c', 'c.id = a.supplier_id','LEFT'],
        ];
        $this->modelSupTrace->join=$join;
        $list =  $this->modelSupTrace->getList($where, $field, $order, $paginate)->toArray();

        foreach ($list as &$row) {
            $row['supplier_name'] = $this->modelCstCustomer->getValue(['id' => $row['supplier_id']], 'name');
            $row['linkman_name'] = $this->modelCstLinkman->getValue(['id' => $row['linkman_id']], 'name');
            $row['chance_name'] = $this->modelCstLinkman->getValue(['id' => $row['chance_id']], 'name');
            $row['create_user_name'] = $this->modelSysUser->getValue(['id' => $row['create_user_id']], 'realname');
            $row['owner_user_name'] = $this->modelSysUser->getValue(['id' => $row['owner_user_id']], 'realname');
        }

        $titles = "联系时间,联系方式,客户名称,沟通内容,下次联系时间,当前状态,创建时间,更新时间,创建人";
        $keys = "link_time,salemode,supplier_name,link_body,next_time,salestage,create_time,update_time,create_user_name";

        action_log('下载', '沟通记录列表');
        export_excel($titles, $keys, $list, '沟通记录列表');
    }

}
