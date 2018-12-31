<?php
/*
 * 后台系统配置管理类
 *
 */	

class SysConfig extends Action{	
	
	private $cacheDir='';//缓存目录
	public function __construct() {
		 _instance('Action/sysmanage/Auth');
	}
	
	//得到系统配置参数
	public function sys_info(){
		$sql 	= "select * from fly_sys_config order by id asc;";
		$list	= $this->C($this->cacheDir)->findAll($sql);
		foreach($list as $key=>$row){
			$string='';
			if($row['type']=='bool'){
				$string .="<input type='radio' name='".$row['varname']."' vlaue='1'> 是";
				$string .="<input type='radio' name='".$row['varname']."' vlaue='0'> 否";
			}elseif($row['type']=='string'){
				$string .="<input type='text' name='".$row['varname']."' value='".$row['value']."' class=\"form-control\">";
			}elseif($row['type']=='number'){
				$string .="<input type='text' name='".$row['varname']."' value='".$row['value']."' class=\"form-control\">";
			}elseif($row['type']=='bstring'){
				$string .="<textarea name='".$row['varname']."' cols='100' rows='5' class=\"form-control\">".$row['value']."</textarea>";
			}
			$list[$key]["namevalue"]=$string;
		}
		return $list;		
	}
	//得到系统配置参数
	public function sys_conf(){
		$sql 	= "select varname,value from fly_sys_config;";
		$list	= $this->C($this->cacheDir)->findAll($sql);
		foreach($list as $key=>$row){
			$rtn[$row['varname']]=$row['value'];
		}
		return $rtn;
	}
	//系统常规设置
	public function sys_config(){
		if(empty($_POST)){
			$list  = $this->sys_info();
			$smarty = $this->setSmarty();
			$smarty->assign(array("list"=>$list));
			$smarty->display('sysmanage/sys_config.html');					
		}else{
			foreach($_POST as $key=>$v){
				$sql="update fly_sys_config set value='".$v."' where varname='".$key."'";
				$this->C($this->cacheDir)->update($sql);
			}
			$this->location('操作成功',"sysmanage/SysConfig/sys_config/");
			//$this->L("Common")->ajax_json_success("操作成功",'1',"/sysmanage/sysconfig/SysConfig/sys_config/");
		}
	}
	
	//系统常规设置
	public function sys_config_add(){
		if(empty($_POST)){
			$smarty = $this->setSmarty();
			$smarty->display('sysmanage/sysconfig/sys_config_add.html');					
		}else{
			$sql="select * from fly_sys_config where varname='$_POST[varname]';";
			$one=$this->C($this->cacheDir)->findOne($sql);
			if(empty($one)){
				$sql="insert into fly_sys_config(varname,name,value,type)
						values('$_POST[varname]','$_POST[name]','$_POST[value]','$_POST[type]')";
				$this->C($this->cacheDir)->update($sql);	
				$this->L("Common")->ajax_json_success("操作成功",'1',"/sysmanage/sysconfig/SysConfig/sys_config/");
			}else{
				$this->L("Common")->ajax_json_error("输出的变量名称已经存在");
			}
		}
	}
	
}//end class
?>