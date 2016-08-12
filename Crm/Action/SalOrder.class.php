<?php 
class SalOrder extends Action{
	private $cacheDir='';//缓存目录	
	public function __construct() {
		_instance('Action/Auth');
	}	
	
	public function sal_order(){
	
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
		$where_str 		   = " create_userID in (".SYS_USER_VIEW.")";

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
		$countSql    = "select id from sal_order where $where_str";
		$totalCount  = $this->C($this->cacheDir)->countRecords($countSql);	//计算记录数
		$beginRecord = ($currentPage-1)*$numPerPage;
		$sql		 = "select * from sal_order where $where_str order by id desc limit $beginRecord,$numPerPage";	
		$list		 = $this->C($this->cacheDir)->findAll($sql);
		foreach($list as $key=>$row){
			$operate[$row["id"]]=$this->sal_order_operate($row["status"],$row["id"]);
			$money[$row["id"]]= $this->L("SalOrderDetail")->sal_get_one_order_detail_money($row["id"]);
		}
		$assignArray = array('list'=>$list,"numPerPage"=>$numPerPage,
								"totalCount"=>$totalCount,"currentPage"=>$currentPage,
								"operate"=>$operate,"money"=>$money
						);	
		return $assignArray;
		
	}
	
	public function sal_order_show(){
			$assArr  				= $this->sal_order();
			$assArr["customer"]		= $this->L("Customer")->customer_arr();
			$assArr["linkman"] 		= $this->L("CstLinkman")->cst_linkman_arr();
			$assArr["status"] 		= $this->sal_order_status();
			$assArr["pay_status"] 	= $this->sal_order_pay_status();
			$assArr["deliver_status"] = $this->sal_order_deliver_status();
			$assArr["bill_status"] 	= $this->sal_order_bill_status();
			$assArr["chance"] 		= $this->L("CstChance")->cst_chance_arr();
			$assArr["users"]		= $this->L("User")->user_arr();
			$smarty  = $this->setSmarty();
			$smarty->assign($assArr);
			$smarty->display('sal_order/sal_order_show.html');	
	}		
	
	public function sal_order_add(){
		if(empty($_POST)){
			$number = date("YmdHis").rand(10,99);
			$smarty = $this->setSmarty();
			$smarty->assign(array("number"=>$number));
			$smarty->display('sal_order/sal_order_add.html');	
		}else{
			$dt	     	= date("Y-m-d H:i:s",time());
			$cusID   	= $this->_REQUEST("org_id");
			$linkmanID  = $this->_REQUEST("linkman_id");
			$chanceID   = $this->_REQUEST("chance_id");
			$our_userID	= $this->_REQUEST("our_id");
			$sql       	= "insert into sal_order(
									ord_number,money,cusID,linkmanID,chanceID,our_userID,
									bdt,edt,title,intro,adt,create_userID) 
								values(
									'$_POST[ord_number]','$_POST[money]','$cusID','$linkmanID','$chanceID','$our_userID',
									'$_POST[bdt]','$_POST[edt]','$_POST[title]','$_POST[intro]','$dt','".SYS_USER_ID."');";
									echo $sql;
			$this->C($this->cacheDir)->update($sql);	
			$this->L("Common")->ajax_json_success("操作成功");		
		}
	}		
	public function sal_order_get_one($id=""){
		if($id){
			$sql = "select * from sal_order where id='$id'";
			$one = $this->C($this->cacheDir)->findOne($sql);	
			return $one;
		}	
	}	
	
	public function sal_order_modify(){
		$id	 = $this->_REQUEST("id");
		if(empty($_POST)){
			$sql 		= "select * from sal_order where id='$id'";
			$one 		= $this->C($this->cacheDir)->findOne($sql);	
			$customer   = $this->L("Customer")->customer_arr();
			$linkman    = $this->L("CstLinkman")->cst_linkman_arr();
			$dict		= $this->L("CstDict")->cst_dict_arr();
			$chance		= $this->L("CstChance")->cst_chance_arr();
			$users		= $this->L("User")->user_arr();
			$smarty  	= $this->setSmarty();
			$smarty->assign(array("one"=>$one,"customer"=>$customer,"linkman"=>$linkman,"dict"=>$dict,"chance"=>$chance,"users"=>$users));
			$smarty->display('sal_order/sal_order_modify.html');
				
		}else{//更新保存数据
		
			$cusID   	 = $this->_REQUEST("org_id");
			$linkmanID   = $this->_REQUEST("linkman_id");
			$chanceID   = $this->_REQUEST("chance_id");
			$sql= "update sal_order set 
							ord_number='$_POST[ord_number]',
							money='$_POST[money]',
							cusID='$cusID',linkmanID='$linkmanID',chanceID='$chanceID',
							bdt='$_POST[bdt]',edt='$_POST[edt]',
							title='$_POST[title]',intro='$_POST[intro]'
			 		where id='$id'";
			$this->C($this->cacheDir)->update($sql);	
			$this->L("Common")->ajax_json_success("操作成功");			
		}
	}
	
		
	public function sal_order_del(){
		$id	  = $this->_REQUEST("ids");
		$sql  = "delete from sal_order where id in ($id)";
		$this->C($this->cacheDir)->update($sql);	
		$this->L("Common")->ajax_json_success("操作成功","1","/SalOrder/sal_order_show/");	
	}


	//下拉选择回放数据
	public function sal_order_select(){
		$cusID  = $this->_REQUEST("cusID");
		$sql	= "select id,title as name,money,bill_money,zero_money,pay_money,(money-zero_money-pay_money) as plan_money from sal_order where cusID='$cusID' order by id asc;";
		$list	=$this->C($this->cacheDir)->findAll($sql);
		echo json_encode($list);
	}
	
		
	//审核
	public function sal_order_audit(){
		$id	  	  = $this->_REQUEST("id");
		$status	  = $this->_REQUEST("status");
		$sql= "update sal_order set status='$status' where id='$id'";
		$this->C($this->cacheDir)->update($sql);	
		$this->L("Common")->ajax_json_success("操作成功");				
	}
		
	public function sal_order_status(){
		return  array(
				"1"=>"<div style='color:#FFA500'>临时单</div>",
				"2"=>"<div style='color:#0000FF'>执行中</div>",
				"3"=>"<div style='color:#008000'>完成</div>",
				"4"=>"<div style='color:#ff0000'>撤销</div>"
		);
	}


	public function sal_order_pay_status(){
		return  array(
				"1"=>"<div style='color:#FFA500'>未付</div>",
				"2"=>"<div style='color:#FF0000'>部分</div>",
				"3"=>"<div style='color:#8A2BE2'>已付</div>"
		);
	}
	
	public function sal_order_deliver_status(){
		return  array(
				"1"=>"<div style='color:#FFA500'>需要</div>",
				"2"=>"<div style='color:#FF0000'>待出库</div>",
				"3"=>"<div style='color:#8A2BE2'>待发货</div>",
				"4"=>"<div style='color:#0000FF'>部分</div>",
				"5"=>"<div style='color:#008000'>全部</div>"
		);
	}

	public function sal_order_bill_status(){
		return  array(
				"1"=>"<div style='color:#FFA500'>需要</div>",
				"2"=>"<div style='color:#008000'>部分</div>",
				"3"=>"<div style='color:#008000'>全部</div>"
		);
	}
	
	public function sal_order_operate($status,$id){
		switch($status){
			case 1:
				$str="<a href='".ACT."/SalOrderDetail/sal_order_detail_add/id/$id/' target='navTab' rel='sal_order_detail_add' title='编辑订单明细' >订单明细</a>";
				break;
			case 2:
				$str="<a href='".ACT."/SalOrder/sal_order_show/id/$id' target='ajaxTodo' title='确定要生成订单吗?'>生成订单</a>";
				break;		
			case 3:
				$str="<a href='#'></a>";
				break;				
		}
		return $str;
	}

	//传入ID返回名字
	public function sal_order_get_name($id){
		if(empty($id)) $id=0;
		$sql  ="select id,title as name from sal_order where id in ($id)";	
		$list =$this->C($this->cacheDir)->findAll($sql);
		$str  ="";
		if(is_array($list)){
			foreach($list as $row){
				$str .= "|-".$row["name"]."&nbsp;";
			}
		}
		return $str;
	}


	//付款修改订单功能
	public function sal_order_pay_modify($cusID,$new_money){
		$one		=$this->sal_order_get_one($cusID);
		$money		=$one["money"];
		$pay_money	=$one["pay_money"];
		if(($pay_money+$new_money)>=$money){
			$pay_status=3;//已付
		}else{
			$pay_status=2;//未付
		}
		//更改付款金额
		$sql="update sal_order set status=2,pay_status='$pay_status',pay_money=pay_money+'$new_money' where id='$cusID';";
		if($this->C($this->cacheDir)->update($sql)>0){
			return true;
		}else{
			return false;	
		}
	}

	//收票修改订单功能
	public function sal_order_invo_modify($salID,$new_money){
		$one		=$this->sal_order_get_one($salID);
		$money		=$one["money"];
		$bill_money	=$one["bill_money"];
		if(($bill_money+$new_money)>=$money){
			$bill_status=3;//已付
		}else{
			$bill_status=2;//部分
		}
		//更改付款金额
		$sql="update sal_order set bill_status='$bill_status',bill_money=bill_money+'$new_money' where id='$salID';";
		if($this->C($this->cacheDir)->update($sql)>0){
			return true;
		}else{
			return false;	
		}
	}

			
}
?>