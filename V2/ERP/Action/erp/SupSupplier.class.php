<?php
/*
 *
 * crm.SupSupplier 供应商管理   
 *
 * =========================================================
 * 零起飞网络 - 专注于网站建设服务和行业系统开发
 * 以质量求生存，以服务谋发展，以信誉创品牌 !
 * ----------------------------------------------
 * @copyright	Copyright (C) 2017-2018 07FLY Network Technology Co,LTD (www.07FLY.com) All rights reserved.
 * @license    For licensing, see LICENSE.html or http://www.07fly.top/crm/license
 * @author ：kfrs <goodkfrs@QQ.com> 574249366
 * @version ：1.0
 * @link ：http://www.07fly.top 
 */	
class SupSupplier extends Action{	
	private $cacheDir='';//缓存目录
	public function __construct() {
		_instance('Action/sysmanage/Auth');
		$this->dict=_instance('Action/crm/CstDict');
	}	
	
	public function sup_supplier(){
		//**获得传送来的数据作分页处理
		$pageNum = $this->_REQUEST("pageNum");//第几页
		$pageSize= $this->_REQUEST("pageSize");//每页多少条
		$pageNum = empty($pageNum)?1:$pageNum;
		$pageSize= empty($pageSize)?$GLOBALS["pageSize"]:$pageSize;
		
		//**************************************************************************
		//**获得传送来的数据做条件来查询

		$name	   = $this->_REQUEST("name");
		$tel	   = $this->_REQUEST("tel");
		$linkman   = $this->_REQUEST("linkman");
		$address   = $this->_REQUEST("address");	
		$bdt   	   = $this->_REQUEST("bdt");
		$edt   	   = $this->_REQUEST("edt");
		$where_str = " supplier_id != 0";
		
		
		if( !empty($name) ){
			$where_str .=" and name like '%$name%'";
		}
		if( !empty($tel) ){
			$where_str .=" and tel like '%$tel%'";
		}	
		if( !empty($linkman) ){
			$where_str .=" and linkman like '%$linkman%'";
		}	
		if( !empty($address) ){
			$where_str .=" and address like '%$address%'";
		}	
		if( !empty($bdt) ){
			$where_str .=" and adt >= '$bdt'";
		}			
		if( !empty($edt) ){
			$where_str .=" and adt < '$edt'";
		}	
		$orderField = $this->_REQUEST("orderField");
		$orderDirection = $this->_REQUEST("orderDirection");		
		$order_by="order by";
		if( $orderField=='by_supplier' ){
			$order_by .=" supplier_id $orderDirection";
		}else if($orderField=='by_connbdt'){
			$order_by .=" conn_time $orderDirection";
		}else{
			$order_by .=" supplier_id desc";
		}
		
		//**************************************************************************
		$countSql    = "select * from sup_supplier where $where_str";
		$totalCount  = $this->C($this->cacheDir)->countRecords($countSql);	//计算记录数
		$beginRecord= ($pageNum-1)*$pageSize;//计算开始行数
		$sql		 = "select * from sup_supplier  where  $where_str $order_by limit $beginRecord,$pageSize";	
		$list		 = $this->C($this->cacheDir)->findAll($sql);
		$dict		 = $this->dict->cst_dict_arr();
		foreach($list as $key=>$row){
			$list[$key]['ecotype_name']=$this->dict->cst_dict_get_name($row['ecotype']);
			//$list[$key]['level_name']=$dict[$row['level']];
			$list[$key]['trade_name']=$dict[$row['trade']];
		}
		$assignArray = array('list'=>$list,"pageSize"=>$pageSize,"totalCount"=>$totalCount,"pageNum"=>$pageNum);	
		return $assignArray;
		
	}
	//返回客户id.名称主要用于下拉选择搜索
	public function sup_supplier_list(){
		$sql ="select * from sup_supplier";
		$list=$this->C($this->cacheDir)->findAll($sql);
		return $list;
	}		
	public function sup_supplier_json(){
		$assArr  = $this->sup_supplier();
		echo json_encode($assArr);
	}		
	public function sup_supplier_show(){
			$assArr  = $this->sup_supplier();
			$smarty  = $this->setSmarty();
			$smarty->assign($assArr);
			$smarty->display('erp/sup_supplier_show.html');	
	}
	
	public function sup_supplier_add(){
		if(empty($_POST)){
			$trade=$this->dict->cst_dict_list('trade');
			$ecotype =$this->dict->cst_dict_list('ecotype');
			$smarty = $this->setSmarty();
			$smarty->assign(array("trade"=>$trade,"ecotype"=>$ecotype));
			$smarty->display('erp/sup_supplier_add.html');	
		}else{
			$into_data=array(
				'name'=>$this->_REQUEST("name"),
				'ecotype'=>$this->_REQUEST("ecotype"),
				'trade'=>$this->_REQUEST("trade"),
				'linkman'=>$this->_REQUEST("linkman"),
				'tel'=>$this->_REQUEST("tel"),
				'fax'=>$this->_REQUEST("fax"),
				'email'=>$this->_REQUEST("email"),
				'address'=>$this->_REQUEST("address"),
				'intro'=>$this->_REQUEST("intro"),
				'create_time'=>NOWTIME,
				'create_user_id'=>SYS_USER_ID,
			);
			$supplier_id=$this->C($this->cacheDir)->insert('sup_supplier',$into_data);
			if($supplier_id>0){
				$into_data=array(
					'supplier_id'=>$supplier_id,
					'name'=>$this->_REQUEST("linkman"),
					'tel'=>$this->_REQUEST("tel"),
					'create_time'=>NOWTIME,
					'create_user_id'=>SYS_USER_ID,
				);
				$this->C($this->cacheDir)->insert('sup_linkman',$into_data);				
				$this->L("Common")->ajax_json_success("操作成功");
			}
		}
	}		
	
	
	public function sup_supplier_modify(){
		$supplier_id = $this->_REQUEST("supplier_id");	
		if(empty($_POST)){
			$sql 	="select * from sup_supplier where supplier_id='$supplier_id'";
			$one 	=$this->C($this->cacheDir)->findOne($sql);	
			$trade	=$this->dict->cst_dict_list('trade');
			$ecotype=$this->dict->cst_dict_list('ecotype');
			$smarty =$this->setSmarty();
			$smarty->assign(array("one"=>$one,"trade"=>$trade,"ecotype"=>$ecotype));
			$smarty->display('erp/sup_supplier_modify.html');	
		}else{//更新保存数据
			$into_data=array(
				'name'=>$this->_REQUEST("name"),
				'ecotype'=>$this->_REQUEST("ecotype"),
				'trade'=>$this->_REQUEST("trade"),
				'linkman'=>$this->_REQUEST("linkman"),
				'tel'=>$this->_REQUEST("tel"),
				'fax'=>$this->_REQUEST("fax"),
				'email'=>$this->_REQUEST("email"),
				'address'=>$this->_REQUEST("address"),
				'intro'=>$this->_REQUEST("intro")
			);
			$this->C($this->cacheDir)->modify('sup_supplier',$into_data,"supplier_id='$supplier_id'");
			$this->L("Common")->ajax_json_success("操作成功");			
		}
	}
	
	//删除
	public function sup_supplier_del(){
		$supplier_id = $this->_REQUEST("supplier_id");	
		$this->C($this->cacheDir)->delete('sup_supplier',"supplier_id in ($supplier_id)");
		$this->L("Common")->ajax_json_success("操作成功");	
	}	
	
	public function supplier_arr(){
		$rtArr  =array();
		$sql	="select id,name from sup_supplier";
		$list	=$this->C($this->cacheDir)->findAll($sql);
		if(is_array($list)){
			foreach($list as $key=>$row){
				$rtArr[$row["id"]]=$row["name"];
			}
		}
		return $rtArr;
	}	
	
	//根据传的ID编号得到名称
	public function sup_supplier_get_one($id){
		if(empty($id)) $id=0;
		$sql  ="select * from sup_supplier where supplier_id in ($id)";	
		$one  =$this->C($this->cacheDir)->findOne($sql);
		return $one;
	}
			
}// end  class
?>