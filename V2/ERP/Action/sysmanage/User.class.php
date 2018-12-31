<?php
/*
 * 后台用户管理类
 *
 */	
class User extends Action{
	private $cacheDir='';//缓存目录
	private $auth;
	private $dept;//部门
	private $postion;//职位
	private $role;//权限
	public function __construct() {
		$this->auth=_instance('Action/sysmanage/Auth');
		$this->dept= $this->L("sysmanage/Dept");
		$this->postion= $this->L("sysmanage/Position");
		$this->role= $this->L("sysmanage/Role");
	}	
	public function user(){
		//**获得传送来的数据作分页处理
		$pageNum = $this->_REQUEST("pageNum");//第几页
		$pageSize= $this->_REQUEST("pageSize");//每页多少条
		$pageNum = empty($pageNum)?1:$pageNum;
		$pageSize= empty($pageSize)?$GLOBALS["pageSize"]:$pageSize;
		//**************************************************************************
		
		//**获得传送来的数据做条件来查询
		$name	   = $this->_REQUEST("name");
		$tel	   = $this->_REQUEST("tel");
		$where_str = "u.id != 0";
		
		$searchKeyword	   = $this->_REQUEST("searchKeyword");
		$searchValue	   = $this->_REQUEST("searchValue");
		if( !empty($searchValue) ){
			$where_str .=" and $searchKeyword like '%$searchValue%'";
		}
		
		if( !empty($name) ){
			$where_str .=" and name like '%$name%'";
		}	
		//**************************************************************************
		$countSql   = "select u.id from fly_sys_user as u 
						left join fly_sys_dept as d on u.deptID=d.id
						left join fly_sys_role as r on u.deptID=r.id
						left join fly_sys_position as p on u.deptID=p.id
						where $where_str";
		$totalCount  = $this->C($this->cacheDir)->countRecords($countSql);	//计算记录数
		$beginRecord = ($pageNum-1)*$pageSize;
		$sql		 = "select u.*,d.name as dept_name,r.name as role_name,p.name as position_name from fly_sys_user as u  
						left join fly_sys_dept as d on u.deptID=d.id
						left join fly_sys_role as r on u.roleID=r.id
						left join fly_sys_position as p on u.positionID=p.id
						where $where_str order by u.id desc limit $beginRecord,$pageSize";
		$list		 = $this->C($this->cacheDir)->findAll($sql);
		$assignArray = array('list'=>$list,"pageSize"=>$pageSize,"totalCount"=>$totalCount,"pageNum"=>$pageNum);	
		return $assignArray;
	}
	public function user_show_json(){
		$assArr = $this->user();
		echo json_encode($assArr);
	}
	public function user_show(){
			$assArr = $this->user();
			$smarty = $this->setSmarty();
			$smarty->assign($assArr);
			$smarty->display('sysmanage/user_show.html');	
	}		
	public function lookup_search(){
			$assArr  			= $this->user();
			$assArr["dept"] 	= $this->dept->dept_arr();
			$assArr["position"] = $this->postion->position_arr();
			$assArr["role"]		= $this->role->role_arr();
			$smarty  			= $this->setSmarty();
			$smarty->assign($assArr);
			$smarty->display('sysmanage/lookup_search.html');	
	}	
	
	public function user_add(){
		if(empty($_POST)){
			$dept 		= $this->dept->dept_select_tree("deptID");
			$position	= $this->postion->position_select_tree("positionID");
			$role		= $this->role->role_select_tree("roleID");
			$smarty = $this->setSmarty();
			$smarty->assign(array("dept"=>$dept,"position"=>$position,"role"=>$role));
			$smarty->display('sysmanage/user_add.html');	
		}else{
			$account	= $this->_REQUEST("account");
			$password	= $this->_REQUEST("password");
			$name	   = $this->_REQUEST("name");
			$gender	   = $this->_REQUEST("gender");
			$deptID	   = $this->_REQUEST("deptID");
			$positionID	= $this->_REQUEST("positionID");
			$roleID	   = $this->_REQUEST("roleID");
			$mobile	   = $this->_REQUEST("mobile");
			$tel	   = $this->_REQUEST("tel");
			$qicq	   = $this->_REQUEST("qicq");
			$email	   = $this->_REQUEST("email");
			$zipcode	= $this->_REQUEST("zipcode");
			$address	= $this->_REQUEST("address");
			$intro	   = $this->_REQUEST("intro");
			$dt	     = date("Y-m-d H:i:s",time());
			$sql     = "insert into fly_sys_user(account,password,name,gender,deptID,positionID,roleID,mobile,tel,qicq,email,zipcode,address,intro,adt) 
								values('$account','$password','$name','$gender','$deptID',
										'$positionID','$roleID','$mobile','$tel',
										'$qicq','$email','$zipcode','$address','$intro','$dt');";
			$this->C($this->cacheDir)->update($sql);	
			$this->location("操作成功","/sysmanage/User/user_show/");		
		}
	}		
	
	
	public function user_modify(){
		$id	  	 = $this->_REQUEST("id");
		if(empty($_POST)){
			$sql 		= "select * from fly_sys_user where id='$id'";
			$one 		= $this->C($this->cacheDir)->findOne($sql);	
			$dept 		= $this->dept->dept_select_tree("deptID",$one["deptID"]);
			$position	= $this->postion->position_select_tree("positionID",$one["positionID"]);
			$role		= $this->role->role_select_tree("roleID",$one["roleID"]);
			$smarty 	= $this->setSmarty();
			$smarty->assign(array("one"=>$one,"dept"=>$dept,"position"=>$position,"role"=>$role));
			$smarty->display('sysmanage/user_modify.html');	
		}else{//更新保存数据
			
			$account	= $this->_REQUEST("account");
			$password	= $this->_REQUEST("password");
			$name	   = $this->_REQUEST("name");
			$gender	   = $this->_REQUEST("gender");
			$deptID	   = $this->_REQUEST("deptID");
			$positionID	= $this->_REQUEST("positionID");
			$roleID	   = $this->_REQUEST("roleID");
			$mobile	   = $this->_REQUEST("mobile");
			$tel	   = $this->_REQUEST("tel");
			$qicq	   = $this->_REQUEST("qicq");
			$email	   = $this->_REQUEST("email");
			$zipcode	= $this->_REQUEST("zipcode");
			$address	= $this->_REQUEST("address");
			$intro	   = $this->_REQUEST("intro");			
			
			$sql= "update fly_sys_user set 
							name='$name',password='$password',gender='$gender',deptID='$deptID',positionID='$positionID',
							roleID='$roleID',mobile='$mobile',tel='$tel',qicq='$qicq',email='$email',
							zipcode='$zipcode',address='$address',intro='$intro'
			 		where id='$id'";
			$this->C($this->cacheDir)->update($sql);	
			$this->location("操作成功","/sysmanage/User/user_show/");			
		}
	}
	
		
	public function user_del(){
		$id	  = $this->_REQUEST("ids");
		$sql  = "delete from fly_sys_user where id in ($id)";
		$this->C($this->cacheDir)->update($sql);	
		$this->location("操作成功","/sysmanage/User/user_show/");
	}	
	
	public function user_list(){
		$sql ="select * from fly_sys_user";
		$list=$this->C($this->cacheDir)->findAll($sql);
		return $list;
	}

	
	//得到一个系统用户权限
	//return Array ( [sys_menu] => Array ( [0] => 10,101,102,105,20,30,50 [1] => 1,507 ) )
	public function user_get_power($id=1){
		$sql	= "select roleID from fly_sys_user where id='$id'";				 
		$one 	= $this->C($this->cacheDir)->findOne($sql);
		$role   = explode(",",$one["roleID"]);
		if(is_array($role)){
			foreach($role as $k=>$v){
				$power=$this->role->role_get_one($v);//多个权限叠加进去
				foreach($power as $key=>$val){
					$pArr[$key][]=$val;
				}
			}
		}
		return $pArr;	
	}	
	
	//获取同当前用户管理的用户编号，通过角色来定义
	public function user_get_sub_user($id=null){
		$sql	 = "select roleID from fly_sys_user where id='$id'";	
		$one 	 = $this->C($this->cacheDir)->findOne($sql);
		$role   = explode(",",$one["roleID"]);//这里表示有多个角色
		$rtArr  =array($id);
		if(is_array($role)){
			foreach($role as $k=>$v){
				$sub_role_arr= $this->role->role_all_child($v);//得到这个角色所有下组角色
				if(!empty($sub_role_arr)){//查询子角色下所有用户
					$role_txt	 =implode(',',$sub_role_arr);
					$sql	 = "select id,name,account from fly_sys_user where roleID in ($role_txt)";	
					$list 	 = $this->C($this->cacheDir)->findAll($sql);
					foreach($list as $key=>$row){
						$rtArr[]=$row["id"];
					}						
				}
			}
		}
		return $rtArr;	
	}	
	//传入ID返回名字
	public function user_get_name($id){
		if(empty($id)) $id=0;
		$sql  ="select id,name from fly_sys_user where id in ($id)";	
		$list =$this->C($this->cacheDir)->findAll($sql);
		$str  ="";
		if(is_array($list)){
			foreach($list as $row){
				$str .= "|-".$row["name"]."&nbsp;";
			}
		}
		return $str;
	}
	//传入ID返回名字
	public function user_get_one($id){
		if(empty($id)) $id=0;
		$sql ="select * from fly_sys_user where id='$id'";
		$one =$this->C($this->cacheDir)->findOne($sql);
		return $one;
	}
}//
?>