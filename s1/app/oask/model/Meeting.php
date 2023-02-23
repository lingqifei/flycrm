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
 * 会议管理=》模型
 */
class Meeting extends OaskBase
{
	/**
	 * 会议状态
	 * 0=未执行，1=执行中，2=执行完成，3=未完成，4=已经取消
	 * @param string $key
	 * @return array|mixed
	 * Author: kfrs <goodkfrs@QQ.com> created by at 2020/11/27 0027
	 */
	public function status($key = '')
	{
		$data = array(
			"1" => array(
				'id' => '1',
				'name' => '计划',
				'html' => '<span class="label label-warning">计划<span>',
				'action' => array(),
			),
			"2" => array(
				'id' => '2',
				'name' => '结束',
				'html' => '<span class="label label-success">结束<span>',
				'action' => array(),
			),
			"3" => array(
				'id' => '3',
				'name' => '取消',
				'html' => '<span class="label label-default">取消<span>',
				'action' => array(),
			)
		);
		return (array_key_exists($key, $data)) ? $data[$key] : $data;
	}
}
