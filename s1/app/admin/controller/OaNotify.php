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
