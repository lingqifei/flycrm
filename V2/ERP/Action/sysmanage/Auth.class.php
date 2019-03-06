<?php
/*
 * 验证类
 */	 
class Auth extends Action {

	private $cacheDir = ''; //缓存目录

	public function __construct() {
		$this->check_login();
		$this->authorization();
		@define( 'SYS_USER_ACCOUNT', $_SESSION[ "CRM" ][ "USER" ][ "account" ] ); //定义
		@define( 'SYS_USER_ID', $_SESSION[ "CRM" ][ "USER" ][ "userID" ] ); //定义
		@define( 'SYS_USER_VIEW', $_SESSION[ "CRM" ][ "USER" ][ "viewID" ] ); //定义查看的权限
		@define( 'SYS_CO_ID', '1' ); //定义所属于公司编号
	}


	//检查是否有登录
	public function check_login() {
		if ( empty( $_SESSION[ "CRM" ][ "USER" ][ "userID" ] )) {
			$this->location( "请登录", '/sysmanage/Login/login');
		}
	}

	//判断是有执行方法的权限
	public function authorization() {
		//print_r($_SESSION[ "CRM" ][ "USER" ][ "method" ]);
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