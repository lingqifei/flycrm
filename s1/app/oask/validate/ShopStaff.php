<?php
/**
 * 零起飞-(07FLY-CRM)
 * ==============================================
 * 版权所有 2015-2028   成都零起飞网络，并保留所有权利。
 * 网站地址: http://www.07fly.xyz
 * ----------------------------------------------------------------------------
 * 如果商业用途务必到官方购买正版授权, 以免引起不必要的法律纠纷.
 * ==============================================
 * Author: kfrs <goodkfrs@QQ.com> 574249366
 * Date: 2019-10-3
 */

namespace app\oask\validate;

/**
 * 员工档案 模块基类
 */
class ShopStaff extends OaskBase
{
	// 验证规则
	protected $rule = [

		'name' => 'require',
		'shop_id' => 'require',
		'idcard' => 'require',
		'mobile' => 'require',
		'birthday' => 'require',
		'entry_date' => 'require',
		'formal_date' => 'require',

	];

	// 验证提示
	protected $message = [
		'name.require' => '员工名称不能为空',
		'shop_id.require' => '选择门店不能为空',
		'idcard.require' => '身份证号码不能为空',
		'mobile.require' => '员工手机号码不能为空',
		'birthday.require' => '员工生日不能为空',
		'entry_date.require' => '员工入职日期不能为空',
		'formal_date.require' => '员工转正日期不能为空',
	];

	// 应用场景
	protected $scene = [

		'add' => ['name', 'shop_id', 'idcard', 'mobile', 'birthday', 'entry_date'],
		'edit' => ['name', 'idcard', 'mobile', 'birthday', 'entry_date'],
		'formal' => ['formal_date'],
	];
}

?>