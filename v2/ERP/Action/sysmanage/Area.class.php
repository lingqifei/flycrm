<?php
/*
 *
 * sysmanage.Area  地区管理登录   
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
class Area extends Action{	
	private $cacheDir='';//缓存目录
	private $tree='';//数形
	
	public function area() {
		$sql	= "select * from fly_sys_area  where visible='1' order by sort asc;";
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
				$v[ 'treename' ] = str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;', $level).'|--'.$v['name'];
				$tree[] = $v;
			}
		}
		return $tree;
	}
	
	//输出树形参数
	function getTreeHtml($tree) {
		$html = '';	
		if(!empty($tree)){
			foreach ( $tree as $key=>$t ) {
				$kg="";
				for($x=1;$x<$t['level'];$x++) {
					$kg .="<i class='fly-fl'>|—</i>";
				}
				if ( $t[ 'children' ] == '' ) {
					$html .= "<li><div class='fly-row lines'>
									<i class='fly-fl'>&nbsp;</i>
									<div  class='fly-col-5'>".$kg."<input type='text' name='name[]'  data-id='".$t['id']."' value='".$t['name']."' class='form-control w150 treeName'/></div>

									<div  class='fly-col-2 fly-fr fly-tr'>
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
		}
		return $html ? '<ul>' . $html . '</ul>': $html;
	}
	//输出树形参数
	function getTreeSelect($tree,$sid) {
		$html = '';	
		if(!empty($tree)){
			foreach ( $tree as $key=>$t ) {
				$selected=($t['id']==$sid)?"selected":"";
				if ( $t[ 'children' ] == '' ) {
					$html .="<option value='".$t['id']."' $selected>".$t['treename']."</option>";
				} else {
					$html .="<option value='".$t['id']."' $selected>".$t['treename']."</option>";
					$html .= $this->getTreeSelect( $t[ 'children' ],$sid);
				}
			}
		}
		return $html;
	}
	
	//输出树形参数
	function getTreeSelectHtml($optid,$sid=0) {
		$list =$this->area();
		$tree =$this->getTree($list, 0);
		$html = "<select name='$optid' id='$optid' class=\"form-control\"><option value='0'>请选择部门</option>";	
		$html .=$this->getTreeSelect($tree,$sid);
		$html .="</select>";
		return $html;
	}
	public function area_show() {
		$list =$this->area();
		$tree =$this->getTree($list, 0);
		$treeHtml=$this->getTreeHtml($tree);
		$smarty = $this->setSmarty();
		$smarty->assign( array( "treeHtml" => $treeHtml) );
		$smarty->display( 'sysmanage/area_show.html' );
	}	
	
	public function area_add(){
		if(empty($_POST)){
			$pid=$this->_REQUEST('pid');
			$parentID=$this->getTreeSelectHtml('parentID',$pid);
			$smarty	= $this->setSmarty();
			$smarty->assign(array("parentID"=>$parentID));//框架变量注入同样适用于smarty的assign方法
			$smarty->display('sysmanage/area_add.html');	
		}else{
			$name	 = $this->_REQUEST("name");
			$parentID= $this->_REQUEST("parentID");
			$sort	 = $this->_REQUEST("sort");
			$visible = $this->_REQUEST("visible");
			$intro	 = $this->_REQUEST("intro");			
			$data=array(
					'name'=>$name,
					'parentID'=>$parentID,
					'sort'=>$sort,
					'visible'=>$visible,
					'intro'=>$intro
					   );
			$this->C( $this->cacheDir )->insert('fly_sys_area',$data );
			$this->L("Common")->ajax_json_success("操作成功");	
		}
	}
	
	public function area_modify(){
		$id	 = $this->_REQUEST("id");
		if(empty($_POST)){
			$sql 		= "select * from fly_sys_area where id='$id'";
			$one 		= $this->C($this->cacheDir)->findOne($sql);	
			$parentID	= $this->getTreeSelectHtml('parentID',$one["parentID"]);
			$smarty  	= $this->setSmarty();
			$smarty->assign(array("one"=>$one,"parentID"=>$parentID));//框架变量注入同样适用于smarty的assign方法
			$smarty->display('sysmanage/area_modify.html');	
		}else{
			$name	 = $this->_REQUEST("name");
			$parentID= $this->_REQUEST("parentID");
			$sort	 = $this->_REQUEST("sort");
			$visible = $this->_REQUEST("visible");
			$intro	 = $this->_REQUEST("intro");	
			$data=array(
					'name'=>$name,
					'parentID'=>$parentID,
					'sort'=>$sort,
					'visible'=>$visible,
					'intro'=>$intro
					   );
			$this->C( $this->cacheDir )->modify('fly_sys_area',$data,"id='$id'");
			$this->L("Common")->ajax_json_success("操作成功");			
		}
	}	
	public function area_del(){
		$id=$this->_REQUEST("id");
		$sql="delete from fly_sys_area where id='$id'";
		$this->C($this->cacheDir)->update($sql);	
		$this->L("Common")->ajax_json_success("操作成功");	
	}	
	
	//树形展示
	public function area_table_tree($sid =""){
			$sql	 = "select * from fly_sys_area order by sort asc;";	
			$list	 = $this->C($this->cacheDir)->findAll($sql);	
			$this->tree->tree($list);
			return $this->tree->get_tree(0, "<tr target='sid_user' rel='\$id'><td><input name='ids' value='\$id\' type='checkbox'></td><td> \$sort</td> <td>\$spacer \$name</td> <td> \$intro</td> <td><a href='".ACT."/sysmanage/Area/area_modify/id/\$id/' class='btn btn-info btn-xs'><i class='fa fa-paste'></i> 修改</a>&nbsp;
                  	<a href='".ACT."/sysmanage/Area/area_del/id/\$id/' class='btn btn-danger btn-xs'><i class='fa fa-remove'></i> 删除</a></tr>", 0, '' , "");
	}	
	//树形下拉
	public function area_select_tree($tag,$sid =""){
			$tree	 = _instance('Extend/Tree');
			$sql	 = "select * from fly_sys_area order by sort asc;";	
			$list	 = $this->C($this->cacheDir)->findAll($sql);	
			$tree->tree($list);	
			$parentID  = "<select name=\"$tag\"  class=\"form-control\">";
			$parentID .= "<option value='0' >请选择地区</option>";
			$parentID .= $tree->get_tree(0, "<option value='\$id' \$selected>\$spacer\$name</option>\n", $sid , '' , "");
			$parentID .="</select>";	
			return $parentID;
	}
	//将数组转化为树形数组
	public function arrToTree($data,$pid){
		$tree = array();
		foreach($data as $k => $v){
			if($v['parentID'] == $pid){
				$v['parentID'] = $this->arrToTree($data,$v['id']);
				$tree[] = $v;
			}
		}        
		return $tree;
	}
	//左边菜单栏输出
	public function outToHtml($tree){
		$html = '';
		foreach($tree as $t){
			if(empty($t['parentID'])){
				$html .= "<li><a href=\"javascript:\" onclick=\"$.bringBack({id:'$t[id]',name:'$t[name]'})\">$t[name]</a></li>";
			}else{
				$html .="<li><a href=\"javascript:\" onclick=\"$.bringBack({id:'$t[id]',name:'$t[name]'})\">$t[name]</a><ul>";
				$html .= $this->outToHtml($t['parentID']);
				$html = $html."</ul></li>";
			}
		} 
		return $html;
	}
	public function area_arr(){
		$rtArr  =array();
		$sql	="select id,name from fly_sys_area";
		$list	=$this->C($this->cacheDir)->findAll($sql);
		if(is_array($list)){
			foreach($list as $key=>$row){
				$rtArr[$row["id"]]=$row["name"];
			}
		}
		return $rtArr;
	}
	public function area_search(){
		$sql	="select * from fly_sys_area order by sort asc;";	
		$list	=$this->C($this->cacheDir)->findAll($sql);
		$data	=$this->arrToTree($list,0);
		$type	=$this->outToHtml($data);
		$smarty  = $this->setSmarty();
		$smarty->assign(array("type"=>$type));//框架变量注入同样适用于smarty的assign方法
		$smarty->display('sysmanage/area_search.html');	
	}
	//传入ID返回名字
	public function area_get_name($id){
		if(empty($id)) $id=0;
		$sql  ="select id,name from fly_sys_area where id in ($id)";	
		$list =$this->C($this->cacheDir)->findAll($sql);
		$str  ="";
		if(is_array($list)){
			foreach($list as $row){
				$str .= "|-".$row["name"]."&nbsp;";
			}
		}
		return $str;
	}
	//排序
	public function area_modify_sort() {
		$id		=$this->_REQUEST('id');	
		$sort	=$this->_REQUEST('sort');	
		$upt_data=array(
					'sort'=>$this->_REQUEST( "sort" )
				 );
		$this->C( $this->cacheDir )->modify('fly_sys_area',$upt_data,"id='$id'",true);
		$this->L("Common")->ajax_json_success("操作成功");	
	}
	//修改名称
	public
	function area_modify_name() {
		$id		=$this->_REQUEST('id');	
		$name	=$this->_REQUEST('name');	
		$upt_data=array(
					'name'=>$this->_REQUEST( "name" )
				 );
		$this->C( $this->cacheDir )->modify('fly_sys_area',$upt_data,"id='$id'",true);
		$this->L("Common")->ajax_json_success("操作成功");
	}
}//
?>