<?php
/**
 * 零起飞-(07FLY-CRM)
 * ==============================================
 * 版权所有 2015-2028   成都零起飞网络，并保留所有权利。
 * 网站地址: http://www.07fly.xyz
 * ----------------------------------------------
 * 如果商业用途务必到官方购买正版授权, 以免引起不必要的法律纠纷.
 * ==============================================
 * Author: kfrs <goodkfrs@QQ.com> 574249366
 * Date: 2023-04-04 10:34:28
 */

use app\admin\logic\Log as LogicLog;

/**
 * 记录行为日志
 */
function action_log($name = '', $describe = '')
{

	$logLogic = get_sington_object('logLogic', LogicLog::class);

	$logLogic->logAdd($name, $describe);
}

//得到把列表数据=》数形参数
if (!function_exists("list2tree")) {
	function list2tree($list, $pId = 0, $level = 0, $pk = 'id', $pidk = 'pid', $name = 'name')
	{
		$tree = [];
		foreach ($list as $k => $v) {
			if ($v[$pidk] == $pId) { //父亲找到儿子
				$v['nodes'] = list2tree($list, $v[$pk], $level + 1, $pk, $pidk, $name);
				$v['level'] = $level + 1;
				$v['treename'] = str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;', $level) . '|--' . $v[$name];
				$v['tags'] = $v['id'];
				$v['text'] = $v[$name];
				$tree[] = $v;
			}
		}
		return $tree;
	}
}
if (!function_exists("list2select")) {

	/**r把列表数据转为树形下拉
	 * @param $list
	 * @param int $pId
	 * @param int $level
	 * @param string $pk
	 * @param string $pidk
	 * @param string $name
	 * @return array|string
	 * Author: lingqifei created by at 2020/4/1 0001
	 */
	function list2select($list, $pId = 0, $level = 0, $pk = 'id', $pidk = 'pid', $name = 'name',$data=[])
	{
		foreach ($list as $k => $v) {
			$v['treename'] = str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;', $level) . '|--' . $v[$name];
			if ($v[$pidk] == $pId) { //父亲找到儿子
				$data[] =$v;
				$data   = list2select($list, $v[$pk], $level + 1, $pk, $pidk, $name,$data);
			}
		}
		return $data;
	}
}

?>
