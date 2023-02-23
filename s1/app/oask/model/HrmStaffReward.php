<?php
/*
*
* hrm.model  模型
*
* =========================================================
* 零起飞网络 - 专注于网站建设服务和行业系统开发
* 以质量求生存，以服务谋发展，以信誉创品牌 !
* ----------------------------------------------
* @copyright	Copyright (C) 2017-2022 07FLY Network Technology Co,LTD.
* @license    For licensing, see LICENSE.html or http://www.07fly.xyz/license
* @author ：kfrs <goodkfrs@QQ.com> 574249366
* @version ：1.0
* @link ：http://www.07fly.xyz
*/

namespace app\oask\model;


/**
 * 员工奖罚 模块基类
 */
class HrmStaffReward extends OaskBase
{
	/**
	 * 学历选择
	 * 0=未执行，1=执行中，2=执行完成，3=未完成，4=已经取消
	 * @param string $key
	 * @return array|mixed
	 * Author: kfrs <goodkfrs@QQ.com> created by at 2020/11/27 0027
	 */
	public function type($key = '')
	{
		$data = array(
			"奖励" => array(
				'id' => '1',
				'name' => '奖励',
				'html' => '<span class="label label-success">奖励<span>',
				'action' => array(),
			),
			"惩罚" => array(
				'id' => '2',
				'name' => '惩罚',
				'html' => '<span class="label label-warning">惩罚<span>',
				'action' => array(),
			),
		);
		return (array_key_exists($key, $data)) ? $data[$key] : $data;
	}

}

?>