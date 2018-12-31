<?php
/*
 * 后台职位管理类
 *
 */	
class Position extends Action{	
	private $cacheDir='';//缓存目录
	private $auth;
	public function __construct() {
		$this->auth=_instance('Action/sysmanage/Auth');
	}	
	
	//获取数据
	public function position(){
		$sql	= "select * from fly_sys_position order by sort asc;";
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
									<a href='".ACT."/sysmanage/Position/position_add/sid/".$t['id']."/'>增加下级</a> 
									<a href='".ACT."/sysmanage/Position/position_modify/id/".$t['id']."/'>修改</a> 
									<a href='".ACT."/sysmanage/Position/position_del/id/".$t['id']."/'>删除</a>
								</div>
								<div  class='fly-col-2  fly-fr fly-tr'><input type='text' name='sort[]'  data-id='".$t['id']."' value='".$t['sort']."' class='form-control w100 treeSort'/></div>
							</div>
						  </li>";
			} else {
				$html .= "<li><div class='fly-row lines'>
								<lable class='fly-col-1'>[+]</lable>
								<div  class='fly-col-5'>".$kg."<input type='text' name='name[]'  data-id='".$t['id']."' value='".$t['name']."' class='form-control w150 treeName'/></div>
								<div  class='fly-col-2  fly-fr fly-tr'>
									<a href='".ACT."/sysmanage/Position/position_add/sid/".$t['id']."/'>增加下级</a> 
									<a href='".ACT."/sysmanage/Position/position_modify/id/".$t['id']."/'>修改</a> 
									<a href='".ACT."/sysmanage/Position/position_del/id/".$t['id']."/'>删除</a>
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

	public
	function position_show() {
		$list =$this->position();
		$tree =$this->getTree($list, 0 );
		$treeHtml=$this->getTreeHtml($tree);
		$smarty = $this->setSmarty();
		$smarty->assign( array( "treeHtml" => $treeHtml) );
		$smarty->display( 'sysmanage/position_show.html' );
	}
	
	public function lookup_tree_html(){
		$sql	="select * from fly_sys_position order by sort asc;";	
		$list	=$this->C($this->cacheDir)->findAll($sql);
		$data	=$this->L("Tree")->arrToTree($list,0);
		$look	=$this->L("Tree")->outToHtml($data);
		$smarty  = $this->setSmarty();
		$smarty->assign(array("lookup_tree_html"=>$look));
		$smarty->display('sysmanage/search.html');	
	}	
	
	public function position_add(){
		if(empty($_POST)){
			$parentID	=$this->position_select_tree("parentID");
			$smarty     = $this->setSmarty();
			$smarty->assign(array("parentID"=>$parentID));//框架变量注入同样适用于smarty的assign方法
			$smarty->display('sysmanage/position_add.html');	
		}else{
			$sql= "insert into fly_sys_position(name,parentID,sort,visible,intro) 
								values('$_POST[name]','$_POST[parentID]','$_POST[sort]','$_POST[visible]','$_POST[intro]');";
			$this->C($this->cacheDir)->update($sql);	
			$this->location("操作成功","/sysmanage/Position/position_show/");		
		}
	}		
	public function position_modify(){
		$id	 = $this->_REQUEST("id");
		if(empty($_POST)){
			$sql 		= "select * from fly_sys_position where id='$id'";
			$one 		= $this->C($this->cacheDir)->findOne($sql);	
			$parentID	= $this->position_select_tree("parentID",$one["parentID"]);
			$smarty  	= $this->setSmarty();
			$smarty->assign(array("one"=>$one,"parentID"=>$parentID));//框架变量注入同样适用于smarty的assign方法
			$smarty->display('sysmanage/position_modify.html');	
		}else{
			$sql= "update fly_sys_position set name='$_POST[name]',
											 parentID='$_POST[parentID]',sort='$_POST[sort]',
											 visible='$_POST[visible]',intro='$_POST[intro]'
					where id='$id'";
			$this->C($this->cacheDir)->update($sql);	
			$this->location("操作成功","/sysmanage/Position/position_show/");			
		}
	}	
	public function position_del(){
		$id=$this->_REQUEST("id");
		$sql="delete from fly_sys_position where id='$id'";
		$this->C($this->cacheDir)->update($sql);	
		$this->location("操作成功","/sysmanage/Position/position_show/");	
	}	
	
	public function position_table_tree($sid =""){
			$tree	 = _instance('Extend/Tree');
			$assArr  = $this->position();
			$sql	 = "select * from fly_sys_position  order by sort asc;";	
			$list	 = $this->C($this->cacheDir)->findAll($sql);	
			$tree->tree($list);	
			return $tree->get_tree(0, "<tr target='sid_user' rel='\$id'><td><input name='ids' value='\$id' type='checkbox'></td><td>\$id</td><td> \$sort</td><td>\$spacer \$name</td> <td> \$intro</td> <td><a href='".ACT."/sysmanage/Position/position_modify/id/\$id/' class='btn btn-info btn-xs'><i class='fa fa-paste'></i> 修改</a>&nbsp;
                  	<a href='".ACT."/sysmanage/Position/position_del/id/\$id/' class='btn btn-danger btn-xs'><i class='fa fa-remove'></i> 删除</a></td></tr>", 0, '' , "");
			
	}
	public function position_select_tree($tag,$sid =""){
			$tree	 = _instance('Extend/Tree');
			$sql	 = "select * from fly_sys_position  order by sort asc;";	
			$list	 = $this->C($this->cacheDir)->findAll($sql);	
			$tree->tree($list);	
			$parentID  = "<select name=\"$tag\" class=\"form-control m-b\">";
			$parentID .= "<option value='0' >请您选择</option>";
			$parentID .= $tree->get_tree(0, "<option value='\$id' \$selected>\$spacer\$name</option>\n", $sid , '' , "");
			$parentID .="</select>";	
			return $parentID;
	}	
	public function position_arr(){
		$rtArr  =array();
		$sql	="select id,name from fly_sys_position";
		$list	=$this->C($this->cacheDir)->findAll($sql);
		if(is_array($list)){
			foreach($list as $key=>$row){
				$rtArr[$row["id"]]=$row["name"];
			}
		}
		return $rtArr;
	}
	//排序
	public
	function position_modify_sort() {
		$id		=$this->_REQUEST('id');	
		$sort	=$this->_REQUEST('sort');	
		$upt_data=array(
					'sort'=>$this->_REQUEST( "sort" )
				 );
		$this->C( $this->cacheDir )->modify('fly_sys_position',$upt_data,"id='$id'",true);
		$rtnArr=array('rtnstatus'=>'success','msg'=>'');
		echo json_encode($rtnArr);
	}
	//修改名称
	public
	function position_modify_name() {
		$id		=$this->_REQUEST('id');	
		$name	=$this->_REQUEST('name');	
		$upt_data=array(
					'name'=>$this->_REQUEST( "name" )
				 );
		$this->C( $this->cacheDir )->modify('fly_sys_position',$upt_data,"id='$id'",true);
		$rtnArr=array('rtnstatus'=>'success','msg'=>'');
		echo json_encode($rtnArr);
	}	
}//
?>