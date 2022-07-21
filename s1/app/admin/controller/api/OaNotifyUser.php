<?php
/*
*
* crm.rpc.RpcBase  crm内部接口 = 客户管理
*
* =========================================================
* 零起飞网络 - 专注于网站建设服务和行业系统开发
* 以质量求生存，以服务谋发展，以信誉创品牌 !
* ----------------------------------------------
* @copyright	Copyright (C) 2017-2018 07FLY Network Technology Co,LTD (www.07FLY.com) All rights reserved.
* @license    For licensing, see LICENSE.html or http://www.07fly.net/html/business
* @author ：kfrs <goodkfrs@QQ.com> 574249366
* @version ：1.0
* @link ：http://www.07fly.xyz
*/
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
