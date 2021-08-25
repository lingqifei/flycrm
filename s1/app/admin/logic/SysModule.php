<?php
/**
 * 零起飞-(07FLY-CRM)
 * ==============================================
 * 版权所有 2015-2028   成都零起飞网络，并保留所有权利。
 * 网站地址: http://www.07fly.xyz
 * ----------------------------------------------------------------------------
 * 如果商业用途务必到官方购买正版授权, 以免引起不必要的法律纠纷.
 * ==============================================
 * Author: kfrs <goodkfrs@QQ.com> 574249366
 * Date: 2019-10-3
 */

namespace app\admin\logic;

/**
 * 模块逻辑
 */
class SysModule extends AdminBase
{


	private $app_path = '';
	private $app_upload_path = '';
	private $app_pack_path = '';
	private $app_download_path = '';

	public function __construct()
	{
		$this->initModuleDir();
	}

	/**
	 * 初始模块目录
	 * @param $module
	 * @return string
	 * Author: lingqifei created by at 2020/6/4 0004
	 */
	public function initModuleDir()
	{
		//模块目录
		$path = PATH_APP;
		!is_dir($path) && mkdir($path, 0755, true);
		$this->app_path = $path;

		//模块上传目录
		$path = PATH_DATA . 'app' . DS . 'upload' . DS;
		!is_dir($path) && mkdir($path, 0755, true);
		$this->app_upload_path = $path;

		//模块打包目录
		$path = PATH_DATA . 'app/zippack/';
		!is_dir($path) && mkdir($path, 0755, true);
		$this->app_pack_path = $path;

		//模块下载目录
		$path = PATH_DATA . 'app' . DS . 'download' . DS;
		!is_dir($path) && mkdir($path, 0755, true);
		$this->app_download_path = $path;


	}

	/**
	 * 初始模块目录
	 * @param $module
	 * @return string
	 * Author: lingqifei created by at 2020/6/4 0004
	 */
	public function createModuleDir($module_name)
	{
		//模块目录
		$module_dir = $this->app_path . $module_name;

        if (is_dir($module_dir)) {
            return [RESULT_ERROR, '模块存在'];
            exit;
        }
		//创建模块目录=>默认直接
		!is_dir($module_dir) && mkdir($module_dir, 0755, true);

		//控制器
		$dir_list = ['controller', 'logic', 'model', 'service', 'validate', 'data'];
		foreach ($dir_list as $dir_name) {
			$action_dir = $module_dir . '/' . $dir_name;
			!is_dir($action_dir) && mkdir($action_dir, 0755, true);
			$this->mkModuleDirFile(['name' => $module_name, 'dirname' => $dir_name]);
		}
		//模块模板
		$action_dir = $module_dir . '/view';
		!is_dir($action_dir) && mkdir($action_dir, 0755, true);

		return true;
	}

	/**
	 * 模块信息
	 */
	public function getSysModuleInfo($where = [], $field = true)
	{
		return $this->modelSysModule->getInfo($where, $field);
	}

	/**
	 * 模块列表
	 */
	public function getSysModuleList($where = [], $field = true, $order = 'sort asc', $paginate = DB_LIST_ROWS)
	{
		$list = $this->modelSysModule->getList($where, $field, $order, $paginate)->toArray();
		if (DB_LIST_ROWS === false) $list['data'] = $list;
		foreach ($list['data'] as &$row) {
			$row['status_arr'] = $this->modelSysModule->status($row['status']);
		}
		return $list;

	}

	/**
	 * 模块信息
	 */
	public function getSysModuleColumn($where = [], $field = '',$key='')
	{
		return $this->modelSysModule->getColumn($where, $field, $key);
	}

	/**
	 * 模块添加
	 */
	public function sysModuleAdd($data = [])
	{

		$validate_result = $this->validateSysModule->scene('add')->check($data);
		if (!$validate_result) {
			return [RESULT_ERROR, $this->validateSysModule->getError()];
		}

		//创建目录结构
		$this->createModuleDir($data['name']);

		unset($data['comm_file']);
		unset($data['module_dir']);

		$data['identifier'] = $data['name'] . '.' . $data['author'];
		$result = $this->modelSysModule->setInfo($data);
		$url = url('show');
		$result && action_log('新增', '新增模块：name' . $data['name']);
		return $result ? [RESULT_SUCCESS, '模块添加成功', $url] : [RESULT_ERROR, $this->modelSysModule->getError()];
	}

	/**
	 *模块编辑
	 */
	public function sysModuleEdit($data = [])
	{

		$validate_result = $this->validateSysModule->scene('edit')->check($data);
		if (!$validate_result) {
			return [RESULT_ERROR, $this->validateSysModule->getError()];
		}

		$result = $this->modelSysModule->setInfo($data);
		$result && action_log('编辑', '编辑模块，name：' . $data['title']);
		$url = url('sysModule');
		return $result ? [RESULT_SUCCESS, '模块辑成功', $url] : [RESULT_ERROR, $this->modelSysModule->getError()];
	}

	/**
	 *模块删除
	 */
	public function sysModuleDel($where = [])
	{
		//1、卸载文件
		$this->sysModuleUninstall($where);
		//2、删除模块目录文件
		$this->sysModuleDelDir($where);
		//3、删除本地模块信息
		$result = $this->modelSysModule->deleteInfo($where, true);
		$result && action_log('删除', '删除模块，where：' . http_build_query($where));
		return $result ? [RESULT_SUCCESS, '模块删除成功'] : [RESULT_ERROR, $this->modelSysModule->getError()];
	}

	/**
	 *模块删除->目录
	 */
	public function sysModuleDelDir($data = [])
	{
		$info = $this->modelSysModule->getInfo(['id' => $data['id']], true);
		//删除模块
		$module_dir = $this->app_path . $info['name'];
		if (!is_dir($module_dir)) {
			return [RESULT_ERROR, '模块目录文件不存在'];
			exit;
		}
		$file = new \lqf\File();
		$res = $file->remove_dir($module_dir, true);
		if (!$res) {
			return [RESULT_ERROR, '模块目录文件删除失败'];
			exit;
		}
	}

	/**
	 * 安装模块
	 * @param array $data
	 * @return array
	 * Author: lingqifei created by at 2020/6/4 0004
	 */
	public function sysModuleInstall($data = [])
	{

		$this->initModuleDir();
		$info = $this->modelSysModule->getInfo(['id' => $data['id']], true);
		$module_name = $info['name'];
		$module_dir = $this->app_path . $module_name . DS;//模块目录
		if (!is_dir($module_dir)) {//判断系统是否有存在相同模块
			return [RESULT_ERROR, '安装的模块名称:' . $module_name . '不存在'];
			exit;
		}

		// 2.1导入菜单栏目
		$res = $this->importModuleMenu($module_name, $module_dir);
		if ($res[0] == RESULT_ERROR) return $res;

		//导入数据SQL脚本
		$res = $this->importModuleSqlExec(array('time' => time(), 'module_dir' => $module_dir . 'data' . DS, 'sqlfile' => 'install.sql'));
		if ($res[0] == RESULT_ERROR) return $res;
		//更新状态
		$result = $this->modelSysModule->setFieldValue(['id' => $data['id']], 'status', '1');
		return $result ? [RESULT_SUCCESS, '模块安装成功'] : [RESULT_ERROR, $this->modelSysModule->getError()];
	}

	/**
	 * 卸载模块,只删除栏目
	 * @param array $data
	 * @return array
	 * Author: lingqifei created by at 2020/6/4 0004
	 */
	public function sysModuleUninstall($data = [])
	{

		$this->initModuleDir();

		$info = $this->modelSysModule->getInfo(['id' => $data['id']], true);

		//1、删除左侧栏目
		$this->delModuleMenu($info['name']);

		//2.备份模块数据表 文件 => app/moduleName/data/table-1.sql 目录
		$module_dir = $this->app_path . $info['name'] . DS;
		$res = $this->exportModuleTable(array('module_dir' => $module_dir . 'data' . DS, 'tables' => $info['tables'], 'sqlfilename' => 'backup'));

		if ($res[0] == RESULT_ERROR) return $res;

		//2、更改模块列表状态
		$result = $this->modelSysModule->setFieldValue(['id' => $data['id']], 'status', '0');

		return $result ? [RESULT_SUCCESS, '模块卸载成功'] : [RESULT_ERROR, $this->modelSysModule->getError()];
	}

	/**
	 * 备份模块
	 * @param array $data
	 * @return array
	 * Author: lingqifei created by at 2020/6/4 0004
	 */
	public function sysModuleBackup($data = [])
	{

		$this->initModuleDir();
		$info = $this->modelSysModule->getInfo(['id' => $data['id']], true);

		//备份模块文件包
		$res = $this->sysModuleCreatePack($info);
		if ($res[0] == RESULT_ERROR) return $res;

		//跳到下载
//        $res=$this->sysModuleDown($info['name']);
//        if($res[0]==RESULT_ERROR) return $res;

		//$url=url('download',array('id'=>$data['id']));
		return [RESULT_SUCCESS, '备份成功文件为：' . $res[1], ''];
	}

	/**
	 * 模块下载
	 * @param array $data
	 * Author: lingqifei created by at 2020/6/4 0004
	 */
	public function sysModuleDown($data = [])
	{
		$info = $this->modelSysModule->getInfo(['id' => $data['id']], true);
		$module_name = $info['name'];
		$pack_zip = $this->app_pack_path . $module_name . '.zip';
		$zip_name = $module_name . '.zip';
		if (!file_exists($pack_zip)) {
			return [RESULT_ERROR, '模块包不存在,请先打包创建文件'];
			exit;
		}
		download($pack_zip, $zip_name);
	}

	/**
	 * 模块打包=>创建zip
	 * @param array $data
	 * Author: lingqifei created by at 2020/6/4 0004
	 */
	public function sysModuleCreatePack($data = [])
	{
		//查询模块信息
		$info = $this->modelSysModule->getInfo(['id' => $data['id']], true);

		if (empty($info)) {
			return [RESULT_ERROR, '本模块数据不存在'];
			exit;
		}

		$module_name = $info['name'];

		$this->initModuleDir();

		//1、把app目录复制到打包目录下
		$module_dir = $this->app_path . $module_name;
		if (!is_dir($module_dir)) {
			return [RESULT_ERROR, '模块文件目录不存在'];
			exit;
		}
		$pack_dir = $this->app_pack_path . $module_name . DS;
		$file = new \lqf\File();
		$result = $file->handle_dir($module_dir, $pack_dir, 'copy', true);
		if ($result == false) {
			return [RESULT_ERROR, '复制模块文件目录失败'];
			exit;
		}

		// 2.1导出左侧菜单信息到配置文件 mneu.php
		$this->exportModuleMenu($module_name, $pack_dir);

		//2.2生成模块信息到 info.php
		$this->mkModuleInfo($info, $pack_dir);

		//2.3导出模块数据表 table-1.sql 文件
		$res = $this->exportModuleTable(array('module_dir' => $pack_dir . 'data' . DS, 'tables' => $info['tables'], 'sqlfilename' => 'backup'));
		if ($res[0] == RESULT_ERROR) return $res;

		//3、压缩包zip文件
		$pack_zip = $this->app_pack_path . $module_name . '.zip';
		$zip = new \lqf\Zip();
		$pack_dir=rtrim($pack_dir,DS);//打包前去掉最一个斜杠，防止ubuntu下解压目录多一个斜杠
		$result = $zip->zip($pack_zip, $pack_dir);
		if ($result == false) {
			return [RESULT_ERROR, '打包模块失败'];
			exit;
		}
		return $result ? [RESULT_SUCCESS, $pack_zip] : [RESULT_ERROR, $this->modelSysModule->getError()];
	}

	/**
	 * 模块上传
	 * @param array $data
	 * Author: lingqifei created by at 2020/6/4 0004
	 */
	public function sysModuleUpload($data = [])
	{

		$object_info = request()->file('filename');
		$save_name = data_md5_key(time());//保存文件名称
		$object = $object_info->move($this->app_upload_path, $save_name);//保留原文件名 savename=‘’设置为空
		$save_file_path = $object->getpathName();//保存文件全路径

		//直接在上传目录中解压，文件名以时间为准
		$module_tmp_dir = $this->app_upload_path . DS . $save_name . DS;//以斜杠结束
		if (file_exists($save_file_path)) {
			$zip = new \lqf\Zip();
			$res = $zip->unzip($save_file_path, $module_tmp_dir);
			if ($res != true) {
				return [RESULT_ERROR, '模块包解压失败'];
			}

			//获取里面的文件包名
			$fp = new \lqf\Dir();
			$dirlist = $fp->listFile($module_tmp_dir);//查看目录列表文件，必须是以斜杠结束
			$app_path = !empty($dirlist) ? $dirlist[0]['pathname'] : '';
			$app_name = !empty($dirlist) ? $dirlist[0]['filename'] : '';
			if (empty($app_path)) {
				return [RESULT_ERROR, '应用插件压缩包缺少目录文件'];
			}

			//2、增加到本地模块
			$app_info_file = $app_path . '/data/info.php';
			$app_sql_install_file = $app_path . '/data/install.sql';
			if (file_exists($app_info_file)) {
				$moduel_info = include($app_info_file);
				$validate_result = $this->validateSysModule->scene('add')->check($moduel_info);
				if (!$validate_result) {
					return [RESULT_ERROR, $this->validateSysModule->getError()];
				}
				$sys_mid = $this->modelSysModule->setInfo($moduel_info);

				//2.0移动包到应用目录
				$module_dir = PATH_APP . $app_name . DS;
				$file = new \lqf\File();
				$result = $file->handle_dir($app_path, $module_dir, 'copy', true);
				if ($result == false) {
					return [RESULT_ERROR, '复制模块文件目录失败'];
					exit;
				}

				// 2.1导入菜单栏目
				$res = $this->logicSysModule->importModuleMenu($app_name, $module_dir);
				if ($res[0] == RESULT_ERROR) return $res;

				//2、判断是否有安装SQL脚本，执行安装脚本
				if (file_exists($app_sql_install_file)) {
					$res = $this->logicSysModule->importModuleSqlExec(array('time' => time(), 'module_dir' => $module_dir . 'data' . DS, 'sqlfile' => 'install.sql'));
					if ($res[0] == RESULT_ERROR) return $res;
				}

				//3、更新模块包,
				$updata = ['status' => 1, 'visible' => 1];
				$result = $this->modelSysModule->updateInfo(['id' => $sys_mid], $updata);
				return $result ? [RESULT_SUCCESS, '应用插件安装部署成功'] : [RESULT_ERROR, $this->modelSysModule->getError()];
			} else {
				return [RESULT_ERROR, '模块目录中模块信息文件info.php不存在'];
				exit;
			}

		}
	}

	/**
	 * 模块的栏目导出
	 *1、生成模块的栏目信息
	 * 2、把生成的格式写入配置文件
	 * @param $modulename
	 * Author: lingqifei created by at 2020/6/4 0004
	 */
	public function exportModuleMenu($modulename, $module_dir)
	{

		$module_dir = $module_dir . 'data' . DS;

		!is_dir($module_dir) && mkdir($module_dir, 0755, true);

		$menus = $this->logicSysMenu->sysMenuExport($modulename);

		$content = json_encode($menus, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);

		file_put_contents($module_dir . 'menu.php', $content);

	}

	/**
	 * 模块栏目导入
	 * @param $modulename
	 * Author: lingqifei created by at 2020/6/4 0004
	 */
	public function importModuleMenu($modulename, $module_dir)
	{
		$module_menu = $module_dir . '/data/menu.php';
		if (file_exists($module_menu)) {
			$content = file_get_contents($module_menu);
			$result = isJson($content, true);
			if ($result) {
				$this->logicSysMenu->sysMenuImport($result, $modulename);
			}
		} else {
			return [RESULT_ERROR, '模块栏目信息文件不存在'];
			exit;
		}
	}


	/**
	 * 模块数据还原
	 * @param array $param ['module_dir'=>'','sqlfile'=>'install.sql']
	 * @return array|bool
	 * Author: kfrs <goodkfrs@QQ.com> created by at 2020/9/14 0014
	 */
	public function importModuleSqlExec($param = [])
	{

		header('Content-Type:application/json; charset=utf-8');

		if (!isset($param['part']) && !isset($param['start'])) {

			$module_table_file = $param['module_dir'] . DS . $param['sqlfile'];
			if (!file_exists($module_table_file)) {
				return [RESULT_SUCCESS, $module_table_file . '文件不存在,跳过数据导入步骤！'];
				exit;
			}
			//参数1为序号，2，文件，3 ，是否压缩
			$list['1'] = array('0' => 1, '1' => $module_table_file, '2' => 1);

			ksort($list);
			// 检测文件正确性
			$last = end($list);
			if (!(count($list) === $last[0])) {
				return [RESULT_ERROR, '备份文件可能已经损坏，请检查！'];
				exit;
			}
			session('backup_list', $list);
			$res = array('msg' => "初始化完成,数据还原中...", 'module_dir' => $param['module_dir'], 'part' => 1, 'start' => 0, 'status' => DATA_NORMAL);

			$this->importModuleSqlExec($res);

		} elseif (is_numeric($param['part']) && is_numeric($param['start'])) {

			$part = $param['part'];
			$start = $param['start'];
			$list = session('backup_list');
			$path = $param['module_dir'];

			$db = new \lqf\Database($list[$part], array(
				'path' => realpath($path) . SYS_DS_PROS,
				'compress' => $list[$part][2],
				'prefix' => SYS_DB_PREFIX,
				'prefix_tpl' => '#@__'
			));

			$start = $db->import($start);
			if (false === $start) {
				return [RESULT_ERROR, '还原数据出错已经损坏，请检查！'];
				exit;
			} elseif (0 === $start) { //下一卷
				if (isset($list[++$part])) {
					$res = array('msg' => "正在还原...#{$part}", 'module_dir' => $param['module_dir'], 'part' => $part, 'start' => 0, 'status' => DATA_NORMAL);
					$this->importModuleSqlExec($res);
				} else {
					session('backup_list', null);
					return [RESULT_SUCCESS, '还原数据还原完成！', ''];
					return true;
				}
			} else {
				$data = array('part' => $part, 'start' => $start[0]);
				if ($start[1]) {
					$rate = floor(100 * ($start[0] / $start[1]));
					$res = array('msg' => "正在还原...#{$part} ({$rate}%)", 'module_dir' => $param['module_dir'], 'part' => $part, 'start' => $start[0], 'status' => DATA_NORMAL);
					$this->importModuleSqlExec($res);
				} else {
					$data['gz'] = 1;
					$res = array('msg' => "正在还原...#{$part}", 'module_dir' => $param['module_dir'], 'part' => $part, 'start' => $start[0], 'gz' => 1, 'status' => DATA_NORMAL);
					$this->importModuleSqlExec($res);
				}
			}
		} else {
			return [RESULT_ERROR, '还原数据出错已经损坏，请检查！'];
		}
	}


	/**
	 * 导出模块表的数据到文件
	 * $param[] 为模块信息,name tables
	 * Author: kfrs <goodkfrs@QQ.com> created by at 2020/9/14 0014
	 */
	public function exportModuleTable($param = [])
	{
		//判断是模块的数据表
		if (empty($param['tables'])) {
			return [RESULT_SUCCESS, '模块数据库表为空'];
			exit;
		} else {
			$param['tables'] = str_replace("\r\n", "", $param['tables']);
			$tableArr = str2arr($param['tables'], ',');
			foreach ($tableArr as $key => $onetable) {
				if (empty($onetable)) continue;
				$tables[] = str_replace(array("\r\n", "\r", "\n"), "", $onetable);
			}
		}
		$module_table_path = $param['module_dir'];
		!is_dir($module_table_path) && mkdir($module_table_path, 0755, true);

		$config = [
			'path' => $module_table_path,
			'part' => '524288000',
			'compress' => '0',
			'level' => '9',
			'prefix' => SYS_DB_PREFIX,
			'prefix_tpl' => '#@__',
		];
		session('backup_config', $config);

		// 生成备份文件信息
		$file = ['name' => $param['sqlfilename'], 'part' => DATA_NORMAL];//备份文件名称 Table-1.sql

		file_put_contents($module_table_path . $param['sqlfilename'].'-'.DATA_NORMAL.'.sql', '');//重新备份文件


		session('backup_file', $file);
		session('backup_tables', $tables);
		$database = new \lqf\Database($file, $config);
		if (false == $database) {
			return [RESULT_ERROR, '备份初始化失败！'];
		}

		$tab = array('id' => 0, 'start' => 0);
		header('Content-Type:application/json; charset=utf-8');
		//$rtn=array('tables' => $param['tables'], 'tab' => $tab, 'status' => DATA_NORMAL);
		$input = ['id' => 0, 'start' => 0];
		$this->exportModuleTableStep2($input);
	}


	/**
	 * 数据备份，步骤2
	 */
	public function exportModuleTableStep2($param = [])
	{

		$id = $param['id'];
		$start = $param['start'];
		$tables = session('backup_tables');
		$database = new \lqf\Database(session('backup_file'), session('backup_config'));

		$start = $database->backup($tables[$id], $start);

		header('Content-Type:application/json; charset=utf-8');

		if (false === $start) {
			return [RESULT_ERROR, '备份模块数据库表有错'];
			exit;
		} elseif (0 === $start) {
			if (isset($tables[++$id])) {
				$tab = array('id' => $id, 'start' => 0);
				//exit(json_encode(array('msg' => $tables[$id].'备份完成', 'tab' => $tab, 'status' => DATA_NORMAL)));
				$this->exportModuleTableStep2($tab);
			} else {
				$config = session('backup_config');
				session('backup_tables', null);
				session('backup_file', null);
				session('backup_config', null);
				return [RESULT_SUCCESS, '备份模块数据库表成功'];
				return true;
			}
		} else {

			$tab = array('id' => $id, 'start' => $start[0]);
			$rate = floor(100 * ($start[0] / $start[1]));
			// exit(json_encode(array('msg' => "正在备份...({$rate}%)", 'tab' => $tab, 'status' => DATA_NORMAL)));
			$this->exportModuleTableStep2($tab);
		}
	}

	/**
	 * 删除模块的栏目数据
	 * @param $modulename
	 * Author: lingqifei created by at 2020/6/4 0004
	 */
	public function delModuleMenu($modulename)
	{
		$this->logicSysMenu->sysMenuDel(['module' => $modulename]);
	}


	/**
	 * 生成模块信息文件
	 * @author lingqifei <574249366@qq.com>
	 */
	private function mkModuleInfo($data = [], $module_dir)
	{
		// 配置内容
		$config = <<<INFO
<?php
// +----------------------------------------------------------------------
// | 07FLY系统 [基于ThinkPHP5.0开发]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2021 http://www.07fly.xyz
// +----------------------------------------------------------------------
// | 07FLY承诺基础框架永久免费开源，您可用于学习和商用，但必须保留软件版权信息。
// +----------------------------------------------------------------------
// | Author: 开发人生 <574249366@qq.com>
// +----------------------------------------------------------------------
/**
 * 模块基本信息
 */
return [
    // 模块名[必填]
    'name'        => '{$data['name']}',
    // 模块标题[必填]
    'title'       => '{$data['title']}',
    // 模块唯一标识[必填]，格式：module.[应用市场ID].模块名[应用市场分支ID]
    'identifier'  => '{$data['identifier']}',
    // 主题模板[必填]，默认default
    'theme'        => 'default',
    // 模块图标[选填]
    'icon'        => '{$data['icon']}',
    // 模块简介[选填]
    'intro' => '{$data['intro']}',
    // 开发者[必填]
    'author'      => '{$data['author']}',
    // 开发者网址[选填]
    'author_url'  => '{$data['author_url']}',
    // 版本[必填],格式采用三段式：主版本号.次版本号.修订版本号
    // 主版本号【位数变化：1-99】：当模块出现大更新或者很大的改动，比如整体架构发生变化。此版本号会变化。
    // 次版本号【位数变化：0-999】：当模块功能有新增或删除，此版本号会变化，如果仅仅是补充原有功能时，此版本号不变化。
    // 修订版本号【位数变化：0-999】：一般是 Bug 修复或是一些小的变动，功能上没有大的变化，修复一个严重的bug即发布一个修订版。
    'version'     => '{$data['version']}',
    //关联数据表是指模块所需要的数据表名称，如果有多个表用英文逗号（,）分隔。如：table1,table2
    'tables'     => '{$data['tables']}',
];
INFO;

		return file_put_contents($module_dir . 'data' . DS . 'info.php', $config);
	}


	/**
	 * 生成模块目录信息文件
	 * @author lingqifei <364666827@qq.com>
	 */
	private function mkModuleDirFile($data = [])
	{
		$name_lo = strtolower($data['name']);
		$name_uc = ucwords(strtolower($data['name']));

		$action_lo = strtolower($data['dirname']);
		$action_uc = ucwords(strtolower($data['dirname']));

		$file_desc = <<<INFO
/*
*
* {$name_lo}.{$action_lo}  模型
*
* =========================================================
* 零起飞网络 - 专注于网站建设服务和行业系统开发
* 以质量求生存，以服务谋发展，以信誉创品牌 !
* ----------------------------------------------
* @copyright	Copyright (C) 2017-2022 07FLY Network Technology Co,LTD.
* @license    For licensing, see LICENSE.html or http://www.07fly.xyz/license
* @author ：kfrs <goodkfrs@QQ.com> 574249366
* @version ：1.0
* @link ：http://www.07fly.xyz
*/
INFO;

		// 配置控器
		$config = <<<INFO
<?php
{$file_desc}
namespace app\\{$name_lo}\\{$action_lo};
use app\common\\{$action_lo}\\{$action_uc}Base;

/**
 * 模块基类
 */
class {$name_uc}Base extends {$action_uc}Base{

}
?>
INFO;

		$filename = $this->app_path . $name_lo . '/' . $action_lo . '/' . $name_uc . "Base.php";
		return file_put_contents($filename, $config);

	}


	/**
	 * 模块打包=>创建框架升级文件
	 * @param array $data
	 * Author: lingqifei created by at 2020/6/4 0004
	 */
	public function sysModuleCreateSys($data = [])
	{

		ini_set('max_execution_time', '0');

		if (empty($data['version'])) {
			return [RESULT_ERROR, '需要打包的版本号不存在'];
			exit;
		}

		$version = $data['version'];

		$this->initModuleDir();

		//导出栏目菜单
		$this->exportModuleMenu('admin',$this->app_path.'admin'.DS);

		//写入版本号
		file_put_contents($this->app_path.'admin'.DS .'data'.DS. 'version', $data['version']);

		//创建打包的临时目录
		$version_dir = $this->app_pack_path . $version . DS;
		!is_dir($version_dir) && mkdir($version_dir, 0755, true);

		//2、升级包=移动需要打包的文件
		$handle_list = [
			'addon',
			'core',
			'extend',
			'vendor',
			'app/admin',
			'app/common',
			'app/command.php',
			'app/common.php',
			'app/extend.php',
			'app/function.php',
			'app/tags.php',
			'public/static/module/admin/css/07fly.css',
			'public/static/module/admin/css/style.css',
			'public/static/module/admin/js/lib',
		];

		//2、安装包=移动需要打包的文件
		$handle_list_intsll=[
			'app/install',
			'app/config.php',
			'public/static/addon/editor',
			'public/static/addon/file',
			'public/static/addon/region',
			'public/static/module/admin',
			'public/static/module/install',
			'public/static/module/login',
			'public/index.php',
			'public/admin.php',
			'public/install.php',
			'public/router.php',
			'public/public.php',
		];

		//判断是升级包，安装包
		if (!empty($data['install'])) {
			$handle_list=array_merge($handle_list,$handle_list_intsll);
		}

		//循环升级包移动文件
		$file = new \lqf\File();
		foreach ($handle_list as $filepath) {
			$source = ROOT_PATH . $filepath;//源位置
			$topath = $version_dir . $filepath;//目的位置
			echo '<hr>' . ROOT_PATH . $filepath . '=>' . $version_dir . $filepath;
			if(!file_exists($source)){
				echo "不存在";
			}
			if(!is_dir($source)){
				$file->handle_file($source, $topath, 'copy', true);
			}else{
				$file->handle_dir($source, $topath, 'copy', true);
			}

		}
		//3、压缩包zip文件
		$pack_zip = $this->app_pack_path . $version . '.zip';
		$zip = new \lqf\Zip();
		$version_dir=rtrim($version_dir,DS);//打包前去掉最一个斜杠，防止ubuntu下解压目录多一个斜杠
		$result = $zip->zip($pack_zip, $version_dir);
		if ($result == false) {
			return [RESULT_ERROR, '打包模块失败'];
			exit;
		}
		echo '<hr>打包生成文件：'.$pack_zip;
		$upgrade_zip=PATH_PUBLIC.'upgrade'.DS.'s1'.DS. $version . '.zip';
		echo '<hr>复制包文件到：'.$upgrade_zip;
		$file->handle_file($pack_zip, $upgrade_zip, 'copy', true);
		exit;
		//return $result ? [RESULT_SUCCESS, $pack_zip] : [RESULT_ERROR, $this->modelSysModule->getError()];
	}


	/**同步数据库结构
	 * @param string $fileinfo
	 * Author: 开发人生 goodkfrs@qq.com
	 * Date: 2021/8/3 0003 9:52
	 */
	public function sysModuleSyncTable($data=[]){

		//查询模块信息
		$info = $this->modelSysModule->getInfo(['id' => $data['id']], true);
		if (empty($info)) {
			return [RESULT_ERROR, '本模块数据不存在'];
			exit;
		}
		$module_name = $info['name'];

		//1、判断目录是否在
		$module_dir = $this->app_path . $module_name.DS;
		if (!is_dir($module_dir)) {
			return [RESULT_ERROR, '模块文件目录不存在'];
			exit;
		}

		$app_table_file = $module_dir . 'data'.DS.'table.php';
		$app_menu_file = $module_dir . 'data'.DS.'menu.php';

		if(file_exists($app_table_file)){
			$this->sysModuleSyncTableFile($app_table_file);
			$this->sysModuleSyncMenuFile($app_menu_file);
			return [RESULT_SUCCESS, 'table和menu文件同步完成'];
			exit;
		}else{
			return [RESULT_ERROR, '模块数据库结构文件不存在'];
			exit;
		}

	}

	/**同步数据库结构
	 * @param string $fileinfo
	 * Author: 开发人生 goodkfrs@qq.com
	 * Date: 2021/8/3 0003 9:52
	 */
	public function sysModuleSyncTableFile($fileinfo=''){
		if(file_exists($fileinfo)){
			$content = include($fileinfo);
			$table = new \lqf\SyncTableDesc($content,SYS_DB_PREFIX);
			$table->generate();
		}
	}

	/**同步栏目数据库结构
	 * @param string $fileinfo
	 * Author: 开发人生 goodkfrs@qq.com
	 * Date: 2021/8/3 0003 9:52
	 */
	public function sysModuleSyncMenuFile($fileinfo=''){
		if(file_exists($fileinfo)){
			$content = file_get_contents($fileinfo);
			$content = isJson($content, true);
			$this->sysModuleMenuImport($content);
		}
	}


	/**同步更新栏目数据，增加不存的数据
	 * @param array $data
	 * @param int $pid
	 * @return bool
	 * Author: 开发人生 goodkfrs@qq.com
	 * Date: 2021/8/5 0005 18:44
	 */
	public function sysModuleMenuImport($data = [], $pid = 0)
	{
		if (empty($data)) {
			return true;
		}
		foreach ($data as $v) {
			$map['url']=['=',$v['url']];
			$map['module']=['=',$v['module']];
			$info=$this->modelSysMenu->getInfo($map,true);

			//整理是否有下级
			$childs = '';
			if (isset($v['nodes'])) {
				$childs = $v['nodes'];
				unset($v['nodes']);
			}
			//当栏目不存在、添加栏目
			if(empty($info)){
				if (!isset($v['pid'])) {
					$v['pid'] = $pid;
				}
				$result = $this->modelSysMenu->setInfo($v);
			}else{//存在跳过
				$result = $info['id'];//设置本为上级栏目
				$this->sysModuleMenuImport($childs, $result);
			}

			if (!$result) {
				return false;
			}
			if (!empty($childs)) {
				$this->sysModuleMenuImport($childs, $result);
			}
		}
		return true;
	}

}
