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
* 系统公告管理-控制器
*/

class OaNotify extends AdminBase
{

    /**
     * 系统公告列表=》模板
     * @return mixed|string
     */
    public function show()
    {
        return $this->fetch('show');
    }

    /**
     * 系统公告列表-》json数据
     * @return
     */
    public function show_json()
    {
        $where['create_user_id'] = ['=', SYS_USER_ID];
        if (!empty($this->param['keywords'])) {
            $where['name|content'] = ['like', '%' . $this->param['keywords'] . '%'];
        }
        $list = $this->logicOaNotify->getOaNotifyList($where);
        return $list;
    }

    /**
     * 系统公告添加
     * @return mixed|string
     */
    public function add()
    {
        IS_POST && $this->jump($this->logicOaNotify->oaNotifyAdd($this->param));
        return $this->fetch('add');
    }

    /**
     * 系统公告编辑
     * @return mixed|string
     */

    public function edit()
    {

        IS_POST && $this->jump($this->logicOaNotify->oaNotifyEdit($this->param));

        $info = $this->logicOaNotify->getOaNotifyInfo(['id' => $this->param['id']]);
        $this->assign('info', $info);
        return $this->fetch('edit');
    }

	/**详细
	 * @return mixed
	 * Author: 开发人生 goodkfrs@qq.com
	 * Date: 2021/10/29 0029 10:55
	 */
	public function detail()
	{
		$info = $this->logicOaNotify->getOaNotifyInfo(['id' => $this->param['id']]);
		$this->assign('info', $info);
		return $this->fetch('detail');
	}

    /**
     * 系统公告删除
     */
    public function del()
    {
        $this->jump($this->logicOaNotify->oaNotifyDel($this->param));
    }



	/**
	 * 我的系统公告列表-》json数据
	 * @return
	 */
	public function main_json()
	{
		if(empty($this->param['id'])){
			$list = $this->logicOaNotify->getOaNotifyListMy($this->param);
			return $list;

		}else{
			$this->logicOaNotify->oaNotifyUserRead($this->param);
			$info = $this->logicOaNotify->getOaNotifyInfo(['id' => $this->param['id']]);
			$this->assign('info', $info);
			return $this->fetch('detail');
		}
	}


}
