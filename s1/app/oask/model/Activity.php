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
 * 营销活动=》模型
 */
class Activity extends OaskBase
{
	/**
	 * 员工状态
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
				'name' => '新活动',
				'html' => '<span class="label label-primary">新活动<span>',
				'action' => array(),
			),
			"2" => array(
				'id' => '2',
				'name' => '进行中',
				'html' => '<span class="label label-info">进行中<span>',
				'action' => array(),
			),
			"3" => array(
				'id' => '3',
				'name' => '已完成',
				'html' => '<span class="label label-success">已完成<span>',
				'action' => array(),
			),
			"4" => array(
				'id' => '4',
				'name' => '已暂停',
				'html' => '<span class="label label-warning">已暂停<span>',
				'action' => array(),
			),
			"5" => array(
				'id' => '5',
				'name' => '已取消',
				'html' => '<span class="label label-default">已取消<span>',
				'action' => array(),
			),

		);
		return (array_key_exists($key, $data)) ? $data[$key] : $data;
	}

	/**
	 * 学历选择
	 * 0=未执行，1=执行中，2=执行完成，3=未完成，4=已经取消
	 * @param string $key
	 * @return array|mixed
	 * Author: kfrs <goodkfrs@QQ.com> created by at 2020/11/27 0027
	 */
	public function degree($key = '')
	{
		$data = array(
			"博士" => array(
				'id' => '博士',
				'name' => '博士',
				'html' => '<span class="label label-success">博士<span>',
				'action' => array(),
			),
			"研究生" => array(
				'id' => '研究生',
				'name' => '研究生',
				'html' => '<span class="label label-success">研究生<span>',
				'action' => array(),
			),
			"本科" => array(
				'id' => '本科',
				'name' => '本科',
				'html' => '<span class="label label-success">本科<span>',
				'action' => array(),
			),
			"大专" => array(
				'id' => '大专',
				'name' => '大专',
				'html' => '<span class="label label-success">大专<span>',
				'action' => array(),
			),
			"高中" => array(
				'id' => '高中',
				'name' => '高中',
				'html' => '<span class="label label-success">高中<span>',
				'action' => array(),
			),
			"初中" => array(
				'id' => '初中',
				'name' => '初中',
				'html' => '<span class="label label-success">初中<span>',
				'action' => array(),
			),
			"其它" => array(
				'id' => '其它',
				'name' => '其它',
				'html' => '<span class="label label-success">其它<span>',
				'action' => array(),
			)
		);
		return (array_key_exists($key, $data)) ? $data[$key] : $data;
	}

}
