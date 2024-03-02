<?php
// +----------------------------------------------------------------------
// | 07FLYCRM [基于ThinkPHP5.0开发]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2021 http://www.07fly.xyz
// +----------------------------------------------------------------------
// | Professional because of focus  Persevering because of happiness
// +----------------------------------------------------------------------
// | Author: 开发人生 <goodkfrs@qq.com>
// +----------------------------------------------------------------------

namespace app\admin\logic;

use think\Db;
use think\Request;
/**
 * 用户公告=》逻辑层
 */
class SysNotifyUser extends AdminBase
{
    /**
     * 用户公告列表
     * @param array $where
     * @param bool $field
     * @param string $order
     * @param int|mixed $paginate
     * @return
     */
    public function getSysNotifyUserList($where = [], $field = 'a.*,n.create_user_id', $order = '', $paginate = DB_LIST_ROWS)
    {

        $this->modelSysNotifyUser->alias('a');
        $join = [
            [SYS_DB_PREFIX . 'oa_notify n', 'n.id = a.notify_id','LEFT'],
        ];
        $this->modelSysNotifyUser->join = $join;
        $list = $this->modelSysNotifyUser->getList($where, $field, $order, $paginate);
        foreach ($list as &$row){
            $row['read_state_text']=($row['read_state']=='1')?'<span class="label">已读</span>':'<span class="label-danger label">未读</span>';
            $row['create_user_name']=$this->modelSysUser->getValue(['id'=>$row['create_user_id']],'realname');
        }
        return $list;
    }

    /**
     * 用户公告添加
     * @param array $data
     * @return array
     */
    public function oaNotifyUserAdd($data = [])
    {
        $sys_user_arr=[];
        if($data['rece_type']=='1'){
            $sys_user_arr=explode(',',$data['rece_user_id']);
        }else{
            $sys_user_arr=$this->modelSysUser->getColumn('','id');
        }
        foreach ($sys_user_arr as $user_id){
            $tmp_data[]=[
                'owner_user_id'=>$user_id,
                'notify_id'=>$data['notify_id'],
                'create_user_id'=>$data['create_user_id'],
            ];
        }
        $result = $this->modelSysNotifyUser->setList($tmp_data);
        $url = url('show');
        $result && action_log('新增', '新增用户公告：' . $data['name']);
        return $result ? [RESULT_SUCCESS, '添加成功', $url] : [RESULT_ERROR, $this->modelSysNotifyUser->getError()];
    }

    /**
     * 用户公告编辑
     * @param array $data
     * @return array
     */
    public function oaNotifyUserRead($data = [])
    {
        $map['id']=['in',$data['id']];
        $data=[
            'read_state'=>1,
            'read_time'=>format_time(),
        ];
        $result = $this->modelSysNotifyUser->updateInfo($map,$data);

        $result && action_log('编辑', '编辑用户公告已读，where：' . http_build_query($map));

        return $result ? [RESULT_SUCCESS, '编辑成功'] : [RESULT_ERROR, $this->modelSysNotifyUser->getError()];
    }

    /**
     * 用户公告删除
     * @param array $where
     * @return array
     */
    public function oaNotifyUserDel($where = [])
    {

        $result = $this->modelSysNotifyUser->deleteInfo($where,true);

        $result && action_log('删除', '删除用户公告，where：' . http_build_query($where));

        return $result ? [RESULT_SUCCESS, '删除成功'] : [RESULT_ERROR, $this->modelSysNotifyUser->getError()];
    }

    /**用户公告信息
     * @param array $where
     * @param bool $field
     * @return
     */
    public function getSysNotifyUserInfo($where = [], $field ='a.*,n.name,n.content,n.create_user_id')
    {
        $this->modelSysNotifyUser->alias('a');
        $join = [
            [SYS_DB_PREFIX . 'oa_notify n', 'n.id = a.notify_id','LEFT'],
        ];
        $this->modelSysNotifyUser->join = $join;
        $info =  $this->modelSysNotifyUser->getInfo($where, $field);
        $info['create_user_name']=$this->modelSysUser->getValue(['id'=>$info['create_user_id']],'realname');
        return $info;
    }


	/**
	 * 获取列表搜索条件
	 */
	public function getWhere($data = [])
	{

        //定义当前登录id
		$where['a.owner_user_id'] =!empty($data['owner_user_id'])?$data['owner_user_id']:SYS_USER_ID;;

		//关键字查
		!empty($data['keywords']) && $where['n.name|n.content'] = ['like', '%'.$data['keywords'].'%'];

		//创建时间
		if(!empty($data['create_time'])){
			$range_date=getDayStartEndTime($data['create_time']);
			$where['a.create_time'] = ['between', [strtotime($range_date['begin']),strtotime($range_date['end'])]];
		}

        //是否已读
        if (isset($data['read_state'])) {
            if (!empty($data['read_state']) || is_numeric($data['read_state'])) {
                $where['read_state'] = ['=', '' . $data['read_state'] . ''];
            }
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
        if ($orderField == 'create_time') {
            $order_by = "a.create_time $orderDirection";
        } else if ($orderField == 'update_time') {
            $order_by = "a.update_time $orderDirection";
        } else if ($orderField == 'read_time') {
            $order_by = "a.read_time $orderDirection";
        } else {
            $order_by = "a.create_time desc";
        }
        return $order_by;
    }

}
