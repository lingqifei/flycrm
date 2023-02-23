<?php
/*
*
* hrm.validate  模型
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

namespace app\oask\validate;

use app\common\validate\ValidateBase;

/**
 * 员工奖罚 模块基类
 */
class HrmStaffReward extends OaskBase
{
	// 验证规则
	protected $rule = [

		'name' => 'require',
		'staff_id' => 'require',
		'typename' => 'require',
		'curr_date' => 'require',

	];

	// 验证提示
	protected $message = [
		'name.require' => '学习名称不能为空',
		'staff_id.require' => '选择的员工不能为空',
		'typename.require' => '奖罚类型不能为空',
		'curr_date.require' => '奖罚日期不能为空',
	];

	// 应用场景
	protected $scene = [
		'add' => ['name', 'staff_id', 'curr_date', 'typename'],
		'edit' => ['name', 'staff_id', 'curr_date', 'typename'],
	];
}

?>