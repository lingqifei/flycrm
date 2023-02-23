<?php
/**
 * 零起飞-(07FLY-CRM)
 * ==============================================
 * 版权所有 2015-2028   成都零起飞网络，并保留所有权利。
 * 网站地址: http://www.07fly.xyz
 * ----------------------------------------------------------------------------
 * 如果商业用途务必到官方购买正版授权, 以免引起不必要的法律纠纷.
 * ==============================================
 * CstTraceor: kfrs <goodkfrs@QQ.com> 574249366
 * Date: 2019-10-3
 */

namespace app\oask\logic;

use app\common\logic\TableField;

/**
 * 跟进列表管理=》逻辑层
 */
class CstTrace extends OaskBase
{
    /**
     * 跟进列表列表
     * @param array $where
     * @param bool $field
     * @param string $order
     * @param int|mixed $paginate
     * @return
     */
    public function getCstTraceList($where = [], $field = 'a.*,c.name as customer_name', $order = 'a.update_time desc', $paginate = DB_LIST_ROWS)
    {
        $this->modelCstTrace->alias('a');
        $join = [
            [SYS_DB_PREFIX . 'cst_customer c', 'c.id = a.customer_id','LEFT'],
        ];
        $this->modelCstTrace->join=$join;
        $list =  $this->modelCstTrace->getList($where, $field, $order, $paginate)->toArray();
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
    public function cstTraceAdd($data = [])
    {

        $validate_result = $this->validateCstTrace->scene('add')->check($data);
        if (!$validate_result) {
            return [RESULT_ERROR, $this->validateCstTrace->getError()];
        }
        $result = $this->modelCstTrace->setInfo($data);

        empty($data['link_time']) && $data['link_time']=format_time();

        //判断关联
        if(!empty($data['chance_id'])){
            $updata=[
                'link_time'=>$data['link_time'],
                'next_time'=>$data['next_time'],
            ];
            $this->modelCstChance->setInfo($updata,['id'=>$data['chance_id']]);
        }

        if(!empty($data['customer_id'])){
            $updata=[
                'link_time'=>$data['link_time'],
                'link_body'=>$data['link_body'],
                'next_time'=>$data['next_time'],
            ];
            $this->modelCstCustomer->updateInfo(['id'=>$data['customer_id']],$updata);
        }
//        if(!empty($data['linkman_id'])){
//            $updata=[
//                'link_time'=>$data['link_time'],
//                'next_time'=>$data['next_time'],
//            ];
//            $this->modelCstLinkman->setInfo($updata,['id'=>$data['linkman_id']]);
//        }


		if(!empty($data['next_time'])){
			sys_msg('cst_trace',$result,$data['link_body'],SYS_USER_ID,$data['next_time']);
		}

        $url = url('show');
        $result && action_log('新增', '新增跟进列表：' . $data['link_body']);
        return $result ? [RESULT_SUCCESS, '添加成功', $url] : [RESULT_ERROR, $this->modelCstTrace->getError()];
    }

    /**
     * 跟进列表编辑
     * @param array $data
     * @return array
     */
    public function cstTraceEdit($data = [])
    {

        $validate_result = $this->validateCstTrace->scene('edit')->check($data);
        if (!$validate_result) {
            return [RESULT_ERROR, $this->validateCstTrace->getError()];
        }

        $result = $this->modelCstTrace->setInfo($data);

        $result && action_log('编辑', '编辑跟进列表，name：' . $data['link_body']);
        $url = url('show');
        return $result ? [RESULT_SUCCESS, '编辑成功', $url] : [RESULT_ERROR, $this->modelCstTrace->getError()];
    }

    /**
     * 跟进列表删除
     * @param array $where
     * @return array
     */
    public function cstTraceDel($where = [])
    {

        $result = $this->modelCstTrace->deleteInfo($where,true);

        $result && action_log('删除', '删除跟进列表，where：' . http_build_query($where));

        return $result ? [RESULT_SUCCESS, '删除成功'] : [RESULT_ERROR, $this->modelCstTrace->getError()];
    }

    /**跟进列表信息
     * @param array $where
     * @param bool $field
     * @return
     */
    public function getCstTraceInfo($where = [], $field = true)
    {
        return $this->modelCstTrace->getInfo($where, $field);
    }

	/**跟进列表状态
	 * @param array $where
	 * @param bool $field
	 * @return
	 */
	public function getStatus($key='')
	{
		return $this->modelCstTrace->status($key);
	}

    /**
     * 获取列表搜索条件
     */
    public function getWhere($data = [])
    {

        $where = [];
        //关键字查
        !empty($data['keywords']) && $where['a.link_body'] = ['like', '%'.$data['keywords'].'%'];

        !empty($data['salestage']) && $where['a.salestage'] = ['like', '%'.$data['salestage'].'%'];
        !empty($data['salemode']) && $where['a.salemode'] = ['like', '%'.$data['salemode'].'%'];

		if(!empty($data['customer_id'])){
			$where['a.customer_id'] = ['=', $data['customer_id']];
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
    public function getCstTraceListDown($where = [], $field = '', $order = 'a.id desc', $paginate = false)
    {
        $this->modelCstTrace->alias('a');
        $join = [
            [SYS_DB_PREFIX . 'cst_customer c', 'c.id = a.customer_id','LEFT'],
        ];
        $this->modelCstTrace->join=$join;
        $list =  $this->modelCstTrace->getList($where, $field, $order, $paginate)->toArray();

        foreach ($list as &$row) {
            $row['customer_name'] = $this->modelCstCustomer->getValue(['id' => $row['customer_id']], 'name');
            $row['linkman_name'] = $this->modelCstLinkman->getValue(['id' => $row['linkman_id']], 'name');
            $row['chance_name'] = $this->modelCstLinkman->getValue(['id' => $row['chance_id']], 'name');
            $row['create_user_name'] = $this->modelSysUser->getValue(['id' => $row['create_user_id']], 'realname');
            $row['owner_user_name'] = $this->modelSysUser->getValue(['id' => $row['owner_user_id']], 'realname');
        }

        $titles = "联系时间,联系方式,客户名称,沟通内容,下次联系时间,当前状态,创建时间,更新时间,创建人";
        $keys = "link_time,salemode,customer_name,link_body,next_time,salestage,create_time,update_time,create_user_name";

        action_log('下载', '沟通记录列表');
        export_excel($titles, $keys, $list, '沟通记录列表');
    }

}
