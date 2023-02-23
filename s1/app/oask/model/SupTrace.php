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
namespace app\oask\model;

/**
 * 跟进列表管理=》模型
 */
class SupTrace extends OaskBase
{
	public function status($key = '')
	{
		$data = array(
			"1" => array(
				'name' => '完结',
				'html' => '<span class="label">完结</span>',
			),
			"2" => array(
				'name' => '待处理',
				'html' => '<span class="label label-primary">待处理</span>',
			),
		);
		return (array_key_exists($key, $data)) ? $data[$key] : $data;
	}
}
