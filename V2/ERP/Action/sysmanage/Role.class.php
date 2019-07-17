<?php
/*
 *
 * sysmanage.Role  角色管理   
 *
 * =========================================================
 * 零起飞网络 - 专注于网站建设服务和行业系统开发
 * 以质量求生存，以服务谋发展，以信誉创品牌 !
 * ----------------------------------------------------------
 *
 * @copyright	Copyright (C) 2017-2018 07FLY Network Technology Co,LTD (www.07FLY.com) All rights reserved.
 * @license    For licensing, see LICENSE.html or http://www.07fly.top/crm/license
 * @author ：kfrs <goodkfrs@QQ.com> 574249366
 * @version ：1.0
 * @link ：http://www.07fly.top 
 */	
class Role extends Action{	

	private $cacheDir='';//缓存目录
	private $auth;
	public function __construct() {
		$this->auth=_instance('Action/sysmanage/Auth');
		$this->menu=_instance('Action/sysmanage/Menu');
		$this->method=_instance('Action/sysmanage/Method');
	}	
	
	public function role(){
		$sql	= "select * from fly_sys_role order by sort asc;";
		$list 	= $this->C( $this->cacheDir )->findAll( $sql );
		return $list;
	}
	//得到数形参数
	function getTree( $data, $pId=0,$level=0) {
		$tree = '';
		foreach ( $data as $k => $v ) {
			if ( $v[ 'parentID' ] == $pId ) { //父亲找到儿子
				$v[ 'children' ] = $this->getTree( $data, $v[ 'id' ], $level + 1);
				$v[ 'level' ] =  $level + 1;
				$tree[] = $v;
			}
		}
		return $tree;
	}
	
	//输出树形参数
	function getTreeHtml($tree) {
		$html = '';
		
		foreach ( $tree as $key=>$t ) {
			$kg="";
			//$fx=($t['level']>1)?"|——":"";
			for($x=1;$x<$t['level'];$x++) {
				$kg .="<i class='fly-fl'>|—</i>";
			}
			
			if ( $t[ 'children' ] == '' ) {
				$html .= "<li><div class='fly-row lines'>
								<i class='fly-fl'>&nbsp;</i>
								<div  class='fly-col-5'>".$kg."<input type='text' name='name[]'  data-id='".$t['id']."' value='".$t['name']."' class='form-control w150 treeName'/></div>
								
								<div  class='fly-col-2 fly-fr fly-tr'>
									<a class='single_operation' data-act='power' data-id='".$t['id']."'>权限维护</a> 
									<a class='single_operation' data-act='add' data-id='".$t['id']."'>增加下级</a> 
									<a class='single_operation' data-act='modify' data-id='".$t['id']."'>修改</a> 
									<a class='single_operation' data-act='del' data-id='".$t['id']."'>删除</a>
								</div>
								<div  class='fly-col-2  fly-fr fly-tr'><input type='text' name='sort[]'  data-id='".$t['id']."' value='".$t['sort']."' class='form-control w100 treeSort'/></div>
							</div>
						  </li>";
			} else {
				$html .= "<li><div class='fly-row lines'>
								<lable class='fly-col-1'>[+]</lable>
								<div  class='fly-col-5'>".$kg."<input type='text' name='name[]'  data-id='".$t['id']."' value='".$t['name']."' class='form-control w150 treeName'/></div>
								<div  class='fly-col-2  fly-fr fly-tr'>
									<a class='single_operation' data-act='power' data-id='".$t['id']."'>权限维护</a>
									<a class='single_operation' data-act='add' data-id='".$t['id']."'>增加下级</a> 
									<a class='single_operation' data-act='modify' data-id='".$t['id']."'>修改</a> 
									<a class='single_operation' data-act='del' data-id='".$t['id']."'>删除</a>
								</div>
								<div class='fly-col-2  fly-fr fly-tr'><input type='text' name='sort[]'  data-id='".$t['id']."' value='".$t['sort']."' class='form-control w100 treeSort'/></div>
							</div>
							";
				$html .= $this->getTreeHtml( $t[ 'children' ] );
				$html .= "</li>";
			}
		}
		return $html ? '<ul>' . $html . '</ul>': $html;
	}

	
	//输出树形参数,+栏目下面的方法
	function getTreeChecked($tree,$role) {
		$html = '';
		$role_menu =explode(',',$role["SYS_MENU"]);
		$role_method =explode(',',$role["SYS_METHOD"]);
		foreach ( $tree as $t ) {
			$kg="";
			for($x=1;$x<$t['level'];$x++) {
				$kg .="<i class='fly-fl'>|—</i>";
			}
			$checked=in_array($t['id'],$role_menu)?"checked":"";
			
			//if ( $t[ 'children' ] == '' ) { //修改判断为空
			if ( empty($t[ 'children' ]) ) {
				$method=$this->L('sysmanage/Method')->method_arr_checkbox($t['id'],$role_method);
				$html .= "<li><div class='fly-row lines'>
								<i class='fly-fl'>&nbsp;</i>
								<div  class='fly-col-8'>
									".$kg."<input type='checkbox' name='menuID[]' value='".$t['id']."'  class='children_method' ".$checked."> ".$t['text']."&nbsp;&nbsp;&nbsp;".$method."
								</div>
							</div>
						  </li>";
			} else {
				$html .= "<li><div class='fly-row lines'>
								<lable class='fly-col-1'>[+]</lable>
								<div  class='fly-col-8'>".$kg."<input type='checkbox' name='menuID[]' value='".$t['id']."' class='children_menu' ".$checked."> ".$t['text']."</div>		
							</div>
							";
				$html .= $this->getTreeChecked( $t[ 'children' ] ,$role);
				$html .= "</li>";
			}
		}
		return $html ? '<ul>' . $html . '</ul>': $html;
	}
	
	//权限选择带回
	function role_check_power(){
		$role_id=$this->_REQUEST("role_id");
		$list =$this->menu->menu_check_list();
		$tree =$this->getTree($list, 0 );
		$role = $this->role_get_one($role_id);
		$role =(!empty($role))?$role:array('SYS_MENU'=>'0','SYS_METHOD'=>'0',);
		$treeHtml=$this->getTreeChecked($tree,$role);
		$smarty = $this->setSmarty();
		$smarty->assign( array( "treeHtml" => $treeHtml,'role_id'=>$role_id) );
		$smarty->display( 'sysmanage/role_check_power.html' );
	}
	//权限保存
	function role_check_power_save(){
		$role_id=$this->_REQUEST("role_id");
		$menuID=$this->_REQUEST("menuID");
		$methodID=$this->_REQUEST("methodID");
		$menu_txt	= is_array($menuID)?implode(',',$menuID):0;
		$method_txt	= is_array($methodID)?implode(',',$methodID):0;
		
		$this->C($this->cacheDir)->delete('fly_sys_power',"master='role' and master_value='$role_id'");//删除菜和方法

		$into_menu_data=array(
			'master'=>'role',
			'master_value'=>$role_id,
			'access'=>'SYS_MENU',
			'access_value'=>$menu_txt,
		);
		$this->C($this->cacheDir)->insert('fly_sys_power',$into_menu_data);
		
		$into_method_data=array(
			'master'=>'role',
			'master_value'=>$role_id,
			'access'=>'SYS_METHOD',
			'access_value'=>$method_txt,
		);
		$this->C($this->cacheDir)->insert('fly_sys_power',$into_method_data);
		$this->L("Common")->ajax_json_success("操作成功");	
	}	

	public function role_show() {
		$list =$this->role();
		$tree =$this->getTree($list, 0 );
		$treeHtml=$this->getTreeHtml($tree);
		$smarty = $this->setSmarty();
		$smarty->assign( array( "treeHtml" => $treeHtml) );
		$smarty->display( 'sysmanage/role_show.html' );
	}
	
	//增加角色
	public function role_add(){
		$role_id = $this->_REQUEST("role_id");
		if(empty($_POST)){
			$menu		=$this->menu_power_check();
			$parentID	=$this->role_select_tree("parentID",$role_id);
			$smarty		=$this->setSmarty();
			$smarty->assign(array("parentID"=>$parentID));
			$smarty->display('sysmanage/role_add.html');	
		}else{
			$name	 = $this->_REQUEST("name");
			$parentID= $this->_REQUEST("parentID");
			$sort	 = $this->_REQUEST("sort");
			$visible = $this->_REQUEST("visible");
			$intro	 = $this->_REQUEST("intro");
			
			$sql= "insert into fly_sys_role(name,parentID,sort,visible,intro) 
								values('$name','$parentID','$sort','$visible','$intro')";
			$this->C($this->cacheDir)->update($sql);
			$this->L("Common")->ajax_json_success("操作成功");
		}
	}
	
	//更新权限表
	public function role_modify(){
		$role_id	 = $this->_REQUEST("role_id");
		if(empty($_POST)){
			$sql 		= "select * from fly_sys_role where id='$role_id'";
			$one 		= $this->C($this->cacheDir)->findOne($sql);	
			$parentID	=$this->role_select_tree("parentID",$one['parentID']);
			$smarty  	= $this->setSmarty();
			$smarty->assign(array("one"=>$one,"parentID"=>$parentID));//框架变量注入同样适用于smarty的assign方法
			$smarty->display('sysmanage/role_modify.html');	
		}else{
			$name	 = $this->_REQUEST("name");
			$parentID= $this->_REQUEST("parentID");
			$sort	 = $this->_REQUEST("sort");
			$visible = $this->_REQUEST("visible");
			$intro	 = $this->_REQUEST("intro");
	
			$sql="update fly_sys_role set name='$name',
											parentID='$parentID',
											sort='$sort',
											visible='$visible',
											intro='$intro'
				  where id='$role_id'";	
			$this->C($this->cacheDir)->update($sql);
			$this->L("Common")->ajax_json_success("操作成功");		
		}
	}	
	
	public function role_del(){
		$role_id=$this->_REQUEST("role_id");
		$sqlstr1 = "delete from fly_sys_role where id in ($role_id)";	
		$sqlstr2 = "delete from fly_sys_power where master_value in ($role_id) and master='role'";										
		$this->C($this->cacheDir)->begintrans();
		if($this->C($this->cacheDir)->update($sqlstr1)<0 || $this->C($this->cacheDir)->update($sqlstr2)<0 ){
			$this->C($this->cacheDir)->rollback();
		}
		$this->C($this->cacheDir)->commit();
		$this->L("Common")->ajax_json_success("操作成功");	
	}		

	//系统栏目和权限列表
	public function menu_power_check($id=null){
		$list 	   = $this->L("sysmanage/Menu")->menu_tree_arr();
		$method	   = $this->L("sysmanage/Method")->method_arr();
		$role_menu = array();
		$role_mod  = array();
		if($id){
			$result = $this->role_get_one($id);
			$role_menu =explode(',',$result["SYS_MENU"]); 
			$role_mod  =explode(',',$result["SYS_METHOD"]); 
		}
		$string  = "<table width=\"100%\"  border='0' cellpadding='5' cellspacing='0' class='table table-bordered'>";
		$string .= "<tr bgcolor='#FBF5C6' height='25'><td>栏目</td><td>菜单</td></tr>";
		$cnt	 = 1;
		if(is_array($list)){
			foreach($list as $key=>$row1){
				$ischeck1=in_array($row1["id"],$role_menu)?"checked":"";
				$string .="<tr><td width='10%'>".$row1["name"]."<input type='checkbox' name='menuID[]' value='".$row1["id"]."' $ischeck1 id='".$row1["id"]."' onclick='checkedStatus(this.id);'></td><td id='sub".$row1["id"]."'>" ;
					foreach($row1["parentID"] as $item_key=>$row2){
						$bgcolor =($cnt%2==0)?"#FBF5C6":"#F9F9F9";
						$ischeck2=in_array($row2["id"],$role_menu)?"checked":"";
						$string .= "<table width=\"100%\" cellpadding='5' cellspacing='0'><tr  bgcolor='$bgcolor'><td width='15%' style='padding-left:10px;'><input type='checkbox' name='menuID[]' value='".$row2["id"]."' $ischeck2 id='".$row2["id"]."'  onclick='checkedStatus(this.id);'> ".$row2["name"]."</td><td id='sub".$row2["id"]."'>";	
							foreach($row2["parentID"] as $item_key=>$row3){
								$ischeck3=in_array($row3["id"],$role_menu)?"checked":"";
								$string .= "<table  width=\"100%\" cellpadding='5' cellspacing='0'><tr><td width='20%' height='25'><input type='checkbox' name='menuID[]' value='".$row3["id"]."' $ischeck3 id='".$row3["id"]."'  onclick='checkedStatus(this.id);'> ".$row3["name"]."</td><td id='sub".$row3["id"]."' align=left>";	
									if( @is_array($method[$row3["id"]]) ){
										$string .= "<table cellpadding='5' cellspacing='0'><tr>";
										foreach( $method[$row3["id"]] as $mkey=>$mvalue){
											$ischeck4=in_array($mkey,$role_mod)?"checked":"";
											$string .= "<td width='100' height='25'><input type='checkbox' name='methodID[]' value='$mkey' $ischeck4 > $mvalue </td>";
										}
										$string .= "</td></tr></table>";	
									}
									
								$string .= "</td></tr></table>";			
							}							
						$cnt++;	
						$string .= "</td></tr></table>";		
					}
				$string .= "</td></tr>";			
			}
			$string .= "</table>";
		}
		return $string;	
	}
	
	//查询一条记录
	public function role_get_one($id){
		$power =array();
		$sql  = "select access,access_value from fly_sys_power where master='role' and master_value='$id' ";
		$list =$this->C($this->cacheDir)->findAll($sql);//查询结果为二维数组，需foreach循环
		if(is_array($list)){
			foreach($list as $key=>$row){
				$power[$row['access']] = $row["access_value"];
			}
		}	
		return $power;	
	}
/*	public function role_table_tree($sid =""){
			$tree	 = _instance('Extend/Tree');
			$sql	 = "select * from fly_sys_role  order by sort asc;";	
			$list	 = $this->C($this->cacheDir)->findAll($sql);	
			$tree->tree($list);	
			return $tree->get_tree(0, "<tr target='sid_user' rel='\$id'><td><input name='ids' value='\$id' type='checkbox'></td><td>\$id</td><td> \$sort</td> <td>\$spacer \$name</td><td> \$intro</td> <td><a href='".ACT."/sysmanage/Role/role_modify/id/\$id/' class='btn btn-info btn-xs'><i class='fa fa-paste'></i> 修改</a>&nbsp;
                  	<a href='".ACT."/sysmanage/Role/role_del/id/\$id/' class='btn btn-danger btn-xs'><i class='fa fa-remove'></i> 删除</a></td></tr>", 0, '' , "");
	}	*/
	
	//下拉选择
	public function role_select_tree($tag,$sid =""){
		$sql	="select * from fly_sys_role  order by sort asc;";	
		$list	=$this->C($this->cacheDir)->findAll($sql);	
		$tree 	=$this->L( "Tree" ,$list);
		$parentID  = "<select name=\"$tag\" class=\"form-control m-b\">";
		$parentID .= "<option value='0' >请您选择</option>";
		$parentID .= $tree->get_tree(0, "<option value='\$id' \$selected>\$spacer\$name</option>\n", $sid , '' , "");
		$parentID .="</select>";	
		return $parentID;
	}	
	
/*	public function role_arr(){
		$rtArr  =array();
		$sql	="select id,name from fly_sys_role";
		$list	=$this->C($this->cacheDir)->findAll($sql);
		if(is_array($list)){
			foreach($list as $key=>$row){
				$rtArr[$row["id"]]=$row["name"];
			}
		}
		return $rtArr;
	}	*/	
	//排序
	public function role_modify_sort() {
		$id		=$this->_REQUEST('id');	
		$sort	=$this->_REQUEST('sort');	
		$upt_data=array(
					'sort'=>$this->_REQUEST( "sort" )
				 );
		$this->C( $this->cacheDir )->modify('fly_sys_role',$upt_data,"id='$id'",true);
		$this->L("Common")->ajax_json_success("操作成功");	
	}
	//修改名称
	public function role_modify_name() {
		$id		=$this->_REQUEST('id');	
		$name	=$this->_REQUEST('name');	
		$upt_data=array(
					'name'=>$this->_REQUEST( "name" )
				 );
		$this->C( $this->cacheDir )->modify('fly_sys_role',$upt_data,"id='$id'",true);
		$this->L("Common")->ajax_json_success("操作成功");	
	}

	//得到传入ID的子类
	public function role_get_child($pid=1){
		$data =$this->role();
		$tree =$this->L('Tree');
		$child=$tree->get_all_child($data,$pid);
		return $child;
	}
	
}//
?>