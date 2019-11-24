<?php
/*
 *
 * sysmanage.SysLog  系统日志管理   
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

 
class SysLog extends Action{	
	
	private $cacheDir='';//缓存目录
	
	public function __construct() {
		 _instance('Action/Auth');
	}
	
	public function main(){

	}
	public function Index(){
		return _instance('Action/Index');
	}	
	public function User(){
		return _instance('Action/User');
	}
	public function Common(){
		return _instance('Extend/Common');
	}
	public function File() {	
		return _instance('Extend/File');
	}		
	public function Temp(){
		return _instance('Action/Temp');
	}
	
	//获取操作日志
	public function sys_log(){
		//**获得传送来的数据作分页处理
		$currentPage = $this->_REQUEST("pageNum");//第几页
		$numPerPage  = $this->_REQUEST("numPerPage");//每页多少条
		$currentPage = empty($currentPage)?1:$currentPage;
		$numPerPage  = empty($numPerPage)?$GLOBALS["pageSize"]:$numPerPage;		

		//用户查询参数
		$searchKeyword= $this->_REQUEST("searchKeyword");
		$searchValue  = $this->_REQUEST("searchValue");
		$startdate    = $this->_REQUEST("startdate");
		$enddate	  = $this->_REQUEST("enddate");	
		$editor	  	  = $this->_REQUEST("org_account");	
		
		$where 		  = "0=0 ";
		if(!empty($searchValue)){
			$where .= " and $searchKeyword like '%$searchValue%'";
		}	
		if($startdate){
			$where .=" and adddatetime>'$startdate' ";
		}
		if($enddate){
			$where .=" and adddatetime<='$enddate' ";
		}	
		if($editor){
			$where .=" and editor='$editor' ";
		}				
		$countSql	= "select * from fly_sys_log where $where";
		$totalCount  = $this->C($this->cacheDir)->countRecords($countSql);	//计算记录数
		$beginRecord = ($currentPage-1)*$numPerPage;	
		$sql		= "select * from fly_sys_log  where $where order by id desc limit $beginRecord,$numPerPage";	
		$list		= $this->C($this->cacheDir)->findAll($sql);//查询结果为二维数组，需foreach循环
		$assignArray=array('list'=>$list,'searchKeyword'=>$searchKeyword,'searchValue'=>$searchValue,
							'startdate'=>$startdate,'enddate'=>$enddate,'editor'=>$editor,
							"numPerPage"=>$numPerPage,"totalCount"=>$totalCount,"currentPage"=>$currentPage
							);				
					
		return $assignArray;
	}
	//调用显示
	public function sys_log_show(){
		$list	= $this->sys_log();
		$smarty = $this->setSmarty();
		$smarty->assign($list);//框架变量注入同样适用于smarty的assign方法
		$smarty->display('sys_log/sys_log.html');			
	}
	
	public function sys_log_add($info,$editor=null){
		$nowtime = date("Y-m-d H:i:s",time());
		if(empty($editor)) $editor  = SYS_USER_ACCOUNT;
		$ip		 = $this->Common()->get_client_ip();
		$sql 	 = "insert into fly_sys_log(ipaddr,content,editor,adddatetime) values('$ip','$info','$editor','$nowtime')";
		if($this->C($this->cacheDir)->update($sql)<=0){
			return false;
		}else{
			return true;
		}
	}

	
	//删除选中记录
	public function sys_log_del (){
		$id	  = $this->_REQUEST("ids");	
		$sql="delete from fly_sys_log where id in (".$id.");";											 
		if($this->C($this->cacheDir)->update($sql)>=0){
			$this->L("Common")->ajax_json_success("操作成功",'1','/SysLog/sys_log_show/');	
		}	
	}	
	
	//删除全部记录
	public function sys_log_del_all (){
		$sql="delete from fly_sys_log";							 
		if($this->C($this->cacheDir)->update($sql)>=0){
			$this->L("Common")->ajax_json_success("操作成功",'1','/SysLog/sys_log_show/');	
		}	
	}

}//end class
?>