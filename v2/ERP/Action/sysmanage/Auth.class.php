<?php
/*
 *
 * sysmanage.Auth  后台权限验证  
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
class Auth extends Action {

	private $cacheDir = ''; //缓存目录

	public function __construct() {
		$this->check_login();//检查是否登录
		$this->authorization();//检查用户动作是否在授权范围之类
		@define( 'SYS_USER_ACCOUNT', $_SESSION[ "CRM" ][ "USER" ][ "account" ] ); //当前登录帐号名
		@define( 'SYS_USER_ID', $_SESSION[ "CRM" ][ "USER" ][ "userID" ] ); //当前登录帐号ID
		@define( 'SYS_USER_SUB_ID', $_SESSION[ "CRM" ][ "USER" ][ "viewID" ] ); //本部门及下属用户
		@define( 'SYS_USER_VIEW', $_SESSION[ "CRM" ][ "USER" ][ "viewID" ] ); //定义查看的权限
		@define( 'SYS_CO_ID', '1' ); //定义所属于公司编号
	}


	//检查是否有登录
	public function check_login() {
		if(isset($_SESSION[ "CRM" ][ "USER" ][ "userID" ])){
			if ( empty($_SESSION[ "CRM" ][ "USER" ][ "userID" ])) {
				$this->location( "请登录", '/sysmanage/Login/login');
			}			
		}else{
			$this->location( "请登录", '/sysmanage/Login/login');
		}
	}

	//判断是有执行方法的权限
	public function authorization() {
		if ( isset( $_SESSION[ "CRM" ][ "NEED" ][ "method" ] ) ) {
			if ( in_array( METHOD_NAME, $_SESSION[ "CRM" ][ "NEED" ][ "method" ] ) ) {
				if ( !in_array( METHOD_NAME, $_SESSION[ "CRM" ][ "USER" ][ "method" ] ) ) {
					$smarty = $this->setSmarty();
					$smarty->display( '404.html' );
					exit;
				}
			}
		}
	}

	//得需要验证的栏目和方法
	//返回：array("1",3,5,5) array('add',modify,del...);
	public function auth_menu_tree_arr() {
		$menu = $_SESSION[ "CRM" ][ "USER" ][ "menustr" ];
		if ( !empty( $menu ) ) {
			$sql = "select * from fly_sys_menu where visible='1' and id in ($menu)  order by sort asc,id desc;";
			$list = $this->C( $this->cacheDir )->findAll( $sql );
			$data = _instance( 'Extend/Tree' )->arrToTree( $list, 0 );
			return $data;
		} else {
			$this->location( "请登录", '/sysmanage/Login/login');
		}
	}

} //

?>