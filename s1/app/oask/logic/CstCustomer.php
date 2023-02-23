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

use app\common\logic\TableField;

/**
 * 客户列表管理=》逻辑层
 */
class CstCustomer extends OaskBase
{

	private $files_path = '';

	public function __construct()
	{
		$this->files_path = PATH_UPLOAD . 'files/';
		!is_dir($this->files_path) && mkdir($this->files_path, 0755, true);
	}

	/**
	 * 客户列表列表
	 * @param array $where
	 * @param bool $field
	 * @param string $order
	 * @param int|mixed $paginate
	 * @return
	 */
	public function getCstCustomerList($where = [], $field = true, $order = 'update_time desc', $paginate = DB_LIST_ROWS)
	{
		$list = $this->modelCstCustomer->getList($where, $field, $order, $paginate);

		foreach ($list as &$row) {
			//$row['status_text']=$this->logicCstDict->getCstDictOneName($row['status']);
			$row['create_user_name']=$this->logicSysUser->getRealname($row['create_user_id']);
		}
		return $list;
	}

	/**
	 * 客户列表列表
	 * @param array $where
	 * @param bool $field
	 * @param string $order
	 * @param int|mixed $paginate
	 * @return
	 */
	public function getCstCustomerSelect($map=[])
	{
		$where = $this->getWhere($map);
		$list = $this->modelCstCustomer->getList($where, 'name,id', 'update_time desc', false)->toArray();
		return $list;
	}

	/**
	 * 客户列表添加
	 * @param array $data
	 * @return array
	 */
	public function cstCustomerAdd($data = [])
	{

		$validate_result = $this->validateCstCustomer->scene('add')->check($data);
		if (!$validate_result) {
			return [RESULT_ERROR, $this->validateCstCustomer->getError()];
		}
		$adddata = $data;
		$adddata['create_user_id'] = SYS_USER_ID;
		$adddata['link_time'] = (!empty($data['link_time'])) ? $data['link_time'] : format_time();
		$adddata['link_body'] = (!empty($data['link_body'])) ? $data['link_body'] : '';
		$adddata['next_time'] = (!empty($data['next_time'])) ? $data['next_time'] : format_time();
		//$adddata['openstatus'] = (!empty($data['owner_user_id'])) ? '1' : '0';

		if(!empty($data['share_user_id'])){
			$adddata['share_user_id']=arr2str($data['share_user_id']);
		}

		$result = $this->modelCstCustomer->setInfo($adddata);

//		//是否有共享人员
//		if($customer_id && !empty($data['share_user_id'])){
//			$this->logicCstCustomerShare->cstCustomerSharefAdd($customer_id,$data['share_user_id']);
//		}

		//增加到联系人
//		$linkmandata = [
//			'customer_id' => $customer_id,
//			'name' => $data['linkman'],
//			'mobile' => $data['mobile'],
//			'is_default' => '1',//默认为首要联系人
//			'create_user_id' => SYS_USER_ID,
//		];
//		$result = $this->modelCstLinkman->setInfo($linkmandata);

		$url = url('show');
		$result && action_log('新增', '新增客户列表：' . $data['name']);
		return $result ? [RESULT_SUCCESS, '添加成功', $url] : [RESULT_ERROR, $this->modelCstCustomer->getError()];
	}

	/**
	 * 客户列表编辑
	 * @param array $data
	 * @return array
	 */
	public function cstCustomerEdit($data = [])
	{

		$validate_result = $this->validateCstCustomer->scene('edit')->check($data);
		if (!$validate_result) {
			return [RESULT_ERROR, $this->validateCstCustomer->getError()];
		}
		//数组转为字符
		if(!empty($data['share_user_id'])){
			$data['share_user_id']=arr2str($data['share_user_id']);
		}else{
			$data['share_user_id']='';
		}
		$result = $this->modelCstCustomer->setInfo($data);

		//是否有共享人员
		//$result && $this->logicCstCustomerShare->cstCustomerSharefAdd($data['id'],$data['share_user_id']);

		//同步首要联系人
//		$syncData=[
//			'customer_id'=>$data['id'],
//			'name'=>$data['linkman'],
//			'mobile'=>$data['mobile'],
//		];
//		$result && $this->logicCstLinkman->cstLinkmanSync($syncData);



		$result && action_log('编辑', '编辑客户列表，name：' . $data['name']);
		$url = url('show');
		return $result ? [RESULT_SUCCESS, '编辑成功', $url] : [RESULT_ERROR, $this->modelCstCustomer->getError()];
	}

	/**
	 * 客户列表删除
	 * @param array $where
	 * @return array
	 */
	public function cstCustomerDel($data = [])
	{

		if (!empty($data['id'])) {
			$where['id'] = ['=', $data['id']];
			$map['customer_id'] = ['=', $data['id']];
		} else {
			$where['id'] = ['=', 0];
			$map['customer_id'] = ['=', 0];
		}

		//$result = $this->modelCstLinkman->deleteInfo($map, true);
		$result = $this->modelCstTrace->deleteInfo($map, true);
		//$result = $this->modelCstChance->deleteInfo($map, true);
		$result = $this->modelCstCustomer->deleteInfo($where, true);

		$result && action_log('删除', '删除客户列表，where：' . http_build_query($where));
		return $result ? [RESULT_SUCCESS, '删除成功'] : [RESULT_ERROR, $this->modelCstCustomer->getError()];
	}

	/**
	 * 客户列表添加=>对外接口调用
	 * @param array $data
	 * @return array
	 */
	public function cstCustomerAddInterface($data = [])
	{

		$validate_result = $this->validateCstCustomer->scene('add')->check($data);
		if (!$validate_result) {
			return [RESULT_ERROR, $this->validateCstCustomer->getError()];
		}
		$adddata = $data;
		$adddata['create_user_id'] = SYS_USER_ID;
		$adddata['link_time'] = (!empty($data['link_time'])) ? $data['link_time'] : format_time();
		$adddata['link_body'] = (!empty($data['link_body'])) ? $data['link_body'] : '';
		$adddata['next_time'] = (!empty($data['next_time'])) ? $data['next_time'] : format_time();
		$adddata['openstatus'] = (!empty($data['owner_user_id'])) ? '1' : '0';

		$customer_id = $this->modelCstCustomer->setInfo($adddata);

		//增加到联系人
		$linkmandata = [
			'customer_id' => $customer_id,
			'name' => $data['linkman'],
			'mobile' => $data['mobile'],
			'create_user_id' => SYS_USER_ID,
		];
		$linkmain_id = $this->modelCstLinkman->setInfo($linkmandata);

		$customer_id && action_log('增加', '接口新增加客户，名称：' . $data['name']);

		if ($customer_id) {
			return ['customer_id' => $customer_id, 'linkman_id' => $linkmain_id];
		} else {
			return [];
		}
	}


	/**
	 * 客户投入公海
	 * @param array $where
	 * @return array
	 */
	public function cstCustomerToPublicl($data = [])
	{
		$where['id'] = ['in', $data['id']];
		$data = [
			'owner_user_id' => '0',
			'openstatus' => '0',
		];
		$result = $this->modelCstCustomer->setInfo($data, $where);
		$result && action_log('客户转公海', '客户转公海，where：' . http_build_query($where));

		return $result ? [RESULT_SUCCESS, '操作成功'] : [RESULT_ERROR, $this->modelCstCustomer->getError()];
	}

	/**
	 * 客户领取
	 * @param array $where
	 * @return array
	 */
	public function cstCustomerToPersonal($data = [])
	{

		$where['id'] = ['in', $data['id']];
		$data = [
			'owner_user_id' => SYS_USER_ID,
			'openstatus' => '1',
		];

		$result = $this->modelCstCustomer->setInfo($data, $where);

		$result && action_log('领取客户', '领取客户，where：' . http_build_query($where));

		return $result ? [RESULT_SUCCESS, '操作成功'] : [RESULT_ERROR, $this->modelCstCustomer->getError()];
	}

	/**
	 * 客户转为垃圾
	 * @param array $where
	 * @return array
	 */
	public function cstCustomerToRubbish($data = [])
	{

		$where['id'] = ['in', $data['id']];
		$data = [
			'openstatus' => '-1',
		];

		$result = $this->modelCstCustomer->setInfo($data, $where);

		$result && action_log('领取客户', '领取客户，where：' . http_build_query($where));

		return $result ? [RESULT_SUCCESS, '操作成功'] : [RESULT_ERROR, $this->modelCstCustomer->getError()];
	}

	/**客户列表信息
	 * @param array $where
	 * @param bool $field
	 * @return
	 */
	public function getCstCustomerInfo($where = [], $field = true)
	{
		$info = $this->modelCstCustomer->getInfo($where, $field);
		$info['owner_user_name'] = $this->logicSysUser->getValue(['id' => $info['owner_user_id']], 'realname');
		return $info;
	}


	/**销售合同列表信息
	 * @param array $where
	 * @param bool $field
	 * @return
	 */
	public function getCstCustomerDetail($data = [])
	{
		$rtnArray = [];
		$map = ['customer_id' => $data['id']];
		if ($data['type'] == 'trace') {
			$list = $this->logicCstTrace->getCstTraceList($map, 'a.*,c.name as customer_name', '', false);
		}else if ($data['type'] == 'sales') {
			$list = $this->logicCstSales->getCstSalesList($map, "a.*,c.name as customer_name", 'a.update_time desc', false);
			$listtype['total_money'] = array_sum(array_column($list['data'], 'money'));
		} else if ($data['type'] == 'contract') {
			$list = $this->logicCstContract->getCstContractList($map, 'a.*,c.name as customer_name', '', false);
			$listtype['total_money']=array_sum(array_column($list,'money'));
		} else if ($data['type'] == 'invoice') {
			$list = $this->serviceFinInvoicePay->getFinInvoicePayList($map, true, 'id desc', false);
			$listtype['total_money'] = array_sum(array_column($list['data'], 'money'));
		}
		$rtnArray['data'] = $list['data'];
		$rtnArray['type'] = $data['type'];
		return $rtnArray;
	}


	/**
	 * 获取列表搜索条件
	 */
	public function getWhere($data = [])
	{

		$where = [];
		//关键字查
		!empty($data['keywords']) && $where['name|linkman|link_body|mobile'] = ['like', '%' . $data['keywords'] . '%'];

		!empty($data['customerstatus']) && $where['customerstatus'] = ['like', '%' . $data['customerstatus'] . '%'];

		!empty($data['level']) && $where['level'] = ['like', '%' . $data['level'] . '%'];

		//下次联系时间
		if (!empty($data['next_rangedate'])) {
			$range_date = str2arr($data['next_rangedate'], "-");
			$where['next_time'] = ['between', $range_date];
		}
		//联系时间
		if (!empty($data['link_rangedate'])) {
			$range_date = str2arr($data['link_rangedate'], "-");
			$where['link_time'] = ['between', $range_date];
		}

		//查看公开程度
		if (isset($data['openstatus'])) {
			if (!empty($data['openstatus']) || is_numeric($data['openstatus'])) {
				$where['openstatus'] = ['=', $data['openstatus']];
			}
		}

		//查看下属数据
		if (!empty($data['listtype'])) {
			if ($data['listtype'] == 'selfson') {
				$ids = $this->logicSysUser->getSysUserViewId(SYS_USER_ID);
				$where['owner_user_id'] = ['in', $ids];

			} else if ($data['listtype'] == 'self') {
				$ids = SYS_USER_ID;
				$where['owner_user_id'] = ['in', $ids];

			} else if ($data['listtype'] == 'son') {
				$ids = $this->logicSysUser->getSysUserViewId(SYS_USER_ID, 'son');
				$where['owner_user_id'] = ['in', $ids];

			}else if ($data['listtype'] == 'share') {
				$map['sys_user_id']=['=',SYS_USER_ID];
				$ids = $this->logicCstCustomerShare->getCstCustomerShareColumn($map, 'customer_id');
				$where['id'] = ['in', $ids];
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
		if (!empty($data['orderField'])) {
			$orderField = $data['orderField'];
			$orderDirection = $data['orderDirection'];
		} else {
			$orderField = "";
			$orderDirection = "";
		}
		if ($orderField == 'by_link') {
			$order_by = "link_time $orderDirection";
		} else if ($orderField == 'by_next') {
			$order_by = "next_time $orderDirection";
		} else if ($orderField == 'by_nodays') {
			$order_by = "nodays $orderDirection";
		} else {
			$order_by = "id desc";
		}
		return $order_by;
	}

	/**
	 * 客户列表列表下载
	 * @param array $where
	 * @param bool $field
	 * @param string $order
	 * @param int|mixed $paginate
	 * @return
	 */
	public function getCstCustomerListDown($where = [], $field = true, $order = 'id desc', $paginate = DB_LIST_ROWS)
	{
		$list = $this->modelCstCustomer->getList($where, $field, $order, false)->toArray();

		foreach ($list as &$row) {
			$row['create_user_name'] = $this->modelSysUser->getValue(['id' => $row['create_user_id']], 'realname');
			$row['owner_user_name'] = $this->modelSysUser->getValue(['id' => $row['owner_user_id']], 'realname');
		}

		$titles = "客户名称,联系人,手机,电话,QQ,微信,地址,备注,来源,客户等级,客户行业,客户状态,客户类型,创建时间,更新时间,最近沟通时间,沟通内容,归属人,创建人";
		$keys = "name,linkman,mobile,tel,qicq,weixin,address,remark,source,level,industry,customerstatus,openstatus,create_time,update_time,link_time,link_body,create_user_name,owner_user_name";

		action_log('下载', '客户列表列表');
		export_excel($titles, $keys, $list, '客户列表');
	}

	/**
	 * 客户列数据导入
	 * @param array $data
	 * Author: lingqifei created by at 2020/6/4 0004
	 */
	public function getCstCustomerUpload($data = [])
	{
		//导入的源文件
		if (empty($data['pathname'])) {
			return [RESULT_ERROR, '选择需要导入的文件'];
		} else {
			if (!file_exists($data['pathname'])) {
				return [RESULT_ERROR, '选择导入的文件不存在'];
			}
		}

		//判断上私人或者公海
		if (empty($data['openstatus'])) {
			$opendata = [
				'openstatus' => 0,
				'owner_user_id' => 0,
			];
		} else {
			$opendata = [
				'openstatus' => 1,
				'owner_user_id' => SYS_USER_ID,
			];
		}

		$path_name = $data['pathname'];
		$data = get_excel_data($file_url = $path_name, $start_row = 2, $start_col = 0);

		$into_data = [];
		$result = true;
		if (!empty($data)) {
			foreach ($data as $row) {
				//if (in_array($row[0], $allcustomer)) continue;//存在用户跳出
				$into_data = [
					'name' => $row[0],
					'linkman' => $row[1],
					'mobile' => $row[2],
					'tel' => $row[3],
					'qicq' => $row[4],
					'weixin' => $row[5],
					'address' => $row[6],
					'remark' => $row[7],
					'source' => $row[8],
					'level' => $row[9],
					'industry' => $row[10],
					'customerstatus' => $row[11],
					'create_user_id' => SYS_USER_ID
				];
				$into_data = array_merge($into_data, $opendata);
				$customer_id = $this->modelCstCustomer->setInfo($into_data);

				//增加到联系人
				$linkmandata = [
					'customer_id' => $customer_id,
					'name' => $row[1],
					'mobile' => $row[2],
					'create_user_id' => SYS_USER_ID,
				];
				$result = $this->modelCstLinkman->setInfo($linkmandata);
			}
		}
		$result && action_log('导入客户', '导入客户资料');
		return $result ? [RESULT_SUCCESS, '操作成功'] : [RESULT_ERROR, $this->modelCstCustomer->getError()];
	}

}
