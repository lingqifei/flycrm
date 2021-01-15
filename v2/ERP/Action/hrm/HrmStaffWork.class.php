<?php
/*
 *
 * crm.HrmStaffWork  工作经历
 *
 * =========================================================
 * 零起飞网络 - 专注于网站建设服务和行业系统开发
 * 以质量求生存，以服务谋发展，以信誉创品牌 !
 * ----------------------------------------------
 * @copyright	Copyright (C) 2017-2018 07FLY Network Technology Co,LTD (www.07FLY.com) All rights reserved.
 * @license    For licensing, see LICENSE.html or http://www.07fly.xyz/hrm/license
 * @author ：kfrs <goodkfrs@QQ.com> 574249366
 * @version ：1.0
 * @link ：http://www.07fly.xyz 
 */	
class HrmStaffWork extends Action{	
	private $cacheDir='';//缓存目录
	public function __construct() {
		_instance('Action/sysmanage/Auth');
		$this->comm=_instance('Extend/Common');
		$this->sys_user=_instance('Action/sysmanage/User');
        $this->dept		= $this->L("sysmanage/Dept");
        $this->postion	= $this->L("sysmanage/Position");
	}	
	
	public function hrm_staff_work(){
		//**获得传送来的数据作分页处理
		$pageNum = $this->_REQUEST("pageNum");//第几页
		$pageSize= $this->_REQUEST("pageSize");//每页多少条
		$pageNum = empty($pageNum)?1:$pageNum;
		$pageSize= empty($pageSize)?$GLOBALS["pageSize"]:$pageSize;
		
		//**************************************************************************
		//**获得传送来的数据做条件来查询
		$name	   = $this->_REQUEST("name");
		$conn_time	= $this->_REQUEST("conn_time");
		$next_time	= $this->_REQUEST("next_time");
		$edt   	  = $this->_REQUEST("edt");
		$orderField = $this->_REQUEST("orderField");
		$orderDirection = $this->_REQUEST("orderDirection");
		
		$where_str = "  1 ";//默认为归属自己的
		
		$keywords	= $this->_REQUEST("keywords");
        $staff_id	= $this->_REQUEST("staff_id");

        if( !empty($staff_id) ){
            $where_str .=" and staff_id='$staff_id'";
        }
		
		$order_by="order by";
		if( $orderField=='by_nextbdt' ){
			$order_by .=" c.next_time $orderDirection";
		}else if($orderField=='by_connbdt'){
			$order_by .=" c.conn_time $orderDirection";
		}else if($orderField=='by_customer'){
			$order_by .=" c.id $orderDirection";
		}else{
			$order_by .=" c.id desc";
		}
		
		//**************************************************************************
		$countSql   = "select c.* from hrm_staff_work as c where $where_str";
		$totalCount	 = $this->C($this->cacheDir)->countRecords($countSql);	//计算记录数
		$beginRecord= ($pageNum-1)*$pageSize;//计算开始行数
		$sql		 = "select c.* from hrm_staff_work as c where $where_str $order_by limit $beginRecord,$pageSize";	
		$list		 = $this->C($this->cacheDir)->findAll($sql);
		foreach($list as $key=>$row){
			//$list[$key]['owner_user']=$this->sys_user->user_get_one($row['owner_user_id']);
		}
		$assignArray = array('list'=>$list,"pageSize"=>$pageSize,"totalCount"=>$totalCount,"pageNum"=>$pageNum);		
		return $assignArray;
	}

	public function hrm_staff_work_json(){
		$assArr  = $this->hrm_staff_work();
		echo json_encode($assArr);
	}	
	//客户列表显示
	public function hrm_staff_work_show(){
		$smarty = $this->setSmarty();
		$smarty->display('hrm/hrm_staff_work_show.html');	
	}	

	//客户增加
	public function hrm_staff_work_add(){
	    $staff_id	= $this->_REQUEST("staff_id");
		if(empty($_POST)){
            $dept 		= $this->dept->getTreeSelectHtml("dept_id");
            $position	= $this->postion->getTreeSelectHtml("position_id");
			$smarty = $this->setSmarty();
			$smarty->assign(array("staff_id"=>$staff_id));
			$smarty->display('hrm/hrm_staff_work_add.html');	
		}else{
            $into_data=array(
                'staff_id'=>$this->_REQUEST("staff_id"),
                'name'=>$this->_REQUEST("name"),
                'begin_date'=>$this->_REQUEST("begin_date"),
                'end_date'=>$this->_REQUEST("end_date"),
                'position'=>$this->_REQUEST("position"),
                'create_time'=>NOWTIME
            );
            $this->C($this->cacheDir)->insert('hrm_staff_work',$into_data);
            $this->L("Common")->ajax_json_success("操作成功");
        }
	}
	public function hrm_staff_work_modify(){
		$id	= $this->_REQUEST("id");
		if(empty($_POST)){
			$sql 	= "select * from hrm_staff_work where id='$id'";
			$one 	= $this->C($this->cacheDir)->findOne($sql);
			$smarty = $this->setSmarty();
			$smarty->assign(array("one"=>$one));
			$smarty->display('hrm/hrm_staff_work_modify.html');	
			
		}else{//更新保存数据
            $into_data=array(
                'name'=>$this->_REQUEST("name"),
                'begin_date'=>$this->_REQUEST("begin_date"),
                'end_date'=>$this->_REQUEST("end_date"),
                'position'=>$this->_REQUEST("position"),
                'create_time'=>NOWTIME
            );
			$this->C($this->cacheDir)->modify('hrm_staff_work',$into_data,"id='$id'");
			$this->L("Common")->ajax_json_success("操作成功");			
		}
	}
	//删除
	public function hrm_staff_work_del(){
		$id = $this->_REQUEST("id");
		$sql  = "delete from hrm_staff_work where id in ($id)";
		$this->C($this->cacheDir)->update($sql);	
		$this->L("Common")->ajax_json_success("操作成功");	
	}	
	//查询一条记录
	public function hrm_staff_work_get_one($id=""){
		if($id){
			$sql = "select * from hrm_staff_work where id='$id' ";
			$one = $this->C($this->cacheDir)->findOne($sql);
			return $one;
		}
	}

}//end class
?>