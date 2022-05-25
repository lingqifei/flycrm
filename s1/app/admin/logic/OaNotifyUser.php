<?php
/**
 * 零起飞-(07FLY-CRM)
 * ==============================================
 * 版权所有 2015-2028   成都零起飞网络，并保留所有权利。
 * 网站地址: http://www.07fly.xyz
 * ----------------------------------------------------------------------------
 * 如果商业用途务必到官方购买正版授权, 以免引起不必要的法律纠纷.
 * ==============================================
 * OaNotifyUseror: kfrs <goodkfrs@QQ.com> 574249366
 * Date: 2019-10-3
 */

namespace app\admin\logic;

use think\Db;
use think\Request;
/**
 * 用户公告=》逻辑层
 */
class OaNotifyUser extends AdminBase
{
    /**
     * 用户公告列表
     * @param array $where
     * @param bool $field
     * @param string $order
     * @param int|mixed $paginate
     * @return
     */
    public function getOaNotifyUserList($where = [], $field = 'a.*,n.create_user_id', $order = '', $paginate = DB_LIST_ROWS)
    {

        $this->modelOaNotifyUser->alias('a');
        $join = [
            [SYS_DB_PREFIX . 'oa_notify n', 'n.id = a.notify_id','LEFT'],
        ];
        $this->modelOaNotifyUser->join = $join;
        $list = $this->modelOaNotifyUser->getList($where, $field, $order, $paginate);
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
        $result = $this->modelOaNotifyUser->setList($tmp_data);
        $url = url('show');
        $result && action_log('新增', '新增用户公告：' . $data['name']);
        return $result ? [RESULT_SUCCESS, '添加成功', $url] : [RESULT_ERROR, $this->modelOaNotifyUser->getError()];
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
        $result = $this->modelOaNotifyUser->updateInfo($map,$data);

        $result && action_log('编辑', '编辑用户公告已读，where：' . http_build_query($map));

        return $result ? [RESULT_SUCCESS, '编辑成功'] : [RESULT_ERROR, $this->modelOaNotifyUser->getError()];
    }

    /**
     * 用户公告删除
     * @param array $where
     * @return array
     */
    public function oaNotifyUserDel($where = [])
    {

        $result = $this->modelOaNotifyUser->deleteInfo($where,true);

        $result && action_log('删除', '删除用户公告，where：' . http_build_query($where));

        return $result ? [RESULT_SUCCESS, '删除成功'] : [RESULT_ERROR, $this->modelOaNotifyUser->getError()];
    }

    /**用户公告信息
     * @param array $where
     * @param bool $field
     * @return
     */
    public function getOaNotifyUserInfo($where = [], $field ='a.*,n.name,n.content,n.create_user_id')
    {
        $this->modelOaNotifyUser->alias('a');
        $join = [
            [SYS_DB_PREFIX . 'oa_notify n', 'n.id = a.notify_id','LEFT'],
        ];
        $this->modelOaNotifyUser->join = $join;
        $info =  $this->modelOaNotifyUser->getInfo($where, $field);
        $info['create_user_name']=$this->modelSysUser->getValue(['id'=>$info['create_user_id']],'realname');
        return $info;
    }


	/**
	 * 获取列表搜索条件
	 */
	public function getWhere($data = [])
	{

		$where['a.owner_user_id'] =SYS_USER_ID;

		//关键字查
		!empty($data['keywords']) && $where['n.name|n.content'] = ['like', '%'.$data['keywords'].'%'];

		//创建时间
		if(!empty($data['create_time'])){
			$range_date=getDayStartEndTime($data['create_time']);
			$where['a.create_time'] = ['between', [strtotime($range_date['begin']),strtotime($range_date['end'])]];
		}

		return $where;
	}

}
