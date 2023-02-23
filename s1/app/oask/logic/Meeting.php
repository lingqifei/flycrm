<?php
/**
 * 零起飞-(07FLY-CRM)
 * ==============================================
 * 版权所有 2015-2028   成都零起飞网络，并保留所有权利。
 * 网站地址: http://www.07fly.xyz
 * ----------------------------------------------------------------------------
 * 如果商业用途务必到官方购买正版授权, 以免引起不必要的法律纠纷.
 * ==============================================
 * Meetingor: kfrs <goodkfrs@QQ.com> 574249366
 * Date: 2019-10-3
 */

namespace app\oask\logic;

use app\common\logic\TableField;

/**
 * 会议管理=》逻辑层
 */
class Meeting extends OaskBase
{
	
    /**
     * 会议列表
     * @param array $where
     * @param bool $field
     * @param string $order
     * @param int|mixed $paginate
     * @return
     */
    public function getMeetingList($where = [], $field = 'a.*', $order = 'a.update_time desc', $paginate = DB_LIST_ROWS)
    {
        $this->modelMeeting->alias('a');
        $list =  $this->modelMeeting->getList($where, $field, $order, $paginate)->toArray();
        if($paginate===false) $list['data']=$list;
        foreach ($list['data']  as  &$row){
            $row['create_user_name']=$this->logicSysUser->getRealname($row['create_user_id']);
            $row['host_user_name']=$this->logicSysUser->getRealname($row['host_user_id']);
            $row['status_arr']=$this->getStatus($row['status']);
        }
        return $list;
    }

    /**
     * 会议添加
     * @param array $data
     * @return array
     */
    public function meetingAdd($data = [])
    {

        $validate_result = $this->validateMeeting->scene('add')->check($data);
        if (!$validate_result) {
            return [RESULT_ERROR, $this->validateMeeting->getError()];
        }
		$data['create_user_id']=SYS_USER_ID;
        $result = $this->modelMeeting->setInfo($data);

        $url = url('show');
        $result && action_log('新增', '新增会议：' . $data['name']);
        return $result ? [RESULT_SUCCESS, '添加成功', $url] : [RESULT_ERROR, $this->modelMeeting->getError()];
    }

    /**
     * 会议编辑
     * @param array $data
     * @return array
     */
    public function meetingEdit($data = [])
    {

        $validate_result = $this->validateMeeting->scene('edit')->check($data);
        if (!$validate_result) {
            return [RESULT_ERROR, $this->validateMeeting->getError()];
        }
        $result = $this->modelMeeting->setInfo($data);
        $result && action_log('编辑', '编辑会议，name：' . $data['name']);
        $url = url('show');
        return $result ? [RESULT_SUCCESS, '编辑成功', $url] : [RESULT_ERROR, $this->modelMeeting->getError()];
    }

    /**
     * 会议删除
     * @param array $where
     * @return array
     */
    public function meetingDel($where = [])
    {

        $result = $this->modelMeeting->deleteInfo($where,true);

        $result && action_log('删除', '删除会议，where：' . http_build_query($where));

        return $result ? [RESULT_SUCCESS, '删除成功'] : [RESULT_ERROR, $this->modelMeeting->getError()];
    }

    /**会议信息
     * @param array $where
     * @param bool $field
     * @return
     */
    public function getMeetingInfo($where = [], $field = true)
    {
        $info= $this->modelMeeting->getInfo($where, $field);
		$info['create_user_name']=$this->logicSysUser->getRealname($info['create_user_id']);
		$info['host_user_name']=$this->logicSysUser->getRealname($info['host_user_id']);

		return $info;
    }


    /**
     * 获取列表搜索条件
     */
    public function getWhere($data = [])
    {

        $where = [];
        //关键字查
        !empty($data['keywords']) && $where['a.remark|a.name'] = ['like', '%'.$data['keywords'].'%'];

		//下次联系时间
        if(!empty($data['begin_rangedate'])){
            $range_date=str2arr($data['begin_rangedate'],"-");
            $where['a.begin_time'] = ['between', $range_date];
        }
        //联系时间
        if(!empty($data['end_rangedate'])){
            $range_date=str2arr($data['end_rangedate'],"-");
            $where['a.end_time'] = ['between', $range_date];
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

	/**会议状态
	 * @param string $key
	 * @return mixed
	 * Author: 开发人生 goodkfrs@qq.com
	 * Date: 2021/8/19 0019 10:40
	 */
	public  function getStatus($key=''){
    	return $this->modelMeeting->status($key);
	}

}
