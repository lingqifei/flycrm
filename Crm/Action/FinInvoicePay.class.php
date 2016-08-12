<?php	 
class FinInvoicePay extends Action{	
	private $cacheDir='';//缓存目录
	public function __construct() {
		_instance('Action/Auth');
	}	
	
	public function fin_invoice_pay(){
		$currentPage = $this->_REQUEST("pageNum");//第几页
		$numPerPage  = $this->_REQUEST("numPerPage");//每页多少条
		$currentPage = empty($currentPage)?1:$currentPage;
		$numPerPage  = empty($numPerPage)?$GLOBALS["pageSize"]:$numPerPage;
		$countSql    = 'select id from fin_invoice_pay';
		$totalCount  = $this->C($this->cacheDir)->countRecords($countSql);	//计算记录数
	
		$moneySql    = 'select sum(money) as sum_money from fin_invoice_pay';
		$moneyRs	 = $this->C($this->cacheDir)->findOne($moneySql);
		
		$beginRecord = ($currentPage-1)*$numPerPage;
		$sql		 = "select * from fin_invoice_pay  order by id desc limit $beginRecord,$numPerPage";	
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

	public function fin_invoice_pay_add(){
		if(empty($_POST)){
			$smarty  = $this->setSmarty();
			//$smarty->assign();//框架变量注入同样适用于smarty的assign方法
			$smarty->display('fin_invoice_pay/fin_invoice_pay_add.html');	
		}else{
			$id			=$this->_REQUEST("id");;
			$salID		=$this->_REQUEST("order_id");
			$cusID		=$this->_REQUEST("cus_id");
			$stages		=$this->_REQUEST("stages");
			$paydate	=$this->_REQUEST("paydate");
			$paymoney	=$this->_REQUEST("pay_money");	
			$billmoney	=$this->_REQUEST("bill_money");
			$name		=$this->_REQUEST("name");
			$invo_number=$this->_REQUEST("invo_number");
			$invo_money	=$this->_REQUEST("invo_money");
			$intro		=$this->_REQUEST("intro");	
			
			$sql= "insert into fin_invoice_pay(cusID,salID,paydate,money,stages,invo_number,
												name,intro,adt,create_userID) 
								values('$cusID','$salID','$paydate','$invo_money','$stages','$invo_number',
										'$name','$intro','".NOWTIME."','".SYS_USER_ID."');";
			if($this->C($this->cacheDir)->update($sql)>0){
				$this->L("SalOrder")->sal_order_invo_modify($salID,$new_money=$invo_money);
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
}//
?>