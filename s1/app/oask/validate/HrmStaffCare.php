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
 * 员工关怀 模块基类
 */
class HrmStaffCare extends OaskBase
{
	// 验证规则
	protected $rule = [

		'name' => 'require',
		'staff_id' => 'require',
		'curr_date' => 'require',

	];

	// 验证提示
	protected $message = [
		'name.require' => '关怀主题不能为空',
		'staff_id.require' => '选择的员工不能为空',
		'contract_no.require' => '学习编号不能为空',
		'begin_date.require' => '关怀日期不能为空',
	];

	// 应用场景
	protected $scene = [
		'add' => ['name', 'staff_id', 'curr_date'],
		'edit' => ['name', 'staff_id', 'curr_date'],
	];
}

?>