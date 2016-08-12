<?php	 
class FinFlowRecord extends Action{	
	private $cacheDir='';//缓存目录
	public function __construct() {
		_instance('Action/Auth');
	}	
	
	public function fin_flow_record(){
		$currentPage = $this->_REQUEST("pageNum");//第几页
		$numPerPage  = $this->_REQUEST("numPerPage");//每页多少条
		$currentPage = empty($currentPage)?1:$currentPage;
		$numPerPage  = empty($numPerPage)?$GLOBALS["pageSize"]:$numPerPage;
		$countSql    = 'select id from fin_flow_record';
		$totalCount  = $this->C($this->cacheDir)->countRecords($countSql);	//计算记录数
		$totalSql	 = 'select sum(paymoney) as payTotal,sum(recemoney) as receTotal from fin_flow_record';
		$totalRs	 = $this->C($this->cacheDir)->findOne($totalSql);
		$beginRecord = ($currentPage-1)*$numPerPage;
		$sql		 = "select * from fin_flow_record  order by id desc limit $beginRecord,$numPerPage";	
		$list		 = $this->C($this->cacheDir)->findAll($sql);
		$assignArray = array('list'=>$list,
							'totalMoney'=>$totalRs,
							"numPerPage"=>$numPerPage,"totalCount"=>$totalCount,"currentPage"=>$currentPage
						);	
		return $assignArray;
	}
	public function fin_flow_record_show(){
			$list	 = $this->fin_flow_record();
			$smarty  = $this->setSmarty();
			$smarty->assign($list);//框架变量注入同样适用于smarty的assign方法
			$smarty->display('fin_flow_record/fin_flow_record_show.html');	
	}		

	public function fin_flow_record_add(){
		if(empty($_POST)){
			$parentID	=$this->fin_flow_record_select_tree();
			$smarty     = $this->setSmarty();
			$smarty->assign(array("parentID"=>$parentID));//框架变量注入同样适用于smarty的assign方法
			$smarty->display('fin_flow_record/fin_flow_record_add.html');	
		}else{
			$sql= "insert into fin_flow_record(name,parentID,sort,visible,intro) 
								values('$_POST[name]','$_POST[parentID]','$_POST[sort]','$_POST[visible]','$_POST[intro]');";
			$this->C($this->cacheDir)->update($sql);	
			$this->L("Common")->ajax_json_success("操作成功","1","/FinIncomeType/fin_flow_record_show/");		
		}
	}		
	public function fin_flow_record_modify(){
		$id	 = $this->_REQUEST("id");
		if(empty($_POST)){
			$sql 		= "select * from fin_flow_record where id='$id'";
			$one 		= $this->C($this->cacheDir)->findOne($sql);	
			$parentID	= $this->fin_flow_record_select_tree($one["parentID"]);
			$smarty  	= $this->setSmarty();
			$smarty->assign(array("one"=>$one,"parentID"=>$parentID));
			$smarty->display('fin_flow_record/fin_flow_record_modify.html');	
		}else{
			$sql= "update fin_flow_record set name='$_POST[name]',
											 parentID='$_POST[parentID]',sort='$_POST[sort]',
											 visible='$_POST[visible]',intro='$_POST[intro]'
					where id='$id'";
			$this->C($this->cacheDir)->update($sql);	
			$this->L("Common")->ajax_json_success("操作成功","1","/FinIncomeType/fin_flow_record_show/");			
		}
	}	
	public function fin_flow_record_del(){
		$id=$this->_REQUEST("id");
		$sql="delete from fin_flow_record where id='$id'";
		$this->C($this->cacheDir)->update($sql);	
		$this->L("Common")->ajax_json_success("操作成功","1","/FinIncomeType/fin_flow_record_show/");	
	}	
	
		
}//
?>