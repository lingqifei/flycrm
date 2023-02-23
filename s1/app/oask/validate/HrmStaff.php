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
 * 员工档案 模块基类
 */
class HrmStaff extends OaskBase
{
	// 验证规则
	protected $rule = [

		'name' => 'require',
		'bind_user_id' => 'require|unique:hrm_staff',
		'idcard' => 'require',
		'mobile' => 'require',
		'birthday' => 'require',
		'entry_date' => 'require',
		'formal_date' => 'require',

	];

	// 验证提示
	protected $message = [
		'name.require' => '员工名称不能为空',
		'bind_user_id.require' => '绑定系统帐号不能为空',
		'bind_user_id.unique'      => '系统帐号已经存在了',
		'idcard.require' => '身份证号码不能为空',
		'mobile.require' => '员工手机号码不能为空',
		'birthday.require' => '员工生日不能为空',
		'entry_date.require' => '员工入职日期不能为空',
		'formal_date.require' => '员工转正日期不能为空',
	];

	// 应用场景
	protected $scene = [

		'add' => ['name', 'bind_user_id', 'idcard', 'mobile', 'birthday', 'entry_date'],
		'edit' => ['name', 'idcard', 'mobile', 'birthday', 'entry_date'],
		'formal' => ['formal_date'],
	];
}

?>