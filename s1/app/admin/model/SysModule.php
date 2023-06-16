<?php
// +----------------------------------------------------------------------
// | 07FLYCRM [基于ThinkPHP5.0开发]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2021 http://www.07fly.xyz
// +----------------------------------------------------------------------
// | Professional because of focus  Persevering because of happiness
// +----------------------------------------------------------------------
// | Author: 开发人生 <goodkfrs@qq.com>
// +----------------------------------------------------------------------

namespace app\admin\model;

/**
 * 模块模型
 */
class SysModule extends AdminBase
{

    /**
     * 模块状态
     * @param string $key
     * @return array|mixed
     * Author: lingqifei created by at 2020/6/3 0003
     */
    public function status($key = '')
    {
        $data = array(
            "0" => array(
                'name' => '未安装',
                'html' => '<span class="label label-warning">未安装<span>',
                'action' => array(
                    '0' => array(
                        'url' => url('install'),
                        'class' => 'ajax-get',
                        'color' => '#27c24c',
                        'name' => '安装'
                    ),
                    '1' => array(
                        'url' => url('del'),
                        'class' => 'ajax-del confirm',
                        'color' => '#F05050',
                        'name' => '删除'
                    ),
                ),
            ),
            "1" => array(
                'name' => '已安装',
                'html' => '<span class="label label-info">已安装<span>',
                'action' => array(
                    '0' => array(
                        'url' => url('uninstall'),
                        'class' => 'ajax-get confirm',
                        'color' => '#23b7e5',
                        'name' => '卸载'
                    ),
                ),
            ),
        );
        return (array_key_exists($key, $data)) ? $data[$key] : $data;
    }

    /**
     * 创建模块目录=》模块默认的目录
     * 目录名称：'controller', 'logic', 'model', 'service', 'validate', 'data', 'view'
     * @param $module
     * @return string
     * Author: lingqifei created by at 2020/6/4 0004
     */
    public function createModuleDir($path, $module_name)
    {
        //模块目录
        $module_dir = $path . $module_name . DS;
        !is_dir($module_dir) && mkdir($module_dir, 0755, true);

        //模块子目录
        $dir_list = ['controller', 'logic', 'model', 'service', 'validate', 'data', 'view'];
        foreach ($dir_list as $dir_name) {
            $action_dir = $module_dir . $dir_name;
            !is_dir($action_dir) && mkdir($action_dir, 0755, true);
        }
        //2、移动模板文件（从/app/admin/data/mdtpl）复制过去
        $tpl_list = [
            'controller/Base.tpl',
            'logic/Base.tpl',
            'model/Base.tpl',
            'service/Base.tpl',
            'validate/Base.tpl',
            'controller/Index.tpl',
            'logic/Index.tpl',
            'model/Index.tpl',
            'validate/Index.tpl',
            'view',
            'common.php',
            'config.php',
        ];

        $modulename = strtolower($module_name);//转为小写
        $modulenameUc = ucwords(strtolower($module_name));//转为小写,首字母大写

        //替换为创建模块名称信息
        $reaplce = [
            'spacename' => $modulename,
            'modulename' => $modulename,
            'ModuleBase' => $modulenameUc . 'Base',
            'datetime' => date('Y-m-d H:i:s', time()),
        ];

        //循环升级包移动文件
        $file = new \lqf\File();
        foreach ($tpl_list as $filepath) {
            $source = PATH_APP . 'admin' . DS . 'data' . DS . 'mdtpl' . DS . $filepath;//源位置
            $target = $module_dir . $filepath;
            $target = str_replace('Base.tpl', $modulenameUc . 'Base.php', $target);//转为基础文件
            $target = str_replace('.tpl', '.php', $target);//转为php
            dlog('<hr>' . $source . '=>' . $target);
            if (file_exists($source)) {
                if (!is_dir($source)) {
                    //替换配置参数
                    $content = file_get_contents($source);
                    foreach ($reaplce as $name => $value) {
                        $content = str_replace("[{$name}]", $value, $content);
                    }
                    file_put_contents($target, $content);
                    //$file->handle_file($source, $topath, 'copy', true);
                } else {
                    $file->handle_dir($source, $target, 'copy', true);
                }
            }

        }
//        //模块子目录
//        $dir_list = ['controller', 'logic', 'model', 'service', 'validate'];
//        foreach ($dir_list as $dir_name) {
//            $action_dir = $module_dir . DS . $dir_name;
//            !is_dir($action_dir) && mkdir($action_dir, 0755, true);
//            //$this->mkModuleDirFile(['name' => $module_name, 'dirname' => $dir_name, 'path' => $path]);
//        }
//        //模板目录
//        $view_dir = $module_dir . DS . 'view';
//        !is_dir($view_dir) && mkdir($view_dir, 0755, true);
//
//        //数据目录
//        $data_dir = $module_dir . DS . 'data';
//        !is_dir($data_dir) && mkdir($data_dir, 0755, true);
        return true;
    }

    /**
     * 生成模块=>目录信息文件
     * param ['name'=>'模块名称','dirnamr'=>'目录名称','path'=>'模块路径',]
     * 文件路径：/app/name/dirname/nameBase.php
     * @author lingqifei <364666827@qq.com>
     */
    public function mkModuleDirFile($data = [])
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
* ----------------------------------------------
* 零起飞网络 - 专注于企业管理系统开发
* 以质量求生存，以服务谋发展，以信誉创品牌 !
* ----------------------------------------------
* @copyright Copyright (C) 2017-2022 07FLY Network Technology Co,LTD.
* @license For licensing, see LICENSE.html or http://www.07fly.xyz/html/business
* @author ：kfrs <goodkfrs@QQ.com> 574249366
* @version ：1.1.0
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

        $filename = $data['path'] . $name_lo . '/' . $action_lo . '/' . $name_uc . "Base.php";
        return file_put_contents($filename, $config);

    }


    /**
     * 生成模块=》/app/name/data/info.php文件
     * @param array $data
     * @param $module_dir
     * @return bool|int
     * Author: 开发人生 goodkfrs@qq.com
     * Date: 2022/1/5 0005 17:31
     */
    public function mkModuleInfo($data = [], $module_dir)
    {
        // 配置内容
        $config = <<<INFO
<?php
// +----------------------------------------------------------------------
// | 07FLYCRM系统 [基于ThinkPHP5.0开发]
// +----------------------------------------------------------------------
// | Copyright (c) 2016-2021 http://www.07fly.xyz
// +----------------------------------------------------------------------
// |  以质量求生存，以服务谋发展，以信誉创品牌 !
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
     * 模块的栏目导出
     * 1、生成模块的栏目信息
     * 2、把生成的格式写入配置文件
     * @param $modulename
     * @param $module_dir
     * Author: lingqifei created by at 2020/6/4 0004
     */
    public function exportModuleMenu($modulename, $module_dir)
    {
        $module_dir = $module_dir . 'data' . DS;
        !is_dir($module_dir) && mkdir($module_dir, 0755, true);
        $menus = $this->logicSysMenu->sysMenuExport($modulename);
        $content = json_encode($menus, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
        //file_put_contents($module_dir . 'menu.php', $content);
        file_put_contents($module_dir . 'menu.json', $content);//新的json文件

    }

    /**
     * 模块=》菜单栏目导入
     * @param $modulename 模块名
     * @param $module_dir 目录
     * @return array|void
     * @author: 开发人生 goodkfrs@qq.com
     * @Time: 2022/12/28 16:32
     */
    public function importModuleMenu($modulename, $module_dir)
    {
        $module_menu = $module_dir . DS . 'data' . DS . 'menu.php';
        $module_menu_json = $module_dir . DS . 'data' . DS . 'menu.json';
        //存在json文件使用json文件，兼容以前后缀为php文件
        if (file_exists($module_menu_json)) {
            $module_menu = $module_menu_json;
        }
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
     * 数据库文件执行导入
     * @param array $param ['module_dir'=>'','sqlfile'=>'install.sql']
     * @return array|bool
     * Author: kfrs <goodkfrs@QQ.com> created by at 2020/9/14 0014
     */
    public function importModuleSqlExec($param = [])
    {
        header('Content-Type:application/json; charset=utf-8');

        if (!isset($param['part']) && !isset($param['start'])) {

            $module_table_file = $param['module_dir']  .DS. $param['sqlfile'];
            if (!file_exists($module_table_file)) {
                throw_response_error($module_table_file . '文件不存在,跳过数据导入步骤！');
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
     * 导出模块表=》导出到文件
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

        file_put_contents($module_table_path . $param['sqlfilename'] . '-' . DATA_NORMAL . '.sql', '');//重新备份文件

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
     * 数据表备份=》步骤2
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
     * 应用表中模块是否存在和启用
     * @param $table
     * @return bool
     * Author: 开发人生 goodkfrs@qq.com
     * Date: 2021/6/18 0018 17:00
     */
    public function appModuleIsEnable($appname)
    {
        $condition['name'] = $appname;
        $condition['visible'] = 1;
        $module = $this->modelSysModule->getValue($condition, 'name');
        if (file_exists($module)) {
            return true;
        } else {
            return false;
        }
    }


    /**
     * 同步=>数据表结构
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

    /**
     * 同步=>菜单栏目功能=》1步
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


    /**
     * 同步=>菜单栏目功能=》2步=》同步更新栏目数据，增加不存的栏目数据
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
