<?php
class Auth extends Action {

	private $cacheDir = ''; //缓存目录

	public
	function __construct() {
		$this->check_login();
		$this->authorization();
		@define( 'SYS_USER_ACCOUNT', $_SESSION[ "CRM" ][ "USER" ][ "account" ] ); //定义
		@define( 'SYS_USER_ID', $_SESSION[ "CRM" ][ "USER" ][ "userID" ] ); //定义
		@define( 'SYS_USER_VIEW', $_SESSION[ "CRM" ][ "USER" ][ "viewID" ] ); //定义查看的权限		
	}


	//检查是否有登录
	public
	function check_login() {
		if ( empty( $_SESSION[ "CRM" ][ "USER" ][ "method" ] ) || empty( $_SESSION[ "CRM" ][ "USER" ][ "menu" ] ) ) {
			if ( @$_SESSION[ "CRM" ][ "USER" ][ 'check' ] != 1 ) {
				$_SESSION[ "CRM" ][ "USER" ][ 'check' ] = 1;
				$this->location( "", 'Login/login', 0 );
			}
		}
	}

	//判断是有执行方法的权限
	public
	function authorization() {
		if ( isset( $_SESSION[ "CRM" ][ "NEED" ][ "method" ] ) ) {
			if ( in_array( METHOD_NAME, $_SESSION[ "CRM" ][ "NEED" ][ "method" ] ) ) {
				if ( !in_array( METHOD_NAME, $_SESSION[ "CRM" ][ "USER" ][ "method" ] ) ) {
					$this->L( "Common" )->alert( "您无权限进行当前的操作！如果需要使用请联系管理员~", "info", "close" );
				}
			}
		}
	}

	//得需要验证的栏目和方法
	//返回：array("1",3,5,5) array('add',modify,del...);
	public
	function auth_menu_tree_arr() {
		$menu = $_SESSION[ "CRM" ][ "USER" ][ "menustr" ];
		if ( !empty( $menu ) ) {
			$sql = "select * from fly_sys_menu where visible='1' and id in ($menu)  order by sort asc,id desc;";
			$list = $this->C( $this->cacheDir )->findAll( $sql );
			$data = _instance( 'Extend/Tree' )->arrToTree( $list, 0 );
			return $data;
		} else {
			$this->location( "", 'Login/login', 0 );
		}
	}

	//界面初始化操作
	public
	function sys_default_conf() {
		return array(
			'title' => 'AAARadius宽带计费系统',
			'companyname' => 'AAARadius宽带计费系统',
			'adtitle' => '网络无处不在，你选择没有错~相信我们就是相信你自己 ',
			'principal' => '鸟木鸟',
			'tel' => '18030402705 ',
			'address' => '成都市一环路南二段 ',
			'email' => 'goodmuzi@qq.com ',
			'login_logo' => '',
			'manage_logo' => '',
			'login_title' => 'AAARadius宽带计费系统 ',
			'copyright' => 'Copyright © 2014 - AAARadius ',
			'i_title' => 'AAA宽带认证管理系统 ',
			'i_weibo' => '官方微博:http://weibo.com/u/2299441430 ',
			'i_note' => '<script type="text/javascript" src="http://bbs.07fly.com/api.php?mod=js&bid=39"></script>',
			'i_web' => 'http://widget.weibo.com/weiboshow/index.php?language=&width=0&height=430&fansRow=1&ptype=1&speed=100&skin=1&isTitle=0&noborder=1&isWeibo=1&isFans=0&uid=2299441430&verifier=c7a29d34&dpc=1',
			'i_copy' => '
<div class="divider"></div>
<h2>有限担保和免责声明:</h2>
<pre style="margin:5px;line-height:1.6em">
本软件及所附带的文件是作为不提供任何明确的或隐含的赔偿或担保的形式提供的。
用户出于自愿而使用本软件，您必须了解使用本软件的风险，在尚未购买产品技术服务之前，
我们不承诺提供任何形式的技术支持、使用担保，也不承担任何因使用本软件而产生问题的相关责任。
究相关责任的权力。
</pre>',
			'i_ser' => '
<div class="divider"></div>
<h2>有偿服务请联系:</h2>
<pre style="margin:5px;line-height:1.6em;">
<font color="#FF0000">定制化开发,公司培训,技术支持,解决使用过程中出现的全部疑难问题</font>
开发团队：零起飞
销售团队：四川卓迈科技
技术交流：<a href="http://bbs.07fly.com/">论坛交流</a>
技术支持：aaanas@qq.com

</pre>'
		);
	}

} //

?>