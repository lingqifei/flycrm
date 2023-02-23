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

namespace app\oask\logic;
use app\common\logic\LogicBase;
use app\admin\logic\AdminBase;
use app\admin\logic\SysAuthAccess;
/**
 * 模块基类
 */
class OaskBase extends LogicBase{

	// 授权过的菜单列表
	protected $authMenuList     =   [];

	// 授权过的菜单url列表
	protected $authMenuUrlList  =   [];

	//实列化adminbase对像
	protected $logicAdminBase  =   '';

	/**
	 * 构造方法
	 */
	public function __construct()
	{

		$SysAuthAccess=new SysAuthAccess();
		$this->logicAdminBase=new AdminBase();
		// 获取授权菜单列表
		$this->authMenuList = $SysAuthAccess->getAuthMenuList(SYS_USER_ID);
		// 获得权限菜单URL列表
		$this->authMenuUrlList = $SysAuthAccess->getAuthMenuUrlList($this->authMenuList);
	}

	/**
	 * 过滤页面内容权限地方，不存在权限直接过滤掉
	 */
	public function checkActionUrl($action_url = '', $url_list = [])
	{
		if(empty($url_list)){
			$url_list=$this->authMenuUrlList ;
		}

		$rtn_action_url=[];
		foreach ($action_url as $row){
			if($row){
				$url=$this->logicAdminBase->getCheckUrl($row['url']);
				$result = $this->logicAdminBase->authCheck($url, $url_list);
				if($result[0] == RESULT_SUCCESS ){
					$rtn_action_url[]=$row;
				}
			}
		}
		return $rtn_action_url;
	}

	/**
	 * 数据排序设置
	 */
	public function setSort($model = null, $param = null)
	{

		$model_str = LAYER_MODEL_NAME . $model;

		$obj = $this->$model_str;

		$result = $obj->setFieldValue(['id' => (int)$param['id']], 'sort', (int)$param['value']);

		$result && action_log('数据排序', '数据排序调整' . '，model：' . $model . '，id：' . $param['id'] . '，value：' . $param['value']);

		return $result ? [RESULT_SUCCESS, '操作成功'] : [RESULT_ERROR, $obj->getError()];
	}

	/**
	 * 字段数据设置
	 */
	public function setField($model = null, $param = null)
	{
		$model_str = LAYER_MODEL_NAME . $model;

		$obj = $this->$model_str;

		$result = $obj->setFieldValue(['id' => (int)$param['id']], $param['name'], (int)$param['value']);

		$result && action_log('数据更新', '数据更新调整' . '，model：' . $model . '，id：' . $param['id'] . '，name：' . $param['name']. '，value：' . $param['value']);

		return $result ? [RESULT_SUCCESS, '操作成功'] : [RESULT_ERROR, $obj->getError()];
	}
}
?>