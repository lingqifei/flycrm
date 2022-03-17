<?php
/**
 * 零起飞-(07FLY-CRM)
 * ==============================================
 * 版权所有 2015-2028   成都零起飞网络，并保留所有权利。
 * 网站地址: http://www.07fly.xyz
 * ----------------------------------------------------------------------------
 * 如果商业用途务必到官方购买正版授权, 以免引起不必要的法律纠纷.
 * ==============================================
 * Agencyor: kfrs <goodkfrs@QQ.com> 574249366
 * Date: 2019-10-3
 */

namespace app\admin\logic;

use think\Cookie;

/**
 * 序列 逻辑
 */
class Store extends AdminBase
{

    private $syskey_path = '';//注册码目录
    private $upgrade_path_back = '';//升级备份目录
    private $upgrade_path_down = '';//升级下载目录


    /**
     * 析构函数
     */
    function __construct()
    {
        $this->file = new \lqf\File();
        $this->zip = new \lqf\Zip();
        $this->initUpgradeDir();
    }


    /**
     * 初始模块目录
     * @param $module
     * @return string
     * Author: lingqifei created by at 2020/6/4 0004
     */
    public function initUpgradeDir()
    {
        //授权码目录
        $path = PATH_DATA;
        !is_dir($path) && mkdir($path, 0755, true);
        $this->syskey_path = $path;
    }


	/**
	 * 登录云
	 * @return string
	 * Author: lingqifei created by at 2020/5/16 0016
	 */
	public function cloudUserLogin($data=[])
	{
		$info = $this->modelStore->getCloudUserLogin($data);
		if($info['code']==0 && !empty($info)){
			$user=$info['data'];
			Cookie::set('stroe_user',$user,360000,'/');
			Cookie::set('username',$user['username'],360000,'/');
			Cookie::set('user_token',$user['user_token'],360000,'/');
			return [RESULT_SUCCESS, '登录成功'];
		}else{
			return [RESULT_ERROR, '登录失败'];
		}
	}

	/**
	 * 登出云
	 * @return string
	 * Author: lingqifei created by at 2020/5/16 0016
	 */
	public function cloudUserLoginout($data=[])
	{
		Cookie::clear('stroe_user');
		return [RESULT_SUCCESS, '成功退出！'];
	}

	/**
	 * 云用户信息
	 * @return string
	 * Author: lingqifei created by at 2020/5/16 0016
	 */
	public function getCloudUserInfo($data=[])
	{
		$userinfo=[];
		if(Cookie::has('stroe_user')){
			$userinfo=Cookie::Get('stroe_user');
		}
		return $userinfo;
	}

	/**
	 * 获取应用插件的列表
	 * Author: lingqifei created by at 2020/6/12 0012
	 */
	public function getCloudStoreList($data=[])
	{


		//得到云服务应用插件列表
		$info = $this->modelStore->getCloudStoreList($data);

		$listdata = array();
		if($info['code']===0){
			if(!empty($info['data'])){
				$listdata = $info['data'];
				foreach ($listdata['data'] as &$row) {
					$row['sale_price_text']=($row['sale_price']>0)?'<span>￥':0;//判断最新版
					if($row['sale_price']>0){
						$row['sale_price_text']="<span class='text-danger'>￥".$row['sale_price'].'</span>';
					}else{
						$row['sale_price_text']="<span class='text-success'>免费</span>";
					}
					switch ($row['classify_id']){
						case '1'://模块
							$map['name']=['=',$row['name']];
							$map['status']=['=','1'];
							$local=$this->modelSysModule->getInfo(['name'=>$row['name']],'id,version');
							if($local){
								$row['isinstall']=1;
								$row['isupdate']=($local['version']<$row['version'])?1:0;//判断最新版
							}else{
								$row['isinstall']=0;
								$row['isupdate']=0;
							}
							break;
						case '2'://插件
							$row['isinstall']=$this->modelAddon->stat(['name'=>$row['name']],'count');
							break;
						case '3'://服务
							break;
						case '4'://模板

							break;
					}
				}
			}
		}
		return $listdata;
	}

	/**
	 * 获取应用插件的基本信息
	 * 1、授权购买=》返回插件app_key
	 * 2、未购买生成购买订单=>返回插件 order_id
	 * @return string
	 * Author: lingqifei created by at 2020/5/16 0016
	 */
	public function getCloudAppInfo($data=[])
	{
		$info = $this->modelStore->getCloudAppInfo($data);
		if($info['code']===0){
			return $info['data'];
		}else{
			return [RESULT_ERROR, $info['msg']];
		}
	}

	/**
	 * 获取应用插件的安装信息
	 * 1、授权购买=》返回插件app_key
	 * 2、未购买生成购买订单=>返回插件 order_id
	 * @return string
	 * Author: lingqifei created by at 2020/5/16 0016
	 */
	public function getCloudAppOrderInfo($data=[])
	{
		$info = $this->modelStore->getCloudAppOrderInfo($data);
		if($info['code']===0){
			return $info['data'];
		}else{
			return [RESULT_ERROR, $info['msg']];
		}
	}

	/**
	 * 获取应用插件的订单支付情况
	 * @return string
	 * Author: lingqifei created by at 2020/5/16 0016
	 */
	public function getCloudAppOrderCheck($data=[])
	{
		if(empty($data['order_id']) || empty($data['order_code'])){
			return [RESULT_ERROR, '订单检查参数不全，order_id,order_code'];
		}

		$info = $this->modelStore->getCloudAppOrderCheck($data);

		if($info['code']===0){
			return $info['data'];
		}else{
			return [RESULT_ERROR, $info['msg']];
		}
	}


	/**
	 * 获取应用插件的安装信息
	 * 1、授权购买=》返回插件app_key
	 * 2、未购买生成购买订单=>返回插件 order_id
	 * @return string
	 * Author: lingqifei created by at 2020/5/16 0016
	 */
	public function getCloudAppDownInstall($data=[])
	{

		if (!isset($data['app_id']) || $data['app_id'] ==0 ) {
			return [RESULT_ERROR, 'app参数不正确'];
		}

		$result = $this->modelStore->getCloudAppDownFile($data);
		if (!isset($result['code']) || $result['code'] != 1) {
			return [RESULT_ERROR, $result['code']];
		}
		$filepath = $result['filepath'];//远程下载件全路经
		$filename = $result['filename'];//远程下载文件名
		$dirpath = $result['dirpath'];//远程下载目录

		$tmppath=$dirpath.rtrim($filename,'.zip').DS;

		if (file_exists($filepath)) {

			//1、解压应用插件包
			$zip=new \lqf\Zip();
			$res=$zip->unzip($filepath, $tmppath);
			if($res!=true){
				return [RESULT_ERROR, '模块包解压失败'];
			}
			//获取里面的文件包名
			$fp=new \lqf\Dir();
			$dirlist=$fp->listFile($tmppath);
			$app_path = !empty($dirlist) ? $dirlist[0]['pathname'] : '';
			$app_name = !empty($dirlist) ? $dirlist[0]['filename'] : '';
			if (empty($app_path)) {
				return [RESULT_ERROR, '应用插件压缩包缺少目录文件'];
			}

			//2、增加到本地模块
			$app_info_file=$app_path.'/data/info.php';
			$app_table_file=$app_path.'/data/table.php';
			$app_menu_file=$app_path.'/data/menu.php';
			$app_sql_install_file=$app_path.'/data/install.sql';
			$app_theme_dir=$app_path.'/data/theme';

			if (file_exists($app_info_file)) {

				$moduel_info=include($app_info_file);

				$validate_result = $this->validateSysModule->scene('add')->check($moduel_info);
				if (!$validate_result) {
					return [RESULT_ERROR, $this->validateSysModule->getError()];
				}
				$sys_mid = $this->modelSysModule->setInfo($moduel_info);

				//2.0移动包到应用目录
				$module_dir=PATH_APP.$app_name.DS;
				$file = new \lqf\File();
				$result = $file->handle_dir($app_path, $module_dir, 'copy', true);
				if ($result == false) {
					return [RESULT_ERROR, '复制模块文件目录失败'];
					exit;
				}

				// 2.1导入菜单栏目
				$res = $this->modelSysModule->importModuleMenu($app_name,$module_dir);
				if ($res[0] == RESULT_ERROR) return $res;

				//2、判断是否有安装SQL脚本，执行安装脚本
				if(file_exists($app_sql_install_file)){
					$res = $this->modelSysModule->importModuleSqlExec(array('time' => time(), 'module_dir' => $module_dir.'data', 'sqlfile' => 'install.sql'));
					if ($res[0] == RESULT_ERROR) return $res;
				}



				//3、更新模块包,
				$updata=['status'=>1,'visible'=>1];
				$result=$this->modelSysModule->updateInfo(['id' => $sys_mid], $updata);


				//4、判断是模模板文件
				if(is_dir($app_theme_dir)){
					$theme_dir=PATH_PUBLIC.'theme'.DS;
					$result = $file->handle_dir($app_theme_dir, $theme_dir, 'copy', true);
					if ($result == false) {
						return [RESULT_ERROR, '复制模板文件失败'];
						exit;
					}
				}

				//5、判断是否有数据表同步文件 table.php
				if(file_exists($app_table_file)){
					$res = $this->logicSysModule->sysModuleSyncTableFile($app_table_file);
					if ($res[0] == RESULT_ERROR) return $res;
				}

				//6、判断是否有栏目数据表同步文件 menu.php
				if(file_exists($app_menu_file)){
					$res = $this->logicSysModule->sysModuleSyncMenuFile($app_menu_file);
					if ($res[0] == RESULT_ERROR) return $res;
				}




				return $result ? [RESULT_SUCCESS, '应用插件安装部署成功'] : [RESULT_ERROR, $this->modelSysModule->getError()];
				exit;
			}else{
				return [RESULT_ERROR, '模块目录中模块信息文件info.php不存在'];
				exit;
			}

		}

	}



	/**
	 * 获取应用插件的升级版本信息
	 * 1、授权购买=》返回插件app_key
	 * 2、未购买生成购买订单=>返回插件 order_id
	 * @return string
	 * Author: lingqifei created by at 2020/5/16 0016
	 */
	public function getCloudAppDownUpgrade($data=[])
	{

		if (!isset($data['app_id']) || $data['app_id'] ==0 || empty($data['version']) ) {
			return [RESULT_ERROR, 'app参数不正确,版本号不全'];
		}
		$result = $this->modelStore->getCloudAppDownFile($data);
		if (!isset($result['code']) || $result['code'] != 1) {
			return [RESULT_ERROR, $result['code']];
		}
		$filepath = $result['filepath'];//远程下载件全路经
		$filename = $result['filename'];//远程下载文件名
		$dirpath = $result['dirpath'];//远程下载目录

		$tmppath=$dirpath.rtrim($filename,'.zip').DS;

		if (file_exists($filepath)) {

			//1、解压应用插件包
			$zip=new \lqf\Zip();
			$res=$zip->unzip($filepath, $tmppath);
			if($res!=true){
				return [RESULT_ERROR, '模块升级包解压失败'];
			}
			//获取里面的文件包名
			$fp=new \lqf\Dir();
			$dirlist=$fp->listFile($tmppath);
			$app_path = !empty($dirlist) ? $dirlist[0]['pathname'] : '';
			$app_name = !empty($dirlist) ? $dirlist[0]['filename'] : '';
			if (empty($app_path)) {
				return [RESULT_ERROR, '应用插件压缩包缺少目录文件'];
			}

			//2、增加到本地模块
			$app_info_file=$app_path.'/data/info.php';
			$app_table_file=$app_path.'/data/table.php';
			$app_menu_file=$app_path.'/data/menu.php';
			$app_sql_upgrade=$app_path.'/data/upgrade.sql';
			$app_theme_dir=$app_path.'/data/theme';

			if (file_exists($app_info_file)) {

				//2.0移动包到应用目录
				$module_dir=PATH_APP.$app_name.DS;
				$file = new \lqf\File();
				$result = $file->handle_dir($app_path, $module_dir, 'copy', true);
				if ($result == false) {
					return [RESULT_ERROR, '复制模块文件目录失败'];
					exit;
				}

				//2、判断是否有升级SQL脚本，执行升级脚本
				if(file_exists($app_sql_upgrade)){
					$res = $this->modelSysModule->importModuleSqlExec(array('time' => time(), 'module_dir' => $module_dir.'data', 'sqlfile' => 'upgrade.sql'));
					if ($res[0] == RESULT_ERROR) return $res;
				}

				//3、更新模块包,根据配置文件获得本地模块信息
				$app_info=include($app_info_file);
				$where['identifier']=['=',$app_info['identifier']];
				$where['name']=['=',$app_info['name']];
				$updata=['version'=>$app_info['version']];
				$result=$this->modelSysModule->updateInfo($where, $updata);

				//4、判断是模模板文件
				if(is_dir($app_theme_dir)){
					$theme_dir=PATH_PUBLIC.'theme'.DS;
					$result = $file->handle_dir($app_theme_dir, $theme_dir, 'copy', true);
					if ($result == false) {
						return [RESULT_ERROR, '复制模板文件失败'];
						exit;
					}
				}

				//5、判断是否有数据表同步文件 table.php
				if(file_exists($app_table_file)){
					$res = $this->logicSysModule->sysModuleSyncTableFile($app_table_file);
					if ($res[0] == RESULT_ERROR) return $res;
				}

				//6、判断是否有栏目数据表同步文件 menu.php
				if(file_exists($app_menu_file)){
					$res = $this->logicSysModule->sysModuleSyncMenuFile($app_menu_file);
					if ($res[0] == RESULT_ERROR) return $res;
				}

				return $result ? [RESULT_SUCCESS, '应用插件安装部署成功'] : [RESULT_ERROR, $this->modelSysModule->getError()];
				exit;
			}else{
				return [RESULT_ERROR, '模块目录中模块信息文件info.php不存在'];
				exit;
			}

		}

	}
}