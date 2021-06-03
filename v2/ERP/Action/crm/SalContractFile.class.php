<?php

/*
 *
 * crm.ContractFile  客户销售合同管理   
 *
 * =========================================================
 * 零起飞网络 - 专注于网站建设服务和行业系统开发
 * 以质量求生存，以服务谋发展，以信誉创品牌 !
 * ----------------------------------------------
 * @copyright	Copyright (C) 2017-2018 07FLY Network Technology Co,LTD (www.07FLY.com) All rights reserved.
 * @license    For licensing, see LICENSE.html or http://www.07fly.xyz/crm/license
 * @author ：kfrs <goodkfrs@QQ.com> 574249366
 * @version ：1.0
 * @link ：http://www.07fly.xyz 
 */

class SalContractFile extends Action
{
    private $cacheDir = '';//缓存目录

    public function __construct()
    {
        _instance('Action/sysmanage/Auth');
        $this->sys_user = _instance('Action/sysmanage/User');
        $this->dict = _instance('Action/crm/CstDict');
        $this->customer = _instance('Action/crm/CstCustomer');
        $this->linkman = _instance('Action/crm/CstLinkman');
        $this->comm = _instance('Extend/Common');
    }

    public function sal_contract_file()
    {
        //**获得传送来的数据作分页处理
        $pageNum = $this->_REQUEST("pageNum");//第几页
        $pageSize = $this->_REQUEST("pageSize");//每页多少条
        $pageNum = empty($pageNum) ? 1 : $pageNum;
        $pageSize = empty($pageSize) ? $GLOBALS["pageSize"] : $pageSize;

        //**************************************************************************
        //**获得传送来的数据做条件来查询
        $title = $this->_REQUEST("title");
        $contract_id = $this->_REQUEST("contract_id");

        $where_str = "f.contract_id='$contract_id'";

        //排序操作
        $orderField = $this->_REQUEST("orderField");
        $orderDirection = $this->_REQUEST("orderDirection");
        $order_by = "order by";
        if ($orderField == 'by_customer') {
            $order_by .= " s.customer_id $orderDirection";
        } else if ($orderField == 'by_startdate') {
            $order_by .= " s.start_date $orderDirection";
        } else {
            $order_by .= " f.contract_id desc";
        }
        //**************************************************************************

        $countSql = "select f.* from sal_contract_file as f where $where_str";
        $totalCount = $this->C($this->cacheDir)->countRecords($countSql);

        $beginRecord = ($pageNum - 1) * $pageSize;//计算开始行数

        $sql = "select f.* from sal_contract_file as f where  $where_str $order_by limit $beginRecord,$pageSize";
        $list = $this->C($this->cacheDir)->findAll($sql);

        foreach ($list as $key => $row) {

        }
        $assignArray = array('list' => $list, "pageSize" => $pageSize, "totalCount" => $totalCount, "pageNum" => $pageNum);
        return $assignArray;
    }

    public function sal_contract_file_json()
    {
        $assArr = $this->sal_contract_file();
        echo json_encode($assArr);
    }

    //合同显示
    public function sal_contract_file_show()
    {
        $smarty = $this->setSmarty();
        //$smarty->assign($assArr);
        $smarty->display('crm/sal_contract_show.html');
    }


    public function sal_contract_file_add()
    {
        $contract_id = $this->_REQUEST("contract_id");
        if (empty($_POST)) {
            $customer = $this->customer->cst_customer_list();
            $sys_user = $this->sys_user->user_list();
            $number = date("ymdH") . rand(10, 99);
            $smarty = $this->setSmarty();
            $smarty->assign(array("number" => $number, "contract_id" => $contract_id, "customer" => $customer, "sys_user" => $sys_user));
            $smarty->display('crm/sal_contract_file_add.html');
        } else {
			$contract_id=$this->_REQUEST("contract_id");
			$name=$this->_REQUEST("name");
			$imglistname=$this->_REQUEST("imglistname");
			if(!empty($imglistname)){
				foreach($imglistname as $row){
					$sql = "insert into sal_contract_file(contract_id,name,filepath) values('$contract_id','$name','$row')";
					$this->C($this->cacheDir)->update($sql);
				}
			}
			$this->L("Common")->ajax_json_success("操作成功");
        }
    }

    //删除
    public function sal_contract_file_del()
    {
        $id = $this->_REQUEST("id");
		$this->C($this->cacheDir)->delete('sal_contract_file', "id in ($id)");
		$this->L("Common")->ajax_json_success("操作成功");
    }
}

?>