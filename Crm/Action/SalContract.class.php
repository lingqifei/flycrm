<?php	 
class SalContract extends Action{	
	private $cacheDir='';//缓存目录
	public function __construct() {
		_instance('Action/Auth');
		//$this->SalContractDetail  = _instance('Action/SalContractDetail');
	}	
	
	public function sal_contract(){
	
		//**获得传送来的数据作分页处理
		$currentPage = $this->_REQUEST("pageNum");//第几页
		$numPerPage  = $this->_REQUEST("numPerPage");//每页多少条
		$currentPage = empty($currentPage)?1:$currentPage;
		$numPerPage  = empty($numPerPage)?$GLOBALS["pageSize"]:$numPerPage;
		
		//**************************************************************************
		//**获得传送来的数据做条件来查询
		$cus_name	   	   = $this->_REQUEST("cus_name");
		$searchKeyword	   = $this->_REQUEST("searchKeyword");
		$searchValue	   = $this->_REQUEST("searchValue");
		$where_str = " c.id=s.cusID and s.create_userID in ('".SYS_USER_VIEW."')";

		if( !empty($searchValue) ){
			$where_str .=" and $searchKeyword like '%$searchValue%'";
		}	
		if( !empty($bdt) ){
			$where_str .=" and adt >= '$bdt'";
		}			
		if( !empty($edt) ){
			$where_str .=" and adt < '$edt'";
		}	
		//**************************************************************************
		$countSql    = "select s.id from sal_contract as s,cst_customer as c where $where_str";
		$totalCount  = $this->C($this->cacheDir)->countRecords($countSql);	//计算记录数
		$beginRecord = ($currentPage-1)*$numPerPage;
		$sql		 = "select c.name as cst_name ,s.* from sal_contract as s,cst_customer as c
						where $where_str 
						order by s.id desc limit $beginRecord,$numPerPage";	
		$list		 = $this->C($this->cacheDir)->findAll($sql);
		foreach($list as $key=>$row){
			$operate[$row["id"]]=$this->sal_contract_operate($row["status"],$row["id"]);
			//$money[$row["id"]]=_instance('Action/SalContractDetail')->cst_get_one_quoted_detail_money($row["id"]);
		}
		$assignArray = array('list'=>$list,"numPerPage"=>$numPerPage,
								"totalCount"=>$totalCount,"currentPage"=>$currentPage,
								"operate"=>$operate//,"money"=>$money
						);	
		return $assignArray;
		
	}
	
	public function sal_contract_show(){
			$assArr  					= $this->sal_contract();
			$assArr["customer"]			= $this->L("Customer")->customer_arr();
			$assArr["dict"] 			= $this->L("CstDict")->cst_dict_arr();
			$assArr["linkman"] 			= $this->L("CstLinkman")->cst_linkman_arr();
			$assArr["status"] 			= $this->sal_contract_status();
			$assArr["pay_status"] 		= $this->sal_contract_pay_status();
			$assArr["deliver_status"] 	= $this->sal_contract_deliver_status();
			$assArr["bill_status"] 		= $this->sal_contract_bill_status();
			$assArr["chance"] 			= $this->L("CstChance")->cst_chance_arr();
			$assArr["users"]			= $this->L("User")->user_arr();
			$smarty  = $this->setSmarty();
			$smarty->assign($assArr);
			$smarty->display('sal_contract/sal_contract_show.html');	
	}		
	
	public function sal_contract_add(){
		if(empty($_POST)){
			$number = date("YmdHis").rand(10,99);
			$smarty = $this->setSmarty();
			$smarty->assign(array("number"=>$number));
			$smarty->display('sal_contract/sal_contract_add.html');	
		}else{
			$dt	     	= date("Y-m-d H:i:s",time());
			$cusID   	= $this->_REQUEST("org_id");
			$linkmanID  = $this->_REQUEST("linkman_id");
			$chanceID   = $this->_REQUEST("chance_id");
			$our_userID	= $this->_REQUEST("our_id");
			$sql       	= "insert into sal_contract(con_number,money,cusID,linkmanID,chanceID,our_userID,bdt,edt,title,intro,adt,create_userID) 
								values('$_POST[con_number]','$_POST[money]','$cusID','$linkmanID','$chanceID','$our_userID',
								'$_POST[bdt]','$_POST[edt]','$_POST[title]','$_POST[intro]','$dt','".SYS_USER_ID."');";
			$this->C($this->cacheDir)->update($sql);	
			$this->L("Common")->ajax_json_success("操作成功");		
		}
	}		
	public function sal_contract_get_one($id=""){
		if($id){
			$sql 		= "select * from sal_contract where id='$id'";
			$one 		= $this->C($this->cacheDir)->findOne($sql);	
			return $one;
		}	
	}	
	
	public function sal_contract_modify(){
		$id	 = $this->_REQUEST("id");
		if(empty($_POST)){
			$sql 		= "select * from sal_contract where id='$id'";
			$one 		= $this->C($this->cacheDir)->findOne($sql);	
			$customer   = $this->L("Customer")->customer_arr();
			$linkman    = $this->L("CstLinkman")->cst_linkman_arr();
			$dict		= $this->L("CstDict")->cst_dict_arr();
			$chance		= $this->L("CstChance")->cst_chance_arr();
			$smarty  	= $this->setSmarty();
			$smarty->assign(array("one"=>$one,"customer"=>$customer,"linkman"=>$linkman,"dict"=>$dict,"chance"=>$chance));
			$smarty->display('sal_contract/sal_contract_modify.html');
				
		}else{//更新保存数据
		
			$cusID   	 = $this->_REQUEST("org_id");
			$linkmanID   = $this->_REQUEST("linkman_id");
			$chanceID    = $this->_REQUEST("chance_id");
			$sql= "update sal_contract set 
							con_number='$_POST[con_number]',
							money='$_POST[money]',
							cusID='$cusID',linkmanID='$linkmanID',chanceID='$chanceID',
							bdt='$_POST[bdt]',edt='$_POST[edt]',
							title='$_POST[title]',intro='$_POST[intro]'
			 		where id='$id'";
			$this->C($this->cacheDir)->update($sql);	
			$this->L("Common")->ajax_json_success("操作成功");			
		}
	}
	
		
	public function sal_contract_del(){
		$id	  = $this->_REQUEST("ids");
		$sql  = "delete from sal_contract where id in ($id)";
		$this->C($this->cacheDir)->update($sql);	
		$this->L("Common")->ajax_json_success("操作成功","1","/SalContract/sal_contract_show/");	
	}
		
	public function sal_contract_audit(){
		$id	  	  = $this->_REQUEST("id");
		$status	  = $this->_REQUEST("status");
		$sql= "update sal_contract set status='$status' where id='$id'";
		$this->C($this->cacheDir)->update($sql);	
		$this->L("Common")->ajax_json_success("操作成功");				
	}
		
	public function sal_contract_status(){
		return  array(
				"1"=>"<div style='color:#FFA500'>临时单</div>",
				"2"=>"<div style='color:#0000FF'>执行中</div>",
				"2"=>"<div style='color:#008000'>完成</div>",
				"4"=>"<div style='color:#ff0000'>撤销</div>"
		);
	}


	public function sal_contract_pay_status(){
		return  array(
				"1"=>"<div style='color:#FFA500'>未付</div>",
				"2"=>"<div style='color:#0000FF'>部分</div>",
				"3"=>"<div style='color:#008000'>已付</div>"
		);
	}
	
	public function sal_contract_deliver_status(){
		return  array(
				"1"=>"<div style='color:#FFA500'>需要</div>",
				"2"=>"<div style='color:#0000FF'>部分</div>",
				"3"=>"<div style='color:#008000'>全部</div>"
		);
	}

	public function sal_contract_bill_status(){
		return  array(
				"1"=>"<div style='color:#FFA500'>需要</div>",
				"2"=>"<div style='color:#008000'>部分</div>",
				"3"=>"<div style='color:#008000'>全部</div>"
		);
	}
	
	public function sal_contract_operate($status,$id){
		switch($status){
			case 1:
				$str="<a href='".ACT."/SalContractDetail/sal_contract_detail_add/id/$id/' target='navTab' rel='sal_contract_detail_add' title='产品报价明细' >编辑明细</a>
					  <a href='".ACT."/SalContract/sal_contract_audit/status/2/id/$id/' target='ajaxTodo' title='确定要同意吗?'>同意</a>
					  <a href='".ACT."/SalContract/sal_contract_audit/status/3/id/$id/' target='ajaxTodo' title='确定要拒决吗?'>拒决</a>";
				break;
			case 2:
				$str="<a href='".ACT."/SalContract/sal_contract_show/id/$id' target='ajaxTodo' title='确定要生成订单吗?'>生成订单</a>";
				break;		
			case 3:
				$str="<a href='#'></a>";
				break;				
		}
		return $str;
	}

			
}
?>