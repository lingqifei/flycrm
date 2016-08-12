<?php	 
class CstTrace extends Action{	
	private $cacheDir='';//缓存目录
	public function __construct() {
		_instance('Action/Auth');
	}	
	
	public function cst_trace(){
	
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
		$where_str = " s.cusID=c.id ";

		if( !empty($searchValue) ){
			$where_str .=" and s.$searchKeyword like '%$searchValue%'";
		}
		if( !empty($cus_name) ){
			$where_str .=" and c.name like '%$cus_name%'";
		}		
		if( !empty($bdt) ){
			$where_str .=" and adt >= '$bdt'";
		}			
		if( !empty($edt) ){
			$where_str .=" and adt < '$edt'";
		}	
		//**************************************************************************
		$countSql    = "select c.name as cst_name ,s.* from cst_trace as s,cst_customer as c where $where_str";
		$totalCount  = $this->C($this->cacheDir)->countRecords($countSql);	//计算记录数
		$beginRecord = ($currentPage-1)*$numPerPage;
		$sql		 = "select c.name as cst_name ,s.* from cst_trace as s,cst_customer as c
						where $where_str 
						order by s.id desc limit $beginRecord,$numPerPage";	
		$list		 = $this->C($this->cacheDir)->findAll($sql);
		$assignArray = array('list'=>$list,"numPerPage"=>$numPerPage,"totalCount"=>$totalCount,"currentPage"=>$currentPage);	
		return $assignArray;
		
	}
	
	public function cst_trace_show(){
			$assArr  			= $this->cst_trace();
			$assArr["dict"] 	= $this->L("CstDict")->cst_dict_arr();
			$assArr["linkman"] 	= $this->L("CstLinkman")->cst_linkman_arr();
			$assArr["status"] 	= $this->cst_trace_status();
			$assArr["chance"] 	= $this->L("CstChance")->cst_chance_arr();
			$assArr["users"] 	= $this->L("User")->user_arr();
			$smarty  			= $this->setSmarty();
			$smarty->assign($assArr);
			$smarty->display('cst_trace/cst_trace_show.html');	
	}		
	
	public function cst_trace_add(){
		if(empty($_POST)){
			$status = $this->cst_trace_status_select("status");
			$smarty = $this->setSmarty();
			$smarty->assign(array("status"=>$status));
			$smarty->display('cst_trace/cst_trace_add.html');	
		}else{
			$dt	     	= date("Y-m-d H:i:s",time());
			$cusID   	= $this->_REQUEST("org_id");
			$salestage  = $this->_REQUEST("salestage_id");
			$salemode   = $this->_REQUEST("salemode_id");
			$linkmanID  = $this->_REQUEST("linkman_id");
			$chanceID   = $this->_REQUEST("chance_id");
			$sql       	= "insert into cst_trace(cusID,salestage,salemode,linkmanID,chanceID,bdt,status,title,intro,adt) 
								values('$cusID','$salestage','$salemode','$linkmanID',$chanceID,'$_POST[bdt]','$_POST[status]',
										'$_POST[title]','$_POST[intro]','$dt');";
			$this->C($this->cacheDir)->update($sql);	
			$this->L("Common")->ajax_json_success("操作成功");		
		}
	}		
	
	
	public function cst_trace_modify(){
		$id	  	 = $this->_REQUEST("id");
		
		if(empty($_POST)){
			$sql 		= "select * from cst_trace where id='$id'";
			$one 		= $this->C($this->cacheDir)->findOne($sql);	
			$customer   = $this->L("Customer")->customer_arr();
			$linkman    = $this->L("CstLinkman")->cst_linkman_arr();
			$dict		= $this->L("CstDict")->cst_dict_arr();
			$chance		= $this->L("CstChance")->cst_chance_arr();
			$status 	= $this->cst_trace_status_select("status",$one["status"]);
			$smarty  	= $this->setSmarty();
			$smarty->assign(array("one"=>$one,"customer"=>$customer,"linkman"=>$linkman,"dict"=>$dict,"chance"=>$chance,"status"=>$status));
			$smarty->display('cst_trace/cst_trace_modify.html');	
		}else{//更新保存数据
		
			$cusID   = $this->_REQUEST("org_id");
			$salestage   = $this->_REQUEST("salestage_id");
			$salemode    = $this->_REQUEST("salemode_id");
			$linkmanID   = $this->_REQUEST("linkman_id");
			$chanceID   = $this->_REQUEST("chance_id");
			$sql= "update cst_trace set 
							cusID='$cusID',linkmanID='$linkmanID',salestage='$salestage',salemode='$salemode',chanceID='$chanceID',
							bdt='$_POST[bdt]',status='$_POST[status]',title='$_POST[title]',intro='$_POST[intro]'
			 		where id='$id'";
			$this->C($this->cacheDir)->update($sql);	
			$this->L("Common")->ajax_json_success("操作成功");			
		}
	}
	
		
	public function cst_trace_del(){
		$id	  = $this->_REQUEST("ids");
		$sql  = "delete from cst_trace where id in ($id)";
		$this->C($this->cacheDir)->update($sql);	
		$this->L("Common")->ajax_json_success("操作成功","1","/CstTrace/cst_trace_show/");	
	}	
	public function cst_trace_status(){
		return  array("1"=>"计划联系","2"=>"已经联系");
	}
	public function cst_trace_status_select($inputname,$value=""){
		$data=$this->cst_trace_status();
		$string ="<select name='$inputname'>";
		foreach($data as $key=>$va){
			$string.="<option value='$key'";
			if($key==$value) $string.=" selected";
			$string.=">".$va."</option>";
		}
		$string.="</select>";
		return $string;
	}		
			
}//
?>