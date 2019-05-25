<?php
/*
 *
 * sysmanage.Menu  后台菜单管理   
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

class Menu extends Action{	
	
	var $common;
	private $cacheDir='';//缓存目录
	private $auth;
	public function __construct() {
		$this->auth=_instance('Action/sysmanage/Auth');
	}
	public function menu(){
		$sql	= "select *,name as text,id as tags  from fly_sys_menu order by sort asc,id desc";	
		$list	= $this->C($this->cacheDir)->findAll($sql);
		return $list;
	}
	public function menu_check_list(){
		$sql	= "select *,name as text,id as tags  from fly_sys_menu where visible='1' order by sort asc,id desc";	
		$list	= $this->C($this->cacheDir)->findAll($sql);
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
		foreach ( $tree as $t ) {
			$kg="";
			for($x=1;$x<$t['level'];$x++) {
				$kg .="<i class='fly-fl'>|—</i>";
			}
			if ( $t[ 'children' ] == '' ) {
				$html .= "<li><div class='fly-row lines'>
								<i class='fly-fl'>&nbsp;</i>
								<div  class='fly-col-3'>".$kg."<input type='text' name='name[]'  data-id='".$t['id']."' value='".$t['name']."' class='form-control w150 treeName'/></div>
								
								<div  class='fly-col-2 fly-fr fly-tr'>
									<a class='single_operation' data-act='add' data-id='".$t['id']."'>增加下级</a> 
									<a class='single_operation' data-act='modify' data-id='".$t['id']."'>修改</a> 
									<a class='single_operation' data-act='del' data-id='".$t['id']."'>删除</a>
								</div>
								<div class='fly-col-1  fly-fr fly-tr'>
									<input type='text' name='visible[]'  data-id='".$t['id']."' value='".$t['visible']."' class='form-control w50 treeVisible' title='是否启用0=不启用，1=启用'/>
								</div>
								<div class='fly-col-1  fly-fr fly-tr'>
									<input type='text' name='sort[]'  data-id='".$t['id']."' value='".$t['sort']."' class='form-control w50 treeSort' title='排序'/>
								</div>
								<div class='fly-col-4  fly-fr fly-tl'><input type='text' name='url[]'  data-id='".$t['id']."' value='".$t['url']."' class='form-control w200 treeUrl'/></div>
							</div>
						  </li>";
			} else {
				$html .= "<li><div class='fly-row lines'>
								<lable class='fly-col-1'>[+]</lable>
								<div  class='fly-col-3'>".$kg."<input type='text' name='name[]'  data-id='".$t['id']."' value='".$t['name']."' class='form-control w150 treeName'/></div>
								<div  class='fly-col-2  fly-fr fly-tr'>
									<a class='single_operation' data-act='add' data-id='".$t['id']."'>增加下级</a> 
									<a class='single_operation' data-act='modify' data-id='".$t['id']."'>修改</a> 
									<a class='single_operation' data-act='del' data-id='".$t['id']."'>删除</a>
								</div>
								<div class='fly-col-1  fly-fr fly-tr'>
									<input type='text' name='visible[]'  data-id='".$t['id']."' value='".$t['visible']."' class='form-control w50 treeVisible' title='是否启用0=不启用，1=启用'/>
								</div>								
								<div class='fly-col-1  fly-fr fly-tr'>
									<input type='text' name='sort[]'  data-id='".$t['id']."' value='".$t['sort']."' class='form-control w50 treeSort' title='排序'/>
								</div>
								<div class='fly-col-4  fly-fr fly-tl'><input type='text' name='url[]'  data-id='".$t['id']."' value='".$t['url']."' class='form-control w200 treeUrl'/></div>
							</div>
							";
				$html .= $this->getTreeHtml( $t[ 'children' ] );
				$html .= "</li>";
			}
		}
		return $html ? '<ul>' . $html . '</ul>': $html;
	}
	
	//得到数形参数,针对bootstrop
	function leftTree( $data, $pId=0,$level=0) {
		$tree = '';
		foreach ( $data as $k => $v ) {
			if ( $v[ 'parentID' ] == $pId ) { //父亲找到儿子
				$v[ 'nodes' ] = $this->leftTree( $data, $v[ 'id' ], $level + 1);
				$v[ 'level' ] = $level + 1;
				$tree[] = $v;
			}
		}
		return $tree;
	}	
	//boot tree格式输出
	public function menu_left_json(){
		$sql = "select *,name as text,id as tags  from fly_sys_menu where visible='1'  order by sort asc";	
		$list= $this->C($this->cacheDir)->findAll($sql);
		$list=$this->leftTree($list);
		echo json_encode($list);
	}
	//栏目显示
	public function menu_show() {
		$list =$this->menu();
		$tree =$this->getTree($list, 0 );
		$treeHtml=$this->getTreeHtml($tree);
		$smarty = $this->setSmarty();
		$smarty->assign( array( "treeHtml" => $treeHtml) );
		$smarty->display( 'sysmanage/menu_show.html' );
	}	
	//添加 
	public function menu_add(){
		$id	 = $this->_REQUEST("id");
		if(empty($_POST)){
			$parentID =$this->menu_select_tree("parentID",$id);
			$smarty  = $this->setSmarty();
			$smarty->assign(array("parentID"=>$parentID));//框架变量注入同样适用于smarty的assign方法
			$smarty->display('sysmanage/menu_add.html');	
		}else{
			$into_data=array(
						'name'=>$this->_REQUEST( "name" ),
						'url'=>$this->_REQUEST( "url" ),
						'parentID'=>$this->_REQUEST( "parentID" ),
						'sort'=>$this->_REQUEST( "sort" ),
						'visible'=>$this->_REQUEST( "visible" )
					 );
			$this->C( $this->cacheDir )->insert('fly_sys_menu',$into_data);
			$this->L("Common")->ajax_json_success("操作成功");
		}
	}
	//修改
	public function menu_modify(){
		$id	 = $this->_REQUEST("id");
		if(empty($_POST)){
			$sql 		= "select * from fly_sys_menu where id='$id'";
			$one 		= $this->C($this->cacheDir)->findOne($sql);	
			$parentID	= $this->menu_select_tree("parentID",$one["parentID"]);
			$smarty  	= $this->setSmarty();
			$smarty->assign(array("one"=>$one,"parentID"=>$parentID));
			$smarty->display('sysmanage/menu_modify.html');	
		}else{
			$upt_data=array(
						'name'=>$this->_REQUEST( "name" ),
						'url'=>$this->_REQUEST( "url" ),
						'parentID'=>$this->_REQUEST( "parentID" ),
						'sort'=>$this->_REQUEST( "sort" ),
						'visible'=>$this->_REQUEST( "visible" )
					 );
			$this->C( $this->cacheDir )->modify('fly_sys_menu',$upt_data,"id='$id'",true);
			$this->L("Common")->ajax_json_success("操作成功");
		}
	}
	//删除
	public function menu_del(){
		$id=$this->_REQUEST("id");
		$sql="delete from fly_sys_menu where id in($id)";
		$this->C($this->cacheDir)->update($sql);	
		$this->location("操作成功","/sysmanage/Menu/menu_show/");	
	}	
	

	//将数组转化为树形数组
	public function arrToTree($data,$pid){
		//echo $pid;
		$tree = array();
		foreach($data as $k => $v){
			if($v['parentID'] == $pid){
				$v['parentID'] = $this->arrToTree($data,$v['id']);
				$tree[] = $v;
			}
		}   
		return $tree;
	}
	public
	function menu_select_tree( $tag, $sid = "" ) {
		$sql = "select * from fly_sys_menu order by sort asc;";
		$list = $this->C( $this->cacheDir )->findAll( $sql );
		$tree =$this->L( "Tree" ,$list);
		$parentID = "<select name=\"$tag\" class=\"form-control m-b\">";
		$parentID .= "<option value='0' >请您选择</option>";
		$parentID .= $tree->get_tree( 0, "<option value='\$id' \$selected>\$spacer\$name</option>\n", $sid, '', "" );
		$parentID .= "</select>";
		return $parentID;
	}	
	//左边菜单栏输出
/*	public function outToHtml($tree){
		$html = '';
		foreach($tree as $t){
			if(empty($t['parentID'])){
				$html .= "<li><a href=\"javascript:\" onclick=\"$.bringBack({region:'$t[id]',regionName:'$t[name]'})\">$t[name]</a></li>";
			}else{
				$html .='<li><a href="javascript:">'.$t['name'].'</a><ul>';
				$html .= $this->outToHtml($t['parentID']);
				$html  = $html.'</ul></li>';
			}
		} 
		return $html;
	}	*/
		
	//修改权限时调用
	public function menu_tree_arr(){
		$sql	="select *,name as text,id as tags  from fly_sys_menu  where visible='1' order by sort asc";	
		$list	=$this->C($this->cacheDir)->findAll($sql);
		$data	=$this->arrToTree($list,0);	
		return $data;
	}


	//判断认证时调用
	public function menu_auth_arr(){
		$rtArr  =array();
		$sql	="select id from fly_sys_menu  where visible='1' order by sort asc,id desc ";
		$list	=$this->C($this->cacheDir)->findAll($sql);
		foreach($list as $key=>$v){
			$rtArr[]=$v["id"];
		}
		return $rtArr;
	}		
	//排序
	public
	function menu_modify_sort() {
		$id		=$this->_REQUEST('id');	
		$sort	=$this->_REQUEST('sort');	
		$upt_data=array(
					'sort'=>$this->_REQUEST( "sort" )
				 );
		$this->C( $this->cacheDir )->modify('fly_sys_menu',$upt_data,"id='$id'",true);
		$this->L("Common")->ajax_json_success("操作成功");
	}
	//修改名称
	public
	function menu_modify_name() {
		$id		=$this->_REQUEST('id');	
		$name	=$this->_REQUEST('name');	
		$upt_data=array(
					'name'=>$this->_REQUEST( "name" )
				 );
		$this->C( $this->cacheDir )->modify('fly_sys_menu',$upt_data,"id='$id'",true);
		$this->L("Common")->ajax_json_success("操作成功");
	}
	//修改地址
	public
	function menu_modify_url() {
		$id		=$this->_REQUEST('id');	
		$url	=$this->_REQUEST('url');	
		$upt_data=array(
					'url'=>$this->_REQUEST( "url" )
				 );
		$this->C( $this->cacheDir )->modify('fly_sys_menu',$upt_data,"id='$id'",true);
		$this->L("Common")->ajax_json_success("操作成功");
	}
	//是否启用
	public
	function menu_modify_visible() {
		$id		=$this->_REQUEST('id');	
		$visible	=$this->_REQUEST('visible');	
		$upt_data=array(
					'visible'=>$this->_REQUEST( "visible" )
				 );
		$this->C( $this->cacheDir )->modify('fly_sys_menu',$upt_data,"id='$id'",true);
		$this->L("Common")->ajax_json_success("操作成功");	
	}
}//
?>