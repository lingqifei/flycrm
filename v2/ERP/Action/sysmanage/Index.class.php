<?php
/*
 * 后台管理入口类
 *
 */	
class Index extends Action{	
	private $cacheDir='';//缓存目录
	private $auth;
	public function __construct() {
		$this->auth=_instance('Action/sysmanage/Auth');
	}	
	public function main(){
		$menu_arr	= $this->auth->auth_menu_tree_arr();
		$sysinfo	= $this->L('sysmanage/Sys')->get_sys_info();
/*		if(empty($serial)){
			$sysinfo=array_merge($sysinfo, $this->auth->sys_default_conf());
		}*/
		$smarty   = $this->setSmarty();
		$smarty->assign(array("menu"=>$menu_arr,'sys'=>$sysinfo,'sys_account'=>SYS_USER_ACC));
		$smarty->display('index.html');	
	}
	public function index(){
		$smarty   = $this->setSmarty();
		$smarty->display('sysmanage/index.html');	
	}	
	//得到系统配置参数
	public function get_sys_config(){
		$sql 	= "select * from fly_sys_config;";
		$list	= $this->C($this->cacheDir)->findAll($sql);
		
		if(is_array($list)){
			foreach($list as $key=>$row){
				$assArr[$row["name"]] = $row["value"];
			}
		}
		return $assArr;		
	}

	public function sys_menu(){
		$smarty  = $this->setSmarty();
		//$smarty->assign($article);//框架变量注入同样适用于smarty的assign方法
		$smarty->display('sys_menu.html');	
	}
}//
?>