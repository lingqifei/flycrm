<?php
// +----------------------------------------------------------------------
// | 07FLYERP [基于ThinkPHP5.0开发]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2021 http://www.07fly.xyz
// +----------------------------------------------------------------------
// | Professional because of focus  Persevering because of happiness
// +----------------------------------------------------------------------
// | Author: 开发人生 <goodkfrs@qq.com>
// +----------------------------------------------------------------------

namespace app\admin\controller\api;

use app\admin\controller\api\AdminApiBase;

/**
 * 系统公告接口
 */
class OaNotifyUser extends AdminApiBase
{
    //数据查询
	public function show_json(){
		$where = $this->logicOaNotifyUser->getWhere($this->param['matchObj']);
        $orderby = $this->logicOaNotifyUser->getOrderby($this->param['sortObj']);
        $list = $this->logicOaNotifyUser->getOaNotifyUserList($where, 'a.*,n.name,n.content,n.create_user_id', 'a.id desc');
		return $this->apiReturn($list);
	}
    //设置为已经读
	public function set_read(){
        $result=$this->logicOaNotifyUser->oaNotifyUserRead($this->param['req']);
        return $this->apiReturn($result);
    }

    /**
     * 删除
     * @return mixed|string
     */
    public function del()
    {
        $result = $this->logicOaNotifyUser->oaNotifyUserDel(['id' => $this->param['req']['id']]);
        return $this->apiReturn($result);
    }

}
