<?php	 
//回款记录
class FinReceRecord extends Action{	
	private $cacheDir='';//缓存目录
	public function __construct() {
		_instance('Action/Auth');
	}	
	public function fin_rece_record(){
		$currentPage = $this->_REQUEST("pageNum");//第几页
		$numPerPage  = $this->_REQUEST("numPerPage");//每页多少条
		$currentPage = empty($currentPage)?1:$currentPage;
		$numPerPage  = empty($numPerPage)?$GLOBALS["pageSize"]:$numPerPage;
		$countSql    = 'select id from fin_rece_record';
		$totalCount  = $this->C($this->cacheDir)->countRecords($countSql);	//计算记录数
		
		$moneySql    = 'select sum(money) as sum_money from fin_rece_record';
		$moneyRs	 = $this->C($this->cacheDir)->findOne($moneySql);
		$beginRecord = ($currentPage-1)*$numPerPage;
		$sql		 = "select * from fin_rece_record  order by id desc limit $beginRecord,$numPerPage";	
		$list		 = $this->C($this->cacheDir)->findAll($sql);
		//供应商
		$customer= array();
		$salorder= array();
		if(is_array($list)){
			foreach($list as $key=>$row){
				$list[$key]["create_user"]	  = $this->L("User")->user_get_name($row['create_userID']);
				$list[$key]["blankaccount"]	  = $this->L("FinBankAccount")->fin_bank_accoun_get_name($row['blankID']);
				$customer[$row['id']] = $this->L("Customer")->customer_get_name($row['salID']);
				$salorder[$row['id']] = $this->L("SalOrder")->sal_order_get_name($row['cusID']);
			}
		}
		$assignArray = array('list'=>$list,'total_money'=>$moneyRs["sum_money"],
								'customer'=>$customer,'salorder'=>$salorder,'customer'=>$customer,'customer'=>$customer,
							"numPerPage"=>$numPerPage,"totalCount"=>$totalCount,"currentPage"=>$currentPage);	
		return $assignArray;
	}
	public function fin_rece_record_show(){
			$list	 = $this->fin_rece_record();
			$smarty  = $this->setSmarty();
			$smarty->assign($list);//框架变量注入同样适用于smarty的assign方法
			$smarty->display('fin_rece_record/fin_rece_record_show.html');	
	}		
	
	public function fin_rece_record_add(){
		if(empty($_POST)){
			$smarty  = $this->setSmarty();
			//$smarty->assign();//框架变量注入同样适用于smarty的assign方法
			$smarty->display('fin_rece_record/fin_rece_record_add.html');	
		}else{
			$id			=$this->_REQUEST("id");;
			$cusID		=$this->_REQUEST("order_id");
			$salID		=$this->_REQUEST("cus_id");
			$blankID	=$this->_REQUEST("blank_id");
			$stages		=$this->_REQUEST("stages");
			$paydate	=$this->_REQUEST("paydate");
			$paymoney	=$this->_REQUEST("pay_money");	
			$intro		=$this->_REQUEST("intro");	
			
			$sql= "insert into fin_rece_record(cusID,salID,paydate,money,stages,blankID,
												intro,adt,create_userID) 
								values('$cusID','$salID','$paydate','$paymoney','$stages','$blankID',
									'$intro','".NOWTIME."','".SYS_USER_ID."');";
			if($this->C($this->cacheDir)->update($sql)>0){
				$this->L("SalOrder")->sal_order_pay_modify($cusID,$new_money=$paymoney);
				$this->L("FinFlowRecord")->fin_flow_record_add('rece',$paymoney,$blankID,$salID);//添加流水
				$this->L("Common")->ajax_json_success("操作成功","0","/FinReceRecord/fin_rece_record_show/");	
			}
		}
	}		
	public function fin_rece_record_del(){
		$id=$this->_REQUEST("ids");
		$sql="delete from fin_rece_record where id in ($id)";
		$this->C($this->cacheDir)->update($sql);	
		$this->L("Common")->ajax_json_success("操作成功","1","/FinReceRecord/fin_rece_record_show/");	
	}
	
	//回款记录添加回款计划 to 回款记录
	public function fin_rece_plan_record_add($planID,$cusID,$salID,$blankID,$paydate,$money,$stages,$intro){
		$sql= "insert into fin_rece_record(
					planID,cusID,salID,blankID,paydate,money,stages,intro,adt,create_userID) 
				values(
					'$planID','$cusID','$salID','$blankID','$paydate','$money','$stages','$intro','".NOWTIME."','".SYS_USER_ID."');";
		if($this->C($this->cacheDir)->update($sql)>0){
			$this->L("SalOrder")->sal_order_pay_modify($cusID,$new_money=$money);
			$this->L("FinFlowRecord")->fin_flow_record_add('rece',$money,$blankID,$salID);//添加流水
			return true;
		}else{
			return false;	
		}	
	}
		
}//
?>