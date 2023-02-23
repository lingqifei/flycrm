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
 * 资产列表管理=》模型
 */
class Assets extends OaskBase
{
	//状态
	public  function status($key = '')
	{
		$data = array(
			"1" => array(
				'id' => '1',
				'name' => '闲置',
				'html' => '<span class="label label-warning">闲置<span>',
				'action' => array(
				),
			),
			"2" => array(
				'id' => '2',
				'name' => '在用',
				'html' => '<span class="label label-info">在用<span>',
				'action' => array(

				),
			),
			"3" => array(
				'id' => '3',
				'name' => '维修',
				'html' => '<span class="label label-info">台账<span>',
				'action' => array(
				),
			),
			"4" => array(
				'id' => '4',
				'name' => '报废',
				'html' => '<span class="label label-info">报废<span>',
				'action' => array(
				),
			),
			"5" => array(
				'id' => '5',
				'name' => '丢失',
				'html' => '<span class="label label-info">丢失<span>',
				'action' => array(
				),
			),
		);
		return (array_key_exists($key,$data))?$data[$key]:$data;
	}

}
