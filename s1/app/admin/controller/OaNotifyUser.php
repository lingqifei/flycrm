<?php
/*
*
* oa.notify  oa系统-频道模型
*
* =========================================================
* 零起飞网络 - 专注于网站建设服务和行业系统开发
* 以质量求生存，以服务谋发展，以信誉创品牌 !
* ----------------------------------------------
* @copyright	Copyright (C) 2017-2018 07FLY Network Technology Co,LTD (www.07FLY.com) All rights reserved.
* @license    For licensing, see LICENSE.html or http://www.07fly.xyz/crm/license
* @author ：kfrs <goodkfrs@QQ.com> 574249366
* @version ：1.0
* @link ：http://www.07fly.xyz
*/

namespace app\admin\controller;

/**
 * 用户公告管理-控制器
 */
class OaNotifyUser extends AdminBase
{

	/**
	 * 用户公告列表=》模板
	 * @return mixed|string
	 */
	public function show()
	{
		return $this->fetch('show');
	}

	/**
	 * 用户公告列表-》json数据
	 * @return
	 */
	public function show_json()
	{

		$where = $this->logicOaNotifyUser->getWhere($this->param);
		$list = $this->logicOaNotifyUser->getOaNotifyUserList($where, 'a.*,n.name,n.content,n.create_user_id', 'a.id desc');
		return $list;
	}

	/**
	 * 用户公告编辑
	 * @return mixed|string
	 */

	public function detail()
	{
		$this->logicOaNotifyUser->oaNotifyUserRead($this->param);
		$info = $this->logicOaNotifyUser->getOaNotifyUserInfo(['a.id' => $this->param['id']]);
		$this->assign('info', $info);
		return $this->fetch('detail');
	}

	/**
	 * 用户公告标已经读
	 * @return mixed|string
	 */

	public function read()
	{
		IS_POST && $this->jump($this->logicOaNotifyUser->oaNotifyUserRead($this->param));
	}

	/**
	 * 用户公告删除
	 */
	public function del()
	{
		$where = empty($this->param['id']) ? ['id' => 0] : ['id' => $this->param['id']];
		$this->jump($this->logicOaNotifyUser->oaNotifyUserDel($where));
	}

}
