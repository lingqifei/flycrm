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

namespace app\admin\logic;

use think\Db;

/**
 * 系统消息逻辑
 */
class SysMsg extends AdminBase
{

	/**
	 * 获取消息列表
	 */
	public function getSysMsgList($where = [], $field = '', $order = 'id desc', $paginate = DB_LIST_ROWS)
	{
		$list = $this->modelSysMsg->getList($where, $field, 'create_time desc', $paginate);
		foreach ($list as $key => &$row) {
			$row['bus_url'] = $this->getSysMsgBusUrl($row['bus_type'], $row['bus_id']);
			$row['deal_user_name'] = $this->modelSysUser->getValue($row['deal_user_id'], 'realname');
		}
		is_object($list) && $list = $list->toArray();
		return $list;
	}

	/**
	 * 消息添加
	 */
	public function sysMsgAddApi($bus_type = '', $bus_id = '', $bus_name = '', $deal_user_id = '', $deal_time = '')
	{
		$data['bus_type'] = $bus_type;
		$data['bus_id'] = $bus_id;
		$data['bus_name'] = $bus_name;
		$data['deal_user_id'] = $deal_user_id;
		$data['deal_time'] = $deal_time;
		$url = url('sysMsgList');
		$this->modelSysMsg->is_update_cache_version = false;
		return $this->modelSysMsg->setInfo($data) ? [RESULT_SUCCESS, '消息添加成功', $url] : [RESULT_ERROR, $this->modelSysMsg->getError()];
	}


	/**更新修改
	 * @param array $data
	 * @return array
	 * Author: 开发人生 goodkfrs@qq.com
	 * Date: 2021/9/8 0008 10:25
	 */
	public function sysMsgAdd($data = [])
	{
		$validate_result = $this->validateSysMsg->scene('add')->check($data);
		if (!$validate_result) {
			return [RESULT_ERROR, $this->validateSysMsg->getError()];
		}
		$data['deal_user_id'] = SYS_USER_ID;
		$result = $this->modelSysMsg->setInfo($data);
		$result && action_log('添加', 'name：' . $data['bus_name']);
		$url = url('show');
		return $result ? [RESULT_SUCCESS, '添加成功', $url] : [RESULT_ERROR, $this->modelSysMsg->getError()];
	}

	/**更新修改
	 * @param array $data
	 * @return array
	 * Author: 开发人生 goodkfrs@qq.com
	 * Date: 2021/9/8 0008 10:25
	 */
	public function sysMsgEdit($data = [])
	{
		$validate_result = $this->validateSysMsg->scene('edit')->check($data);
		if (!$validate_result) {
			return [RESULT_ERROR, $this->validateSysMsg->getError()];
		}
		$url = url('show');
		$result = $this->modelSysMsg->setInfo($data);
		$result && action_log('编辑', 'name：' . $data['bus_name']);
		return $result ? [RESULT_SUCCESS, '编辑成功', $url] : [RESULT_ERROR, $this->modelSysMsg->getError()];
	}

	/**
	 * 消息删除
	 */
	public function sysMsgDel($data = [])
	{
		if (!empty($data['id'])) {
			$where['id'] = ['in', $data['id']];
			$result = $this->modelSysMsg->deleteInfo($where, true);
			$result && action_log('删除', '删除提醒消息，where：' . http_build_query($where));
			return $result ? [RESULT_SUCCESS, '删除成功'] : [RESULT_ERROR, $this->modelSysMsg->getError()];
		} else {
			return [RESULT_ERROR, '参数不能为空'];
		}
	}

	/**
	 * 消息设置为处理
	 */
	public function sysMsgSetDeal($data = [])
	{
		if (!empty($data['id'])) {
			$where['id'] = ['in', $data['id']];
			$result = $this->modelSysMsg->updateInfo($where, ['deal_status'=>1]);
			return $result ? [RESULT_SUCCESS, '删除成功'] : [RESULT_ERROR, $this->modelSysMsg->getError()];
		} else {
			return [RESULT_ERROR, '参数不能为空'];
		}
	}

	/**
	 * 消息删除
	 */
	public function getSysMsgInfo($where = [])
	{
		return $this->modelSysMsg->getInfo($where, true);
	}

	/**
	 * 获取列表搜索条件
	 */
	public function getWhere($data = [])
	{
		$where = [];
		//关键字查
		!empty($data['keywords']) && $where['bus_name'] = ['like', '%' . $data['keywords'] . '%'];

		if (isset($data['deal_status'])) {
			if (!empty($data['deal_status']) || is_numeric($data['deal_status'])) {
				$where['deal_status'] = ['=', '' . $data['deal_status'] . ''];
			}
		}

		if (isset($data['deal_user_id'])) {
			if (!empty($data['deal_user_id']) || is_numeric($data['deal_user_id'])) {
				$where['deal_user_id'] = ['=', '' . $data['deal_user_id'] . ''];
			}
		}

		return $where;
	}

	/**
	 * 获取排序条件
	 */
	public function getOrderBy($data = [])
	{
		$order_by = "";
		//排序操作
		if (!empty($data['orderField'])) {
			$orderField = $data['orderField'];
			$orderDirection = $data['orderDirection'];
		} else {
			$orderField = "";
			$orderDirection = "";
		}
		if ($orderField == 'by_name') {
			$order_by = "a.name $orderDirection";
		} else if ($orderField == 'by_url') {
			$order_by = "a.url $orderDirection";
		} else {
			$order_by = "a.create_time asc";
		}
		return $order_by;
	}

	/**
	 * 回显 =>业务订单详细
	 * @param array $data
	 * @return array
	 * Author: kfrs <goodkfrs@QQ.com> created by at 2020/10/9 0009
	 */
	public function getSysMsgBusUrl($bus_type, $bus_id)
	{
		$url = '';

		if ($this->appExists('erp')) {
			$model_name = 'erp';
		} else {
			$model_name = 'crm';
		}

		if (!empty($bus_type)) {
			switch ($bus_type) {
				case "cst_customer":
					if ($this->tableExists('cst_customer')) {
						//$info = Db::name('cst_customer')->where(['id' => $bus_id])->find();
						$url = url($model_name . '/CstCustomer/detail', array('id' => $bus_id));
					}
					break;
				case "cst_chance":
					if ($this->tableExists('cst_chance')) {
						$info = Db::name('cst_chance')->field('customer_id,id')->where(['id' => $bus_id])->find();
						$url = url($model_name . '/CstTrace/add', array('customer_id' => $info['customer_id'], 'chance_id' => $info['id']));
					}
					break;
				case "cst_clue":
					if ($this->tableExists('cst_clue')) {
						//$info = Db::name('cst_clue')->where(['id' => $bus_id])->find();
						$url = url($model_name . '/CstClue/detail', array('id' => $bus_id));
					}
					break;

				case "sal_contract":
					if ($this->tableExists('sal_contract')) {
						//$info = Db::name('sal_contract')->where(['id' => $bus_id])->find();
						$url = url($model_name . '/SalContract/detail', array('id' => $bus_id));
					}
					break;
				case "sal_contract_expire":
					if ($this->tableExists('sal_contract')) {
						//$info = Db::name('sal_contract')->where(['id' => $bus_id])->find();
						$url = url($model_name . '/SalContract/detail', array('id' => $bus_id));
					}
					break;
				case "sal_order":
					$info = Db::name('sal_order')->where(['id' => $bus_id])->find();
					$rtn = [
						'type' => '销售订单',
						'name' => $info['name'],
						'id' => $info['id'],
						'url' => url('erp/SalOrder/detail', array('id' => $info['id'])),
					];
					break;
				default:
					break;
			}
		}
		return $url;
	}

	/**检查表是否存在
	 * @param $table
	 * @return bool
	 * Author: 开发人生 goodkfrs@qq.com
	 * Date: 2021/6/18 0018 17:00
	 */
	public function tableExists($table)
	{
		$table = SYS_DB_PREFIX . $table;
		$isTable = db()->query('SHOW TABLES LIKE ' . "'" . $table . "'");
		if ($isTable) {
			return true;//表存在
		} else {
			return false;//表不存在
		}
	}


	/**应用表是否存在
	 * @param $table
	 * @return bool
	 * Author: 开发人生 goodkfrs@qq.com
	 * Date: 2021/6/18 0018 17:00
	 */
	public function appExists($appname)
	{
		$app = APP_PATH . $appname;
		if (file_exists($app)) {
			return true;
		} else {
			return false;
		}

	}


}
