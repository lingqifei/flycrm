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
        //应用模块目录
        $path = PATH_APP;
        !is_dir($path) && mkdir($path, 0755, true);
        $this->app_path = $path;

        //模块包上传目录
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
        if ($paginate === false) $list['data'] = $list;
        foreach ($list['data'] as &$row) {
            $row['status_arr'] = $this->modelSysModule->status($row['status']);
        }
        return $list;
    }

    /**
     * 模块信息
     */
    public function getSysModuleColumn($where = [], $field = '', $key = '')
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
       return $this->modelSysModule->createModuleDir($this->app_path, $data['name']);

        //删除多余字段
        unset($data['comm_file']);
        unset($data['module_dir']);

        //模块的标识
        $data['identifier'] = 'module.lingqifei.'.$data['name'];
        $data['status'] =1;//安装
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

        $info = $this->modelSysModule->getInfo(['id' => $data['id']], true);
        $module_name = $info['name'];
        $module_dir = $this->app_path . $module_name . DS;//模块目录
        if (!is_dir($module_dir)) {//判断系统是否有存在相同模块
            return [RESULT_ERROR, '安装的模块名称:' . $module_name . '不存在'];
            exit;
        }
        // 2.1导入菜单栏目
        $res = $this->modelSysModule->importModuleMenu($module_name, $module_dir);
        if ($res[0] == RESULT_ERROR) return $res;

        //2.2执行install.sql文件
        $res = $this->modelSysModule->importModuleSqlExec(array('time' => time(), 'module_dir' => $module_dir . 'data' . DS, 'sqlfile' => 'install.sql'));
        if ($res[0] == RESULT_ERROR) return $res;

        //3、更新状态
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
        $res = $this->modelSysModule->exportModuleTable(array('module_dir' => $module_dir . 'data' . DS, 'tables' => $info['tables'], 'sqlfilename' => 'backup'));

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

        return [RESULT_SUCCESS, '备份成功'];
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
        $this->modelSysModule->exportModuleMenu($module_name, $pack_dir);

        //2.2生成模块信息到 info.php
        $this->modelSysModule->mkModuleInfo($info, $pack_dir);

        //2.3导出模块数据表 table-1.sql 文件
        $res = $this->modelSysModule->exportModuleTable(array('module_dir' => $pack_dir . 'data' . DS, 'tables' => $info['tables'], 'sqlfilename' => 'backup'));
        if ($res[0] == RESULT_ERROR) return $res;

        //3、压缩包zip文件
        $pack_zip = $this->app_pack_path . $module_name . '.zip';
        $zip = new \lqf\Zip();
        $pack_dir = rtrim($pack_dir, DS);//打包前去掉最一个斜杠，防止ubuntu下解压目录多一个斜杠
        $result = $zip->zip($pack_zip, $pack_dir);
        if ($result == false) {
            return [RESULT_ERROR, '打包模块失败'];
            exit;
        }
        return $result ? [RESULT_SUCCESS, '备份操作成功'] : [RESULT_ERROR, $this->modelSysModule->getError()];
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
                $res = $this->modelSysModule->importModuleMenu($app_name, $module_dir);
                if ($res[0] == RESULT_ERROR) return $res;

                //2、判断是否有安装SQL脚本，执行安装脚本
                if (file_exists($app_sql_install_file)) {
                    $res = $this->modelSysModule->importModuleSqlExec(array('time' => time(), 'module_dir' => $module_dir . 'data' . DS, 'sqlfile' => 'install.sql'));
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
     * 删除模块的栏目数据
     * @param $modulename
     * Author: lingqifei created by at 2020/6/4 0004
     */
    public function delModuleMenu($modulename)
    {
        $this->logicSysMenu->sysMenuDel(['module' => $modulename]);
    }

    /**同步数据结构
     * @param string $fileinfo
     * Author: 开发人生 goodkfrs@qq.com
     * Date: 2021/8/3 0003 9:52
     */
    public function sysModuleSyncTable($data = [])
    {

        //查询模块信息
        $info = $this->modelSysModule->getInfo(['id' => $data['id']], true);
        if (empty($info)) {
            return [RESULT_ERROR, '本模块数据不存在'];
            exit;
        }
        $module_name = $info['name'];

        //1、判断目录是否在
        $module_dir = $this->app_path . $module_name . DS;
        if (!is_dir($module_dir)) {
            return [RESULT_ERROR, '模块文件目录不存在'];
            exit;
        }

        //2、同部数据表字段
        $app_table_file = $module_dir . 'data' . DS . 'table.php';
        $this->sysModuleSyncTableFile($app_table_file);

        //3、同步栏目
        $app_menu_file = $module_dir . 'data' . DS . 'menu.json';
        if (!file_exists($app_menu_file)) {
            $app_menu_file = $module_dir . 'data' . DS . 'menu.php';
        }
        $this->sysModuleSyncMenuFile($app_menu_file);
        return [RESULT_SUCCESS, '文件同步完成',''];
    }

    /**同步表数据库结构
     * @param string $filename
     * Author: 开发人生 goodkfrs@qq.com
     * Date: 2021/8/3 0003 9:52
     */
    public function sysModuleSyncTableFile($filename = '')
    {
        if (file_exists($filename)) {
            $content = include($filename);//加载table结构数组
            $table = new \lqf\SyncTableDesc($content, SYS_DB_PREFIX);
            $table->generate();
        }
    }

    /**同步栏目数据库结构
     * @param string $filename
     * Author: 开发人生 goodkfrs@qq.com
     * Date: 2021/8/3 0003 9:52
     */
    public function sysModuleSyncMenuFile($filename = '')
    {
        if (file_exists($filename)) {
            $content = file_get_contents($filename);
            $content = isJson($content, true);
            $this->sysModuleMenuImport($content);
        }
    }


    /**同步更新栏目数据，增加不存的栏目数据
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
            $map['url'] = ['=', $v['url']];
            $map['module'] = ['=', $v['module']];
            $info = $this->modelSysMenu->getInfo($map, true);

            //整理是否有下级
            $childs = '';
            if (isset($v['nodes'])) {
                $childs = $v['nodes'];
                unset($v['nodes']);
            }
            //当栏目不存在、添加栏目
            if (empty($info)) {
                if (!isset($v['pid'])) {
                    $v['pid'] = $pid;
                }
                $result = $this->modelSysMenu->setInfo($v);
            } else {//存在跳过
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
