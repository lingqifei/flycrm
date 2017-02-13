<?php	 
class FinInvoicePay extends Action{	
	private $cacheDir='';//缓存目录
	public function __construct() {
		_instance('Action/Auth');
	}	
	
	public function fin_invoice_pay($id=null){
		$currentPage = $this->_REQUEST("pageNum");//第几页
		$numPerPage  = $this->_REQUEST("numPerPage");//每页多少条
		$currentPage = empty($currentPage)?1:$currentPage;
		$numPerPage  = empty($numPerPage)?$GLOBALS["pageSize"]:$numPerPage;
		
		$where_str	 = " 0=0 ";
		if($id){
		$where_str  .= " and id in($id)";
		}
		
		$countSql    = "select id from fin_invoice_pay where $where_str";
		$totalCount  = $this->C($this->cacheDir)->countRecords($countSql);	//计算记录数
	
		$moneySql    = "select sum(money) as sum_money from fin_invoice_pay where $where_str";
		$moneyRs	 = $this->C($this->cacheDir)->findOne($moneySql);
		
		$beginRecord = ($currentPage-1)*$numPerPage;
		$sql		 = "select * from fin_invoice_pay where $where_str order by id desc limit $beginRecord,$numPerPage";	
		$list		 = $this->C($this->cacheDir)->findAll($sql);
		//供应商
		$customer= array();
		$salorder= array();
		if(is_array($list)){
			foreach($list as $key=>$row){
				$list[$key]["create_user"]	  = $this->L("User")->user_get_name($row['create_userID']);
				$customer[$row['id']] = $this->L("Customer")->customer_get_name($row['cusID']);
				$salorder[$row['id']] = $this->L("SalOrder")->sal_order_get_name($row['salID']);
			}
		}
		$assignArray = array('list'=>$list,'total_money'=>$moneyRs["sum_money"],
								'customer'=>$customer,'salorder'=>$salorder,'customer'=>$customer,'customer'=>$customer,
								"numPerPage"=>$numPerPage,"totalCount"=>$totalCount,"currentPage"=>$currentPage);	
		return $assignArray;
	}
	public function fin_invoice_pay_show(){
			$list	 = $this->fin_invoice_pay();
			$smarty  = $this->setSmarty();
			$smarty->assign($list);//框架变量注入同样适用于smarty的assign方法
			$smarty->display('fin_invoice_pay/fin_invoice_pay_show.html');	
	}		
	//主要用于BOX局部调用
	public function fin_invoice_pay_show_box(){
			
			$busID	=$this->_REQUEST("busID");
			$busType=$this->_REQUEST("busType");
			if($busType=="sal_order"){
				$where_str=" and type='sal_order';";
			}elseif($busType=="sal_contract"){
				$where_str=" and type='sal_contract';";
			}
			$sql	="select invID from fin_invoice_pay_list where busID='$busID' $where_str";
			$id_list=$this->C($this->cacheDir)->findAll($sql);	
			$id_str =array("1.1");
			foreach($id_list as $row){
				$id_str[]=$row["invID"];
			}
			$id_str = implode(",",$id_str);
			
			$list	= $this->fin_invoice_pay($id_str);
			$list["busID"] 	 = $busID;
			$list["busType"] = $busType;			
			$smarty = $this->setSmarty();
			$smarty->assign($list);
			$smarty->display('fin_invoice_pay/fin_invoice_pay_show_box.html');	
	}
	
	public function fin_invoice_pay_add(){
		if(empty($_POST)){
			$smarty  = $this->setSmarty();
			//$smarty->assign();//框架变量注入同样适用于smarty的assign方法
			$smarty->display('fin_invoice_pay/fin_invoice_pay_add.html');	
		}else{
			$id			=$this->_REQUEST("id");;
			$cusID		=$this->_REQUEST("cus_id");
			$stages		=$this->_REQUEST("stages");
			$paydate	=$this->_REQUEST("paydate");
			$paymoney	=$this->_REQUEST("pay_money");	
			$billmoney	=$this->_REQUEST("bill_money");
			$name		=$this->_REQUEST("name");
			$sal_type	=$this->_REQUEST("order_type");
			$salID		=$this->_REQUEST("order_id");
			$invo_number=$this->_REQUEST("invo_number");
			$invo_money	=$this->_REQUEST("order_now_bill_money");
			$intro		=$this->_REQUEST("intro");	
			
			$sql= "insert into fin_invoice_pay(cusID,salID,paydate,money,stages,invo_number,
												name,intro,adt,create_userID) 
								values('$cusID','$salID','$paydate','$invo_money','$stages','$invo_number',
										'$name','$intro','".NOWTIME."','".SYS_USER_ID."');";
			$invoID=$this->C($this->cacheDir)->update($sql);
			if($invoID>0){
				$this->fin_invoice_pay_list_add($sal_type,$invoID,$salID,$cusID);
				if($sal_type=="sal_order"){
					$this->L("SalOrder")->sal_order_invo_modify($salID,$paymoney);//更改订单发票
				}elseif($sal_type=="sal_contract"){
					$this->L("SalContract")->sal_contract_invo_modify($salID,$paymoney);//更改合同发票金额
				}
				$this->L("Common")->ajax_json_success("操作成功","0","/FinPayRecord/fin_invoice_pay_show/");	
			}
		}
	}	


	
	public function fin_invoice_pay_modify(){
		$id	 = $this->_REQUEST("id");
		if(empty($_POST)){
			$sql 		= "select * from fin_invoice_pay where id='$id'";
			$one 		= $this->C($this->cacheDir)->findOne($sql);	
			$parentID	= $this->fin_invoice_pay_select_tree($one["parentID"]);
			$smarty  	= $this->setSmarty();
			$smarty->assign(array("one"=>$one,"parentID"=>$parentID));//框架变量注入同样适用于smarty的assign方法
			$smarty->display('fin_invoice_pay/fin_invoice_pay_modify.html');	
		}else{
			$sql= "update fin_invoice_pay set name='$_POST[name]',
											 parentID='$_POST[parentID]',sort='$_POST[sort]',
											 visible='$_POST[visible]',intro='$_POST[intro]'
					where id='$id'";
			$this->C($this->cacheDir)->update($sql);	
			$this->L("Common")->ajax_json_success("操作成功","1","/FinInvoicePay/fin_invoice_pay_show/");			
		}
	}	
	public function fin_invoice_pay_del(){
		$id=$this->_REQUEST("id");
		$sql="delete from fin_invoice_pay where id='$id'";
		$this->C($this->cacheDir)->update($sql);	
		$this->L("Common")->ajax_json_success("操作成功","1","/FinInvoicePay/fin_invoice_pay_show/");	
	}	
	
	public function fin_invoice_pay_arr(){
		$rtArr  =array();
		$sql	="select id,name from fin_invoice_pay";
		$list	=$this->C($this->cacheDir)->findAll($sql);
		if(is_array($list)){
			foreach($list as $key=>$row){
				$rtArr[$row["id"]]=$row["name"];
			}
		}
		return $rtArr;
	}	

	//关联业务选择
	public function fin_invoice_get_customer_business(){
		$order	=$this->L("SalOrder")->sal_order_select('bill_status');
		$contr	=$this->L("SalContract")->sal_contract_select('bill_status');
/*		print_r($order);
		print_r($contr);*/
/*            [id] => 4
            [name] => 100
            [money] => 1000
            [bill_money] => 0
            [zero_money] => 0
            [back_money] => 0
            [now_back_money] => 1000*/
		$rtnArr	=array();
		$key	=0;
		foreach($order as $row){
			$rtnArr[$key]			=$row;
			$rtnArr[$key]["type"]	="sal_order";
			$key++;
		}
		foreach($contr as $row){
			$rtnArr[$key]=$row;
			$rtnArr[$key]["type"]	="sal_contract";
			$key++;
		}
		//print_r($rtnArr);
		echo json_encode($rtnArr);
		
	}
	
	//财务关联客户业务，订单和合同
	public function fin_invoice_pay_list_add($type,$invID,$busID,$cusID){
		$sql="insert into fin_invoice_pay_list(type,invID,busID,cusID) 
											values('$type','$invID','$busID','$cusID');";	
		
		if($this->C($this->cacheDir)->update($sql)>0){
			return true;
		}else{
			return false;	
		}									
	}
	//根据财务ID显示关联的订单、合同号
	public function fin_invoice_pay_list_view($invID){		
		$sql="select * from fin_invoice_pay_list where invID='$invID'";
		$one=$this->C($this->cacheDir)->findOne($sql);
		switch($one["type"])
		{
			case "sal_order":
				$name=$this->L("SalOrder")->sal_order_get_name($one["busID"]);
				$rtn ="<a target='navTab' rel='sal_order_view' href='".ACT."/SalOrder/sal_order_view/id/".$one["busID"]."/'>".$name."</a>";
				 break;
			case "sal_contract":
				$name=$this->L("SalContract")->sal_contract_get_name($one["busID"]);
				$rtn ="<a target='navTab' rel='sal_contract_view' href='".ACT."/SalContract/sal_contract_view/id/".$one["busID"]."/'>".$name."</a>";
				 break;
			default:
				$rtn ="";
		}		
		return $rtn;								
	}	
			
}//
?>