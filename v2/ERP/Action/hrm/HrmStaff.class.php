<?php
/*
 *
 * crm.HrmStaff  客户管理   
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
class HrmStaff extends Action{	
	private $cacheDir='';//缓存目录
	public function __construct() {
		_instance('Action/sysmanage/Auth');
		$this->comm=_instance('Extend/Common');
		$this->sys_user=_instance('Action/sysmanage/User');
        $this->dept		= $this->L("sysmanage/Dept");
        $this->postion	= $this->L("sysmanage/Position");
	}	
	
	public function hrm_staff(){
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

		if( !empty($keywords) ){
			$where_str .=" and ( c.name like '%$keywords%' 
			or c.mobile like '%$keywords%' 
			or c.address like '%$keywords%'  
			or c.marriage like '%$keywords%'  
			or c.politics like '%$keywords%'  
			or c.qualification like '%$keywords%'  
			or c.social like '%$keywords%'  
			or c.degree like '%$keywords%'  
			or c.major like '%$keywords%'  
			or c.mobile like '%$keywords%' )";
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
		$countSql   = "select c.* from hrm_staff as c where $where_str";
		$totalCount	 = $this->C($this->cacheDir)->countRecords($countSql);	//计算记录数
		$beginRecord= ($pageNum-1)*$pageSize;//计算开始行数
		$sql		 = "select c.* from hrm_staff as c where $where_str $order_by limit $beginRecord,$pageSize";	
		$list		 = $this->C($this->cacheDir)->findAll($sql);
		foreach($list as $key=>$row){
			//$list[$key]['owner_user']=$this->sys_user->user_get_one($row['owner_user_id']);
		}
		$assignArray = array('list'=>$list,"pageSize"=>$pageSize,"totalCount"=>$totalCount,"pageNum"=>$pageNum);		
		return $assignArray;
	}
	//返回客户id.名称主要用于下拉选择搜索
	public function hrm_staff_list(){
		$sql ="select id,name from hrm_staff";
		$list=$this->C($this->cacheDir)->findAll($sql);
		return $list;
	}

	public function hrm_staff_json(){
		$assArr  = $this->hrm_staff();
		echo json_encode($assArr);
	}	
	//客户列表显示
	public function hrm_staff_show(){
		$smarty = $this->setSmarty();
		$smarty->display('hrm/hrm_staff_show.html');	
	}	

	//客户增加
	public function hrm_staff_add(){
		if(empty($_POST)){
            $dept 		= $this->dept->dept_select_tree();
            $position	= $this->postion->position_select_tree();
			$smarty = $this->setSmarty();
			$smarty->assign(array("dept"=>$dept,"position"=>$position));
			$smarty->display('hrm/hrm_staff_add.html');	
		}else{
		    $this->hrm_staff_add_save();
        }
	}		
	//保存数据
	public function hrm_staff_add_save(){
        $into_data=array(
            'staff_no'=>$this->_REQUEST("staff_no"),
            'name'=>$this->_REQUEST("name"),
            'age'=>$this->_REQUEST("age"),
            'gender'=>$this->_REQUEST("gender"),
            'dept_id'=>$this->_REQUEST("dept_id"),
            'position_id'=>$this->_REQUEST("position_id"),
            'idcard'=>$this->_REQUEST("idcard"),
            'marriage'=>$this->_REQUEST("marriage"),
            'politics'=>$this->_REQUEST("politics"),
            'degree'=>$this->_REQUEST("degree"),
            'major'=>$this->_REQUEST("major"),
            'qualification'=>$this->_REQUEST("qualification"),
            'position'=>$this->_REQUEST("position"),
            'social'=>$this->_REQUEST("social"),
            'mobile'=>$this->_REQUEST("mobile"),
            'qicq'=>$this->_REQUEST("qicq"),
            'email'=>$this->_REQUEST("email"),
            'zipcode'=>$this->_REQUEST("zipcode"),
            'address'=>$this->_REQUEST("address"),
            'intro'=>$this->_REQUEST("intro"),
            'create_time'=>NOWTIME
        );
        $this->C($this->cacheDir)->insert('hrm_staff',$into_data);
        $this->L("Common")->ajax_json_success("操作成功");

    }
	public function hrm_staff_modify(){
		$id	= $this->_REQUEST("id");
		if(empty($_POST)){
			$sql 	= "select * from hrm_staff where id='$id'";
			$one 	= $this->C($this->cacheDir)->findOne($sql);
            $dept 		= $this->dept->dept_select_tree();
            $position	= $this->postion->position_select_tree();
			$smarty = $this->setSmarty();
			$smarty->assign(array("one"=>$one,"dept"=>$dept,"position"=>$position));
			$smarty->display('hrm/hrm_staff_modify.html');	
			
		}else{//更新保存数据
            $into_data=array(
                'staff_no'=>$this->_REQUEST("staff_no"),
                'name'=>$this->_REQUEST("name"),
                'age'=>$this->_REQUEST("age"),
                'gender'=>$this->_REQUEST("gender"),
                'dept_id'=>$this->_REQUEST("dept_id"),
                'position_id'=>$this->_REQUEST("position_id"),
                'idcard'=>$this->_REQUEST("idcard"),
                'marriage'=>$this->_REQUEST("marriage"),
                'politics'=>$this->_REQUEST("politics"),
                'degree'=>$this->_REQUEST("degree"),
                'major'=>$this->_REQUEST("major"),
                'qualification'=>$this->_REQUEST("qualification"),
                'position'=>$this->_REQUEST("position"),
                'social'=>$this->_REQUEST("social"),
                'mobile'=>$this->_REQUEST("mobile"),
                'qicq'=>$this->_REQUEST("qicq"),
                'email'=>$this->_REQUEST("email"),
                'zipcode'=>$this->_REQUEST("zipcode"),
                'address'=>$this->_REQUEST("address"),
                'intro'=>$this->_REQUEST("intro"),
                'create_time'=>NOWTIME
            );
			$this->C($this->cacheDir)->modify('hrm_staff',$into_data,"id='$id'");
			$this->L("Common")->ajax_json_success("操作成功");			
		}
	}
	//详细
	public function hrm_staff_detail(){
		$id = $this->_REQUEST("id");
		$one =$this->hrm_staff_get_one($id);
		$smarty = $this->setSmarty();
		$smarty->assign(array("one"=>$one));
		$smarty->display('hrm/hrm_staff_detail.html');			
	}
	//删除
	public function hrm_staff_del(){
		$id = $this->_REQUEST("id");
		$sql  = "delete from hrm_staff where id in ($id)";
		$this->C($this->cacheDir)->update($sql);	
		$this->L("Common")->ajax_json_success("操作成功");	
	}	
	//查询一条记录
	public function hrm_staff_get_one($id=""){
		if($id){
			$sql = "select * from hrm_staff where id='$id' ";
			$one = $this->C($this->cacheDir)->findOne($sql);
			return $one;
		}
	}
    //删除
    public function hrm_staff_to_comm(){
        $id = $this->_REQUEST("id");
        $sql  = "update hrm_staff set owner_user_id='0' where id in ($id)";
        $this->C($this->cacheDir)->update($sql);
        $this->L("Common")->ajax_json_success("操作成功");
    }

}//end class
?>