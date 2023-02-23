<?php
/*
*
* cms.Archives  内容发布系统-频道模型
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

namespace app\oask\controller;

/**
 * 规章制度列表管理-控制器
 */
class Regulation extends OaskBase
{

	/**
	 * 规章制度列表列表=》模板
	 * @return mixed|string
	 */
	public function show()
	{
		if (!empty($this->param['listtype'])) {
			$this->assign('listtype', $this->param['listtype']);
		} else {
			$this->assign('listtype', 'selfson');
		}
		$this->common_data();
		return $this->fetch('show');
	}


	/**
	 * 规章制度列表列表-》json数据
	 * @return
	 */
	public function show_json()
	{
		$where = $this->logicRegulation->getWhere($this->param);
		$orderby = $this->logicRegulation->getOrderby($this->param);
		$list = $this->logicRegulation->getRegulationList($where, '*', $orderby);
		return $list;
	}


	/**
	 * 规章制度列表添加
	 * @return mixed|string
	 */
	public function add()
	{

		IS_POST && $this->jump($this->logicRegulation->regulationAdd($this->param));

		$this->common_data();

		return $this->fetch('add');
	}

	/**
	 * 规章制度列表编辑
	 * @return mixed|string
	 */

	public function edit()
	{

		IS_POST && $this->jump($this->logicRegulation->regulationEdit($this->param));

		$this->common_data();
		$info = $this->logicRegulation->getRegulationInfo(['id' => $this->param['id']]);
		$this->assign('info', $info);
		return $this->fetch('edit');
	}

	/**
	 * 规章制度详细展示
	 * @return mixed|string
	 */

	public function detail()
	{

		//详细=>关联数据调用
		if (!empty($this->param['type'])) {
			$list = $this->logicRegulation->getRegulationDetail($this->param);
			return $list;
		}
		$this->common_data();
		$info = $this->logicRegulation->getRegulationInfo(['id' => $this->param['id']]);
		$this->assign('info', $info);
		return $this->fetch('detail');
	}

	/**
	 * 规章制度列表删除
	 */
	public function del()
	{
		$this->jump($this->logicRegulation->regulationDel($this->param));
	}


	/**
	 * 公共数据
	 * Author: lingqifei created by at 2020/6/15 0015
	 */
	public function common_data()
	{
		$dict = $this->logicCstDict->getCstDictListTypeall();
		$this->assign('dict', $dict);

		$sys_user = $this->logicSysUser->getSysUserSubList();
		$this->assign('sys_user_list', $sys_user);
		$this->assign('sys_user_id', SYS_USER_ID);

		$type_list = $this->logicRegulationType->getRegulationTypeTreeSelect();
		$this->assign('type_list', $type_list);

	}

}
