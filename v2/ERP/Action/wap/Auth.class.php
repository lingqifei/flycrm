<?php
/*
 * 验证类
 */	 
class Auth extends Action {

	private $cacheDir = ''; //缓存目录

	public function __construct() {
		//$this->check_login();
		$this->authorization();
		//@define( 'SYS_USER_ACCOUNT', $_SESSION[ "CRM" ][ "USER" ][ "account" ] ); //定义
		@define( 'SYS_USER_ACCOUNT',$_SESSION["sys_user_acc"]); //定义
		//@define( 'SYS_USER_ID', $_SESSION[ "CRM" ][ "USER" ][ "userID" ] ); //定义
		define( 'SYS_USER_ID','1'); //定义
		@define( 'SYS_USER_VIEW','1,4' ); //定义查看的权限
		@define( 'SYS_CO_ID', '1' ); //定义所属于公司编号
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
    //检查是否有登录
    public function check_login()
    {
        if (isset($_SESSION["sys_user_id"])) {
            if (empty($_SESSION["sys_user_id"])) {
               return false;
            }
        } else {
            return true;
        }
    }

    /**
     * api 数据返回
     * @param  [int] $code [结果码 200:正常/4**数据问题/5**服务器问题]
     * @param  [string] $msg  [接口要返回的提示信息]
     * @param  [array]  $data [接口要返回的数据]
     * @return [string]       [最终的json数据]
     */
    public function return_msg($code, $msg = '', $data = []) {
        $return_data['statusCode'] = $code;
        $return_data['msg']  = $msg;
        $return_data['data'] = $data;
        echo json_encode($return_data);
        die;
    }
} //
?>